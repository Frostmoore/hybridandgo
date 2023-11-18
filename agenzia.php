<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
require_once "res/conn.php";

$agenzie = [];
$agenzia = [];
$id = $_GET['id'];

$sql = "SELECT * FROM `agenzie` WHERE `id`=" . $id;
$result = $con->query($sql);
$agenzia = $result->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">

    <title><?= $agenzia["nome"]; ?></title>

    <link href="res/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1>GSV - Agenzie</h1>
            <a href="#"><?= $_SESSION['name']; ?></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <div class="page">
        <h1><?= $agenzia["nome"]; ?></h1>
        <!--ID-->
        <p>ID: <strong><?= $agenzia["id"]; ?></strong></p>
    </div>
    <div class="container-age">
        <div class="row">
            <form action="res/updateagenzia.php" method="POST" enctype="multipart/form-data">
                <div class="col-sm agenzia">
                    <!--Cover-->
                    <img src="<?php echo ($agenzia["logo"] == "placeholder") ? "https://loremflickr.com/512/256" : "res/" . $agenzia["cover"]; ?>" class="cover" width="1000" height="523" />
                    <!--Logo-->
                    <img src="<?php echo ($agenzia["logo"] == "placeholder") ? "https://loremflickr.com/128/128" : "res/" . $agenzia["logo"]; ?>" class="logo" style="width: 20%;" />
                    </br></br>
                    <div class="mb-3 corto">
                        <label for="logo" class="form-label"><strong>Logo dell'Agenzia:</strong></label>
                        <input class="form-control" type="file" id="logo" name="logo">
                        <small id="logohelp" class="form-text text-muted">Carica un solo file .png di dimensione 1024x1024x7MB.</small>
                    </div>
                    </br></br>
                    <div class="mb-3 corto">
                        <label for="cover" class="form-label"><strong>Cover dell'Agenzia:</strong></label>
                        <input class="form-control" type="file" id="cover" name="cover">
                        <small id="coverhelp" class="form-text text-muted">Carica un solo file .png di dimensione massima 2400x1256x14MB.</small>
                    </div>
                    </br></br>
                    <!--API Key-->
                    <div class="mb-3 corto">
                        <label for="api_key" class="form-label"><strong>API Key dell'Agenzia</strong></label>
                        <input class="form-control" type="text" id="api-key" name="api-key" value="<?= $agenzia["api_key"] ?>">
                        <small id="apikeyhelp" class="form-text text-muted">Chiave API da inserire in fase di creazione dell'App.</small>
                    </div>
                    <!--Orari-->
                    <p><strong>Orari:</strong></p>
                    <input type="text" class="form-control corto" id="orari" name="orari" value="<?= $agenzia["orari"] ?>">
                    <small id="orarihelp" class="form-text text-muted">Inserisci gli Orari separando ogni riga con un ?.</small>
                    </br></br>
                    <!--Email-->
                    <p><strong>Email:</strong></p>
                    <input type="text" class="form-control corto" id="email" name="email" value="<?= $agenzia["email"]; ?>">
                    <small id="emailhelp" class="form-text text-muted">Inserisci i vari indirizzi e-mail separandoli con un ?.</small>
                    </br></br>
                    <!--Telefono-->
                    <p><strong>Telefono:</strong></p>
                    <input type="text" class="form-control corto" id="telefono" name="telefono" value="<?= $agenzia["telefono"]; ?>">
                    <small id="telefonohelp" class="form-text text-muted">Inserisci i vari numeri di telefono separandoli con un ?.</small>
                    </br></br>
                    <!--Social-->
                    <p><strong>Social:</strong></p>
                    <input type="text" class="form-control corto" id="social" name="social" value="<?= $agenzia["social"]; ?>">
                    <small id="socialhelp" class="form-text text-muted">Inserisci gli indirizzi dei vari social separandoli con uno spazio.</small>
                    </br></br>
                    <!--Colori-->
                    <p><strong>Colori:</strong></p>
                    <div>
                        <?php
                        $colori = explode(" ", $agenzia["colori"]);
                        foreach ($colori as $colore) {
                            echo "<span class='quadrato', style='display:inline-block;background-color:" . $colore = trim($colore) . ";position:relative;'></span>";
                        }
                        ?>
                    </div>
                    <input type="text" class="form-control corto" id="colori" name="colori" value="<?= $agenzia["colori"]; ?>">
                    <small id="colorihelp" class="form-text text-muted">Inserisci i codici hex dei colori principali dell'app separandoli con uno spazio.</small>
                    </br></br>
                    <!--Indirizzi-->
                    <p><strong>Indirizzi:</strong></p>
                    <input type="text" class="form-control corto" id="indirizzo" name="indirizzo" value="<?= $agenzia["indirizzo"]; ?>">
                    <small id="indirizzihelp" class="form-text text-muted">Inserisci gli indirizzi delle varie sedi separandole con un ?.</small>
                    </br></br>
                    <!--Mappa-->
                    <p><strong>Geolocation:</strong></p>
                    <input type="text" class="form-control corto" id="geolocation" name="geolocation" value="<?= $agenzia["geolocation"]; ?>">
                    <small id="geolocationhelp" class="form-text text-muted">Inserisci le coordinate geografiche delle varie sedi separandole con uno spazio.</small>
                    </br></br>
                    <!--Immagini-->
                    <p style="margin-top: 20px;"><strong>Galleria:</strong></p>
                    <?php
                    $immagini = explode(" ", $agenzia["immagini"]);
                    foreach ($immagini as $immagine) {
                        if ($immagine == "placeholder") {
                            echo "<img src='https://loremflickr.com/128/128' class='gallery' />";
                        } else {
                            echo "<img src='" . "res/" . $immagine . "' class='gallery' />";
                        }
                    }
                    ?>
                    <div class="mb-3 corto">
                        <input class="form-control" type="file" id="immagini" name="immagini[]" multiple>
                        <small id="immaginihelp" class="form-text text-muted">Carica quanti file .png desideri, di dimensione massima 2160x2160x30MB.</small>
                    </div>
                    <input type="text" style="display: none;" id="id" name="id" value="<?= $agenzia["id"]; ?>">
                    <button type="submit" class="btn btn-outline-success" style="margin-bottom:30px; width:100%; position:relative; transform:translatex(-50%); left: 50%;">Modifica</button>
                    <!-- TEST <a href=""><img src="assets/plus.png"></a> -->
                </div>
            </form>
        </div>
    </div>
</body>

</html>