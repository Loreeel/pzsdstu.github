
async function selectNews(category,callback) {
    if(category==null) category = 'news_category'
    const url = "../database/news/selectNewsByCategory.php"
    getData({"category": category}, url).then(res=>{
        callback(res)
    })
}

async function newNews(body,callback) {
    const url = '../database/news/createNews.php'
    getData(body,url).then(()=>{
        callback()
    })
}

async function deleteNews(id,callback) {
    const url = '../database/news/deleteNews.php'
    getData({"id": id},url).then(()=>{
        callback()
    })
}


async function updateNews(body,callback) {
    const url = '../database/news/updateNews.php'
    getData(body,url).then(()=>{
        callback()
    })
}

async function selectOneNews(id,callback) {
    const url = "../database/news/selectOneNews.php"
    getData({"id": id}, url).then(res=>{
        callback(res)
    })
}
