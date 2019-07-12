/**
 * Created by Paras on 6/13/2016.
 */

function getSelectedHtml() {
    var html = "";
    if (typeof window.getSelection != "undefined") {
        var sel = window.getSelection();
        if (sel.rangeCount) {
            var container = document.createElement("div");
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                container.appendChild(sel.getRangeAt(i).cloneContents());
            }
            html = container.innerHTML;
        }
    } else if (typeof document.selection != "undefined") {
        if (document.selection.type == "Text") {
            html = document.selection.createRange().htmlText;
        }
    }
    return html;
}
function getCaretPosition(element) {
    var caretOffset = 0;
    var doc = element.ownerDocument || element.document;
    var win = doc.defaultView || doc.parentWindow;
    var sel;
    if (typeof win.getSelection != "undefined") {
        sel = win.getSelection();
        if (sel.rangeCount > 0) {
            var range = win.getSelection().getRangeAt(0);
            var preCaretRange = range.cloneRange();
            preCaretRange.selectNodeContents(element);
            preCaretRange.setEnd(range.endContainer, range.endOffset);
            caretOffset = preCaretRange.toString().length;
        }
    } else if ( (sel = doc.selection) && sel.type != "Control") {
        var textRange = sel.createRange();
        var preCaretTextRange = doc.body.createTextRange();
        preCaretTextRange.moveToElementText(element);
        preCaretTextRange.setEndPoint("EndToEnd", textRange);
        caretOffset = preCaretTextRange.text.length;
    }
    return caretOffset;
}
function editHtmlAtCaret(html) {
    var sel, range;
    if (window.getSelection) {
        // IE9 and non-IE
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();

            // Range.createContextualFragment() would be useful here but is
            // non-standard and not supported in all browsers (IE9, for one)
            var el = document.createElement("div");
            el.innerHTML = html;
            var frag = document.createDocumentFragment(), node, lastNode;
            while ( (node = el.firstChild) ) {
                lastNode = frag.appendChild(node);
            }
            range.insertNode(frag);

            // Preserve the selection
            if (lastNode) {
                range = range.cloneRange();
                range.setStartAfter(lastNode);
                range.collapse(true);
                sel.removeAllRanges();
                sel.addRange(range);
            }
        }
    } else if (document.selection && document.selection.type != "Control") {
        // IE < 9
        document.selection.createRange().pasteHTML(html);
    }
}


function bold(){
    text=getSelectedHtml();
    body=document.getElementById('writearea').innerHTML;
    caretPosition=getCaretPosition(document.getElementById('writearea'));

    if(text.length>0 & caretPosition>0){
        editHtmlAtCaret("<div class='bold inline'>"+text+"</div>")
    }
}
function italic(){
    text=getSelectedHtml();
    body=document.getElementById('writearea').innerHTML;
    caretPosition=getCaretPosition(document.getElementById('writearea'));

    if(text.length>0 & caretPosition>0){
        editHtmlAtCaret("<div class='italic inline'>"+text+"</div>")
    }
}
function underline(){
    text=getSelectedHtml();
    body=document.getElementById('writearea').innerHTML;
    caretPosition=getCaretPosition(document.getElementById('writearea'));

    if(text.length>0 & caretPosition>0){
        editHtmlAtCaret("<div class='underline inline'>"+text+"</div>")
    }
}
function strike(){
    text=getSelectedHtml();
    body=document.getElementById('writearea').innerHTML;
    caretPosition=getCaretPosition(document.getElementById('writearea'));

    if(text.length>0 & caretPosition>0){
        editHtmlAtCaret("<span class='strike'>"+text+"</span>")
    }
}


function tabchange(id) {
    bodyid = id.replace('tabhead', 'tabbody');

    if (document.getElementById(bodyid).style.display=='block') {
        document.getElementById(bodyid).style.display='none'
    }
    else {
        document.getElementById(bodyid).style.display='block'
    }
}
active=''
function getThis(id) {
    id = encodeURI(id);
    var url="filereader.php?id="+id;
    getAjax(url,function(){});
    active=id;
}

function saveThis(){
    var url='savefile.php';
    var obj;
    if (window.XMLHttpRequest) {
        obj = new XMLHttpRequest();
    }
    else {
        obj = new ActiveXObject("Microsoft.XMLHTTP");
    }
    obj.open("POST", url, true);
    obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    obj.send("id="+encodeURI(active)+"&data="+encodeURI(document.getElementById('writearea').innerHTML));
    func = function () {
        if (obj.readyState == 4 && obj.status == 200) {
            alert(obj.responseText);
        }
    }
    obj.onreadystatechange=func;
}


function getAjax(url,func) {
    var obj;
    func = function () {
        if (obj.readyState == 4 && obj.status == 200) {
            //alert(obj.responseText)
            document.getElementById("writearea").innerHTML=obj.responseText;
        }
    }
    if (window.XMLHttpRequest) {
        obj = new XMLHttpRequest();
    }
    else {
        obj = new ActiveXObject("Microsoft.XMLHTTP");
    }
    obj.open("GET", url, true);
    obj.send();
    obj.onreadystatechange=func;
}

function createNew(){
    document.getElementById('createnew').style.display='block';
    document.getElementById('catname').value='';
    document.getElementById('filename').value=''
}
function createNewProceed(){
    catname=document.getElementById('catname').value;
    filename=document.getElementById('filename').value;
    if (catname=='') catname='default';
    url="files.php?createnew=true&catname="+encodeURI(catname)+"&filename="+encodeURI(filename);
    
    if (window.XMLHttpRequest) {
        var obj = new XMLHttpRequest();
    }
    else {
        var obj = new ActiveXObject("Microsoft.XMLHTTP");
    }
    obj.open("GET", url, true);
    obj.send();
    func = function () {
        if (obj.readyState == 4 && obj.status == 200) {
            document.getElementById("filelist").innerHTML=obj.responseText;
        }
    }
    obj.onreadystatechange=func;
}