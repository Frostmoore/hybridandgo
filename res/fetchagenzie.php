<?php
require_once "conn.php";
$agenzie = [];
$agenzia = [];

$sql = "SELECT * FROM agenzie";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $agenzia = $row;
        array_push($agenzie, $agenzia);
    }
}
