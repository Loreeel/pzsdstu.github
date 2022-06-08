function AJAX(body,url,callback)
{
    const header={
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
    }
    return fetch(url,
        {
            method:'POST',
            headers:header,
            body:Object.entries(body).map(([k,v])=>{return k+'='+v}).join('&'),
        }).then(res=>{
            callback(res)
        }
    )
}
async function getData(body,url)
{
    const header={
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
    }
    const response = await fetch(url,
        {
            method:'POST',
            headers:header,
            body:Object.entries(body).map(([k,v])=>{return k+'='+v}).join('&'),
        })
    return await response.json()
}

function sendFetchRequest(method,url,body){
    const header={
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
    }
    return fetch(url,
        {
            method:method,
            body:Object.entries(body).map(([k,v])=>{return k+'='+v}).join('&'),
            headers:header
        }).then(res=>{
            if(res.ok)
            {
                return res.json()
            }
            return res.json().then( error=>
            {
                const e =new Error('Error')
                e.data = error
                throw e
            })
        })
}
function authRequest(body){
    const header={
        "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
    }
    return fetch('../database/auth.php',
        {
            method:'POST',
            body:Object.entries(body).map(([k,v])=>{return k+'='+v}).join('&'),
            headers:header
        }).then(res=>{
        if(res.ok)
        {
            return res.text()
        }
        return res.json().then( error=>
        {
            const e =new Error('Error')
            e.data = error
            throw e
        })
    })
}
