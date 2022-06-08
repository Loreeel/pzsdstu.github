
function newNews(body)
{
    const url = '../database/news/createNews.php'
    AJAX(body,url,function (){
        document.location.reload()
    })
}

function deleteNews(id)
{
    let body = {"id":id}
    const url = '../database/news/deleteNews.php'
    AJAX(body,url,function (){
        document.location.reload()
    })
}

function updateNews(body)
{
    const url = '../database/news/updateNews.php'
    AJAX(body,url,function (){
        document.location.reload()
    })
}

function selectOneNews(id,callback)
{
    let body = {"id":id}
    const url = '../database/news/selectOneNews.php'
    sendFetchRequest('POST',url,body).then( data=>
    {
        callback(data)
    })
}