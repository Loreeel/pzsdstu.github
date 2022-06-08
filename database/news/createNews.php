<?php
require_once '../settings.php';
/** @var TYPE_NAME $host */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
/** @var TYPE_NAME $db */

$conn = new mysqli($host, $user, $password, $db);
$query = "Insert into News(title,content,image,news_category,date) values ('".$_POST["title"]."','".$_POST["content"]."','".$_POST["image"]."','".$_POST["news_category"]."','".$_POST["date"]."')";
$conn->query($query);
echo json_encode($query);