function addBbButtonsAndField(div_id)
{
    let div = document.createElement('div')
    div.classList.add('container')
    div.classList.add('mx-0')

    div.innerHTML=
    `   <button class="btn btn-outline-secondary " onclick="addBoldBB('textarea')"><strong>Ж</strong></button>
        <button class="btn btn-outline-secondary " onclick="addItalicBB('textarea')"><i>К</i></button>
        <button class="btn btn-outline-secondary " onclick="addLinedBB('textarea')"><u>Ч</u></button>
        <button class="btn btn-outline-secondary " onclick="addUlLiBB('textarea')">Список</button>
        <button id="img_btn" class="btn btn-outline-secondary " onclick="addImgBB('textarea')">Img</button>
        <input class="d-none" type="file" id="img_file" multiple="multiple"/>`

    div.innerHTML+=
        `<textarea style="margin-top: 5px" class="form-control" rows="15" id="textarea"></textarea>
        <button id="BBSubmit" class="btn btn-outline-primary " onclick="parseBB('textarea','testdiv')">Оновити</button>`
    const div_elem = document.getElementById(div_id)

    div_elem.appendChild(div)

    div_elem.querySelector('#textarea').addEventListener('keydown', function(e) {
        if (e.key == 'Tab') {
            e.preventDefault();
            let start = this.selectionStart;
            let end = this.selectionEnd;

            // set textarea value to: text before caret + tab + text after caret
            this.value = this.value.substring(0, start) +
                "\t" + this.value.substring(end);

            // put caret at right position again
            this.selectionStart =
                this.selectionEnd = start + 1;
        }
    });
}
function addBoldBB(tagId)
{
    insertBB(tagId,'[b]','[/b]')
}

function addImgBB(tagId)
{
    insertBB(tagId,'[img]','[/img]')
}

function addItalicBB(tagId)
{
    insertBB(tagId,'[i]','[/i]')
}

function addLinedBB(tagId)
{
    insertBB(tagId,'[u]','[/u]')
}
function addUlLiBB(tagId)
{
    insertBB(tagId,'[list]\n\t[li]','[/li]\n[/list]')
}
function insertBB(tagId,textOp,textEnd)
{
    let txtArea = document.getElementById(tagId);
    let start = txtArea.selectionStart;
    let end = txtArea.selectionEnd;
    let sel = txtArea.value.substring(start, end);
    let finText = txtArea.value.substring(0, start) + textOp + sel + textEnd + txtArea.value.substring(end);
    txtArea.value = finText;
    txtArea.focus();
    txtArea.selectionEnd= end + textOp.length+textEnd.length;

}
function parseBB(inputID,resultID)
{
    let text = $('#'+inputID).val()
    let result = XBBCODE.process({
        text: text,
        removeMisalignedTags: false,
        addInLineBreaks: false
    });
    document.getElementById(resultID).innerHTML=result.html
}