function uploadFile(input, directory) {

    let file_data = $(input).prop('files')[0]
    let form_data = new FormData()
    form_data.append('file', file_data)
    form_data.append('directory', directory)
    $.ajax({
        url: '../../database/files/uploadNewsContent.php',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (res) {

            $('#spinner').hide()
            $('#upload_btn').prop('disabled', false)

            const data = JSON.parse(res)
            $(input)[0].value=""
            $('.preview').html('')

            console.log(data['ext'])
            if(data['ext'] == "mp4")
            {
                $('.uploaded')[0].insertAdjacentHTML('afterbegin',
                    `<div class="preview-image">
                            <div class="preview_bb" data-type="vid" data-bb="${data['path']}">&#43;</div>
                            <video width="400" height="300" controls="controls" src="${data['path']}"/>
                          </div>`)
            }
            else
            {
                $('.uploaded')[0].insertAdjacentHTML('afterbegin',
                    `<div class="preview-image">
                            <div class="preview_bb" data-type="img" data-bb="${data['path']}">&#43;</div>
                            <img src="${data['path']}"/>
                          </div>`)
            }
        }
    });
}