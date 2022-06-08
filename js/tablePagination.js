function setTablePagination(table_id,option_values)
{
    let maxRows = document.createElement('select')
    maxRows.id = "maxRows"
    maxRows.classList.add('form-control')
    maxRows.style.width = '50px'

    let paginationDiv = document.createElement('div')
    paginationDiv.classList.add('pagination-container')
    let paginationUl = document.createElement('ul')
    paginationUl.classList.add('pagination')
    paginationDiv.append(paginationUl)

    let options = []
    for(let i=0;i<option_values.length;i++)
    {
        options[i] = document.createElement('option')
        options[i].value = option_values[i]
        options[i].innerHTML = option_values[i]
        if(i+1 == option_values.length) options[i].selected = true
        maxRows.append(options[i])
    }
    let myTable = table_id

    $(table_id).before(maxRows)
    $(table_id).after(paginationDiv)

    let func = function ()
    {
        $('.pagination').html('')

        let trnum = 0
        let maxRows = parseInt($(this).val())
        let totalRows = $(myTable+' tbody tr').length

        $(myTable+' tr:gt(0)').each(function ()
        {
            trnum++
            if(trnum > maxRows)
            {   $(this).hide()  }

            if(trnum<=maxRows)
            {   $(this).show()  }
        })

        if(totalRows> maxRows)
        {
            let pageNum = Math.ceil(totalRows/maxRows)
            for(let i=1;i<=pageNum;)
            {
                $('.pagination').append(
                    `<li class="page-item" data-page="${i}">\
                        <a class="page-link" href="#">${i++}</a>
                    </li>`).show()
            }
        }
        $('.pagination li:first-child').addClass('active')
        $('.pagination li').on('click',function ()
        {
            let pageNum = $(this).attr('data-page')
            let trIndex = 0;
            $('.pagination li').removeClass('active')
            $(this).addClass('active')
            $(myTable+' tr:gt(0)').each(function ()
            {
                trIndex++
                if(trIndex>(maxRows*pageNum)||trIndex<=((maxRows*pageNum)-maxRows))
                {
                    $(this).hide()
                }
                else
                {
                    $(this).show()
                }
            })
        })
    }

    $('#maxRows').on('change',func)
    $("#maxRows").prop("selectedIndex", 0).change();
}