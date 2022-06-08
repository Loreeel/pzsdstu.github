<?php include("../modules/header.php") ?>
<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['role'] == 1)
        echo
        '<div class="container my-2 ml-5">
                 <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addTeacherModal" >Додати викладача</button>
            </div>';
}
?>

    <div class="container bg-light rounded shadow align-self-center align-content-center py-3">
        <div id="teachersList" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 ">
            <script>
                function createTeacher() {

                    const fileInput = $('#img-input')[0].files

                    let formData = new FormData()
                    if (fileInput.length !== 0) {
                        $.each(fileInput, function (i, file) {
                            formData.append(`file[${i}]`, file)
                        })
                    } else {
                        alert("Оберіть файл")
                        return false
                    }
                    formData.append("directory", '../../uploaded/photo/')

                    let path = ''

                    $.ajax(
                        {
                            type: "POST",
                            url: "../database/files/uploadFile.php",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function (data) {
                                if (!data['error']) path = data['result']
                            },
                            complete: function () {
                                newTeacher(
                                    {
                                        'pib': document.getElementById('add-teacher-pib').value,
                                        'position': document.getElementById('add-teacher-position').value,
                                        'description': document.getElementById('add-teacher-description').value,
                                        'photo': path
                                    })
                            }
                        })
                }

                let role = <?php
                    if (isset($_SESSION['id']))
                    {
                        echo $_SESSION['role'];
                    }
                    else echo 0;
                    ?>;

                const url = "../database/select.php"
                sendFetchRequest('POST', url,
                    {
                        "table": "Teachers"
                    })
                    .then(data => {
                        const table = new TableAdapter(data)
                        document.getElementById("teachersList").innerHTML += table.getTeacherItem(role)
                    })

            </script> <!--create teacher script and fill teacherList by role-->

        </div>
    </div>

    <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeacherModalLabel">Додавання викладача</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add-teacher-pib" class="col-form-label">ПІБ:</label>
                        <input type="text" class="form-control" id="add-teacher-pib">
                    </div>
                    <div class="mb-3">
                        <label for="add-teacher-position" class="col-form-label">Посада:</label>
                        <textarea class="form-control" id="add-teacher-position"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="add-teacher-description" class="col-form-label">Короткий опис:</label>
                        <textarea class="form-control" id="add-teacher-description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="teacher-photo" class="col-form-label">Посилання на фото</label>
                        <div class="container">
                            <input class="form-control" type="file" id="img-input" name="user-file"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <button onclick="createTeacher()" type="button" class="btn btn-primary">Створити</button>
                </div>
            </div>

        </div>

    </div>

    <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="d-none" id="teacher-id"></label>
                    <h5 class="modal-title" id="editTeacherModalLabel">Редагуванняння новини</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="edit-teacher-pib" class="col-form-label">ПІБ:</label>
                            <input type="text" class="form-control" id="edit-teacher-pib">
                        </div>
                        <div class="mb-3">
                            <label for="edit-teacher-position" class="col-form-label">Посада:</label>
                            <textarea class="form-control" id="edit-teacher-position"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-teacher-description" class="col-form-label">Опис:</label>
                            <textarea class="form-control" id="edit-teacher-description"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="container" id="image">
                                <img class="d-none" id="img-field" src="" alt="">
                                <input class="form-control" type="file" id="img-input-edit" name="user-file"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    <button onclick="updTeacher()" type="button" class="btn btn-primary">Зберегти</button>
                </div>
            </div>
            <!--update news and fill updating form-->
            <script>

                function updTeacher() {
                    let teacherId = exampleModal.querySelector('#teacher-id')
                    let teacherPib = exampleModal.querySelector('#edit-teacher-pib')
                    let teacherPosition = exampleModal.querySelector('#edit-teacher-position')
                    let teacherDescription = exampleModal.querySelector('#edit-teacher-description')
                    let teacherLastPhoto = exampleModal.querySelector('#img-field')
                    let teacherNewPhoto = exampleModal.querySelector('#img-input-edit')
                    const fileInput = $('#img-input-edit')[0].files

                    if (teacherNewPhoto.files.length) {

                        if (teacherNewPhoto.files[0].name == teacherLastPhoto.src.split('/')[5]) {
                            const path = '../' + teacherLastPhoto.src.split('/')[3] + "/" + teacherLastPhoto.src.split('/')[4] + "/" + teacherLastPhoto.src.split('/')[5]
                            updateTeacher({
                                'id': teacherId.textContent,
                                'pib': teacherPib.value,
                                'position': teacherPosition.value,
                                'description': teacherDescription.value,
                                'photo': path
                            })
                        } else {

                            let formData = new FormData()
                            if (fileInput.length !== 0) {
                                $.each(fileInput, function (i, file) {
                                    formData.append(`file[${i}]`, file)
                                })
                            } else {
                                alert("Оберіть файл")
                                return false
                            }
                            formData.append("directory", '../../uploaded/photo/')

                            let path = ''
                            $.ajax(
                                {
                                    type: "POST",
                                    url: "../database/files/uploadFile.php",
                                    data: formData,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    dataType: 'json',
                                    success: function (data) {
                                        if (!data['error']) path = data['result']
                                    },
                                    complete: function () {
                                        $.ajax({
                                            type: "POST",
                                            url: "../database/files/unsetFile.php",
                                            data: {
                                                path: teacherLastPhoto.getAttribute('src').slice(2)
                                            },
                                            success: function (data)
                                            {

                                            },
                                            complete: function ()
                                            {
                                                console.log(path)
                                                updateTeacher({
                                                    'id': teacherId.textContent,
                                                    'pib': teacherPib.value,
                                                    'position': teacherPosition.value,
                                                    'description': teacherDescription.value,
                                                    'photo': path
                                                })
                                            }
                                        })

                                    }
                                })


                        }
                    } else {
                        const path = '../' + teacherLastPhoto.src.split('/')[3] + "/" + teacherLastPhoto.src.split('/')[4] + "/" + teacherLastPhoto.src.split('/')[5]
                        updateTeacher({
                            'id': teacherId.textContent,
                            'pib': teacherPib.value,
                            'position': teacherPosition.value,
                            'description': teacherDescription.value,
                            'photo': path
                        })
                    }
                }

                let exampleModal = document.getElementById('editTeacherModal')
                exampleModal.addEventListener('show.bs.modal', function (event) {
                    $('.preview-image').html('')
                    let button = event.relatedTarget
                    let recipient = button.getAttribute('data-bs-whatever')
                    let teacherId = exampleModal.querySelector('#teacher-id')

                    teacherId.textContent = recipient

                    selectOneTeacher(recipient, function (res) {
                        let data = res[0]

                        let teacherPib = exampleModal.querySelector('#edit-teacher-pib')
                        let teacherPosition = exampleModal.querySelector('#edit-teacher-position')
                        let teacherDescription = exampleModal.querySelector('#edit-teacher-description')
                        let teacherPhoto = exampleModal.querySelector('#img-input-edit')
                        let teacherPhotoPath = exampleModal.querySelector('#img-field')

                        teacherPib.value = data['pib']
                        teacherPosition.value = data['position']
                        teacherDescription.value = data['description']
                        teacherPhotoPath.src = data['photo']

                        let tmppreview = ''

                        if (!document.getElementById('tmp')) {
                            tmppreview = document.createElement('div')
                            tmppreview.classList.add('tmppreview')
                            tmppreview.id = 'tmp'
                        } else {
                            tmppreview = document.getElementById('tmp')
                            tmppreview.innerHTML = ""
                        }

                        const img = document.createElement('img')
                        img.src = data['photo']
                        teacherPhoto.insertAdjacentElement('afterend', tmppreview)
                        tmppreview.insertAdjacentElement('afterbegin', img)
                    })
                })
            </script>
        </div>
    </div>
    <script src="../js/scripts/previewInputImage.js"></script>
    <script type="text/javascript">
        const types = ['.png', '.jpg', '.jpeg', '.gif']

        const input = document.querySelector("#img-input")
        const input2 = document.querySelector("#img-input-edit")

        setImagePreview(input,types,'../../uploaded/photo',null)
        setImagePreview(input2,types,'../../uploaded/photo',null)
        //setImagePreview(document.querySelector("#img_news_input"), types,directory, $('#summernote'))
    </script> <!-- preview image-->
<?php include("../modules/footer.php") ?>