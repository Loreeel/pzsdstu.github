<?php include("../modules/header.php") ;?>

    <div class="card text-dark bg-light m-3 w-75 mx-auto">
        <div class="card-header" id="news-header"></div>
        <div class="card-body" id="news-body"></div>
        <script>
            function imgDiv(src)
            {
                let imageDiv = document.createElement('div')
                imageDiv.classList.add('overflow-hidden')

                let imgCont = document.createElement('div')
                imgCont.classList.add('container')
                //imgCont.classList.add('px-5')
                imgCont.classList.add('align-content-center')


                const image = document.createElement('img')
                image.src = src
                image.classList.add('mx-auto')
                image.classList.add('w-100')
                image.style.maxWidth='700px'
                image.classList.add('img-fluid')
                image.classList.add('rounded')
                image.classList.add('d-block')

                imgCont.append(image)
                imageDiv.append(imgCont)
                return imageDiv
            }

            function titleDiv(title,date)
            {
                let titleDiv = document.createElement('figure')
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
                titleDiv.append(blockTitle)
                titleDiv.append(dateCaption)

                return titleDiv
            }

            function contentDiv(content)
            {
                const contentDiv = document.createElement('div')
                contentDiv.classList.add('container')
                contentDiv.classList.add('py-3')

                const contentText = document.createElement('p')
                contentText.innerHTML = content
                //contentText.style.whiteSpace = 'break-spaces'

                contentDiv.append(contentText)
                return contentDiv
            }

            function fillPage(img_src,title_text,content_text,date_cr)
            {
                const newsHeader = $('#news-header')[0]
                const newsBody = $('#news-body')[0]

                newsHeader.append(titleDiv(title_text,date_cr))
                newsBody.append(imgDiv(img_src))
                newsBody.append(contentDiv(content_text))
            }

            $(document).ready(function ()
            {
                selectOneNews(<?php echo $_GET['id'];?>,function (res)
                {
                    const data = res[0]
                    fillPage(data['image'],data['title'],data['content'],data['date'])
                })
            })


        </script>
    </div>
<?php include("../modules/footer.php") ;?>