<?php
    unlink($_SERVER['DOCUMENT_ROOT'] .$_POST['path']);
    echo $_SERVER['DOCUMENT_ROOT'] .$_POST['path'];