<!doctype html>
<html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Rich Text Editor</title>
<script type="text/javascript">
var oDoc, sDefTxt;

function initDoc() {
  oDoc = document.getElementById("textBox");
  sDefTxt = oDoc.innerHTML;
  if (document.compForm.switchMode.checked) { setDocMode(true); }
}

function formatDoc(sCmd, sValue) {
  if (validateMode()) { document.execCommand(sCmd, false, sValue); oDoc.focus(); }
}

function validateMode() {
  if (!document.compForm.switchMode.checked) { return true ; }
  alert("Uncheck \"Show HTML\".");
  oDoc.focus();
  return false;
}

function setDocMode(bToSource) {
  var oContent;
  if (bToSource) {
    oContent = document.createTextNode(oDoc.innerHTML);
    oDoc.innerHTML = "";
    var oPre = document.createElement("pre");
    oDoc.contentEditable = false;
    oPre.id = "sourceText";
    oPre.contentEditable = true;
    oPre.appendChild(oContent);
    oDoc.appendChild(oPre);
    document.execCommand("defaultParagraphSeparator", false, "div");
  } else {
    if (document.all) {
      oDoc.innerHTML = oDoc.innerText;
    } else {
      oContent = document.createRange();
      oContent.selectNodeContents(oDoc.firstChild);
      oDoc.innerHTML = oContent.toString();
    }
    oDoc.contentEditable = true;
  }
  oDoc.focus();
}

function printDoc() {
  if (!validateMode()) { return; }
  var oPrntWin = window.open("","_blank","width=450,height=470,left=400,top=100,menubar=yes,toolbar=no,location=no,scrollbars=yes");
  oPrntWin.document.open();
  oPrntWin.document.write("<!doctype html><html><head><title>Print<\/title><\/head><body onload=\"print();\">" + oDoc.innerHTML + "<\/body><\/html>");
  oPrntWin.document.close();
}
</script>
<style type="text/css">
.intLink { cursor: pointer; }
img.intLink { border: 0; }
#toolBar1 select { font-size:10px; }
#uppic {display:none;
position:absolute;
top:100px;
left:800px; }
#textBox {
margin-top:150px;
  width: 740px;
  height: 800px;
  border: 1px #000000 solid;
  padding: 12px;
  overflow: scroll;
}
#textBox #sourceText {
  padding: 0;
  margin: 0;
  min-width: 498px;
  min-height: 200px;
}
#editMode label { cursor: pointer; }
</style>
</head>

<body onload="initDoc();">
<form name="compForm">
<input type="hidden" name="myDoc">
<div id="toolBar1">
<select onchange="formatDoc('formatblock',this[this.selectedIndex].value);this.selectedIndex=0;">
<option selected>- formatting -</option>
<option value="h1">Title 1 &lt;h1&gt;</option>
<option value="h2">Title 2 &lt;h2&gt;</option>
<option value="h3">Title 3 &lt;h3&gt;</option>
<option value="h4">Title 4 &lt;h4&gt;</option>
<option value="h5">Title 5 &lt;h5&gt;</option>
<option value="h6">Subtitle &lt;h6&gt;</option>
<option value="p">Paragraph &lt;p&gt;</option>
<option value="pre">Preformatted &lt;pre&gt;</option>
</select>
<select onchange="formatDoc('fontname',this[this.selectedIndex].value);this.selectedIndex=0;">
<option class="heading" selected>- font -</option>
<option>Arial</option>
<option>Arial Black</option>
<option>Courier New</option>
<option>Times New Roman</option>
</select>
<select onchange="formatDoc('fontsize',this[this.selectedIndex].value);this.selectedIndex=0;">
<option class="heading" selected>- size -</option>
<option value="1">Very small</option>
<option value="2">A bit small</option>
<option value="3">Normal</option>
<option value="4">Medium-large</option>
<option value="5">Big</option>
<option value="6">Very big</option>
<option value="7">Maximum</option>
</select>
<select onchange="formatDoc('forecolor',this[this.selectedIndex].value);this.selectedIndex=0;">
<option class="heading" selected>- color -</option>
<option value="red">Red</option>
<option value="blue">Blue</option>
<option value="green">Green</option>
<option value="black">Black</option>
</select>
<select onchange="formatDoc('backcolor',this[this.selectedIndex].value);this.selectedIndex=0;">
<option class="heading" selected>- background -</option>
<option value="red">Red</option>
<option value="green">Green</option>
<option value="black">Black</option>
</select>
</div>
<div id="toolBar2">
<img class="intLink" height='16px' title="Clean" onclick="if(validateMode()&&confirm('Are you sure?')){oDoc.innerHTML=sDefTxt};" src="clean.png" />
<img class="intLink" title="Print" onclick="printDoc();" src="print.png">
<img class="intLink" title="Undo" onclick="formatDoc('undo');" src="undo.png" />
<img class="intLink" title="Redo" onclick="formatDoc('redo');" src="redo.png" />
<img class="intLink" title="Remove formatting" onclick="formatDoc('removeFormat')" src="redo.png">
<img class="intLink" title="Bold" onclick="formatDoc('bold');" src="bold.png" />
<img class="intLink" title="Italic" onclick="formatDoc('italic');" src="italics.png" />
<img class="intLink" title="Underline" onclick="formatDoc('underline');" src="underline.png" />
<img class="intLink" title="Left align" onclick="formatDoc('justifyleft');" src="left.png" />
<img class="intLink" title="Center align" onclick="formatDoc('justifycenter');" src="center.png" />
<img class="intLink" title="Right align" onclick="formatDoc('justifyright');" src="right.png" />
<img class="intLink" title="Numbered list" onclick="formatDoc('insertorderedlist');" src="orderedlist.png" />
<img class="intLink" title="Dotted list" onclick="formatDoc('insertunorderedlist');" src="unorderedlist.png" />
<img class="intLink" title="Quote" onclick="formatDoc('formatblock','blockquote');" src="quote.png" />
<img class="intLink" title="Delete indentation" onclick="formatDoc('outdent');" src="outdent.png" />
<img class="intLink" title="Add indentation" onclick="formatDoc('indent');" src="indent.png" />
<img onclick='showupload();' src='image.png' />
<img class="intLink" title="Hyperlink" onclick="var sLnk=prompt('Write the URL here','http:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('createlink',sLnk)}" src="link.png" />
<img class="intLink" title="Cut" onclick="formatDoc('cut');" src="cut.png" />
<img class="intLink" title="Copy" onclick="formatDoc('copy');" src="copy.png" />
<img class="intLink" title="Paste" onclick="formatDoc('paste');" src="paste.png" />
</div>
<div id="textBox" contenteditable="true"><p>Lorem ipsum</p></div>
<p id="editMode"><input type="checkbox" name="switchMode" id="switchBox" onchange="setDocMode(this.checked);" /> <label for="switchBox">Show HTML</label></p>
<p><div onclick='savecontent();'>Preview</div></p>
</form><form action='processpost.php' method='post' name='ss'><textarea cols='30' rows='30' name='xx'></textarea><input type='submit' name='submit' value='submit' /></form><div id='ww'></div>
<div id='uppic'><form enctype='multipart/form-data' name='rform' id='myform' action=' ' method='post'><br>        <div class='preview'>
            <img src="" id="img" width="100" height="100">
        </div><input type='hidden' name='MAX_FILE_SIZE' value='30000000' /><input name='userfile' type='file'  id='userfile' /><input type="button" class="button" value="Upload" id="but_upload"></form><form name='resform'><input type='text' value=' ' name='results' id='results'>r</form><img class="intLink" title="Image" onclick="var sLnkx=document.resform.results.value;if(sLnkx&&sLnkx!=''&&sLnkx!='http://'){formatDoc('insertImage',sLnkx)}" src="addimage.png" /></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
        <script>
        function showupload() { 
        document.getElementById("uppic").style.display = "block";
        }
        </script>
        <script>
        $(document).ready(function(){

    $("#but_upload").click(function(){

        var fd = new FormData();
        var files = $('#userfile')[0].files[0];
        fd.append('userfile',files);

        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    $("#img").attr("src",response); 
                    $(".preview img").show(); // Display image element
                       $("#results").html(response); 
                       document.resform.results.value = response;
                    
                }else{
                    alert('file not uploaded');
                }
            },
        });
    });
});
</script>
           
<script>
function savecontent() { 
document.ss.xx.value = document.getElementById("textBox").innerHTML;
document.getElementById('ww').innerHTML = document.getElementById("textBox").innerHTML;
} 

</script>
</body>
</html>
<div>Icons made by <a href="https://www.flaticon.com/authors/icomoon" title="Icomoon">Icomoon</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
<div>Icons made by <a href="https://www.freepik.com/?__hstc=57440181.35c71bd455e989c58bb655c77503a4a9.1558092505080.1558092505080.1558671309880.2&__hssc=57440181.1.1558671309880&__hsfp=1369520902" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>