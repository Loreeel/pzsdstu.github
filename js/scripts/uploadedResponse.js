function hideBtn(){
    $('#upload').hide();
    $('#res').html("Идет загрузка файла");
}
function handleResponse(mes) {
    $('#upload').show();
    if (mes.errors != null) {
        $('#res').html("Возникли ошибки во время загрузки файла: " + mes.errors);
    }
    else {
        $('#res').html("Файл " + mes.name + " загружен");
    }
}