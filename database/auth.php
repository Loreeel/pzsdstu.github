<?php

require_once 'settings.php';
/** @var TYPE_NAME $host */
/** @var TYPE_NAME $user */
/** @var TYPE_NAME $password */
/** @var TYPE_NAME $db */

$conn = new mysqli($host, $user, $password, $db);

$query = "SELECT id,name,login,password,role from Users WHERE login='".$_POST['login']."'";
$result =$conn->query($query);
$row = mysqli_fetch_array($result);

if( $result-> num_rows != 0)
{
    if(password_verify($_POST['pass'],$row['password']))
    {
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        echo 'auth';
    }
    else
    {
        echo "noAuth";
    }
}
else
{
    echo "noAuth";
}
