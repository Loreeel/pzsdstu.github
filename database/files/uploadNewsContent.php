<?php
    $path = $_POST['directory'].'/'.$_FILES['file']['name'];
    $fileInfo = pathinfo($path);

    $directory = $_POST['directory'].'/';
    $fileName = $fileInfo["filename"];
    $fileExt = $fileInfo["extension"];

    $file = $directory.$fileName.".".$fileExt;

    $i=1;
    while(file_exists($file))
    {
        $file = $directory.$fileName."($i).".$fileExt;
        $i++;
    }

    move_uploaded_file($_FILES['file']['tmp_name'], $file);

    $res['path'] = $file;
    $res['file'] = $fileName."($i).".$fileExt;
    $res['ext']  = $fileExt;

    echo json_encode($res);



