<?php

require_once '../settings.php';;
/** @var TYPE_NAME $host */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
/** @var TYPE_NAME $db */

$content = $_POST["content"];
$content = str_replace("'","\'",$content);

$conn = new mysqli($host, $user, $password, $db);
$query = "update About set content = '".$content."' where id=1";
$conn->query($query);
echo json_encode($query);