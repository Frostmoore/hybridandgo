<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include_once 'conn.php';

$sqlid = "SELECT MAX(id) FROM documenti";
$result = $con->query($sqlid);
$row = $result->fetch_array();
$latestid = $row[0];
$currentid = (int)$latestid + 1;

if (!isset($_POST['agenzia_id_documenti'])) {
    die('Accesso Negato');
}

// Main.Run()
if (isset($_POST['agenzia_id_documenti'])) {
    richiestadocumenti($_POST, $_FILES, $currentid, $con, $mail_username, $mail_password);
} else {
    die('Accesso Negato');
}

// Func denuncia sinistro AUTO
function richiestadocumenti($post, $files, $currentid, $conn, $mail_username, $mail_password)
{
    // Gestione $_POST e creazione variabili
    $id = $currentid;
    $nome = $post['cognome_documenti'] . ' ' . $post['primo_nome_documenti'];
    $email = $post['email_documenti'];
    $descrizione = $post['descrizione_documenti'];
    $agenzia_id = $post['agenzia_id_documenti'];
    $data_denuncia = date('d/m/Y');
    $denuncia_mail = $post['denuncia_mail_documenti'];

    $zip = new ZipArchive();
    $zip_file_name = 'sinistri/' . date('Ymd') . '-' . $id . '-' . 'documentazione.zip';
    if ($zip->open($zip_file_name, ZipArchive::CREATE) === true) {
        // Declare counters
        $j = 0;

        // Declare iteratables
        $documenti_documenti = $files['documenti_documenti'];

        // Add files to Archive
        // TODO: Sanitize FILES input
        foreach ($documenti_documenti['tmp_name'] as $doc) {
            $xp = explode('.', $documenti_documenti['name'][(int)$j]);
            $ext = end($xp);
            $zip->addFile($doc, 'DOCUMENTI-' . $j . '.' . $ext);
            $j += 1;
        }
        $zip->close();
        //var_dump($zip_file_name);

        // DB Call
        $privacy = $_POST['checkbox_privacy_documenti'];

        $stmt = $conn->prepare("INSERT INTO documenti (id, id_agenzia, nome_denuncia, email_denuncia, documenti_denuncia, data_denuncia, descrizione_denuncia, privacy_denuncia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $currentid, $agenzia_id, $nome, $email, $zip_file_name, $data_denuncia, $descrizione, $privacy);
        $stmt->execute();
        $stmt->close();

        // Send e-mail
        $to = $denuncia_mail;
        $from = $email;
        $fromname = 'Caricamento Documenti';
        $subject = 'Nuovo Documento caricato da ' . $nome;
        $attachment_file = $zip_file_name;
        $body_contents = '
        <h2><strong>NUOVO DOCUMENTO CARICATO</strong></h2>
        <p><strong>Richiedente</strong>: ' . $nome . '</p>
        <p><strong>e-mail Richiedente</strong>: <a href="mailto:' . $email . '">' . $email . '</a></p>
        <p><strong>Data Richiesta</strong>: ' . $data_denuncia . '</p>
        <p><strong>Descrizione</strong>: </p>
        <p>' . $descrizione . '</p>
        <p><strong>In allegato, la documentazione presentata dal richiedente.</strong></p>
        ';
        $headers = 'From: ' . $fromname . '<' . $email . '>';

        // PHPMailer setup and send
        $mail = new PHPMailer;
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Host = "smtps.aruba.it";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = $mail_username;
        $mail->Password = $mail_password;
        $mail->setFrom('r.ronconi@smp-digital.it', $fromname); // Cambiare FROM
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body_contents;
        $mail->AltBody = 'Messaggi HTML non supportati';
        $mail->addAttachment($zip_file_name);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        if (!$mail->send()) {
            echo "Errore PHPMailer: " . $mail->ErrorInfo;
        } else {
            echo "<h2>Complimenti!</h2>";
            echo "<p>Hai inoltrato il tuo documento.<br />Verrai contattato al più presto da un nostro consulente!</p>";
        }
    }
}