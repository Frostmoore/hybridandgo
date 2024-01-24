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

$sql = "SELECT * FROM `agenzie_new` WHERE `id`=" . $id;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        <h1><?= $agenzia["nome_agenzia"]; ?></h1>
        <!--ID-->
        <p>ID: <strong><?= $agenzia["id"]; ?></strong></p>
    </div>
    <div class="container-age">
        <div class="row">
            <!--Cover-->
            <img src="<?php echo ($agenzia["header_agenzia"] == "placeholder") ? "https://loremflickr.com/512/256" : "res/" . $agenzia["header_agenzia"]; ?>" class="cover" width="1000" height="523" />
            <!--Logo-->
            <img src="<?php echo ($agenzia["logo_agenzia"] == "placeholder") ? "https://loremflickr.com/128/128" : "res/" . $agenzia["logo_agenzia"]; ?>" class="logo" style="width: 20%;" />
            </br></br>
            <h1 style="text-align:center;margin-bottom: 35px;">Modifica l'Agenzia <?= $agenzia['nome_agenzia']; ?></h1>
            </br></br>
            <form action="res/updateagenzia.php" method="POST" enctype="multipart/form-data">
                <h4 class="errore" id="errore"></h4>
                <div class="step1" id="step1">
                    <h2>Step n. 1: Generali</h2>
                    <div class="form-group">
                        <label for="nome_app">Nome Applicazione</label>
                        <input type="text" class="form-control" id="nome_app" name="nome_app" value="<?= $agenzia['nome_app']; ?>">
                        <small id="nomeapphelp" class="form-text text-muted">Questo sarà il nome utilizzato per l'applicazione</small>
                    </div>
                    <div class="form-group">
                        <label for="nome_agenzia">Nome Agenzia</label>
                        <input type="text" class="form-control" id="nome_agenzia" name="nome_agenzia" value="<?= $agenzia['nome_agenzia']; ?>">
                        <small id=" nomeagenziahelp" class="form-text text-muted">Questo sarà il nome utilizzato per l'Agenzia</small>
                    </div>
                    <div class="rowbottone">
                        <button type="button" class="bottone_next" id="bottone1" onclick="muovitiAvanti('1')">AVANTI</button>
                    </div>
                </div>
                <div class="step2 a_hidden" id="step2">
                    <h2>Step n. 2: Social</h2>
                    <div class="form-group">
                        <label for="facebook_agenzia">Indirizzo Facebook</label>
                        <input type="text" class="form-control" id="facebook_agenzia" name="facebook_agenzia" value="<?= $agenzia['facebook_agenzia']; ?>">
                        <small id="facebook_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo Facebook del tasto sotto il logo</small>
                    </div>
                    <div class="form-group">
                        <label for="instagram_agenzia">Indirizzo Instagram</label>
                        <input type="text" class="form-control" id="instagram_agenzia" name="instagram_agenzia" value="<?= $agenzia['instagram_agenzia']; ?>">
                        <small id="instagram_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo Instagram del tasto sotto il logo</small>
                    </div>
                    <div class="form-group">
                        <label for="linkedin_agenzia">Indirizzo LinkedIn</label>
                        <input type="text" class="form-control" id="linkedin_agenzia" name="linkedin_agenzia" value="<?= $agenzia['linkedin_agenzia']; ?>">
                        <small id="linkedin_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo LinkedIn del tasto sotto il logo</small>
                    </div>
                    <div class="form-group">
                        <label for="google_agenzia">Indirizzo Google Places</label>
                        <input type="text" class="form-control" id="google_agenzia" name="google_agenzia" value="<?= $agenzia['google_agenzia']; ?>">
                        <small id="google_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo Google Places del tasto sotto il logo</small>
                    </div>
                    <div class="form-group">
                        <label for="sito_agenzia">Indirizzo Sito Web</label>
                        <input type="text" class="form-control" id="sito_agenzia" name="sito_agenzia" value="<?= $agenzia['sito_agenzia']; ?>">
                        <small id="sito_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo Sito Web del tasto sotto il logo</small>
                    </div>
                    <div class="rowbottone">
                        <button type="button" class="bottone_previous" id="indietro2" onclick="muovitiIndietro('2')">INDIETRO</button>
                        <button type="button" class="bottone_next" id="bottone2" onclick="muovitiAvanti('2')">AVANTI</button>
                    </div>
                </div>
                <div class="step3 a_hidden" id="step3">
                    <h2>Step n. 3: Blocco Info</h2>
                    <div class="form-group">
                        <label for="info_titolo">Titolo della sezione Info</label>
                        <input type="text" class="form-control" id="info_titolo" name="info_titolo" value="<?= $agenzia['info_titolo']; ?>">
                        <small id="info_titolohelp" class="form-text text-muted">Questo sarà il titolo della sezione Info dell'Applicazione</small>
                    </div>
                    <div class="form-group">
                        <label for="info_nomi_sedi">Nomi delle varie Sedi</label>
                        <input type="text" class="form-control" id="info_nomi_sedi" name="info_nomi_sedi" value="<?= $agenzia['info_nomi_sedi']; ?>">
                        <small id="info_nomi_sedihelp" class="form-text text-muted">Separa i nomi usando un |</small>
                    </div>
                    <div class="form-group">
                        <label for="info_indirizzi_sedi">Indirizzi delle varie Sedi</label>
                        <input type="text" class="form-control" id="info_indirizzi_sedi" name="info_indirizzi_sedi" value="<?= $agenzia['info_indirizzi_sedi']; ?>">
                        <small id="info_indirizzi_sedihelp" class="form-text text-muted">Separa gli indirizzi usando un |</small>
                    </div>
                    <div class="form-group">
                        <label for="info_testo_orari">Testo sopra gli orari di apertura</label>
                        <input type="text" class="form-control" id="info_testo_orari" name="info_testo_orari" value="<?= $agenzia['info_testo_orari']; ?>">
                        <small id="info_testo_orarihelp" class="form-text text-muted">Separa i testi usando un |</small>
                    </div>
                    <div class="form-group">
                        <label for="info_orari_sedi">Orari di apertura delle varie Sedi</label>
                        <input type="textarea" class="form-control" id="info_orari_sedi" name="info_orari_sedi" value="<?= $agenzia['info_orari_sedi']; ?>">
                        <small id="info_orari_sedihelp" class="form-text text-muted">Separa gli orari usando un |, se vuoi andare a capo potrai usare la shortcut "\n"</small>
                    </div>
                    <div class="form-group">
                        <label for="info_recensioni_sedi">Link per la recensione delle sedi</label>
                        <input type="text" class="form-control" id="info_recensioni_sedi" name="info_recensioni_sedi" value="<?= $agenzia['info_recensioni_sedi']; ?>">
                        <small id="info_recensioni_sedihelp" class="form-text text-muted">Separa i link usando un |</small>
                    </div>
                    <div class="form-group">
                        <label for="info_telefono_sedi">Numeri di Telefono delle varie sedi</label>
                        <input type="text" class="form-control" id="info_telefono_sedi" name="info_telefono_sedi" value="<?= $agenzia['info_telefono_sedi']; ?>">
                        <small id="info_telefono_sedihelp" class="form-text text-muted">Scrivilo nel formato internazionale (+393333333333). Separa i numeri usando un |</small>
                    </div>
                    <div class="form-group">
                        <label for="info_email_sedi">Indirizzi e-mail delle varie sedi</label>
                        <input type="text" class="form-control" id="info_email_sedi" name="info_email_sedi" value="<?= $agenzia['info_email_sedi']; ?>">
                        <small id="info_email_sedihelp" class="form-text text-muted">Separa gli indirizzi usando un |</small>
                    </div>
                    <div class="form-group">
                        <label for="info_mappa_sedi">Indirizzo Google Places delle varie sedi</label>
                        <input type="text" class="form-control" id="info_mappa_sedi" name="info_mappa_sedi" value="<?= $agenzia['info_mappa_sedi']; ?>">
                        <small id="info_mappa_sedihelp" class="form-text text-muted">Separa gli indirizzi usando un |</small>
                    </div>
                    <div class="form-group">
                        <label for="info_sito_sedi">Indirizzo web delle varie sedi</label>
                        <input type="text" class="form-control" id="info_sito_sedi" name="info_sito_sedi" value="<?= $agenzia['info_sito_sedi']; ?>">
                        <small id="info_sito_sedihelp" class="form-text text-muted">Separa gli indirizzi usando un |</small>
                    </div>
                    <div class="rowbottone">
                        <button type="button" class="bottone_previous" id="indietro3" onclick="muovitiIndietro('3')">INDIETRO</button>
                        <button type="button" class="bottone_next" id="bottone3" onclick="muovitiAvanti('3')">AVANTI</button>
                    </div>
                </div>
                <div class="step4 a_hidden" id="step4">
                    <h2>Step n. 4: Area di Notifica</h2>
                    <div class="form-group">
                        <label for="notifica_titolo">Inserisci il titolo dell'area di notifica</label>
                        <input type="text" class="form-control" id="notifica_titolo" name="notifica_titolo" value="<?= $agenzia['notifica_titolo']; ?>">
                        <small id="notifica_titolohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                    </div>
                    <div class="form-group">
                        <label for="notifica_testo">Inserisci il testo della notifica</label>
                        <input type="textarea" class="form-control" id="notifica_testo" name="notifica_testo" value="<?= $agenzia['notifica_testo']; ?>">
                        <small id="notifica_testohelp" class="form-text text-muted"> </small>
                    </div>
                    <div class="form-group">
                        <label for="notifica_link">Inserisci il link della notifica</label>
                        <input type="text" class="form-control" id="notifica_link" name="notifica_link" value="<?= $agenzia['notifica_link']; ?>">
                        <small id="notifica_linkhelp" class="form-text text-muted">Sarà il link del tasto "Scopri di più"</small>
                    </div>
                    <div class="rowbottone">
                        <button type="button" class="bottone_previous" id="indietro4" onclick="muovitiIndietro('4')">INDIETRO</button>
                        <button type="button" class="bottone_next" id="bottone4" onclick="muovitiAvanti('4')">AVANTI</button>
                    </div>
                </div>
                <div class="step5 a_hidden" id="step5">
                    <h2>Step n. 5: Sezione Contatti e Numeri Utili</h2>
                    <div class="form-group">
                        <label for="contatti_titolo">Inserisci il titolo della sezione Contatti</label>
                        <input type="text" class="form-control" id="contatti_titolo" name="contatti_titolo" value="<?= $agenzia['contatti_titolo']; ?>">
                        <small id="contatti_titolohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                    </div>
                    <div class="form-group">
                        <label for="numeri_utili_labels">Inserisci i testi da riportare sui pulsanti dei numeri utili</label>
                        <input type="text" class="form-control" id="numeri_utili_labels" name="numeri_utili_labels" value="<?= $agenzia['numeri_utili_labels']; ?>">
                        <small id="numeri_utili_labelshelp" class="form-text text-muted">Inserisci l'etichetta di ciascun pulsante, separandole con un | e tenendo presente che l'ordine sarà il seguente: salute, assistenza stradale, noleggio</small>
                    </div>
                    <div class="form-group">
                        <label for="numeri_utili_colori">Inserisci i colori di ciascun tasto</label>
                        <input type="text" class="form-control" id="numeri_utili_colori" name="numeri_utili_colori" value="<?= $agenzia['numeri_utili_colori']; ?>">
                        <small id="numeri_utili_colorihelp" class="form-text text-muted">Inserisci i colori di ciascun pulsante, separandoli con un | e tenendo presente che l'ordine sarà il seguente: salute, assistenza stradale, noleggio. I colori dovranno essere espressi nel formato 0xffffffff</small>
                    </div>
                    <div class="form-group">
                        <label for="numeri_utili_salute">Inserisci i numeri di "Salute"</label>
                        <input type="text" class="form-control" id="numeri_utili_salute" name="numeri_utili_salute" value="<?= $agenzia['numeri_utili_salute']; ?>">
                        <small id="numeri_utili_salutehelp" class="form-text text-muted">Inserisci i link di ciascun pulsante, separandoli con un |</small>
                    </div>
                    <div class="form-group">
                        <label for="numeri_utili_assistenza">Inserisci i numeri di "Assistenza Stradale"</label>
                        <input type="text" class="form-control" id="numeri_utili_assistenza" name="numeri_utili_assistenza" value="<?= $agenzia['numeri_utili_assistenza']; ?>">
                        <small id="numeri_utili_assistenzahelp" class="form-text text-muted">Inserisci i link di ciascun pulsante, separandoli con un |</small>
                    </div>
                    <div class="form-group">
                        <label for="numeri_utili_noleggio">Inserisci i numeri di "Noleggio Auto"</label>
                        <input type="text" class="form-control" id="numeri_utili_noleggio" name="numeri_utili_noleggio" value="<?= $agenzia['numeri_utili_noleggio']; ?>">
                        <small id="numeri_utili_noleggiohelp" class="form-text text-muted">Inserisci i link di ciascun pulsante, separandoli con un |</small>
                    </div>
                    <div class="rowbottone">
                        <button type="button" class="bottone_previous" id="indietro5" onclick="muovitiIndietro('5')">INDIETRO</button>
                        <button type="button" class="bottone_next" id="bottone5" onclick="muovitiAvanti('5')">AVANTI</button>
                    </div>
                </div>
                <div class="step6 a_hidden" id="step6">
                    <h2>Step n. 6: Sezione "Denuncia un Sinistro"</h2>
                    <!-- <div class="mb-3">
                        <label for="denuncia_immagine" class="form-label">Immagine di fondo della sezione "Denuncia un Sinistro"</label>
                        <input class="form-control" type="file" id="denuncia_immagine" name="denuncia_immagine">
                        <small id="denuncia_immaginehelp" class="form-text text-muted">Carica un solo file .png delle dimensioni che preferisci, ma con un rapporto di 6:1.</small>
                    </div> -->
                    <div class="form-group">
                        <label for="denuncia_titolo">Inserisci il titolo della sezione "Denuncia un Sinistro"</label>
                        <input type="text" class="form-control" id="denuncia_titolo" name="denuncia_titolo" value="<?= $agenzia['denuncia_titolo']; ?>">
                        <small id="denuncia_titolohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                    </div>
                    <div class="form-group">
                        <label for="denuncia_testo_grassetto">Inserisci il testo in grassetto della sezione "Denuncia un Sinistro"</label>
                        <input type="text" class="form-control" id="denuncia_testo_grassetto" name="denuncia_testo_grassetto" value="<?= $agenzia['denuncia_testo_grassetto']; ?>">
                        <small id="denuncia_testo_grassettohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                    </div>
                    <div class="form-group">
                        <label for="preventivo_titolo">Inserisci il titolo della sezione "Preventivo"</label>
                        <input type="text" class="form-control" id="preventivo_titolo" name="preventivo_titolo" value="<?= $agenzia['preventivo_titolo']; ?>">
                        <small id="preventivo_titolohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                    </div>
                    <div class="form-group">
                        <label for="preventivo_testo_grassetto">Inserisci il testo in grassetto della sezione "Preventivo"</label>
                        <input type="text" class="form-control" id="preventivo_testo_grassetto" name="preventivo_testo_grassetto" value="<?= $agenzia['preventivo_testo_grassetto']; ?>">
                        <small id="preventivo_testo_grassettohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                    </div>
                    <div class="rowbottone">
                        <button type="button" class="bottone_previous" id="indietro6" onclick="muovitiIndietro('6')">INDIETRO</button>
                        <button type="button" class="bottone_next" id="bottone6" onclick="muovitiAvanti('6')">AVANTI</button>
                    </div>
                </div>
                <div class="step7 a_hidden" id="step7">
                    <h2>Step n. 7: Sezione Contatti Rapidi</h2>
                    <div class="form-group">
                        <label for="quick_telefono">Inserisci il numero di telefono per le chiamate rapide</label>
                        <input type="text" class="form-control" id="quick_telefono" name="quick_telefono" value="<?= $agenzia['quick_telefono']; ?>">
                        <small id="quick_telefonohelp" class="form-text text-muted"> </small>
                    </div>
                    <div class="form-group">
                        <label for="quick_whatsapp">Inserisci il link WhatsApp per le chiamate rapide</label>
                        <input type="text" class="form-control" id="quick_whatsapp" name="quick_whatsapp" value="<?= $agenzia['quick_whatsapp']; ?>">
                        <small id="quick_whatsapphelp" class="form-text text-muted">Inserisci il "Call Link" di WhatsApp Business</small>
                    </div>
                    <div class="form-group">
                        <label for="quick_email">Inserisci l'email per le chiamate rapide</label>
                        <input type="text" class="form-control" id="quick_email" name="quick_email" value="<?= $agenzia['quick_email']; ?>">
                        <small id="quick_emailhelp" class="form-text text-muted"> </small>
                    </div>
                    <div class="rowbottone">
                        <button type="button" class="bottone_previous" id="indietro7" onclick="muovitiIndietro('7')">INDIETRO</button>
                        <button type="button" class="bottone_next" id="bottone7" onclick="muovitiAvanti('7')">AVANTI</button>
                    </div>
                </div>
                <div class="step8 a_hidden" id="step8">
                    <h2>Ultimo Sep: Attivare l'agenzia</h2>
                    <div class="form-group">
                        <label for="denuncia_mail">Inserisci l'email per le Denunce di Sinistro</label>
                        <input type="text" class="form-control" id="denuncia_mail" name="denuncia_mail" placeholder="E-mail per le denunce di sinistro">
                        <small id="denuncia_mailhelp" class="form-text text-muted"> </small>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="attiva" name="attiva" value="<?= $agenzia['attiva']; ?>">
                        <label for="attiva">Attivare l'Agenzia?</label><br>
                        <small id="attivahelp" class="form-text text-muted">Potrai disabilitarla in qualunque momento</small>
                    </div>
                    <div class="rowbottone">
                        <input type="text" class="a_hidden" value="<?= $agenzia['id'] ?>" name="id" id="id">
                        <button type="button" class="bottone_previous" id="indietro8" onclick="muovitiIndietro('8')">INDIETRO</button>
                        <button class="bottone_next" id="bottone8">MODIFICA</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
</body>

<script>
    // BUTTONS NEXT
    var bottone1 = $("#bottone1");
    var bottone2 = $("#bottone2");
    var bottone3 = $("#bottone3");
    var bottone4 = $("#bottone4");
    var bottone5 = $("#bottone5");
    var bottone6 = $("#bottone6");
    var bottone7 = $("#bottone7");
    var bottone8 = $("#bottone8");

    // BUTTONS PREVIOUS
    var indietro2 = $("#indietro2");
    var indietro3 = $("#indietro3");
    var indietro4 = $("#indietro4");
    var indietro5 = $("#indietro5");
    var indietro6 = $("#indietro6");
    var indietro7 = $("#indietro7");
    var indietro8 = $("#indietro8");

    // SEZIONI
    var step1 = $("#step1");
    var step2 = $("#step2");
    var step3 = $("#step3");
    var step4 = $("#step4");
    var step5 = $("#step5");
    var step6 = $("#step6");
    var step7 = $("#step7");
    var step8 = $("#step8");

    // FORM ELEMENTS
    var form = $("#formcrea");
    var errore = $("#errore");
    //// Step 1
    var nome_app = $("#nome_app");
    var nome_agenzia = $("#nome_agenzia");
    var logo_agenzia = $("#logo_agenzia");
    var header_agenzia = $("#header_agenzia");
    var colori = $("#colori");
    //// Step 2
    var facebook_agenzia = $("#facebook_agenzia");
    var instagram_agenzia = $("#instagram_agenzia");
    var linkedin_agenzia = $("#linkedin_agenzia");
    var google_agenzia = $("#google_agenzia");
    var sito_agenzia = $("#sito_agenzia");
    //// Step 3
    var info_titolo = $("#info_titolo");
    var info_immagine = $("#info_immagine");
    var info_nomi_sedi = $("#info_nomi_sedi");
    var info_indirizzi_sedi = $("#info_indirizzi_sedi");
    var info_testo_orari = $("#info_testo_orari");
    var info_orari_sedi = $("#info_orari_sedi");
    var info_recensioni_sedi = $("#info_recensioni_sedi");
    var info_telefono_sedi = $("#info_telefono_sedi");
    var info_email_sedi = $("#info_email_sedi");
    var info_mappa_sedi = $("#info_mappa_sedi");
    var info_sito_sedi = $("#info_sito_sedi");
    //// Step 4
    var notifica_titolo = $("#notifica_titolo");
    var notifica_testo = $("#notifica_testo");
    var notifica_link = $("#notifica_link");
    //// Step 5
    var contatti_immagine = $("#contatti_immagine");
    var contatti_titolo = $("#contatti_titolo");
    var contatti_testo = $("#contatti_testo");
    var numeri_utili_labels = $("#numeri_utili_labels");
    var numeri_utili_colori = $("#numeri_utili_colori");
    var numeri_utili_link = $("#numeri_utili_link");
    //// Step 6
    var denuncia_immagine = $("#denuncia_immagine");
    var denuncia_titolo = $("#denuncia_titolo");
    var denuncia_testo = $("#denuncia_testo");
    var denuncia_testo_grassetto = $("#denuncia_testo_grassetto");
    //// Step 7
    var quick_telefono = $("#quick_telefono");
    var quick_whatsapp = $("#quick_whatsapp");
    var quick_email = $("#quick_email");
    //// Step 8
    var attiva = $("#attiva");

    // FUNZIONE AVANTI
    function muovitiAvanti(location) {
        switch (location) {
            case '1':
                step1.addClass("a_hidden");
                step2.removeClass("a_hidden");
                break;
            case '2':
                step2.addClass("a_hidden");
                step3.removeClass("a_hidden");
                break;
            case '3':
                step3.addClass("a_hidden");
                step4.removeClass("a_hidden");
                break;
            case '4':
                step4.addClass("a_hidden");
                step5.removeClass("a_hidden");
                break;
            case '5':
                step5.addClass("a_hidden");
                step6.removeClass("a_hidden");
                break;
            case '6':
                step6.addClass("a_hidden");
                step7.removeClass("a_hidden");
                break;
            case '7':
                step7.addClass("a_hidden");
                step8.removeClass("a_hidden");
                break;
        }
    }

    // FUNZIONE INDIETRO
    function muovitiIndietro(location) {
        switch (location) {
            case '2':
                step2.addClass("a_hidden");
                step1.removeClass("a_hidden");
                break;
            case '3':
                step3.addClass("a_hidden");
                step2.removeClass("a_hidden");
                break;
            case '4':
                step4.addClass("a_hidden");
                step3.removeClass("a_hidden");
                break;
            case '5':
                step5.addClass("a_hidden");
                step4.removeClass("a_hidden");
                break;
            case '6':
                step6.addClass("a_hidden");
                step5.removeClass("a_hidden");
                break;
            case '7':
                step7.addClass("a_hidden");
                step6.removeClass("a_hidden");
                break;
            case '8':
                step7.removeClass("a_hidden");
                step8.addClass("a_hidden");
                break;
        }
    }
</script>

</html>