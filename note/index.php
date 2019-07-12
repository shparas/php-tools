<html>
<head>
    <title>Note</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<div class="sidebox">
    <div>
        <div id="filelist">
            <?php include("files.php"); ?>
        </div>
    </div>
    <div>
        <div class="createNew button" onclick="createNew()">+New</div>
        <div id="createnew">
            Category:<input id='catname' type="text" name="catname" value="default" placeholder="Category:">
            FileName:<input id='filename' type="text" name="filename" value="" placeholder="File Name">
            <button name="done" value="Create" onclick="createNewProceed()">Create</button>
        </div>
    </div>
</div>
<div class="mainbox">

    <div class="toolbar">
        <button class="toolitem bold" id="bold" onclick="bold()">B</button>
        <button class="toolitem italic" id="italic" onclick="italic()">I</button>
        <button class="toolitem underline" id="underline" onclick="underline()">U</button>
        <button class="toolitem strike" id="strike" onclick="strike()">S</button>
        <button class="toolitem strike" id="save" onclick="saveThis()">Save</button>

        <input style='width:60px' type="number" class="toolitem" name="size" value="24">S</input>
        <input type="color" class="toolitem" name="color" value="#000000">C</input>
        <input type="color" class="toolitem" name="highlight" value="#FFFFFF">H</input>
        <select class="toolitem" name="face">
            <option value="1" selected>Arial</option>
            <option value="2" selected>Calibri</option>
            <option value="3" selected>TNR</option>
            <option value="4" selected>Old Eng</option>
        </select>
        <select class="toolitem" name="align">
            <option value="Left" selected>Left</option>
            <option value="Right" selected>Right</option>
            <option value="Center" selected>Center</option>
            <option value="Justify" selected>Justify</option>
        </select>
    </div>

    <div class="textbox3">
        <div class="textbox2">
            <div class="textbox overflowcontrol" id="writearea" contenteditable="true">sdf</div>
        </div>
        <div id="footer">
            <div id="pagenumber">12</div>
        </div>
    </div>
    
    <button onclick="alert(getSelectedHtml()+'->'+getCaretPosition(document.getElementById('writearea'))+'->'+document.getElementById('writearea').innerHTML)">HeLLO</button>
</div>
<div id="hello">

</div>
</body>
</html>
