<?php
include("../modules/header.php")
?>
<script type="text/javascript" src="../js/requests.js"></script>
<script type="text/javascript" src="../js/tablePagination.js"></script>

<!--<div class="modal fade" id="imagesUploadModal" tabindex="-1" aria-labelledby="addTeacherModalLabel"-->
<!--     aria-hidden="true">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="addTeacherModalLabel">Додавання викладача</h5>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                 <input class="form-control" type="file" id="img_news_input" name="user-file"/>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>-->
<!--                <button onclick="createTeacher()" type="button" class="btn btn-primary">Створити</button>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!---->
<!--</div>-->

<div class="container bg-light rounded shadow py-3">
    <div class="row">
        <div class="col-lg ">
            <div class="form-group">
                <div id="summernote"><p>Hello Summernote</p></div>

                <script src="../js/scripts/imageUploadButton.js"></script>
                <script src="../js/scripts/previewInputImage.js"></script>
                <script src="../js/scripts/uploadFile.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#summernote').summernote({
                            height: 300,                 // set editor height
                            minHeight: 250,             // set minimum height of editor
                            maxHeight: 700,             // set maximum height of editor
                            focus: true,                  // set focus to editable area after initializing summernote
                            lang: 'uk-UA',
                            placeholder: "",
                            disableDragAndDrop: true
                        });

                        $('#summernote').summernote('code', '')

                        const types = ['.png', '.jpg', '.jpeg', '.gif','.mp4']
                        replaceImageButton($('.note-icon-picture').parent(),types,'../../uploaded/photo')//replace summernote button to custom button

                        $("body").tooltip({ selector: '[data-bs-toggle=tooltip]' });




                        // let showInput = document.createElement('input')
                        // showInput.type = 'file'
                        // showInput.id = 'img_input'
                        // showInput.accept = '.jpeg, .jpg, .gif, .png'


                        // const triggerInput = () => showInput.click()


                        // const changeHandler = event => {
                        //     console.log(event.target.files)
                        //     event.target.files.forEach(file=>
                        //     {
                        //
                        //     })
                        // }

                        //$(button).click(triggerInput)
                        // function (){
                        //     //$('#summernote').summernote('pasteHTML', '');
                        // })
                        //$(showInput).change(changeHandler)

                        //button.appendChild(showInput)


                        //let oldButton = document.get('note-insert')[0].getElementsByTagName('button')[1]

                    });
                </script>
                <!--                <div id="area"></div>-->
                <!--                <div id="testdiv" style=" display: block; white-space: pre"></div>-->
                <div id="test"></div>
            </div>
        </div>
        <div class="col-lg ">
            <!--            <div class="ratio ratio-16x9">-->
            <!--                <iframe width="560" height="315" src="" alt="тест" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
            <!--                 https://www.youtube.com/embed/hp2CkXlfyMo -->
            <!--            </div>-->
        </div>
    </div>

    <!--    <script src="../js/scripts/previewInputImage.js"></script>-->
    <!--    <script src="../js/scripts/bbcode_buttons.js"></script>-->
    <!--    <script src="../js/js-bbcode-parser/xbbcode.js"></script>-->
    <!---->
    <!--    <script> addBbButtonsAndField("area") </script>-->

    <!--        const types = ['.png', '.jpg', '.jpeg', '.gif']-->
    <!--        const input = document.querySelector("#img_file")-->
    <!--        const button = document.querySelector("#img_btn")-->
    <!--        const textarea = document.querySelector("#textarea")-->
    <!--        const path = '../uploaded/photo/'-->
    <!--        setBB(input,types,button,textarea,path)-->
    <div class="row mt-5 d-none">
        <form method="post" action="../database/register.php">
            <div class="row mb-3">
                <label for="login" class="col-sm-2 col-form-label">Логін</label>
                <div class="col-sm-10">
                    <input name="login" id="login" type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="pass" class="col-sm-2 col-form-label">Пароль</label>
                <div class="col-sm-10">
                    <input name="pass" id="pass" type="password" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Ім'я</label>
                <div class="col-sm-10">
                    <input name="name" id="pass" type="text" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <button type="submit" class="btn btn-success">Зареєструвати</button>
            </div>
        </form>
    </div>
</div>


<!--<script type="text/javascript">-->
<!--    const table_content =-->
<!--        [{'id': 1, 'name': 'name', 'age': 21},-->
<!--            {'id': 2, 'name': 'name', 'age': 22},-->
<!--            {'id': 3, 'name': 'name', 'age': 23},-->
<!--            {'id': 4, 'name': 'name', 'age': 24},-->
<!--            {'id': 5, 'name': 'name', 'age': 26},-->
<!--            {'id': 6, 'name': 'name', 'age': 25},-->
<!--            {'id': 7, 'name': 'name', 'age': 27},-->
<!--            {'id': 8, 'name': 'name', 'age': 28},-->
<!--            {'id': 9, 'name': 'name', 'age': 29},-->
<!--            {'id': 10, 'name': 'name', 'age': 21},-->
<!--            {'id': 11, 'name': 'name', 'age': 22},-->
<!--            {'id': 12, 'name': 'name', 'age': 23},-->
<!--            {'id': 13, 'name': 'name', 'age': 24},-->
<!--            {'id': 14, 'name': 'name', 'age': 25},-->
<!--            {'id': 15, 'name': 'name', 'age': 26},-->
<!--            {'id': 16, 'name': 'name', 'age': 27}]-->
<!---->
<!--    let col = ['id', 'name', 'age']-->
<!--    let titles = ['ІД', "Ім'я", 'Вік']-->
<!--    let table = new TableAdapter(table_content, "Title", 'testTable')-->
<!--    document.getElementById("test").innerHTML += table.getViewTable(col, titles)-->
<!---->
<!---->
<!--    $(document).ready(function () {-->
<!--        setTablePagination('#testTable', [5, 10])-->
<!--    });-->
<!---->
<!--    // const url = "../database/select.php"-->
<!--    // sendFetchRequest('POST',url,-->
<!--    // {-->
<!--    //     "table": "NewTest"-->
<!--    // })-->
<!--    // .then( data=>-->
<!--    // {-->
<!--    //     let content = data-->
<!--    //     let col = ['id', 'name','age']-->
<!--    //     let titles = ['ІД', "Ім'я",'Вік']-->
<!--    //     let table = new TableAdapter(content,"Title")-->
<!--    //     document.getElementById("test").innerHTML+=table.getViewTable(col,titles)+table.getDropDownList("name")-->
<!--    // })-->
<!--</script>-->
<?php include("../modules/footer.php") ?>



