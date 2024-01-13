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

// Upload Immagine Info
if (!isset($_FILES["info_immagine"])) {
    die("Non è stato caricato alcun file nel capo Cover. La Cover è un elemento obbligatorio.");
} else {

    // Define Variables
    $info_immaginePath = $_FILES["info_immagine"]["tmp_name"];
    $info_immagineDimensions = @getimagesize($info_immaginePath);
    $info_immagineWidth = $info_immagineDimensions[0];
    $info_immagineHeight = $info_immagineDimensions[1];
    $info_immagineSize = filesize($info_immaginePath);
    $info_immagineInfo = finfo_open(FILEINFO_MIME_TYPE);
    $info_immagineType = finfo_file($info_immagineInfo, $info_immaginePath);

    // Check File Size
    if ($info_immagineSize === 0) {
        die("Il file Immagine Info è vuoto.");
    } elseif ($info_immagineSize > 16145728) {
        die("La Immagine Info che hai caricato è troppo pesante. Max 14MB.");
    }

    // Check File Type
    if (!in_array($info_immagineType, $allowedTypes)) {
        die("Questo tipo di file non è consentito per la Immagine Info.");
    }

    // Check File Dimensions
    if ($info_immagineWidth > 2400) {
        die("La tua Immagine Info è troppo larga.");
    }

    if ($info_immagineHeight > 1256) {
        die("La tua Immagine Info è troppo alta.");
    }

    // Upload File
    if ($_FILES["info_immagine"]["error"] > 0) {
        echo "Error: " . $_FILES["info_immagine"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["info_immagine"]["tmp_name"], $dir . "info_immagine.png");

        /* PATH TO Immagine Infoe */
        $info_immagine = $dir . "info_immagine.png";
    }
}

// Upload Immagine Contatti
if (!isset($_FILES["contatti_immagine"])) {
    die("Non è stato caricato alcun file nel capo Cover. La Cover è un elemento obbligatorio.");
} else {

    // Define Variables
    $contatti_immaginePath = $_FILES["contatti_immagine"]["tmp_name"];
    $contatti_immagineDimensions = @getimagesize($contatti_immaginePath);
    $contatti_immagineWidth = $contatti_immagineDimensions[0];
    $contatti_immagineHeight = $contatti_immagineDimensions[1];
    $contatti_immagineSize = filesize($contatti_immaginePath);
    $contatti_immagineInfo = finfo_open(FILEINFO_MIME_TYPE);
    $contatti_immagineType = finfo_file($contatti_immagineInfo, $contatti_immaginePath);

    // Check File Size
    if ($contatti_immagineSize === 0) {
        die("Il file Immagine Contatti è vuoto.");
    } elseif ($contatti_immagineSize > 16145728) {
        die("La Immagine Contatti che hai caricato è troppo pesante. Max 14MB.");
    }

    // Check File Type
    if (!in_array($contatti_immagineType, $allowedTypes)) {
        die("Questo tipo di file non è consentito per la Immagine Contatti.");
    }

    // Check File Dimensions
    if ($contatti_immagineWidth > 2400) {
        die("La tua Immagine Contatti è troppo larga.");
    }

    if ($contatti_immagineHeight > 1256) {
        die("La tua Immagine Contatti è troppo alta.");
    }

    // Upload File
    if ($_FILES["contatti_immagine"]["error"] > 0) {
        echo "Error: " . $_FILES["contatti_immagine"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["contatti_immagine"]["tmp_name"], $dir . "contatti_immagine.png");

        /* PATH TO Immagine Contattie */
        $contatti_immagine = $dir . "contatti_immagine.png";
    }
}

// Upload Immagine Denuncia Sinistro
if (!isset($_FILES["denuncia_immagine"])) {
    die("Non è stato caricato alcun file nel capo Cover. La Cover è un elemento obbligatorio.");
} else {

    // Define Variables
    $denuncia_immaginePath = $_FILES["denuncia_immagine"]["tmp_name"];
    $denuncia_immagineDimensions = @getimagesize($denuncia_immaginePath);
    $denuncia_immagineWidth = $denuncia_immagineDimensions[0];
    $denuncia_immagineHeight = $denuncia_immagineDimensions[1];
    $denuncia_immagineSize = filesize($denuncia_immaginePath);
    $denuncia_immagineInfo = finfo_open(FILEINFO_MIME_TYPE);
    $denuncia_immagineType = finfo_file($denuncia_immagineInfo, $denuncia_immaginePath);

    // Check File Size
    if ($denuncia_immagineSize === 0) {
        die("Il file Immagine Denuncia Sinistro è vuoto.");
    } elseif ($denuncia_immagineSize > 16145728) {
        die("La Immagine Denuncia Sinistro che hai caricato è troppo pesante. Max 14MB.");
    }

    // Check File Type
    if (!in_array($denuncia_immagineType, $allowedTypes)) {
        die("Questo tipo di file non è consentito per la Immagine Denuncia Sinistro.");
    }

    // Check File Dimensions
    if ($denuncia_immagineWidth > 2400) {
        die("La tua Immagine Denuncia Sinistro è troppo larga.");
    }

    if ($denuncia_immagineHeight > 1256) {
        die("La tua Immagine Denuncia Sinistro è troppo alta.");
    }

    // Upload File
    if ($_FILES["denuncia_immagine"]["error"] > 0) {
        echo "Error: " . $_FILES["denuncia_immagine"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["denuncia_immagine"]["tmp_name"], $dir . "denuncia_immagine.png");

        /* PATH TO Immagine Denuncia Sinistroe */
        $denuncia_immagine = $dir . "denuncia_immagine.png";
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
//$logo_agenzia = $_POST["logo_agenzia"];
//$header_agenzia = $_POST["header_agenzia"];
$colori = $_POST["colori"];
// Sezione 2
$facebook_agenzia = $_POST["facebook_agenzia"];
$instagram_agenzia = $_POST["instagram_agenzia"];
$linkedin_agenzia = $_POST["linkedin_agenzia"];
$google_agenzia = $_POST["google_agenzia"];
$sito_agenzia = $_POST["sito_agenzia"];
// Sezione 3
$info_titolo = $_POST["info_titolo"];
//$info_immagine = $_POST["info_immagine"];
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
//$contatti_immagine = $_POST["contatti_immagine"];
$contatti_titolo = $_POST["contatti_titolo"];
$contatti_testo = $_POST["contatti_testo"];
$numeri_utili_labels = $_POST["numeri_utili_labels"];
$numeri_utili_colori = $_POST["numeri_utili_colori"];
$numeri_utili_link = $_POST["numeri_utili_link"];
// Sezione 6
//$denuncia_immagine = $_POST["denuncia_immagine"];
$denuncia_titolo = $_POST["denuncia_titolo"];
$denuncia_testo = $_POST["denuncia_testo"];
$denuncia_testo_grassetto = $_POST["denuncia_testo_grassetto"];
// Sezione 7
$quick_telefono = $_POST["quick_telefono"];
$quick_whatsapp = $_POST["quick_whatsapp"];
$quick_email = $_POST["quick_email"];
// Sezione 8
$denuncia_mail = $_POST['denuncia_mail'];
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
$stmt = $con->prepare("INSERT INTO agenzie_new (id, nome_app, nome_agenzia, logo_agenzia, header_agenzia, colori, facebook_agenzia, instagram_agenzia, linkedin_agenzia, google_agenzia, sito_agenzia, info_titolo, info_immagine, info_nomi_sedi, info_indirizzi_sedi, info_testo_orari, info_orari_sedi, info_recensioni_sedi, info_telefono_sedi, info_email_sedi, info_mappa_sedi, info_sito_sedi, notifica_titolo, notifica_testo, notifica_link, contatti_immagine, contatti_titolo, contatti_testo, numeri_utili_labels, numeri_utili_colori, numeri_utili_link, denuncia_immagine, denuncia_titolo, denuncia_testo, denuncia_testo_grassetto, quick_telefono, quick_whatsapp, quick_email, attiva, token, denuncia_mail) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssssssssssssssssssssssssssssssss", $currentid, $nome_app, $nome_agenzia, $logo_agenzia, $header_agenzia, $colori, $facebook_agenzia, $instagram_agenzia, $linkedin_agenzia, $google_agenzia, $sito_agenzia, $info_titolo, $info_immagine, $info_nomi_sedi, $info_indirizzi_sedi, $info_testo_orari, $info_orari_sedi, $info_recensioni_sedi, $info_telefono_sedi, $info_email_sedi, $info_mappa_sedi, $info_sito_sedi, $notifica_titolo, $notifica_testo, $notifica_link, $contatti_immagine, $contatti_titolo, $contatti_testo, $numeri_utili_labels, $numeri_utili_colori, $numeri_utili_link, $denuncia_immagine, $denuncia_titolo, $denuncia_testo, $denuncia_testo_grassetto, $quick_telefono, $quick_whatsapp, $quick_email, $attiva, $token, $denuncia_mail);
$stmt->execute();
$stmt->close();
//$con->close();
header("refresh:3; url=..\\home.php");
