<?php include("../modules/header.php") ?>

<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['role'] == 1)
        echo
        '<div class="container mb-3">
                 <button onclick="modalForAddContent()" type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newsModal" >Створити новину</button>
            </div>';
}
?> <!--check role and draw addNews button-->

    <div class="container bg-light rounded shadow py-2" id="newsList"></div>

    <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="news-id" class="d-none"></div>
                    <h5 class="modal-title" id="newsModalLabel">Створення новини</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="news-title" class="col-form-label">Заголовок новини:</label>
                            <input type="text" class="form-control" id="news-title">
                        </div>
                        <div class="mb-3">
                            <label for="news-text" class="col-form-label">Текст новини:</label>
                            <div id="summernote"></div>
                        </div>
                        <div class="mb-3">
                            <label for="news-image" class="col-form-label">Посилання на титульне зображення</label>
                            <input class="form-control" id="news-image">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <button onclick="" id="news-submit" type="button" class="btn btn-primary">Створити</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/scripts/imageUploadButton.js"></script>
    <script src="../js/scripts/previewInputImage.js"></script>
    <script src="../js/scripts/uploadFile.js"></script>

    <script>
        //FE methods
        function modalForEditContent(button){
            let newsModal = document.getElementById('newsModal')

            let recipient = button.getAttribute('data-bs-whatever')

            let newsId = newsModal.querySelector('#news-id')
            newsId.textContent = recipient

            selectOneNews(recipient,function (res)
            {
                let data = res[0]
                let newsTitle = newsModal.querySelector('#news-title')
                let newsImage = newsModal.querySelector('#news-image')
                $('#summernote').summernote('code',data['content'])

                newsTitle.value = data['title']
                newsImage.value = data['image']
            })

            $('#news-submit').off('click')
            $('#news-submit').html('Змінити')
            $('#news-submit').on('click',function ()
            {
                updNews()
            })
        }
        function modalForAddContent(){
            $('#news-submit').off('click')
            $('#news-submit').val('Створити')
            $('#news-submit').on('click',function ()
            {
                createNews()
            })
        }
        //DB methods
        function updNews(){
            let newsModal = document.getElementById('newsModal')
            let newsTitle = newsModal.querySelector('#news-title')
            let newsContent = $('#summernote').summernote('code')
            let newsImage = newsModal.querySelector('#news-image')
            let newsId = newsModal.querySelector('#news-id')

            updateNews({
                'id':newsId.textContent,
                'title': newsTitle.value,
                'content':newsContent,
                'image':newsImage.value
            })
        }
        function createNews(){
            newNews(
                {
                    'title':document.getElementById('news-title').value,
                    'content':$('#summernote').summernote('code'),
                    'image': document.getElementById('news-image').value,
                    'date':new Date().toISOString().split('T')[0]
                })
        }
        function fillPage(){
            let role = <?php
                if (isset($_SESSION['id']))
                {
                    echo $_SESSION['role'];
                }
                else echo 0;
                ?>;

            const url = "../database/select.php"
            sendFetchRequest('POST',url,
                {
                    "table": "News"
                })
                .then( data=>
                {
                    const table = new TableAdapter(data)
                    document.getElementById("newsList").innerHTML+=table.getNewsItem(role)
                })
        }

        //events
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,                 // set editor height
                minHeight: 250,             // set minimum height of editor
                maxHeight: 700,             // set maximum height of editor
                focus: true,                  // set focus to editable area after initializing summernote
                lang: 'uk-UA',
                placeholder: ""

            });//init text editor
            $('#summernote').summernote('code', '');//init text editor (clear hello message)

            $('.dropdown-toggle').dropdown();//init toggle message

            const types = ['.png', '.jpg', '.jpeg', '.gif','.mp4']

            replaceImageButton($('.note-icon-picture').parent(),types,'../../uploaded/photo/news')//replace summernote button to custom button
            fillPage()//fill news content
            //setting event to swap between modalWindows
            $('#imagesUploadModal').on('hide.bs.modal',function () {
                $('#newsModal').modal('show')
            })
        })
    </script>
<?php include("../modules/footer.php") ?>