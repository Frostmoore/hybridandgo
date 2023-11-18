<?php

header("Content-Type:application/json");

include "conn.php";

if (isset($_GET["id"]) && $_GET["id"] != "") {
    if (isset($_GET["api_key"]) && $_GET["api_key"] != "") {
        $id = $_GET["id"];
        $sqlkey = "SELECT api_key FROM agenzie WHERE id=$id";
        $result = $con->query($sqlkey);
        if ($result->num_rows > 0) {
            while ($rowkey = $result->fetch_assoc()) {
                $api_key = $rowkey["api_key"];
            }
        }

        if ($api_key == $_GET["api_key"]) {

            $sql = "SELECT * FROM agenzie WHERE id=$id";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $response["nome"] = $row["nome"];
                    $response["email"] = $row["email"];
                    $response["telefono"] = $row["telefono"];
                    $response["geolocation"] = $row["geolocation"];
                    $response["indirizzo"] = $row["indirizzo"];
                    $response["social"] = $row["social"];
                    $response["orari"] = $row["orari"];
                    $response["colori"] = $row["colori"];
                    $response["logo"] = $row["logo"];
                    $response["cover"] = $row["cover"];
                    $response["immagini"] = $row["immagini"];
                }
            }

            $json_response = json_encode($response);
            echo $json_response;
        } else {
            die("API Key not valid.");
        }
    }
}
