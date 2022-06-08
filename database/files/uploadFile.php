<?php
$res = array();

if(isset($_FILES['file']['tmp_name'])) {

    $folder =  $_POST["directory"];
    $error = true;
    $whitelist = array(".gif", ".jpeg", ".png",".jpg");

    foreach  ($whitelist as  $item) {
        if(preg_match("/$item\$/i",$_FILES['file']['name'][0])) $error = false;
    }

    if(!$error)
    {
        $uploadFile = $folder.basename($_FILES['file']['name'][0]);
      
        if(is_uploaded_file($_FILES['file']['tmp_name'][0])){
            
            if(move_uploaded_file($_FILES['file']['tmp_name'][0],$uploadFile)){
                $res['result'] =$folder.$_FILES['file']['name'][0];
            }
            else {
                $res['error'] = "Во время загрузки файла произошла ошибка";
            }
        }
        else {
            $res['error'] = "Файл не загружен";
        }
    }
    else
    {
        $res['error'] = "Некорректное расширение";
    }
}
else
{
    $res['rez'] = "ОК";
}
echo json_encode($res);
