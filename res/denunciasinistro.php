<?php

if (!isset($_POST['agenzia_id_auto']) && !isset($_POST['agenzia_id_nonauto'])) {
    die('Accesso Negato');
}

if (isset($_POST['agenzia_id_auto'])) {
    denunciaAuto($_POST, $_FILES);
} else {
    denunciaNonAuto($_POST, $_FILES);
}

function denunciaAuto($post, $files)
{
    $nome_auto = $post['cognome_denuncia_auto'] . ' ' . $post['primo_nome_denuncia_auto'];
    $email_auto = $post['email_denuncia_auto'];
    $descrizione_auto = $post['descrizione_denuncia_auto'];
    $agenzia_id_auto = $post['agenzia_id_auto'];

    echo '<strong>Nome</strong>: ' . $nome_auto . '<br />';
    echo '<strong>E-Mail</strong>: ' . $email_auto . '<br />';
    echo '<strong>Descrizione Sinistro</strong>: ' . $descrizione_auto . '<br />';
    echo '<strong>ID Agenzia</strong>: ' . $agenzia_id_auto . '<br />';

    echo "<br /><br />";
    print_r($files['cai_denuncia_auto']);
    echo "<br /><br />";
    print_r($files['immagini_denuncia_auto']);
    echo "<br /><br />";
    print_r($files['documenti_denuncia_auto']);
}

function denunciaNonAuto($post, $files)
{
    print_r($post);
}
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

</html>