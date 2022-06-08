<?php

require_once '../settings.php';;
/** @var TYPE_NAME $host */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
/** @var TYPE_NAME $db */

$conn = new mysqli($host, $user, $password, $db);
$query = "update News set title = '".$_POST["title"]."',news_category = '".$_POST["news_category"]."',content = '".$_POST["content"]."',image = '".$_POST["image"]."' where id=" . $_POST["id"];
$conn->query($query);
echo json_encode($query);