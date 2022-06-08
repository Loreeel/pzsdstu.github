function replaceImageButton(oldButton, types, directory)
{
    for(let i=0;i<oldButton.length;i++)
    {
        let span = document.createElement('span')
        span.setAttribute('data-bs-toggle', 'modal')
        span.setAttribute('data-bs-target', '#imagesUploadModal')

        let button = document.createElement('button')
        button.type = 'button'
        button.classList.add('note-btn')
        button.title = 'Картинка'
        button.setAttribute('data-bs-toggle', 'tooltip')
        button.setAttribute('data-bs-placement', 'bottom')
        button.setAttribute('aria-label', 'Картинка')
        button.setAttribute('data-bs-original-title', 'Картинка')

        button.innerHTML = `<i class="note-icon-picture" data-b></i>`

        span.appendChild(button)
        document.getElementsByClassName('note-insert')[i].replaceChild(span,oldButton[i])
    }
    addModalWindow(types,directory)
}

function addModalWindow(types,directory)
{
    let modalDiv = document.createElement('div')
     modalDiv.innerHTML=
         `<div class="modal fade" id="imagesUploadModal" tabindex="-1" aria-labelledby="addImageModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addImageModalLabel">Додавання зображень</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <input class="form-control" type="file" id="img_news_input" name="user-file"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                    </div>
                </div>
            </div>
        </div>`

    $('body').append(modalDiv)

    setImagePreview(document.querySelector("#img_news_input"), types,directory, $('#summernote'))
}

