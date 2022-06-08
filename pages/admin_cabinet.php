<?php
session_start();
if (isset($_SESSION["role"])) {
    if ($_SESSION["role"] != 1) {
        header('Location: news.php');
    } else {
        include("../modules/header.php"); ?>

        <div class="row d-flex mx-auto">
            <div class="col-sm-3">
                <div class="nav flex-column nav-pills bg-light" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="true">
                        Головна сторінка
                    </button>
                    <button class="nav-link" id="v-pills-news-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-news" type="button" role="tab" aria-controls="v-pills-news"
                            aria-selected="false">
                        Новини
                    </button>
                    <button class="nav-link" id="v-pills-history-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-history" type="button" role="tab" aria-controls="v-pills-history"
                            aria-selected="false">
                        Історія кафедри
                    </button>

                    <button class="nav-link" id="v-pills-about-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-about" type="button" role="tab" aria-controls="v-pills-about"
                            aria-selected="false">
                        Про кафедру
                    </button>
                    <!--<button class="nav-link" id="v-pills-contact-tab" data-bs-toggle="pill"-->
                    <!--                            data-bs-target="#v-pills-contact" type="button" role="tab" aria-controls="v-pills-contact"-->
                    <!--                            aria-selected="false">-->
                    <!--                        Контакти-->
                    <!--                    </button>-->
                    <button class="nav-link" id="v-pills-users-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-users"
                            type="button" role="tab" aria-controls="v-pills-users" aria-selected="false">
                        Користувачі
                    </button>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="tab-content border-top py-2 bg-light" id="v-pills-tabContent">
                    <div class="tab-pane fade show active " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="container d-flex justify-content-center">
                            Керування головною сторінкою
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-news" role="tabpanel" aria-labelledby="v-pills-news-tab">
                        <div class="container d-flex justify-content-center w-100">
                            <div id="newsCategoryContainer" class="col">
                                <p>Керування розділом новин</p>
                                <div class="container" id="newsCategoryTable">
                                    <!---->
                                </div>
                                <div class="container" id="newsCategoryAddForm">
                                    <button class="btn btn-outline-success d-inline-flex mx-2 my-auto" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#addNewsCategory"
                                            aria-expanded="true" aria-controls="addNewsCategory">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <script type="text/javascript" src="../js/tablePagination.js"></script>
                            <script src="../js/newsCategory.js"></script>
                            <script>

                                $(document).ready(function () {
                                    createNewsCategoryAddForm()
                                    fillNewsCategoryTbl()
                                });

                                function addCategory(nameCategory) {
                                    const value = nameCategory.val()
                                    nameCategory.val('')

                                    if (!value) alert('Введіть назву категорії')

                                    else {
                                        let body = {"name": value}
                                        newNewsCategory(body, function () {
                                            fillNewsCategoryTbl()
                                        })
                                    }
                                }

                                function createNewsCategoryAddForm() {
                                    let container = document.getElementById('newsCategoryAddForm')
                                    let content = `
                                <div id="addNewsCategory" tabindex="-1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div id="newsCategoryContent" class="accordion-body">
                                        <form>
                                            <div class="mb-3">
                                                <label  for="news-category-name" class="col-form-label">Назва категорії</label>
                                                <div class="d-flex">
                                                    <input class="form-control mx-2" id="category-name">
                                                    <button onclick="addCategory($('#category-name'))" type="button" class="btn btn-primary">Створити</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>`
                                    container.innerHTML += content
                                }

                                function editNewsCategory(elem, id) {
                                    let nameCategory = elem.parentElement.parentElement.firstChild
                                    if (!nameCategory.querySelector('input')) {
                                        let input = document.createElement('input')
                                        input.classList.add('form-control')
                                        input.value = nameCategory.innerHTML
                                        nameCategory.innerHTML = ""
                                        nameCategory.appendChild(input)
                                        input.focus()
                                        input.addEventListener('blur', function () {
                                            let body = {
                                                "id": id,
                                                "name_category": this.value
                                            }
                                            updateNewsCategory(body, function () {
                                                fillNewsCategoryTbl()
                                            })
                                        })
                                    }
                                }

                                function fillNewsCategoryTbl() {
                                    let body = {"table": "NewsCategories"}
                                    const url = "../database/select.php"
                                    sendFetchRequest('POST', url, body)
                                        .then(data => {
                                            let content = data
                                            let col = ['name_category']
                                            let titles = ['Назва категорії']
                                            let table = new TableAdapter(content, "Категорії", 'categoryTable')
                                            document.getElementById("newsCategoryTable").innerHTML = table.getViewTable(col, titles, true)
                                            setTablePagination('#categoryTable', [5, 10])
                                        })
                                }
                            </script>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
                        <div class="container justify-content-center w-100">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeHistory" aria-expanded="false" aria-controls="collapseThreeHistory">
                                        Оновити історію
                                    </button>
                                </h2>
                                <div id="collapseThreeHistory" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="summernote_history"></div>

                                        <button class="btn btn-outline-secondary" id="BB_historySubmit">Зберегти</button>

                                        <script src="../js/scripts/imageUploadButton.js"></script>
                                        <script src="../js/scripts/previewInputImage.js"></script>
                                        <script src="../js/scripts/uploadFile.js.js"></script>

                                        <script>
                                            // async function fillAboutText(textArea) {
                                            //     const url = "../database/select.php"
                                            //     getData({"table": "About"}, url).then(res=>{
                                            //         textArea.summernote('code', res[0]['content']);
                                            //     })
                                            // }
                                            //
                                            // async function updateAboutText(content) {
                                            //     const url = "../database/aboutPage/aboutUpdate.php"
                                            //     getData({"content": content}, url).then(res=>{
                                            //         fillAboutText($('.summernote'))
                                            //     })
                                            // }

                                            $(document).ready(function() {
                                                $('.summernote_history').summernote({
                                                    height: 300,                 // set editor height
                                                    minHeight: 250,             // set minimum height of editor
                                                    maxHeight: 700,             // set maximum height of editor
                                                    focus: true,                  // set focus to editable area after initializing summernote
                                                    lang: 'uk-UA',
                                                    placeholder: ""
                                                });

                                                $('.summernote_history').summernote('code', '');
                                                // const types = ['.png', '.jpg', '.jpeg', '.gif','.mp4']
                                                //
                                                // replaceImageButton($('.note-icon-picture').parent(),types,'../../uploaded/photo')//replace summernote button to custom button
                                                //
                                                // fillAboutText($('.summernote'))
                                                //
                                                // $('#BBSubmit').attr('onclick',null)
                                                // $('#BBSubmit').on('click',function (){
                                                //     updateAboutText($('.summernote').summernote('code'))
                                                // })
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-users" role="tabpanel" aria-labelledby="v-pills-users-tab">
                        <div class="container d-flex justify-content-center w-100">
                            Керування користувачами системи
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-about" role="tabpanel" aria-labelledby="v-pills-about-tab">
                        <div class="container justify-content-center w-100">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Оновити опис
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                        <div class="summernote_about"></div>

                                        <button class="btn btn-outline-secondary" id="BB_aboutSubmit">Зберегти</button>

                                        <script src="../js/scripts/imageUploadButton.js"></script>
                                        <script src="../js/scripts/previewInputImage.js"></script>
                                        <script src="../js/scripts/uploadFile.js.js"></script>

                                        <script>
                                            async function fillAboutText(textArea) {
                                                const url = "../database/select.php"
                                                getData({"table": "About"}, url).then(res=>{
                                                    textArea.summernote('code', res[0]['content']);
                                                })
                                            }

                                            async function updateAboutText(content) {
                                                const url = "../database/aboutPage/aboutUpdate.php"
                                                getData({"content": content}, url).then(res=>{
                                                    fillAboutText($('.summernote_about'))
                                                })
                                            }

                                            $(document).ready(function() {
                                                $('.summernote_about').summernote({
                                                    height: 300,                 // set editor height
                                                    minHeight: 250,             // set minimum height of editor
                                                    maxHeight: 700,             // set maximum height of editor
                                                    focus: true,                  // set focus to editable area after initializing summernote
                                                    lang: 'uk-UA',
                                                    placeholder: ""
                                                });

                                                $('.summernote').summernote('code', '');
                                                const types = ['.png', '.jpg', '.jpeg', '.gif','.mp4']

                                                replaceImageButton($('.note-icon-picture').parent(),types,'../../uploaded/photo')//replace summernote button to custom button

                                                fillAboutText($('.summernote_about'))

                                                $('#BB_aboutSubmit').attr('onclick',null)
                                                $('#BB_aboutSubmit').on('click',function (){
                                                    updateAboutText($('.summernote_about').summernote('code'))
                                                })
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("../modules/footer.php");
    }
} else {
    header('Location: news.php');
}
?>


