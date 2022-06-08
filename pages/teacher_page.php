<?php include("../modules/header.php") ;?>


    <div class="card text-dark bg-light m-3">
        <div class="card-header d-sm-flex d-lg-inline-flex" id="teacher-header"></div>
        <div class="card-body" id="teacher-body" ></div>
        <script>
            function imgDiv(src)
            {
                let imageDiv = document.createElement('div')
                imageDiv.classList.add('col-sm')

                let imgCont = document.createElement('div')
                imgCont.classList.add('container')
                imgCont.classList.add('align-content-center')

                const image = document.createElement('img')
                image.src = src
                image.classList.add('mx-auto')
                image.classList.add('w-100')
                image.style.maxWidth='350px'
                image.classList.add('img-fluid')
                image.classList.add('rounded')
                image.classList.add('d-block')

                imgCont.append(image)
                imageDiv.append(imgCont)
                return imageDiv
            }

            function titleDiv(title,date)
            {
                let titleDiv = document.createElement('div')
                titleDiv.classList.add('col-sm')
                let titleFig = document.createElement('figure')
                let blockTitle = document.createElement('blockquote')
                blockTitle.classList.add('blockquote')
                let titleText = document.createElement('h2')
                titleText.textContent=title

                let dateCaption = document.createElement('p')
                dateCaption.classList.add('y')

                let dateText = document.createElement('em')
                dateText.innerText = date
                dateCaption.append(dateText)

                blockTitle.append(titleText)
                titleFig.append(blockTitle)
                titleFig.append(dateCaption)

                titleDiv.append(titleFig)

                return titleDiv
            }

            function contentDiv(content)
            {
                const contentDiv = document.createElement('div')
                contentDiv.classList.add('container')
                contentDiv.classList.add('py-3')

                const contentText = document.createElement('p')
                contentText.innerHTML = content
                contentText.style.whiteSpace = 'break-spaces'

                contentDiv.append(contentText)
                return contentDiv
            }

            function fillPage(photo,pib,description,position)
            {
                const teacherHeader = $('#teacher-header')[0]
                const teacherBody = $('#teacher-body')[0]

                let headerDiv = document.createElement('div')
                headerDiv.classList.add('row')


                headerDiv.append(imgDiv(photo))
                headerDiv.append(titleDiv(pib,position))

                teacherHeader.append(headerDiv)
                teacherBody.append(contentDiv(description))
                teacherBody.append(contentDiv("Місце для pdf"))
            }

            $(document).ready(function ()
            {
                selectOneTeacher(<?php echo $_GET['teacher'];?>,function (res)
                {
                    const data = res[0]
                    fillPage(data['photo'],data['pib'],data['description'],data['position'])
                })
            })


        </script>
    </div>

<?php include("../modules/footer.php") ;?>