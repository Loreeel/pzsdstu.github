
function setImagePreview(input,types,directory,summernote) {

    let files =[]

    const open = document.createElement('button')
    open.classList.add('btnn')
    open.textContent = 'Прикріпити зображення'
    open.type = 'button'
    ///////////////////////////////////////////////////
    const upload = document.createElement('div')
    upload.classList.add('container')
    upload.classList.add('d-flex')
    upload.classList.add('flex-row')

    const upload_btn = document.createElement('button')
    upload_btn.classList.add('btnn_up')
    upload_btn.textContent = 'Завантажити'
    upload_btn.type = 'button'
    upload_btn.id = 'upload_btn'

    let spinner = document.createElement('div')
    spinner.classList.add('spinner-border')
    spinner.classList.add('text-success')
    spinner.role = 'status'
    spinner.id = 'spinner'
    spinner.style.display = 'none'
    spinner.innerHTML = `<span class="visually-hidden">Loading...</span>`

    upload.append(upload_btn)
    upload.append(spinner)

    //////////////////////////////////////////////////////
    const preview = document.createElement('div')
    preview.classList.add('preview')

    const uploaded = document.createElement('div')
    uploaded.classList.add('uploaded')
    uploaded.classList.add('d-flex')

    ////////////////////////////////////////////////////////////////////

    const hr = document.createElement('hr')

    const uploaded_label = document.createElement('label')
    uploaded_label.innerText = 'Завантажені зображення:'

    if(summernote!=null)
    {
        input.insertAdjacentElement('afterend', uploaded)
        input.insertAdjacentElement('afterend', uploaded_label)
        input.insertAdjacentElement('afterend', hr)

        input.insertAdjacentElement('afterend', upload)
        input.insertAdjacentElement('afterend', preview)
        input.insertAdjacentElement('afterend', open)
    }
    else
    {
        input.insertAdjacentElement('afterend', preview)
        input.insertAdjacentElement('afterend', open)
    }


    input.accept = types.join(',')

    const triggerInput = () => input.click()

    const changeHandler = event => {
        preview.innerHTML=''
        if (!event.target.files.length) return
        files = Array.from(event.target.files)

        files.forEach(file => {

            let filename = event.target.files[0].name
            let ext = filename.split('.')[(filename.split('.').length-1)]

            const reader = new FileReader()

            reader.onload = ev => {
                if(ext =='mp4')
                {
                    preview.insertAdjacentHTML('afterbegin',
                        `<div class="preview-image">
                            <div class="preview_remove" data-remove="${file.name}">&times;</div>
                            <video width="300" height="200" controls="controls" src="${ev.target.result}"/>
                          </div>`)
                }
                else
                {
                    preview.insertAdjacentHTML('afterbegin',
                        `<div class="preview-image">
                            <div class="preview_remove" data-remove="${file.name}">&times;</div>
                            <img src="${ev.target.result}"/>
                          </div>`)
                }
            }

            reader.readAsDataURL(file)
        })
    }
    const removeHandler = event =>
    {
        if(event.target.dataset.remove)
        {
            const name = event.target.dataset.remove
            //files.filter(file=> file.name !== name)
            input.value=''
            const block = preview.querySelector(`[data-remove="${name}"]`).closest('.preview-image')
            block.remove()
        }

        if(event.target.dataset.bb)
        {
            console.log(event.target.dataset)

            if(event.target.dataset.type == 'img')
            {
                const name = event.target.dataset.bb
                const img = document.createElement('img')
                img.src = name
                summernote.summernote('code',summernote.summernote('code')+img.outerHTML)
            }
            else if(event.target.dataset.type == 'vid')
            {
                const name = event.target.dataset.bb
                const video = document.createElement('video')
                video.src = name
                video.style.cssText += 'width:300px; height: auto;';
                video.controls = true
                summernote.summernote('code',summernote.summernote('code')+video.outerHTML)
            }
        }
    }

    const uploadToServer = () => {
        const files = input.files
        if(files.length!=0) {
            uploadFile(input, directory)
            $('#spinner').show()
            $('#upload_btn').prop('disabled', true)
        }
        else alert("Void input")
    }

    ////////////////////////////////////////////
    upload.addEventListener('click',uploadToServer)
    open.addEventListener('click', triggerInput)
    input.addEventListener('change', changeHandler)
    preview.addEventListener('click',removeHandler)
    uploaded.addEventListener('click',removeHandler)
}