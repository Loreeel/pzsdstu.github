<?php
/*session_start();
if (isset($_SESSION["role"])) {
    if ($_SESSION["role"] != 2) {
        header('Location: home.php');
    } else {*/
        include("../modules/header.php"); ?>

        <div class="row d-flex mx-auto">
            <div class="col-sm-3">
                <div class="nav flex-column nav-pills bg-light" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">
                        Редагування картки викладача
                    </button>
                    <button class="nav-link" id="v-pills-news-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-news" type="button" role="tab" aria-controls="v-pills-news"
                            aria-selected="false">
                        Керування акаунтом
                    </button>
                </div>
            </div>

            <div class="col-sm-9">

                <div class="tab-content border-top py-2 bg-light" id="v-pills-tabContent">

                    <div class="tab-pane fade show active " id="v-pills-home" role="tabpanel"
                         aria-labelledby="v-pills-home-tab">
                        <div class="container d-flex justify-content-center">
                            Редагування картки викладача
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-news" role="tabpanel" aria-labelledby="v-pills-news-tab">
                        <div class="container d-flex justify-content-center w-100">
                            <div id="newsCategoryContainer" class="col">
                                <p>Керування акаунтом</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php include("../modules/footer.php");
    /*}
} else {
    header('Location: home.php');
}*/
?>


