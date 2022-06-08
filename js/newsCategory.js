function newNewsCategory(body,callback)
{
    const url = "../database/newsCategory/createNewsCategory.php"
    AJAX(body,url,callback)
}

function deleteNewsCategory(id)
{
    const url = '../database/newsCategory/deleteNewsCategory.php'
    AJAX({"id":id},url,function ()
    {
        fillNewsCategoryTbl()
    })
}

function updateNewsCategory(body)
{
    const url = '../database/newsCategory/updateNewsCategory.php'
    AJAX(body,url,function (){
        fillNewsCategoryTbl()
    })
}
