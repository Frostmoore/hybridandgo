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
        <h1>Nuova Agenzia</h1>
    </div>
    <div class="container-age">
        <div class="row">
            <div class="col">
                <form action="res/nuovagenzia.php" method="POST" enctype="multipart/form-data" id="formcrea">
                    <h4 class="errore" id="errore"></h4>
                    <div class="step1" id="step1">
                        <h2>Step n. 1: Generali</h2>
                        <div class="form-group">
                            <label for="nome_app">Nome Applicazione</label>
                            <input type="text" class="form-control" id="nome_app" name="nome_app" placeholder="Inserisci il Nome della nuova Applicazione">
                            <small id="nomeapphelp" class="form-text text-muted">Questo sarà il nome utilizzato per l'applicazione</small>
                        </div>
                        <div class="form-group">
                            <label for="nome_agenzia">Nome Agenzia</label>
                            <input type="text" class="form-control" id="nome_agenzia" name="nome_agenzia" placeholder="Inserisci il Nome della nuova Agenzia">
                            <small id="nomeagenziahelp" class="form-text text-muted">Questo sarà il nome utilizzato per l'Agenzia</small>
                        </div>
                        <div class="mb-3">
                            <label for="logo_agenzia" class="form-label">Logo dell'Agenzia</label>
                            <input class="form-control" type="file" id="logo_agenzia" name="logo_agenzia">
                            <small id="logo_agenziahelp" class="form-text text-muted">Carica un solo file .png di dimensione 1024x1024x7MB.</small>
                        </div>
                        <div class="mb-3">
                            <label for="header_agenzia" class="form-label">Cover dell'Agenzia</label>
                            <input class="form-control" type="file" id="header_agenzia" name="header_agenzia">
                            <small id="header_agenziahelp" class="form-text text-muted">Carica un solo file .png di dimensione massima 2400x1256x14MB.</small>
                        </div>
                        <div class="form-group">
                            <label for="colori">Colori</label>
                            <input type="text" class="form-control" id="colori" name="colori" placeholder="Inserisci i Colori principali dell'app">
                            <small id="nomeagenziahelp" class="form-text text-muted">Inserisci tre colori, separati da un |, nel formato 0xffffffff</small>
                        </div>
                        <div class="rowbottone">
                            <button type="button" class="bottone_next" id="bottone1" onclick="muovitiAvanti('1')">AVANTI</button>
                        </div>
                    </div>
                    <div class="step2 a_hidden" id="step2">
                        <h2>Step n. 2: Social</h2>
                        <div class="form-group">
                            <label for="facebook_agenzia">Indirizzo Facebook</label>
                            <input type="text" class="form-control" id="facebook_agenzia" name="facebook_agenzia" placeholder="Inserisci l'indirizzo Facebook dell'Agenzia">
                            <small id="facebook_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo Facebook del tasto sotto il logo</small>
                        </div>
                        <div class="form-group">
                            <label for="instagram_agenzia">Indirizzo Instagram</label>
                            <input type="text" class="form-control" id="instagram_agenzia" name="instagram_agenzia" placeholder="Inserisci l'indirizzo Instagram dell'Agenzia">
                            <small id="instagram_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo Instagram del tasto sotto il logo</small>
                        </div>
                        <div class="form-group">
                            <label for="linkedin_agenzia">Indirizzo LinkedIn</label>
                            <input type="text" class="form-control" id="linkedin_agenzia" name="linkedin_agenzia" placeholder="Inserisci l'indirizzo LinkedIn dell'Agenzia">
                            <small id="linkedin_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo LinkedIn del tasto sotto il logo</small>
                        </div>
                        <div class="form-group">
                            <label for="google_agenzia">Indirizzo Google Places</label>
                            <input type="text" class="form-control" id="google_agenzia" name="google_agenzia" placeholder="Inserisci l'indirizzo Google Places dell'Agenzia">
                            <small id="google_agenziahelp" class="form-text text-muted">Questo sarà l'indirizzo Google Places del tasto sotto il logo</small>
                        </div>
                        <div class="form-group">
                            <label for="sito_agenzia">Indirizzo Sito Web</label>
                            <input type="text" class="form-control" id="sito_agenzia" name="sito_agenzia" placeholder="Inserisci l'indirizzo Sito Web dell'Agenzia">
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
                            <input type="text" class="form-control" id="info_titolo" name="info_titolo" placeholder="Inserisci il titolo che vuoi che appaia per il blocco Info">
                            <small id="info_titolohelp" class="form-text text-muted">Questo sarà il titolo della sezione Info dell'Applicazione</small>
                        </div>
                        <div class="mb-3">
                            <label for="info_immagine" class="form-label">Immagine di fondo del Titolo della sezione Info</label>
                            <input class="form-control" type="file" id="info_immagine" name="info_immagine">
                            <small id="info_immaginehelp" class="form-text text-muted">Carica un solo file .png delle dimensioni che preferisci, ma con un rapporto di 6:1.</small>
                        </div>
                        <div class="form-group">
                            <label for="info_nomi_sedi">Nomi delle varie Sedi</label>
                            <input type="text" class="form-control" id="info_nomi_sedi" name="info_nomi_sedi" placeholder="Inserisci i nomi delle varie sedi dell'Agenzia">
                            <small id="info_nomi_sedihelp" class="form-text text-muted">Separa i nomi usando un |</small>
                        </div>
                        <div class="form-group">
                            <label for="info_indirizzi_sedi">Indirizzi delle varie Sedi</label>
                            <input type="text" class="form-control" id="info_indirizzi_sedi" name="info_indirizzi_sedi" placeholder="Inserisci gli indirizzi delle varie sedi dell'Agenzia">
                            <small id="info_indirizzi_sedihelp" class="form-text text-muted">Separa gli indirizzi usando un |</small>
                        </div>
                        <div class="form-group">
                            <label for="info_testo_orari">Testo sopra gli orari di apertura</label>
                            <input type="text" class="form-control" id="info_testo_orari" name="info_testo_orari" placeholder="Inserisci il testo che vuoi che appaia in grassetto sopra gli orari delle varie sedi">
                            <small id="info_testo_orarihelp" class="form-text text-muted">Separa i testi usando un |</small>
                        </div>
                        <div class="form-group">
                            <label for="info_orari_sedi">Orari di apertura delle varie Sedi</label>
                            <input type="textarea" class="form-control" id="info_orari_sedi" name="info_orari_sedi" placeholder="Inserisci gli orari di apertura delle varie sedi dell'Agenzia">
                            <small id="info_orari_sedihelp" class="form-text text-muted">Separa gli orari usando un |, se vuoi andare a capo potrai usare la shortcut "\n"</small>
                        </div>
                        <div class="form-group">
                            <label for="info_recensioni_sedi">Link per la recensione delle sedi</label>
                            <input type="text" class="form-control" id="info_recensioni_sedi" name="info_recensioni_sedi" placeholder="Inserisci il link a cui rimanderà il tasto 'lascia una recensione'">
                            <small id="info_recensioni_sedihelp" class="form-text text-muted">Separa i link usando un |</small>
                        </div>
                        <div class="form-group">
                            <label for="info_telefono_sedi">Numeri di Telefono delle varie sedi</label>
                            <input type="text" class="form-control" id="info_telefono_sedi" name="info_telefono_sedi" placeholder="Inserisci il numero di telefono delle varie sedi">
                            <small id="info_telefono_sedihelp" class="form-text text-muted">Scrivilo nel formato internazionale (+393333333333). Separa i numeri usando un |</small>
                        </div>
                        <div class="form-group">
                            <label for="info_email_sedi">Indirizzi e-mail delle varie sedi</label>
                            <input type="text" class="form-control" id="info_email_sedi" name="info_email_sedi" placeholder="Inserisci l'indirizzo e-mail delle varie sedi">
                            <small id="info_email_sedihelp" class="form-text text-muted">Separa gli indirizzi usando un |</small>
                        </div>
                        <div class="form-group">
                            <label for="info_mappa_sedi">Indirizzo Google Places delle varie sedi</label>
                            <input type="text" class="form-control" id="info_mappa_sedi" name="info_mappa_sedi" placeholder="Inserisci l'indirizzo Google Places delle varie sedi">
                            <small id="info_mappa_sedihelp" class="form-text text-muted">Separa gli indirizzi usando un |</small>
                        </div>
                        <div class="form-group">
                            <label for="info_sito_sedi">Indirizzo web delle varie sedi</label>
                            <input type="text" class="form-control" id="info_sito_sedi" name="info_sito_sedi" placeholder="Inserisci l'indirizzo web delle varie sedi">
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
                            <input type="text" class="form-control" id="notifica_titolo" name="notifica_titolo" placeholder="Titolo della notifica (ad es. 'ATTENZIONE!'">
                            <small id="notifica_titolohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                        </div>
                        <div class="form-group">
                            <label for="notifica_testo">Inserisci il testo della notifica</label>
                            <input type="textarea" class="form-control" id="notifica_testo" name="notifica_testo" placeholder="Testo della notifica">
                            <small id="notifica_testohelp" class="form-text text-muted"> </small>
                        </div>
                        <div class="form-group">
                            <label for="notifica_link">Inserisci il link della notifica</label>
                            <input type="text" class="form-control" id="notifica_link" name="notifica_link" placeholder="Link della notifica">
                            <small id="notifica_linkhelp" class="form-text text-muted">Sarà il link del tasto "Scopri di più"</small>
                        </div>
                        <div class="rowbottone">
                            <button type="button" class="bottone_previous" id="indietro4" onclick="muovitiIndietro('4')">INDIETRO</button>
                            <button type="button" class="bottone_next" id="bottone4" onclick="muovitiAvanti('4')">AVANTI</button>
                        </div>
                    </div>
                    <div class="step5 a_hidden" id="step5">
                        <h2>Step n. 5: Sezione Contatti e Numeri Utili</h2>
                        <div class="mb-3">
                            <label for="contatti_immagine" class="form-label">Immagine di fondo della sezione Contatti</label>
                            <input class="form-control" type="file" id="contatti_immagine" name="contatti_immagine">
                            <small id="contatti_immaginehelp" class="form-text text-muted">Carica un solo file .png delle dimensioni che preferisci, ma con un rapporto di 6:1.</small>
                        </div>
                        <div class="form-group">
                            <label for="contatti_titolo">Inserisci il titolo della sezione Contatti</label>
                            <input type="text" class="form-control" id="contatti_titolo" name="contatti_titolo" placeholder="Titolo Sez. Contatti">
                            <small id="contatti_titolohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                        </div>
                        <div class="form-group">
                            <label for="contatti_testo">Inserisci il testo da riportare nella sezione Contatti</label>
                            <input type="textarea" class="form-control" id="contatti_testo" name="contatti_testo" placeholder="Testo Sezione Contatti">
                            <small id="contatti_testohelp" class="form-text text-muted">Puoi andare a capo utilizzando la shortcut "\n"</small>
                        </div>
                        <div class="form-group">
                            <label for="numeri_utili_labels">Inserisci i testi da riportare sui pulsanti dei numeri utili</label>
                            <input type="text" class="form-control" id="numeri_utili_labels" name="numeri_utili_labels" placeholder="Testi pulsanti numeri utili">
                            <small id="numeri_utili_labelshelp" class="form-text text-muted">Inserisci l'etichetta di ciascun pulsante, separandole con un | e tenendo presente che l'ordine sarà il seguente: salute, assistenza stradale, noleggio</small>
                        </div>
                        <div class="form-group">
                            <label for="numeri_utili_colori">Inserisci i colori di ciascun tasto</label>
                            <input type="text" class="form-control" id="numeri_utili_colori" name="numeri_utili_colori" placeholder="Colori pulsanti numeri utili">
                            <small id="numeri_utili_colorihelp" class="form-text text-muted">Inserisci i colori di ciascun pulsante, separandoli con un | e tenendo presente che l'ordine sarà il seguente: salute, assistenza stradale, noleggio. I colori dovranno essere espressi nel formato 0xffffffff</small>
                        </div>
                        <div class="form-group">
                            <label for="numeri_utili_link">Inserisci i link di ciascun tasto</label>
                            <input type="text" class="form-control" id="numeri_utili_link" name="numeri_utili_link" placeholder="Link pulsanti numeri utili">
                            <small id="numeri_utili_linkhelp" class="form-text text-muted">Inserisci i link di ciascun pulsante, separandoli con un | e tenendo presente che l'ordine sarà il seguente: salute, assistenza stradale, noleggio. I numeri dovranno essere espressi nel formato internazionale (+393333333333)</small>
                        </div>
                        <div class="rowbottone">
                            <button type="button" class="bottone_previous" id="indietro5" onclick="muovitiIndietro('5')">INDIETRO</button>
                            <button type="button" class="bottone_next" id="bottone5" onclick="muovitiAvanti('5')">AVANTI</button>
                        </div>
                    </div>
                    <div class="step6 a_hidden" id="step6">
                        <h2>Step n. 6: Sezione "Denuncia un Sinistro"</h2>
                        <div class="mb-3">
                            <label for="denuncia_immagine" class="form-label">Immagine di fondo della sezione "Denuncia un Sinistro"</label>
                            <input class="form-control" type="file" id="denuncia_immagine" name="denuncia_immagine">
                            <small id="denuncia_immaginehelp" class="form-text text-muted">Carica un solo file .png delle dimensioni che preferisci, ma con un rapporto di 6:1.</small>
                        </div>
                        <div class="form-group">
                            <label for="denuncia_titolo">Inserisci il titolo della sezione "Denuncia un Sinistro"</label>
                            <input type="text" class="form-control" id="denuncia_titolo" name="denuncia_titolo" placeholder="Titolo Sezione">
                            <small id="denuncia_titolohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                        </div>
                        <div class="form-group">
                            <label for="denuncia_testo_grassetto">Inserisci il testo in grassetto della sezione "Denuncia un Sinistro"</label>
                            <input type="text" class="form-control" id="denuncia_testo_grassetto" name="denuncia_testo_grassetto" placeholder="Testo in grassetto">
                            <small id="denuncia_testo_grassettohelp" class="form-text text-muted">Il testo apparirà in grassetto</small>
                        </div>
                        <div class="form-group">
                            <label for="denuncia_testo">Inserisci il testo della sezione "Denuncia un Sinistro"</label>
                            <input type="textarea" class="form-control" id="denuncia_testo" name="denuncia_testo" placeholder="Testo Sezione 'Denuncia un Sinistro'">
                            <small id="denuncia_testohelp" class="form-text text-muted">Il testo apparirà sotto il titolo</small>
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
                            <input type="text" class="form-control" id="quick_telefono" name="quick_telefono" placeholder="Numero di Telefono per chiamate rapide">
                            <small id="quick_telefonohelp" class="form-text text-muted"> </small>
                        </div>
                        <div class="form-group">
                            <label for="quick_whatsapp">Inserisci il link WhatsApp per le chiamate rapide</label>
                            <input type="text" class="form-control" id="quick_whatsapp" name="quick_whatsapp" placeholder="Ad es. https://call.whatsapp.com/voice/fJdossDZ45dx2">
                            <small id="quick_whatsapphelp" class="form-text text-muted">Inserisci il "Call Link" di WhatsApp Business</small>
                        </div>
                        <div class="form-group">
                            <label for="quick_email">Inserisci l'email per le chiamate rapide</label>
                            <input type="text" class="form-control" id="quick_email" name="quick_email" placeholder="E-mail dell'indirizzo rapido">
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
                            <input type="text" class="form-control" id="denuncia_mail" name="denuncia_mail" placeholder="E-mail a per le denunce di sinistro">
                            <small id="denuncia_mailhelp" class="form-text text-muted"> </small>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="attiva" name="attiva" value="1">
                            <label for="attiva">Attivare l'Agenzia?</label><br>
                            <small id="attivahelp" class="form-text text-muted">Potrai disabilitarla in qualunque momento</small>
                        </div>
                        <div class="rowbottone">
                            <button type="button" class="bottone_previous" id="indietro8" onclick="muovitiIndietro('8')">INDIETRO</button>
                            <button class="bottone_next" id="bottone8">CREA AGENZIA</button>
                        </div>
                    </div>
                </form>
            </div>
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
    var mail_denuncia = $("#mail_denuncia");
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