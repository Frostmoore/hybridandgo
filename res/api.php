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
            }
        }

        if ($token == $_GET["token"]) {

            $sql = "SELECT * FROM agenzie_new WHERE id=$id";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    //$response["id"] = $row["id"];
                    $response["nome_app"] = $row["nome_app"];
                    $response["nome_agenzia"] = $row["nome_agenzia"];
                    $response["logo_agenzia"] = $row["logo_agenzia"];
                    $response["header_agenzia"] = $row["header_agenzia"];
                    $response["colori"] = $row["colori"];
                    $response["facebook_agenzia"] = $row["facebook_agenzia"];
                    $response["instagram_agenzia"] = $row["instagram_agenzia"];
                    $response["linkedin_agenzia"] = $row["linkedin_agenzia"];
                    $response["google_agenzia"] = $row["google_agenzia"];
                    $response["sito_agenzia"] = $row["sito_agenzia"];
                    $response["info_titolo"] = $row["info_titolo"];
                    $response["info_immagine"] = $row["info_immagine"];
                    $response["info_nomi_sedi"] = $row["info_nomi_sedi"];
                    $response["info_indirizzi_sedi"] = $row["info_indirizzi_sedi"];
                    $response["info_testo_orari"] = $row["info_testo_orari"];
                    $response["info_orari_sedi"] = $row["info_orari_sedi"];
                    $response["info_recensioni_sedi"] = $row["info_recensioni_sedi"];
                    $response["info_telefono_sedi"] = $row["info_telefono_sedi"];
                    $response["info_email_sedi"] = $row["info_email_sedi"];
                    $response["info_mappa_sedi"] = $row["info_mappa_sedi"];
                    $response["info_sito_sedi"] = $row["info_sito_sedi"];
                    $response["notifica_titolo"] = $row["notifica_titolo"];
                    $response["notifica_testo"] = $row["notifica_testo"];
                    $response["notifica_link"] = $row["notifica_link"];
                    $response["contatti_immagine"] = $row["contatti_immagine"];
                    $response["contatti_titolo"] = $row["contatti_titolo"];
                    $response["contatti_testo"] = $row["contatti_testo"];
                    $response["numeri_utili_labels"] = $row["numeri_utili_labels"];
                    $response["numeri_utili_colori"] = $row["numeri_utili_colori"];
                    $response["numeri_utili_link"] = $row["numeri_utili_link"];
                    $response["denuncia_immagine"] = $row["denuncia_immagine"];
                    $response["denuncia_titolo"] = $row["denuncia_titolo"];
                    $response["denuncia_testo"] = $row["denuncia_testo"];
                    $response["denuncia_testo_grassetto"] = $row["denuncia_testo_grassetto"];
                    $response["quick_telefono"] = $row["quick_telefono"];
                    $response["quick_whatsapp"] = $row["quick_whatsapp"];
                    $response["quick_email"] = $row["quick_email"];
                    $response["attiva"] = $row["attiva"];
                    //$response["token"] = $row["token"];
                }
            }

            $json_response = json_encode($response);
            echo $json_response;
        } else {
            die("API Key not valid.");
        }
    }
}
