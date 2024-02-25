<?php

header("Content-Type:application/json");

include "conn.php";

if (isset($_GET["id"]) && $_GET["id"] != "") {
    if (isset($_GET["token"]) && $_GET["token"] != "") {
        $id = $_GET["id"];
        $sqlkey = "SELECT token FROM agenzie_new WHERE id=$id";
        $result = $con->query($sqlkey);
        if ($result->num_rows > 0) {
            while ($rowkey = $result->fetch_assoc()) {
                $token = $rowkey["token"];
                echo $token;
            }
        }

        if ($token == $_GET["token"]) {

            $sql = "SELECT * FROM agenzie_new WHERE id=$id";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //$response["id"] = $row["id"];
                    $response["nome_app"] = mb_convert_encoding($row["nome_app"], 'UTF-8', 'UTF-8');
                    $response["nome_agenzia"] = mb_convert_encoding($row["nome_agenzia"], 'UTF-8', 'UTF-8');
                    $response["logo_agenzia"] = mb_convert_encoding($row["logo_agenzia"], 'UTF-8', 'UTF-8');
                    $response["header_agenzia"] = mb_convert_encoding($row["header_agenzia"], 'UTF-8', 'UTF-8');
                    $response["colori"] = mb_convert_encoding($row["colori"], 'UTF-8', 'UTF-8');
                    $response["facebook_agenzia"] = mb_convert_encoding($row["facebook_agenzia"], 'UTF-8', 'UTF-8');
                    $response["instagram_agenzia"] = mb_convert_encoding($row["instagram_agenzia"], 'UTF-8', 'UTF-8');
                    $response["linkedin_agenzia"] = mb_convert_encoding($row["linkedin_agenzia"], 'UTF-8', 'UTF-8');
                    $response["google_agenzia"] = mb_convert_encoding($row["google_agenzia"], 'UTF-8', 'UTF-8');
                    $response["sito_agenzia"] = mb_convert_encoding($row["sito_agenzia"], 'UTF-8', 'UTF-8');
                    $response["info_titolo"] = mb_convert_encoding($row["info_titolo"], 'UTF-8', 'UTF-8');
                    $response["info_immagine"] = mb_convert_encoding($row["info_immagine"], 'UTF-8', 'UTF-8');
                    $response["info_nomi_sedi"] = mb_convert_encoding($row["info_nomi_sedi"], 'UTF-8', 'UTF-8');
                    $response["info_indirizzi_sedi"] = mb_convert_encoding($row["info_indirizzi_sedi"], 'UTF-8', 'UTF-8');
                    $response["info_testo_orari"] = mb_convert_encoding($row["info_testo_orari"], 'UTF-8', 'UTF-8');
                    $response["info_orari_sedi"] = mb_convert_encoding($row["info_orari_sedi"], 'UTF-8', 'UTF-8');
                    $response["info_recensioni_sedi"] = mb_convert_encoding($row["info_recensioni_sedi"], 'UTF-8', 'UTF-8');
                    $response["info_telefono_sedi"] = mb_convert_encoding($row["info_telefono_sedi"], 'UTF-8', 'UTF-8');
                    $response["info_email_sedi"] = mb_convert_encoding($row["info_email_sedi"], 'UTF-8', 'UTF-8');
                    $response["info_mappa_sedi"] = mb_convert_encoding($row["info_mappa_sedi"], 'UTF-8', 'UTF-8');
                    $response["info_sito_sedi"] = mb_convert_encoding($row["info_sito_sedi"], 'UTF-8', 'UTF-8');
                    $response["notifica_titolo"] = mb_convert_encoding($row["notifica_titolo"], 'UTF-8', 'UTF-8');
                    $response["notifica_testo"] = mb_convert_encoding($row["notifica_testo"], 'UTF-8', 'UTF-8');
                    $response["notifica_link"] = mb_convert_encoding($row["notifica_link"], 'UTF-8', 'UTF-8');
                    $response["contatti_immagine"] = mb_convert_encoding($row["contatti_immagine"], 'UTF-8', 'UTF-8');
                    $response["contatti_titolo"] = mb_convert_encoding($row["contatti_titolo"], 'UTF-8', 'UTF-8');
                    //$response["contatti_testo"] = mb_convert_encoding($row["contatti_testo"], 'UTF-8', 'UTF-8');
                    $response["numeri_utili_labels"] = mb_convert_encoding($row["numeri_utili_labels"], 'UTF-8', 'UTF-8');
                    $response["numeri_utili_colori"] = mb_convert_encoding($row["numeri_utili_colori"], 'UTF-8', 'UTF-8');
                    $response["numeri_utili_salute"] = mb_convert_encoding($row["numeri_utili_salute"], 'UTF-8', 'UTF-8');
                    $response["numeri_utili_assistenza"] = mb_convert_encoding($row["numeri_utili_assistenza"], 'UTF-8', 'UTF-8');
                    $response["numeri_utili_noleggio"] = mb_convert_encoding($row["numeri_utili_noleggio"], 'UTF-8', 'UTF-8');
                    $response["denuncia_immagine"] = mb_convert_encoding($row["denuncia_immagine"], 'UTF-8', 'UTF-8');
                    $response["denuncia_titolo"] = mb_convert_encoding($row["denuncia_titolo"], 'UTF-8', 'UTF-8');
                    //$response["denuncia_testo"] = mb_convert_encoding($row["denuncia_testo"], 'UTF-8', 'UTF-8');
                    $response["denuncia_testo_grassetto"] = mb_convert_encoding($row["denuncia_testo_grassetto"], 'UTF-8', 'UTF-8');
                    $response["preventivo_immagine"] = mb_convert_encoding($row["preventivo_immagine"], 'UTF-8', 'UTF-8');
                    $response["preventivo_testo_grassetto"] = mb_convert_encoding($row["preventivo_testo_grassetto"], 'UTF-8', 'UTF-8');
                    $response["preventivo_titolo"] = mb_convert_encoding($row["preventivo_titolo"], 'UTF-8', 'UTF-8');
                    $response["quick_telefono"] = mb_convert_encoding($row["quick_telefono"], 'UTF-8', 'UTF-8');
                    $response["quick_whatsapp"] = mb_convert_encoding($row["quick_whatsapp"], 'UTF-8', 'UTF-8');
                    $response["quick_email"] = mb_convert_encoding($row["quick_email"], 'UTF-8', 'UTF-8');
                    $response["attiva"] = mb_convert_encoding($row["attiva"], 'UTF-8', 'UTF-8');
                    $response["denuncia_mail"] = mb_convert_encoding($row["denuncia_mail"], 'UTF-8', 'UTF-8');
                    //$response["token"] = mb_convert_encoding($row["token"], 'UTF-8', 'UTF-8');
                }
            }

            $json_response = json_encode($response);
            var_dump($json_response);
        } else {
            die("API Key not valid.");
        }
    }
}
