<?php

require_once '../settings.php';
/** @var TYPE_NAME $host */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
/** @var TYPE_NAME $db */

$conn = new mysqli($host, $user, $password, $db);
$query = "update Teachers set    pib = '" . $_POST["pib"] . "',position = '" . $_POST["position"] . "',description = '" . $_POST["description"] . "',photo = '" . $_POST["photo"] . "' where id=" . $_POST["id"];

$conn->query($query);
echo json_encode($query);