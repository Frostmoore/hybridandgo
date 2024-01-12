<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
include_once "res/fetchagenzie.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link href="res/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
        <h1>Agenzie</h1>
    </div>
    <div class="container-age">
        <div class="row">
            <?php foreach ($agenzie as $agenzia) : ?>
                <?php if ($agenzia['id'] != 0) : ?>
                    <div class="col-sm">
                        <div class="agenzia-compressed">
                            <div class="logo-compressed">
                                <!--Logo-->
                                <img src="<?php echo ($agenzia["logo_agenzia"] == "placeholder") ? "https://loremflickr.com/128/128" : "res/" . $agenzia["logo_agenzia"]; ?>" width="128" height="128" />
                            </div>
                            <div class="info-compressed">
                                <!--Nome-->
                                <h2><?= $agenzia["nome_agenzia"]; ?></h2>
                                <!--ID-->
                                <p>ID: <strong><?= $agenzia["id"]; ?></strong></p>
                            </div>
                            <div class="info-compressed">
                                <a href="agenzia.php?id=<?= $agenzia["id"] ?>"><button type="button" class="btn btn-outline-danger">Modifica Dati</button></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="col-sm">
                <div class="agenzia-compressed">
                    <div class="logo-compressed">
                        <!--Logo-->
                        <img src="assets/plus.png" />
                    </div>
                    <div class="info-compressed">
                        <!--Nome-->
                        <h2>Nuovo</h2>
                    </div>
                    <div class="info-compressed">
                        <a href="creagenzia.php"><button type="button" class="btn btn-outline-success">Nuova Agenzia</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>