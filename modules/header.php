<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!Doctype html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Кафедра ПЗС ДДТУ</title>

    <!-- custom css -->
    <link rel="stylesheet" href="../style/upload.css"/>
    <link rel="stylesheet" href="../style/xbbcode.css"/>

    <!-- icons -->
    <link rel="shortcut icon" href="../img/laptop.svg" type="image/x-icon">

    <!-- library css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="../css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- library js -->
    <script src="../js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="../js/jquery/dist/jquery.min.js"></script>

    <!-- custom js -->
    <script src="../js/requests.js"></script>
    <script type="text/javascript" src="../js/tableAdapter.js"></script>

    <script src="../js/news.js"></script>
    <script src="../js/teacher-card.js"></script>
    <!-- text editor -->

    <!-- include libraries(jQuery, bootstrap) -->

    <!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.17/lang/summernote-uk-UA.js"></script>    <script>
        function Auth() {
            let log = document.getElementById('auth_login').value
            let psw = document.getElementById('auth_pass').value
            authRequest(
                {
                    'login': log,
                    'pass': psw
                }).then(data => {
                if (data !== 'noAuth') {
                    document.location.reload()
                } else
                    alert('Невірний логін чи пароль')
            })
        }

        function Logout() {
            fetch('../database/logout.php').then(() => {
                document.location.reload()
            })

        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-expand-lg sticky-top navbar-light bg-light h6 bg-gradient">
    <div class="container-fluid">
        <a class="navbar-brand" href="../pages/home.php">
            <i class='fas fa-laptop-code'></i>
            Кафедра ПЗС ДДТУ
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../pages/news.php"> <!--href="../pages/home.php"-->Головна</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/about.php">Про кафедру</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/history.php">Історія кафедри</a>
                </li>
<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="../pages/news.php">Новини</a>-->
<!--                </li>-->

                <!--                <li class="nav-item dropdown">-->
                <!--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">-->
                <!--                        Dropdown-->
                <!--                    </a>-->
                <!--                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">-->
                <!--                        <li><a class="dropdown-item" href="#">Action</a></li>-->
                <!--                        <li><a class="dropdown-item" href="#">Another action</a></li>-->
                <!--                        <li><hr class="dropdown-divider"></li>-->
                <!--                        <li><a class="dropdown-item" href="#">Something else here</a></li>-->
                <!--                    </ul>-->
                <!--                </li>-->
                <!--                <li class="nav-item">-->
                <!--                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>-->
                <!--                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="../pages/teachers.php">Викладачі</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php
                if (isset($_SESSION['id'])) {
                    if ($_SESSION['role'] == 1) {
                        echo "<a href='../pages/admin_cabinet.php' class=\"btn btn-outline-primary mx-1\">" . $_SESSION["name"] . "</a>";
                    }
                    else {
                        echo "<button class=\"btn btn-outline-primary mx-1\">" . $_SESSION["name"] . "</button>";

                    }
                    echo "<button onclick=\"Logout()\" class=\"btn btn-outline-danger mx-1\">Вийти</button>";
                }
                else {
                    echo "<button class=\"btn btn-outline-success\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\" >Увійти</button>";
                }
                ?>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Авторизація</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="auth_login" class="col-sm-2 col-form-label">Логін</label>
                    <div class="col-sm-10">
                        <input name="login" id="auth_login" type="text" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="auth_pass" class="col-sm-2 col-form-label">Пароль</label>
                    <div class="col-sm-10">
                        <input name="pass" id="auth_pass" type="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                <button onclick="Auth()" type="button" class="btn btn-outline-success">Увійти</button>
            </div>
        </div>
    </div>
</div>


