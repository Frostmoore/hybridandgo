<?php
if (!isset($_GET['id'])) {
    die('Inserisci un id valido');
}

$id = $_GET['id'];

include_once "res/conn.php";

$sqlid = "SELECT * FROM agenzie_new WHERE id=$id";
$result = $con->query($sqlid);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $agenzia = $row;
    }
}

if (!isset($_GET['token'])) {
    die('Accesso non consentito');
} else {
    if ($_GET['token'] != $agenzia['token']) {
        die('Accesso non consentito');
    }
}

if (!isset($_GET['token'])) {
    die('Accesso non consentito');
} else {
    if ($_GET['token'] != $agenzia['token']) {
        die('Accesso non consentito');
    }
}

$token = $_GET['token'];
$agenzia_id = $_GET['id'];
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

<body>
    <div class="header_agenzia" style="background-image: url('res/img/<?= $agenzia['id']; ?>/header_agenzia.png'); height: 200px; background-position: center;background-size: cover;width:auto;"></div>
    <!--<img src="res/img//header_agenzia.png" id="header_agenzia" class="header_agenzia">-->
    <div class="page_denuncia">
        <h1 style="text-align:center;" class="h1_form_denuncia">Denuncia il tuo Sinistro su <?= $agenzia['nome_agenzia']; ?></h1>
        <div class="row_selettore" id="row_selettore">
            <button type="button" class="tasto_selezione_sinistro" name="button_auto" id="button_auto" onclick="dropdown_form('auto')">Sinistro Auto</button>
            <button type="button" class="tasto_selezione_sinistro" name="button_nonauto" id="button_nonauto" onclick="dropdown_form('nonauto')">Altro Sinistro</button>
        </div>
        <div class="form_auto_wrapper a_hidden" id="form_auto_wrapper">
            <form action="res/denunciasinistro.php" method="post" enctype="multipart/form-data" id="form_auto">
                <div class="row_form_denuncia">
                    <div class="form-group-denuncia">
                        <label for="primo_nome_denuncia_auto" class="label_denuncia">Il tuo Nome<span style="color: red;">*</span></label><br />
                        <input type="text" class="form-control" id="primo_nome_denuncia_auto" name="primo_nome_denuncia_auto" placeholder="Es. Mario">
                    </div>
                    <div class="form-group-denuncia">
                        <label for="cognome_denuncia_auto" class="label_denuncia">Il tuo Cognome<span style="color: red;">*</span></label><br />
                        <input type="text" class="form-control" id="cognome_denuncia_auto" name="cognome_denuncia_auto" placeholder="Es. Rossi">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email_denuncia_auto" class="label_denuncia">Il tuo Indirizzo e-mail<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="email_denuncia_auto" name="email_denuncia_auto" placeholder="Es. mario.rossi@email.it">
                    <small id="email_denuncia_autohelp" class="form-text text-muted">Questo sarà l'indirizzo al quale riceverai la risposta.</small>
                </div>

                <div class="form-group">
                    <label for="descrizione_denuncia_auto" class="label_denuncia">Descrivi brevemente il tuo sinistro<span style="color: red;">*</span></label>
                    <textarea class="form-control" id="descrizione_denuncia_auto" name="descrizione_denuncia_auto" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label for="cai_denuncia_auto" class="label_denuncia">Carica il tuo CAI compilato<span style="color: red;">*</span></label>
                    <input class="form-control" type="file" id="cai_denuncia_auto" name="cai_denuncia_auto[]" multiple="multiple">
                    <small id="cai_denuncia_autohelp" class="form-text text-muted">Puoi scattargli una foto o caricarlo in PDF!</small>
                </div>

                <div class="mb-3">
                    <label for="documenti_denuncia_auto" class="label_denuncia">Carica fronte e retro della tua patente<span style=" color: red;">*</span></label>
                    <input class="form-control" type="file" id="documenti_denuncia_auto" name="documenti_denuncia_auto[]" multiple="multiple">
                    <small id="documenti_denuncia_autohelp" class="form-text text-muted">Puoi scattare due foto o caricarla in PDF!</small>
                </div>

                <div class="mb-3">
                    <label for="immagini_denuncia_auto" class="label_denuncia">Carica immagini relative al tuo sinistro</label>
                    <input class="form-control" type="file" id="immagini_denuncia_auto" name="immagini_denuncia_auto[]" multiple="multiple">
                    <small id="immagini_denuncia_autohelp" class="form-text text-muted">Puoi scattare delle foto o caricarle direttamente.</small>
                </div>


                <div class="form-group">
                    <h4>Dichiarazione di accettazione della liberatoria privacy</h4>
                    <p class="form_privacy" id="form_privacy">Dichiaro di aver preso visione della <a href="https://luneziainsurance.it/privacy-e-cookie-policy/" id="privacy_link_auto">Privacy policy</a> e autorizzo l'agenzia <?= $agenzia['nome_agenzia']; ?> al trattamento dei miei dati personali, che saranno trattati ex Artt. 13-14 del Regolamento (UE) n. 679/2016 (c.d. G.D.P.R.) sulla protezione dei dati personali, per le finalità ivi indicate.
                    </p>
                    <div class="row_form_denuncia_center">
                        <input type="checkbox" id="checkbox_privacy_auto" name="checkbox_privacy_auto" class="cb_denuncia">
                        <label for="checkbox_privacy_auto" class="label_privacy">Do il consenso<span style="color: red;">*</span></label><br>
                    </div>
                </div>

                <input type="text" class="a_hidden" name="agenzia_id_auto" id="agenzia_id_auto" value="<?= $agenzia_id; ?>">
                <input type="text" class="a_hidden" name="denuncia_mail_auto" id="denuncia_mail_auto" value="<?= $agenzia['denuncia_mail']; ?>">
                <div class="errore a_hidden" id="errore">
                    <h2 id="h2_errore">ATTENZIONE!</h2>
                    <p id="p_errore"></p>
                </div>
                <div class="rowbottone">
                    <button type="button" name="bottone_submit_denuncia_auto" class="bottone_submit_denuncia_auto" id="bottone_submit_denuncia_auto" onclick="denunciaSinistro('auto')">INOLTRA LA DENUNCIA</button>
                </div>
        </div>
        </form>
    </div>
    <div class="page_denuncia">
        <div class="form_nonauto_wrapper a_hidden" id="form_nonauto_wrapper">
            <form action="res/denunciasinistro.php" method="post" enctype="multipart/form-data" id="form_nonauto">
                <div class="row_form_denuncia">
                    <div class="form-group-denuncia">
                        <label for="primo_nome_denuncia_nonauto" class="label_denuncia">Il tuo Nome<span style="color: red;">*</span></label><br />
                        <input type="text" class="form-control" id="primo_nome_denuncia_nonauto" name="primo_nome_denuncia_nonauto" placeholder="Es. Mario">
                    </div>
                    <div class="form-group-denuncia">
                        <label for="cognome_denuncia_nonauto" class="label_denuncia">Il tuo Cognome<span style="color: red;">*</span></label><br />
                        <input type="text" class="form-control" id="cognome_denuncia_nonauto" name="cognome_denuncia_nonauto" placeholder="Es. Rossi">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email_denuncia_nonauto" class="label_denuncia">Il tuo Indirizzo e-mail<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="email_denuncia_nonauto" name="email_denuncia_nonauto" placeholder="Es. mario.rossi@email.it">
                    <small id="email_denuncia_nonautohelp" class="form-text text-muted">Questo sarà l'indirizzo al quale riceverai la risposta.</small>
                </div>
                <div class="form-group">
                    <label for="descrizione_denuncia_nonauto" class="label_denuncia">Descrivi brevemente il tuo sinistro<span style="color: red;">*</span></label>
                    <textarea class="form-control" id="descrizione_denuncia_nonauto" name="descrizione_denuncia_nonauto" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="documenti_denuncia_nonauto" class="label_denuncia">Carica fronte e retro del documento di identità<span style=" color: red;">*</span></label>
                    <input class="form-control" type="file" id="documenti_denuncia_nonauto" name="documenti_denuncia_nonauto[]" multiple="multiple">
                    <small id="documenti_denuncia_nonautohelp" class="form-text text-muted">Puoi scattare due foto o caricarlo in PDF!</small>
                </div>
                <div class="mb-3">
                    <label for="immagini_denuncia_nonauto" class="label_denuncia">Carica immagini relative al tuo sinistro</label>
                    <input class="form-control" type="file" id="immagini_denuncia_nonauto" name="immagini_denuncia_nonauto[]" multiple="multiple">
                    <small id="immagini_denuncia_nonautohelp" class="form-text text-muted">Puoi scattare delle foto o caricarle direttamente.</small>
                </div>
                <div class="form-group">
                    <h4>Dichiarazione di accettazione della liberatoria privacy</h4>
                    <p class="form_privacy" id="form_privacy">Dichiaro di aver preso visione della <a href="https://luneziainsurance.it/privacy-e-cookie-policy/" id="privacy_link_nonauto">Privacy policy</a> e autorizzo l'agenzia <?= $agenzia['nome_agenzia']; ?> al trattamento dei miei dati personali, che saranno trattati ex Artt. 13-14 del Regolamento (UE) n. 679/2016 (c.d. G.D.P.R.) sulla protezione dei dati personali, per le finalità ivi indicate.
                    </p>
                    <div class="row_form_denuncia_center">
                        <input type="checkbox" id="checkbox_privacy_nonauto" name="checkbox_privacy_nonauto" class="cb_denuncia">
                        <label for="checkbox_privacy_nonauto" class="label_privacy">Do il consenso<span style="color: red;">*</span></label><br>
                    </div>
                    <input type="text" class="a_hidden" name="agenzia_id_nonauto" id="agenzia_id_nonauto" value="<?= $agenzia_id; ?>">
                    <input type="text" class="a_hidden" name="denuncia_mail_nonauto" id="denuncia_mail_nonauto" value="<?= $agenzia['denuncia_mail']; ?>">
                    <div class="errore a_hidden" id="nerrore">
                        <h2 id="nh2_errore">ATTENZIONE!</h2>
                        <p id="np_errore"></p>
                    </div>
                    <div class="rowbottone">
                        <button type="button" name="bottone_submit_denuncia_nonauto" class="bottone_submit_denuncia_nonauto" id="bottone_submit_denuncia_nonauto" onclick="denunciaSinistro('nonauto')">INOLTRA LA DENUNCIA</button>
                    </div>
            </form>
        </div>
    </div>
</body>

<script>
    // campi generici
    var form_nonauto_wrapper = $("#form_nonauto_wrapper");
    var form_auto_wrapper = $("#form_auto_wrapper");
    var form_auto = $("#form_auto");
    var form_nonauto = $("#form_nonauto");
    var select_sinistro = $("#select_sinistro");
    var option_selezione = $("#option_selezione");
    var option_auto = $("#option_auto");
    var option_nonauto = $("#option_nonauto");
    var row_selettore = $("#row_selettore");
    var errore = $("#errore");
    var h2_errore = $("#h2_errore");
    var p_errore = $("#p_errore");
    var nerrore = $("#nerrore");
    var nh2_errore = $("#nh2_errore");
    var np_errore = $("#np_errore");


    // campi auto
    var primo_nome_denuncia_auto = $("#primo_nome_denuncia_auto");
    var cognome_denuncia_auto = $("#cognome_denuncia_auto");
    var email_denuncia_auto = $("#email_denuncia_auto");
    var descrizione_denuncia_auto = $("#descrizione_denuncia_auto");
    var cai_denuncia_auto = $("#cai_denuncia_auto");
    var documenti_denuncia_auto = $("#documenti_denuncia_auto");
    var immagini_denuncia_auto = $("#immagini_denuncia_auto");
    var checkbox_privacy_auto = $("#checkbox_privacy_auto");

    // campi non auto
    var primo_nome_denuncia_nonauto = $("#primo_nome_denuncia_nonauto");
    var cognome_denuncia_nonauto = $("#cognome_denuncia_nonauto");
    var email_denuncia_nonauto = $("#email_denuncia_nonauto");
    var descrizione_denuncia_nonauto = $("#descrizione_denuncia_nonauto");
    var documenti_denuncia_nonauto = $("#documenti_denuncia_nonauto");
    var immagini_denuncia_nonauto = $("#immagini_denuncia_nonauto");
    var checkbox_privacy_nonauto = $("#checkbox_privacy_nonauto");


    // Funzionalità
    function dropdown_form(value) {
        switch (value) {
            case 'auto':
                form_auto_wrapper.fadeIn();
                form_nonauto_wrapper.fadeOut();
                row_selettore.fadeOut();
                break;
            case 'nonauto':
                form_auto_wrapper.fadeOut();
                form_nonauto_wrapper.fadeIn();
                row_selettore.fadeOut();
                break;
        }
    }

    function denunciaSinistro(tipo) {
        if (tipo == 'auto') {
            //todo
            if (primo_nome_denuncia_auto[0].value.length < 1) {
                errore.removeClass("a_hidden").fadeIn();
                p_errore[0].innerHTML = "Il campo Nome è obbligatorio";
            } else if (cognome_denuncia_auto[0].value.length < 1) {
                errore.removeClass("a_hidden").fadeIn();
                p_errore[0].innerHTML = "Il campo Cognome è obbligatorio";
            } else if (email_denuncia_auto[0].value.length < 1) {
                errore.removeClass("a_hidden").fadeIn();
                p_errore[0].innerHTML = "Il campo e-mail è obbligatorio";
            } else if (descrizione_denuncia_auto[0].value.length < 1) {
                errore.removeClass("a_hidden").fadeIn();
                p_errore[0].innerHTML = "Il campo Descrizione è obbligatorio";
            } else if (cai_denuncia_auto[0].files.length < 1) {
                errore.removeClass("a_hidden").fadeIn();
                p_errore[0].innerHTML = "Il campo CAI è obbligatorio";
            } else if (documenti_denuncia_auto[0].files.length < 1) {
                errore.removeClass("a_hidden").fadeIn();
                p_errore[0].innerHTML = "Il campo Documenti è obbligatorio";
            } else if (!checkbox_privacy_auto[0].checked) {
                errore.removeClass("a_hidden").fadeIn();
                p_errore[0].innerHTML = "Per proseguire, devi accettare la liberatoria privacy";
            } else {
                form_auto.submit();
            }
        } else {
            //todo
            if (primo_nome_denuncia_nonauto[0].value.length < 1) {
                nerrore.fadeIn();
                np_errore[0].innerHTML = "Il campo Nome è obbligatorio";
            } else if (cognome_denuncia_nonauto[0].value.length < 1) {
                nerrore.fadeIn();
                np_errore[0].innerHTML = "Il campo Cognome è obbligatorio";
            } else if (email_denuncia_nonauto[0].value.length < 1) {
                nerrore.fadeIn();
                np_errore[0].innerHTML = "Il campo e-mail è obbligatorio";
            } else if (descrizione_denuncia_nonauto[0].value.length < 1) {
                nerrore.fadeIn();
                np_errore[0].innerHTML = "Il campo Descrizione è obbligatorio";
            } else if (documenti_denuncia_nonauto[0].files.length < 1) {
                nerrore.fadeIn();
                np_errore[0].innerHTML = "Il campo Documenti è obbligatorio";
            } else if (!checkbox_privacy_nonauto[0].checked) {
                nerrore.fadeIn();
                np_errore[0].innerHTML = "Per proseguire, devi accettare la liberatoria privacy";
            } else {
                form_nonauto.submit();
            }
        }
    }
</script>

</html>