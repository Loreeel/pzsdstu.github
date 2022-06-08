<?php

require_once '../settings.php';
/** @var TYPE_NAME $host */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
/** @var TYPE_NAME $db */

$conn = new mysqli($host, $user, $password, $db);
$query = "Insert into Teachers(pib,position,description,photo,cv) values ('" . $_POST["pib"] . "','" . $_POST["position"] . "','" . $_POST["description"] . "','" . $_POST["photo"] . "','')";
$conn->query($query);
echo json_encode($query);