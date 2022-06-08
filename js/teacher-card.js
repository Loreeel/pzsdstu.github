
function newTeacher(body)
{
    const url = '../database/teacher/createTeacher.php'
    AJAX(body,url,function (){
        document.location.reload()
    })
}

function deleteTeacher(id)
{
    let body = {"id":id}
    const url = '../database/teacher/deleteTeacher.php'
    AJAX(body,url,function (){
        document.location.reload()
    })
}

function updateTeacher(body)
{
    const url = '../database/teacher/updateTeacher.php'
    AJAX(body,url,function (){
        document.location.reload()
    })
}

function selectOneTeacher(id,callback)
{
    let body = {"id":id}
    const url = '../database/teacher/selectOneTeacher.php'
    sendFetchRequest('POST',url,body).then( data=>
    {
        callback(data)
    })
}