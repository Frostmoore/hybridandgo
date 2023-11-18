<?php
require_once "res/conn.php";

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['nomeutente'], $_POST['password'], $_POST['email'])) {
    // Could not get the data that should have been sent.
    exit('Per favore, completa il form di registrazione!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['nomeutente']) || empty($_POST['password']) || empty($_POST['email'])) {
    // One or more values are empty.
    exit('Per favore, completa il form di registrazione!');
}
// We need to check if the account with that username exists.
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Questa email non è valida!');
}
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8) {
    exit('La lunghezza della password deve essere inclusa tra gli 8 e i 20 caratteri!');
}
if ($stmt = $con->prepare('SELECT id, password FROM utenti WHERE nomeutente = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
    $stmt->bind_param('s', $_POST['nomeutente']);
    $stmt->execute();
    $stmt->store_result();
    // Store the result so we can check if the account exists in the database.
    if ($stmt->num_rows > 0) {
        // Username already exists
        echo 'Questo nome utente è già in uso, scegline un altro!';
    } else {
        // Username doesn't exists, insert new account
        if ($stmt = $con->prepare('INSERT INTO utenti (nomeutente, password, email, activation_code) VALUES (?, ?, ?, ?)')) {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $uniqid = uniqid();
            $stmt->bind_param('ssss', $_POST['nomeutente'], $password, $_POST['email'], $uniqid);
            $stmt->execute();

            $from    = 'noreply@gsv.com';
            $subject = 'Attivazione Account';
            $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";

            // Update the activation variable below
            $activate_link = 'http://gsv.com/phplogin/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
            $message = '<p>Clicca su questo link per attivare il tuo account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
            mail($_POST['email'], $subject, $message, $headers);
            echo 'Controlla la tua email per attivare il tuo account!';
        } else {
            // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all three fields.
            echo 'Could not prepare statement!';
        }
    }
    $stmt->close();
} else {
    // Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
    echo 'Could not prepare statement!';
}
$con->close();
