<?php
require_once '../settings.php';
/** @var TYPE_NAME $host */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
/** @var TYPE_NAME $db */

$conn = new mysqli($host, $user, $password, $db);

$query = "select n.*,nc.name_category from News n
inner join NewsCategories nc on n.news_category = nc.id
where news_category = ".$_POST["category"]." order by date desc";

$result = $conn->query($query);


$res = array();
while ($tmp = mysqli_fetch_assoc($result)) {
    $res[] = $tmp;
}
echo json_encode($res);




