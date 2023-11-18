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
if (!isset($_FILES["logo"])) {
    die("Non è stato caricato alcun file nel campo Logo. Il Logo è un elemento obbligatorio.");
} else {

    // Define Variables
    $logoPath = $_FILES["logo"]["tmp_name"];
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
    if ($_FILES["logo"]["error"] > 0) {
        echo "Error: " . $_FILES["logo"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["logo"]["tmp_name"], $dir . "logo.png");

        /* PATH TO LOGO */
        $logo = $dir . "logo.png";
    }
}


// Upload Cover
if (!isset($_FILES["cover"])) {
    die("Non è stato caricato alcun file nel capo Cover. La Cover è un elemento obbligatorio.");
} else {

    // Define Variables
    $coverPath = $_FILES["cover"]["tmp_name"];
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
    if ($_FILES["cover"]["error"] > 0) {
        echo "Error: " . $_FILES["cover"]["error"] . "<br />";
    } else {
        move_uploaded_file($_FILES["cover"]["tmp_name"], $dir . "cover.png");

        /* PATH TO COVER */
        $cover = $dir . "cover.png";
    }
}

// Upload Gallery
$count = 0;
$imgpaths = [];

if (!isset($_FILES["immagini"])) {
    $imgpaths = ["placeholder", "placeholder", "placeholder"];
} else {
    foreach ($_FILES["immagini"]["name"] as $immagine) {

        // Define Variables
        $imgPath = $_FILES["immagini"]["tmp_name"][$count];
        $imgDimensions = @getimagesize($imgPath);
        $imgWidth = $imgDimensions[0];
        $imgHeight = $imgDimensions[1];
        $imgSize = filesize($imgPath);
        $imgInfo = finfo_open(FILEINFO_MIME_TYPE);
        $imgType = finfo_file($imgInfo, $imgPath);

        // Check File Size
        if ($imgSize === 0) {
            die("L'immagine n. " . $count . " è vuota.");
        } elseif ($imgSize > 45145728) {
            die("L'immagine n. " . $count . " è troppo pesante. Max 30MB.");
        }

        // Check File Type
        if (!in_array($imgType, $allowedTypes)) {
            die("Il tipo di file per l'immagine n. " . $count . " non è consentito.");
        }

        // Check File Dimensions
        if ($imgWidth > 2160) {
            die("L'immagine n. " . $count . " è troppo larga.");
        }

        if ($imgHeight > 2160) {
            die("L'immagine n. " . $count . " è troppo alta.");
        }

        // Upload Files
        if ($_FILES["immagini"]["error"][$count] > 0) {
            die("Error: " . $count . ":" . $_FILES["immagini"]["error"][$count] . "<br />");
        } else {
            move_uploaded_file($_FILES["immagini"]["tmp_name"][$count], $dir . $count . ".png");
            array_push($imgpaths, $dir . $count . ".png");
            $count = $count + 1;
        }
    }

    /* PATH TO IMAGES */
    $immagini = implode(" ", $imgpaths);
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
$nome = $_POST["nome"];
$geolocation = $_POST["geolocation"];
$indirizzo = $_POST["indirizzo"];
$social = $_POST["social"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$orari = $_POST["orari"];
$colori = $_POST["colori"];
$api_key = generateRandomString();

// TEST
echo $nome . "</br>";
echo $geolocation . "</br>";
echo $indirizzo . "</br>";
echo $social . "</br>";
echo $email . "</br>";
echo $telefono . "</br>";
echo $orari . "</br>";
echo $colori . "</br>";
echo $logo . "</br>";
echo $cover . "</br>";
echo $immagini . "</br>";

// DB INSERTS
$stmt = $con->prepare("INSERT INTO agenzie (id, nome, geolocation, indirizzo, social, email, telefono, orari, colori, logo, cover, immagini, api_key) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssss", $currentid, $nome, $geolocation, $indirizzo, $social, $email, $telefono, $orari, $colori, $logo, $cover, $immagini, $api_key);
$stmt->execute();
$stmt->close();
//$con->close();
header("refresh:3; url=..\\home.php");
