<?php
include_once 'conn.php';

$sqlid = "SELECT MAX(id) FROM sinistri";
$result = $con->query($sqlid);
$row = $result->fetch_array();
$latestid = $row[0];
$currentid = (int)$latestid + 1;

if (!isset($_POST['agenzia_id_auto']) && !isset($_POST['agenzia_id_nonauto'])) {
    die('Accesso Negato');
}

// Main.Run()
if (isset($_POST['agenzia_id_auto'])) {
    denunciaAuto($_POST, $_FILES, $currentid, $con);
} else {
    denunciaNonAuto($_POST, $_FILES, $currentid, $con);
}

// Func denuncia sinistro AUTO
function denunciaAuto($post, $files, $currentid, $conn)
{
    // Gestione $_POST e creazione variabili
    $id = $currentid;
    $nome = $post['cognome_denuncia_auto'] . ' ' . $post['primo_nome_denuncia_auto'];
    $email = $post['email_denuncia_auto'];
    $descrizione = $post['descrizione_denuncia_auto'];
    $agenzia_id = $post['agenzia_id_auto'];
    $tipo = 'auto';
    $data_denuncia = date('d/m/Y');

    // Echo data TEST
    // echo '<strong>ID Sinistro</strong>: ' . $id . '<br />';
    // echo '<strong>Data Denuncia</strong>: ' . $data_denuncia . '<br />';
    // echo '<strong>Nome</strong>: ' . $nome . '<br />';
    // echo '<strong>E-Mail</strong>: ' . $email . '<br />';
    // echo '<strong>Tipo di Sinistro</strong>: ' . $tipo . '<br />';
    // echo '<strong>Descrizione Sinistro</strong>: ' . $descrizione . '<br />';
    // echo '<strong>ID Agenzia</strong>: ' . $agenzia_id . '<br />';
    // echo '<strong>CAI</strong>: ' . $cai_denuncia['tmp_name'][0] . '<br />';
    // echo '<strong>Documenti</strong>: ' . $documenti_denuncia['tmp_name'][0] . '<br />';
    // echo '<strong>Immagini</strong>: ' . $immagini_denuncia['tmp_name'][0] . '<br />';

    $zip = new ZipArchive();
    $zip_file_name = 'sinistri/' . date('Ymd') . '-' . $id . '-' . 'documentazione.zip';
    if ($zip->open($zip_file_name, ZipArchive::CREATE) === true) {
        // Declare counters
        $i = 0;
        $j = 0;
        $k = 0;

        // Declare iteratables
        $cai_denuncia_auto = $files['cai_denuncia_auto'];
        $documenti_denuncia_auto = $files['documenti_denuncia_auto'];
        $immagini_denuncia_auto = $files['immagini_denuncia_auto'];
        //print_r($cai_denuncia_auto['name'][$i]);

        // Add files to Archive
        foreach ($cai_denuncia_auto['tmp_name'] as $cai) {
            $xp = explode('.', $cai_denuncia_auto['name'][(int)$i]);
            $ext = end($xp);
            $zip->addFile($cai, 'CAI-' . $i . '.' . $ext);
            //echo $cai . '<br />';
            $i += 1;
        }

        foreach ($documenti_denuncia_auto['tmp_name'] as $doc) {
            $xp = explode('.', $documenti_denuncia_auto['name'][(int)$j]);
            $ext = end($xp);
            $zip->addFile($doc, 'DOCUMENTI-' . $j . '.' . $ext);
            //echo $doc . '<br />';
            $j += 1;
        }

        foreach ($immagini_denuncia_auto['tmp_name'] as $ima) {
            $xp = explode('.', $immagini_denuncia_auto['name'][(int)$k]);
            $ext = end($xp);
            $zip->addFile($ima, 'IMMAGINI-' . $k . '.' . $ext);
            //echo $ima . '<br />';
            $k += 1;
        }
        $zip->close();
        //var_dump($zip_file_name);

        // DB Call
        $privacy = $_POST['checkbox_privacy_auto'];

        $stmt = $conn->prepare("INSERT INTO SINISTRI (id, id_agenzia, nome_denuncia, tipo_sinistro, email_denuncia, documenti_denuncia, data_denuncia, descrizione_denuncia, privacy_denuncia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $currentid, $agenzia_id, $nome, $tipo, $email, $zip_file_name, $data_denuncia, $descrizione, $privacy);
        $stmt->execute();
        $stmt->close();
        header('refresh=1; url=./success.html');
    }
}

// Func denuncia sinistro NON AUTO
function denunciaNonAuto($post, $files, $currentid, $conn)
{
    // Gestione $_POST e creazione variabili
    $id = $currentid;
    $nome = $post['cognome_denuncia_nonauto'] . ' ' . $post['primo_nome_denuncia_nonauto'];
    $email = $post['email_denuncia_nonauto'];
    $descrizione = $post['descrizione_denuncia_nonauto'];
    $agenzia_id = $post['agenzia_id_nonauto'];
    $tipo = 'nonauto';
    $data_denuncia = date('d/m/Y');

    $zip = new ZipArchive();
    $zip_file_name = 'sinistri/' . date('Ymd') . '-' . $id . '-' . 'documentazione.zip';
    if ($zip->open($zip_file_name, ZipArchive::CREATE) === true) {
        // Declare counters
        $i = 0;
        $j = 0;
        $k = 0;

        // Declare iteratables
        $documenti_denuncia_nonauto = $files['documenti_denuncia_nonauto'];
        $immagini_denuncia_nonauto = $files['immagini_denuncia_nonauto'];
        //print_r($cai_denuncia_nonauto['name'][$i]);

        // Add files to Archive
        foreach ($documenti_denuncia_nonauto['tmp_name'] as $doc) {
            $xp = explode('.', $documenti_denuncia_nonauto['name'][(int)$j]);
            $ext = end($xp);
            $zip->addFile($doc, 'DOCUMENTI-' . $j . '.' . $ext);
            //echo $doc . '<br />';
            $j += 1;
        }

        foreach ($immagini_denuncia_nonauto['tmp_name'] as $ima) {
            $xp = explode('.', $immagini_denuncia_nonauto['name'][(int)$k]);
            $ext = end($xp);
            $zip->addFile($ima, 'IMMAGINI-' . $k . '.' . $ext);
            //echo $ima . '<br />';
            $k += 1;
        }
        $zip->close();
        //var_dump($zip_file_name);

        // DB Call
        $privacy = $_POST['checkbox_privacy_nonauto'];

        $stmt = $conn->prepare("INSERT INTO SINISTRI (id, id_agenzia, nome_denuncia, tipo_sinistro, email_denuncia, documenti_denuncia, data_denuncia, descrizione_denuncia, privacy_denuncia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $currentid, $agenzia_id, $nome, $tipo, $email, $zip_file_name, $data_denuncia, $descrizione, $privacy);
        $stmt->execute();
        $stmt->close();
        header('refresh=1; url=./success.html');
    }
}
