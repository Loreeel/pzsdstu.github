class TableAdapter {

    constructor(array, title, table_id) {
        this.array = array
        this.title = title
        this.table_id = table_id
    }

    getViewTable(columns, titles, isEdit) {
        let rez = `
        <div class="table-responsive">
            <table id="${this.table_id}" class="table table-bordered caption-top fade-in">
                <caption id="${this.table_id + '_cap'}">
                    ${this.title}`
        if (isEdit)
            rez += ``
        rez += `</caption>
        <thead class="table-primary">
            <tr>`
        titles.forEach(col => {
            rez += `<th scope="col">${col}</th>`
        })
        if (isEdit) {
            rez += `<th  style="width: 10%; text-align: center" scope="col">Ред.</th>
                    <th style="width: 10%; text-align: center" scope="col">Вид.</th>`
        }
        rez += `</tr>
        </thead>`
        ///////////////////////////
        rez += `<tbody>`
        this.array.forEach(item => {
            rez += `<tr data-id="${item["id"]}">`
            columns.forEach(col => {
                rez += `<td class="align-middle">${item[col]}</td>`
                if (isEdit) {
                    rez += `
                            <td>
                                <button type="button" onclick="editNewsCategory(this,${item["id"]})"  class="btn btn-outline-secondary d-flex mx-auto">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" onclick="deleteNewsCategory(${item["id"]})" class="btn btn-outline-danger d-flex mx-auto">
                                    <i class="fa-solid fa-bucket"></i>
                                </button>
                            </td>
                            `
                }
            })


            rez += `</tr>`
        })

        return rez + `</tbody>
            </table>
        </div>`
    }

    getDropDownList(column) {
        let rez = ''
        rez += `<select class="form-select form-select-sm" aria-label="Оберіть із списку">`
        this.array.forEach(item => {
            rez += `<option>${item[column]}</option>`
        })
        return rez + `</select>`
    }

    getNewsItem(role) {
        let rez = ""
        this.array.forEach(item => {
            let newsContent = item['content']
            newsContent = newsContent.replace(/<[^>]+>/g,'')
            if (newsContent.length>200)
            {
                newsContent = newsContent.substr(0,200)+'...'
            }
            rez += `
                <div id="${item["id"]}" class="card mb-3" style="max-width: 1080px;">
                    <div class="row g-0">
                        <div class="col-lg-4">
                            <img src="${item["image"]}"class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <div class="header">
                                    <h5 class="card-title">${item["title"]}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><small>${item["date"]}</small></h6>
                                </div>
                                <div class="card-text mb-5"> ${newsContent} </div>
                                <div class="card-body position-absolute bottom-0 end-0">
                                     <a type="button" href="../pages/news_page.php?id=${item['id']}" class="btn btn-primary mx-1">Переглянути</a type="button">`
                                    if (role == 1) rez +=
                                    `<button type="button" onclick="deleteNews(${item["id"]})" class="btn btn-outline-danger ">
                                        <i class="fa-solid fa-bucket"></i>
                                    </button>
                                    <button onclick="modalForEditContent(this)" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#newsModal" data-bs-whatever="${item["id"]}">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>`;
            rez +=              `</div>
                            </div>
                        </div>
                    </div>
                </div>`
            //
            //             <div class="card-body">
            //                     <div class="header">
            //                         <h5 class="card-title">${item["title"]}</h5>
            //                          <h6 class="card-subtitle mb-2 text-muted"><small>${item["date"]}</small></h6>
            //                     </div>
            //                     ${console.log(newsContent)}
            //                     <div class="card-text"> ${newsContent} </div>
            //                 </div>`
            //
            //                 rez+= `
            //                 <div class="card-body position-absolute bottom-0 end-0">
            //                 <a type="button" href="../pages/news_page.php?id=${item['id']}" class="btn btn-primary">Переглянути</a type="button">`
            //
            // if (role == 1) rez += `
            //                 <button type="button" onclick="deleteNews(${item["id"]})" class="btn btn-outline-danger ">
            //                     <i class="fa-solid fa-bucket"></i>
            //                 </button>
            //                 <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editNewsModal" data-bs-whatever="${item["id"]}">
            //                     <i class="fa-solid fa-pen"></i>
            //                 </button>
            //                 `;
            //
            //            </div>

        })
        return rez
    }

    getTeacherItem(role) {
        let rez = ""
        this.array.forEach(item => {
            //let newsContent = item['content'].substr(0, 200) + "..."
            rez += `
                <div class="col">
                    <div id="${item['id']}" class="card h-100">
                        <div class="card-img d-flex justify-content-center"   >   
<!--                    --> <img style="
                                width:auto;
                                height:330px;"
                            src="${item['photo']}" class="card-img-top" alt="..."/>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">${item['pib']}</h5>
                            <p class="fst-italic">${item['position']}</p>
                            <p class="card-text">${item['description']}</p>
                            <a href="../pages/teacher_page.php?teacher=${item['id']}" class="btn btn-primary">Переглянути</a>
                     
                            `;
            if (role == 1) rez += `
                            <button type="button" onclick="deleteTeacher(${item["id"]})" class="btn btn-outline-danger ">
                                <i class="fa-solid fa-bucket"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editTeacherModal" data-bs-whatever="${item["id"]}">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            `;
            rez += ` </div>
                    </div>
                </div>
            </div>
            `
        })
        return rez
    }
}