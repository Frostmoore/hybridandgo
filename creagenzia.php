<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <title>Crea Agenzia</title>

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
        <h1>Nuova Agenzia</h1>
    </div>
    <div class="container-age">
        <div class="row">
            <div class="col">
                <form action="res/nuovagenzia.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome Agenzia</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Inserisci il Nome della nuova Agenzia">
                        <small id="nomehelp" class="form-text text-muted">Questo sarà il nome utilizzato anche per l'applicazione</small>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="geolocation">Coordinate Geografiche</label>
                        <input type="text" class="form-control" id="geolocation" name="geolocation" placeholder="Inserisci le coordinate geografiche delle varie sedi dell'agenzia, separate da uno spazio. Es.: '42.242249,12.3484909 42.242301,12.3513665'">
                        <small id="geolocationhelp" class="form-text text-muted">Verranno utilizzate per generare le mappe sull'app.</small>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="indirizzo">Indirizzi delle Sedi</label>
                        <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="Inserisci gli indirizzi delle varie sedi dell'agenzia separate da un ?. Es.: 'Via dell'alloro, 34 - Roma?Via del Tritone, 21'">
                        <small id="indirizzohelp" class="form-text text-muted">Verranno elencati sull'applicazione.</small>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="social">Profili Social</label>
                        <input type="text" class="form-control" id="social" name="social" placeholder="Inserisci i profili social dell'agenzia separati da uno spazio. Es.: 'https://www.facebook.com/tizio_caio www.instagram.com/tizio_caio/'">
                        <small id="socialhelp" class="form-text text-muted">Verranno utilizzati per generare i collegamenti social sull'app.</small>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Inserisci gli indirizzi e-mail dell'agenzia separati da un?. Es.: 'tizio@caio.it?mariorossi@sever.com'">
                        <small id="emailhelp" class="form-text text-muted">Verranno utilizzati per generare il form di contatto e la sezione contatti dell'app.</small>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="telefono">Contatti Telefonici</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Inserisci i contatti telefonici dell'agenzia separati da un ?. Es.: 'Mario Rossi: 3331234564?Fabio Neri: 3358842617'">
                        <small id="telefonohelp" class="form-text text-muted">Verranno utilizzate per la chiamata diretta e per generare la sezione contatti dell'app.</small>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="orari">Orari di Apertura</label>
                        <input type="text" class="form-control" id="orari" name="orari" placeholder="Inserisci gli orari di apertura delle varie sedi, separando ogni riga con un ?. Es.: 'Dal lunedì al venerdì: 08:30-12:30 / 15:00-18:30?Sabato e domenica: Chiusi'">
                        <small id="orarihelp" class="form-text text-muted">Verranno elencati sull'applicazione.</small>
                    </div>
                    </br>
                    <div class="form-group">
                        <label for="colori">Colori App</label>
                        <input type="text" class="form-control" id="colori" name="colori" placeholder="Inserisci i codici colore Hex per l'applicazione, separati da uno spazio. Es.: '#F08968 #43a5be #5c62d6'">
                        <small id="colorihelp" class="form-text text-muted">Verranno utilizzati per generare i colori principali delle pagine dell'app.</small>
                    </div>
                    </br>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo dell'Agenzia</label>
                        <input class="form-control" type="file" id="logo" name="logo">
                        <small id="logohelp" class="form-text text-muted">Carica un solo file .png di dimensione 1024x1024x7MB.</small>
                    </div>
                    </br>
                    <div class="mb-3">
                        <label for="cover" class="form-label">Cover dell'Agenzia</label>
                        <input class="form-control" type="file" id="cover" name="cover">
                        <small id="coverhelp" class="form-text text-muted">Carica un solo file .png di dimensione massima 2400x1256x14MB.</small>
                    </div>
                    </br>
                    <div class="mb-3">
                        <label for="immagini" class="form-label">Foto-gallery dell'Agenzia</label>
                        <input class="form-control" type="file" id="immagini" name="immagini[]" multiple>
                        <small id="immaginihelp" class="form-text text-muted">Carica quanti file .png desideri, di dimensione massima 2160x2160x30MB.</small>
                    </div>
                    </br>
                    <button type="submit" class="btn btn-outline-success" style="margin-bottom:30px; width:100%; position:relative; transform:translatex(-50%); left: 50%;">Crea</button>
                    </br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>