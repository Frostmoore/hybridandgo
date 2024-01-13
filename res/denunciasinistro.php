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

if (isset($_POST['agenzia_id_auto'])) {
    denunciaAuto($_POST, $_FILES, $currentid);
} else {
    denunciaNonAuto($_POST, $_FILES, $currentid);
}

function denunciaAuto($post, $files, $currentid)
{
    // Gestione $_POST e creazione variabili
    $id = $currentid;
    $nome = $post['cognome_denuncia_auto'] . ' ' . $post['primo_nome_denuncia_auto'];
    $email = $post['email_denuncia_auto'];
    $descrizione = $post['descrizione_denuncia_auto'];
    $agenzia_id = $post['agenzia_id_auto'];
    $tipo = 'auto';
    $cai_denuncia = $files['cai_denuncia_auto'];
    $documenti_denuncia = $files['documenti_denuncia_auto'];
    $immagini_denuncia = $files['immagini_denuncia_auto'];
    $data_denuncia = date('d/m/Y');

    // Echo data TEST
    echo '<strong>ID Sinistro</strong>: ' . $id . '<br />';
    echo '<strong>Data Denuncia</strong>: ' . $data_denuncia . '<br />';
    echo '<strong>Nome</strong>: ' . $nome . '<br />';
    echo '<strong>E-Mail</strong>: ' . $email . '<br />';
    echo '<strong>Tipo di Sinistro</strong>: ' . $tipo . '<br />';
    echo '<strong>Descrizione Sinistro</strong>: ' . $descrizione . '<br />';
    echo '<strong>ID Agenzia</strong>: ' . $agenzia_id . '<br />';
    echo '<strong>CAI</strong>: ' . $cai_denuncia['tmp_name'][0] . '<br />';
    echo '<strong>Documenti</strong>: ' . $documenti_denuncia['tmp_name'][0] . '<br />';
    echo '<strong>Immagini</strong>: ' . $immagini_denuncia['tmp_name'][0] . '<br />';

    $zip = new ZipArchive();
    $zip_file_name = 'sinistri/' . date('Ymd') . '-' . $id . '-' . 'documentazione.zip';
    if ($zip->open($zip_file_name, ZipArchive::CREATE) === true) {
        $i = 0;
        $j = 0;
        $k = 0;

        //var_dump($files['cai_denuncia_auto']);
        //print_r($files['cai_denuncia_auto']['tmp_name']);
        $cai_denuncia_auto = $files['cai_denuncia_auto'];
        $documenti_denuncia_auto = $files['documenti_denuncia_auto'];
        $immagini_denuncia_auto = $files['immagini_denuncia_auto'];
        print_r($cai_denuncia_auto['name'][$i]);

        foreach ($cai_denuncia_auto['tmp_name'] as $cai) {
            $xp = explode('.', $cai_denuncia_auto['name'][(int)$i]);
            $ext = end($xp);
            $zip->addFile($cai, 'CAI-' . $i . '.' . $ext);
            echo $cai . '<br />';
            $i += 1;
        }

        foreach ($documenti_denuncia_auto['tmp_name'] as $doc) {
            $xp = explode('.', $documenti_denuncia_auto['name'][(int)$j]);
            $ext = end($xp);
            $zip->addFile($doc, 'DOCUMENTI-' . $j . '.' . $ext);
            echo $doc . '<br />';
            $j += 1;
        }

        foreach ($immagini_denuncia_auto['tmp_name'] as $ima) {
            $xp = explode('.', $immagini_denuncia_auto['name'][(int)$k]);
            $ext = end($xp);
            $zip->addFile($ima, 'IMMAGINI-' . $k . '.' . $ext);
            echo $ima . '<br />';
            $k += 1;
        }
        $zip->close();
    }
}

function denunciaNonAuto($post, $files, $currentid)
{
    print_r($post);
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="res/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

</html>