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
        <h1 style="text-align:center;margin-top:30px;" class="h1_form_denuncia">Carica un Documento su <?= $agenzia['nome_agenzia']; ?></h1>
        <div class="form_auto_wrapper" id="form_auto_wrapper">
            <form action="res/richiestadocumenti.php" method="post" enctype="multipart/form-data" id="form_auto">
                <div class="row_form_denuncia">
                    <div class="form-group-denuncia">
                        <label for="primo_nome_documenti" class="label_denuncia">Il tuo Nome<span style="color: red;">*</span></label><br />
                        <input type="text" class="form-control" id="primo_nome_documenti" name="primo_nome_documenti" placeholder="Es. Mario">
                    </div>
                    <div class="form-group-denuncia">
                        <label for="cognome_documenti" class="label_denuncia">Il tuo Cognome<span style="color: red;">*</span></label><br />
                        <input type="text" class="form-control" id="cognome_documenti" name="cognome_documenti" placeholder="Es. Rossi">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email_documenti" class="label_denuncia">Il tuo Indirizzo e-mail<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="email_documenti" name="email_documenti" placeholder="Es. mario.rossi@email.it">
                    <small id="email_documentihelp" class="form-text text-muted">Questo sarà l'indirizzo al quale riceverai la risposta.</small>
                </div>

                <div class="form-group">
                    <label for="descrizione_documenti" class="label_denuncia">Descrivi brevemente la richiesta di documenti<span style="color: red;">*</span></label>
                    <textarea class="form-control" id="descrizione_documenti" name="descrizione_documenti" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label for="documenti_documenti" class="label_denuncia">Carica il documenti da inviare<span style=" color: red;">*</span></label>
                    <input class="form-control" type="file" id="documenti_documenti" name="documenti_documenti[]" multiple="multiple">
                    <small id="documenti_documentihelp" class="form-text text-muted">Puoi scattare foto o caricarlo in PDF!</small>
                </div>

                <div class="form-group">
                    <h4>Dichiarazione di accettazione della liberatoria privacy</h4>
                    <p class="form_privacy" id="form_privacy">Dichiaro di aver preso visione della <a href="https://luneziainsurance.it/privacy-e-cookie-policy/" id="privacy_link_documenti">Privacy policy</a> e autorizzo l'agenzia <?= $agenzia['nome_agenzia']; ?> al trattamento dei miei dati personali, che saranno trattati ex Artt. 13-14 del Regolamento (UE) n. 679/2016 (c.d. G.D.P.R.) sulla protezione dei dati personali, per le finalità ivi indicate.
                    </p>
                    <div class="row_form_denuncia_center">
                        <input type="checkbox" id="checkbox_privacy_documenti" name="checkbox_privacy_documenti" class="cb_denuncia">
                        <label for="checkbox_privacy_documenti" class="label_privacy">Do il consenso<span style="color: red;">*</span></label><br>
                    </div>
                </div>

                <input type="text" class="a_hidden" name="agenzia_id_documenti" id="agenzia_id_documenti" value="<?= $agenzia_id; ?>">
                <input type="text" class="a_hidden" name="denuncia_mail_documenti" id="denuncia_mail_documenti" value="<?= $agenzia['denuncia_mail']; ?>">
                <input type="text" class="a_hidden" name="token_documenti" id="token_documenti" value="<?= $agenzia['token']; ?>">
                <div class="errore a_hidden" id="errore">
                    <h2 id="h2_errore">ATTENZIONE!</h2>
                    <p id="p_errore"></p>
                </div>
                <div class="rowbottone">
                    <button type="button" name="bottone_submit_denuncia_auto" class="bottone_submit_denuncia_auto" id="bottone_submit_denuncia_auto" onclick="richiedidocumenti()">CARICA DOCUMENTO</button>
                </div>
        </div>
        </form>
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
    var validRegex = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$");


    // campi auto
    var primo_nome_documenti = $("#primo_nome_documenti");
    var cognome_documenti = $("#cognome_documenti");
    var email_documenti = $("#email_documenti");
    var descrizione_documenti = $("#descrizione_documenti");
    var documenti_documenti = $("#documenti_documenti");
    var checkbox_privacy_documenti = $("#checkbox_privacy_documenti");


    function richiedidocumenti() {
        //todo
        if (primo_nome_documenti[0].value.length < 1) {
            errore.removeClass("a_hidden").fadeIn();
            p_errore[0].innerHTML = "Il campo Nome è obbligatorio";
        } else if (cognome_documenti[0].value.length < 1) {
            errore.removeClass("a_hidden").fadeIn();
            p_errore[0].innerHTML = "Il campo Cognome è obbligatorio";
        } else if (email_documenti[0].value.length < 1) {
            errore.removeClass("a_hidden").fadeIn();
            p_errore[0].innerHTML = "Il campo e-mail è obbligatorio";
        } else if (descrizione_documenti[0].value.length < 1) {
            errore.removeClass("a_hidden").fadeIn();
            p_errore[0].innerHTML = "Il campo Descrizione è obbligatorio";
        } else if (documenti_documenti[0].files.length < 1) {
            errore.removeClass("a_hidden").fadeIn();
            p_errore[0].innerHTML = "Il campo Documenti è obbligatorio";
        } else if (!checkbox_privacy_documenti[0].checked) {
            errore.removeClass("a_hidden").fadeIn();
            p_errore[0].innerHTML = "Per proseguire, devi accettare la liberatoria privacy";
        } else if (!email_documenti[0].value.match(validRegex)) {
            errore.removeClass("a_hidden").fadeIn();
            p_errore[0].innerHTML = "Inserisci un indirizzo e-mail valido";
        } else {
            form_auto.submit();
        }
    }
</script>

</html>