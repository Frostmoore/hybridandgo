<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

require_once "conn.php";

// Fetch the id of the latest entry in agenzie.
$sqlid = "SELECT MAX(id) FROM agenzie";
$result = $con->query($sqlid);
$row = $result->fetch_array();

// These are the latest id entry and the current id entry in the table.
$latestid = $row[0];
$currentid = (int)$latestid + 1;

/* 

- UPLOAD SYSTEM -
- Changes to make -

-- Change slashes

*/

// Define app assets directory
$dir = "img\\" . $currentid . "\\"; // Change slash if in prod on linux

// Create app assets directory if not exists
if (!file_exists("img\\" . $currentid)) { // Change slash if in prod on linux
    mkdir("img\\" . $currentid); // Change slash if in prod on linux
}

// Allowed file types for images
$allowedTypes = ["image/png", "image/x-png"];

// Upload Logo
if (!isset($_FILES["logo_agenzia"])) {
    die("Non è stato caricato alcun file nel campo Logo. Il Logo è un elemento obbligatorio.");
} else {

    // Define Variables
    $logoPath = $_FILES["logo_agenzia"]["tmp_name"];
    $logoDimensions = @getimagesize($logoPath);
    $logoWidth = $logoDimensions[0];
    $logoHeight = $logoDimensions[1];
    $logoSize = filesize($logoPath);
    $logoInfo = finfo_open(FILEINFO_MIME_TYPE);
    $logoType = finfo_file($logoInfo, $logoPath);

    // Check File Size
    if ($logoSize === 0) {
        die("Il file Logo è vuoto.");
    } elseif ($logoSize > 8145728) {
        die("Il Logo che hai caricato è troppo pesante. Max 7MB.");
    }

    // Check File Type
    if (!in_array($logoType, $allowedTypes)) {
        die("Questo tipo di file non è consentito per il Logo.");
    }

    // Check File Dimensions
    if ($logoWidth > 1024) {
        die("Il tuo Logo è troppo largo.");
    }

    if ($logoHeight > 1024) {
        die("Il tuo Logo è troppo alto.");
    }

    // Upload File
    if ($_FILES["logo_agenzia"]["error"] > 0) {
        echo "Error: " . $_FILES["logo_agenzia"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["logo_agenzia"]["tmp_name"], $dir . "logo_agenzia.png");

        /* PATH TO logo_agenzia */
        $logo_agenzia = $dir . "logo_agenzia.png";
    }
}


// Upload Cover
if (!isset($_FILES["header_agenzia"])) {
    die("Non è stato caricato alcun file nel capo Cover. La Cover è un elemento obbligatorio.");
} else {

    // Define Variables
    $coverPath = $_FILES["header_agenzia"]["tmp_name"];
    $coverDimensions = @getimagesize($coverPath);
    $coverWidth = $coverDimensions[0];
    $coverHeight = $coverDimensions[1];
    $coverSize = filesize($coverPath);
    $coverInfo = finfo_open(FILEINFO_MIME_TYPE);
    $coverType = finfo_file($coverInfo, $coverPath);

    // Check File Size
    if ($coverSize === 0) {
        die("Il file Cover è vuoto.");
    } elseif ($coverSize > 16145728) {
        die("La Cover che hai caricato è troppo pesante. Max 14MB.");
    }

    // Check File Type
    if (!in_array($coverType, $allowedTypes)) {
        die("Questo tipo di file non è consentito per la Cover.");
    }

    // Check File Dimensions
    if ($coverWidth > 2400) {
        die("La tua cover è troppo larga.");
    }

    if ($coverHeight > 1256) {
        die("La tua cover è troppo alta.");
    }

    // Upload File
    if ($_FILES["header_agenzia"]["error"] > 0) {
        echo "Error: " . $_FILES["header_agenzia"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["header_agenzia"]["tmp_name"], $dir . "header_agenzia.png");

        /* PATH TO header_agenzia */
        $header_agenzia = $dir . "header_agenzia.png";
    }
}

// Generate API Key
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ?^!ç°§*|';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Fetch form data and create variables.
/*$nome = $_POST["nome"];
$geolocation = $_POST["geolocation"];
$indirizzo = $_POST["indirizzo"];
$social = $_POST["social"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$orari = $_POST["orari"];
$colori = $_POST["colori"];
$api_key = generateRandomString();*/

// Sezione 1
$nome_app = $_POST["nome_app"];
$nome_agenzia = $_POST["nome_agenzia"];
$logo_agenzia = $_POST["logo_agenzia"];
$header_agenzia = $_POST["header_agenzia"];
// Sezione 2
$facebook_agenzia = $_POST["facebook_agenzia"];
$instagram_agenzia = $_POST["instagram_agenzia"];
$linkedin_agenzia = $_POST["linkedin_agenzia"];
$google_agenzia = $_POST["google_agenzia"];
$sito_agenzia = $_POST["sito_agenzia"];
// Sezione 3
$info_titolo = $_POST["info_titolo"];
$info_immagine = $_POST["info_immagine"];
$info_nomi_sedi = $_POST["info_nomi_sedi"];
$info_indirizzi_sedi = $_POST["info_indirizzi_sedi"];
$info_testo_orari = $_POST["info_testo_orari"];
$info_orari_sedi = $_POST["info_orari_sedi"];
$info_recensioni_sedi = $_POST["info_recensioni_sedi"];
$info_telefono_sedi = $_POST["info_telefono_sedi"];
$info_email_sedi = $_POST["info_email_sedi"];
$info_mappa_sedi = $_POST["info_mappa_sedi"];
$info_sito_sedi = $_POST["info_sito_sedi"];
// Sezione 4
$notifica_titolo = $_POST["notifica_titolo"];
$notifica_testo = $_POST["notifica_testo"];
$notifica_link = $_POST["notifica_link"];
// Sezione 5
$contatti_immagine = $_POST["contatti_immagine"];
$contatti_titolo = $_POST["contatti_titolo"];
$contatti_testo = $_POST["contatti_testo"];
$numeri_utili_labels = $_POST["numeri_utili_labels"];
$numeri_utili_colori = $_POST["numeri_utili_colori"];
$numeri_utili_link = $_POST["numeri_utili_link"];
// Sezione 6
$denuncia_immagine = $_POST["denuncia_immagine"];
$denuncia_titolo = $_POST["denuncia_titolo"];
$denuncia_testo = $_POST["denuncia_testo"];
$denuncia_testo_grassetto = $_POST["denuncia_testo_grassetto"];
// Sezione 7
$quick_telefono = $_POST["quick_telefono"];
$quick_whatsapp = $_POST["quick_whatsapp"];
$quick_email = $_POST["quick_email"];
// Sezione 8
$attiva = $_POST["attiva"];
// Sezione 9
$token = generateRandomString();





// TEST
/*echo $nome . "</br>";
echo $geolocation . "</br>";
echo $indirizzo . "</br>";
echo $social . "</br>";
echo $email . "</br>";
echo $telefono . "</br>";
echo $orari . "</br>";
echo $colori . "</br>";
echo $logo . "</br>";
echo $cover . "</br>";
echo $immagini . "</br>";*/

// DB INSERTS
$stmt = $con->prepare("INSERT INTO agenzie_new (id, nome_app, nome_agenzia, logo_agenzia, header_agenzia, colori, facebook_agenzia, instagram_agenzia, linkedin_agenzia, google_agenzia, sito_agenzia, info_titolo, info_immagine, info_nomi_sedi, info_indirizzi_sedi, info_testo_orari, info_orari_sedi, info_recensioni_sedi, info_telefono_sedi, info_email_sedi, info_mappa_sedi, info_sito_sedi, notifica_titolo, notifica_testo, notifica_link, contatti_immagine, contatti_titolo, contatti_testo, numeri_utili_labels, numeri_utili_colori, numeri_utili_link, denuncia_immagine, denuncia_titolo, denuncia_testo, denuncia_testo_grassetto, quick_telefono, quick_whatsapp, quick_email, attiva, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssss", $currentid, $nome_app, $nome_agenzia, $logo_agenzia, $header_agenzia, $colori, $facebook_agenzia, $instagram_agenzia, $linkedin_agenzia, $google_agenzia, $sito_agenzia, $info_titolo, $info_immagine, $info_nomi_sedi, $info_indirizzi_sedi, $info_testo_orari, $info_orari_sedi, $info_recensioni_sedi, $info_telefono_sedi, $info_email_sedi, $info_mappa_sedi, $info_sito_sedi, $notifica_titolo, $notifica_testo, $notifica_link, $contatti_immagine, $contatti_titolo, $contatti_testo, $numeri_utili_labels, $numeri_utili_colori, $numeri_utili_link, $denuncia_immagine, $denuncia_titolo, $denuncia_testo, $denuncia_testo_grassetto, $quick_telefono, $quick_whatsapp, $quick_email, $attiva, $token);
$stmt->execute();
$stmt->close();
//$con->close();
header("refresh:3; url=..\\home.php");
