<?php
require_once 'settings.php';
/** @var TYPE_NAME $host */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
/** @var TYPE_NAME $db */

$conn = new mysqli($host, $user, $password, $db);
$query = "select * from ".$_POST["table"];
$result = $conn->query($query);

$res = array();
while ($tmp = mysqli_fetch_assoc($result)) {
    $res[] = $tmp;
}
echo json_encode($res);




