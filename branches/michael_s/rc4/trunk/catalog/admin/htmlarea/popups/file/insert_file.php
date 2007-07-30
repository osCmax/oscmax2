<?php
/***********************************************************************
** Title.........:  File Manager for HTMLArea
** Version.......:  0.1
** Adaptor.......:  Tim van Pelt <taurentius@hotmail.com>
** Filename......:	insert_file.php
** Last changed..:	11 Apr 2003 
** Notes.........:	Configuration in config.inc.php 

** Based on......:
** Title.........:	Image Manager for HTMLArea 3.0 Alpha, PHP Version
** Version.......:	1.01
** Author........:	Xiang Wei ZHUO <wei@zhuo.org>

                    - Only compatible with IE 5.5+

***********************************************************************/

	include 'config.inc.php';
	$no_dir = false;
	if(!is_dir($BASE_DIR.$BASE_ROOT)) {
		$no_dir = true;
	}

?>
<html style="width: 580; height: 455;">
<head>
<title>Link to file</title>
<script type="text/javascript" src="dialog.js"></script>
<script type="text/javascript">

function _CloseOnEsc() {
  if (event.keyCode == 27) { window.close(); return; }
}

function _getTextRange(elm) {
  var r = elm.parentTextEdit.createTextRange();
  r.moveToElementText(elm);
  return r;
}

window.onerror = HandleError

function HandleError(message, url, line) {
  var str = "An error has occurred in this dialog." + "\n\n"
  + "Error: " + line + "\n" + message;
  alert(str);
  window.close();
  return true;
}

function Init() {

  var txtFileName = MM_findObj("f_url");
  var txtDescription = MM_findObj("f_description");
  
  // event handlers  
  document.body.onkeypress = _CloseOnEsc;
  document.form1.btnOK.onclick = new Function("btnOKClick()");
  
  txtFileName.focus();
}

function _isValidNumber(txtBox) {
  var val = parseInt(txtBox);
  if (isNaN(val) || val < 0 || val > 999) { return false; }
  return true;
}

function btnOKClick() {

  var txtFileName = MM_findObj("f_url");
  var txtDescription = MM_findObj("f_description");
  
  // error checking
  if (!txtFileName.value || txtFileName.value == "http://") { 
    alert("File name must be specified.");
    txtFileName.focus();
    return;
  }
  
  var text = "";
  if (txtFileName.value == '')
  {
	text = escape( txtDescription.value );
  }
  else
  {
    text = escape( "<a href='<?php "/".$FILE_ROOT?>" );
	text = text + escape( txtFileName.value );
	//target=_blank by default
	text = text + escape( "' target='_blank'>" );
	if (txtDescription.value != '') {
	  text = text + escape( txtDescription.value );
	}
	else {
	  text = text + escape( txtFileName.value );	
	}
	text = text + escape( "</a>" );
  }
  window.returnValue = text;	// set return value
  window.close();
}
</script>
<style type="text/css">
html, body {
  background: ButtonFace;
  color: ButtonText;
  font: 11px Tahoma,Verdana,sans-serif;
  margin: 0px;
  padding: 0px;
}
body { padding: 5px; }
table {
  font: 11px Tahoma,Verdana,sans-serif;
}
form p {
  margin-top: 5px;
  margin-bottom: 5px;
}
.fl { width: 9em; float: left; padding: 2px 5px; text-align: right; }
.fr { width: 6em; float: left; padding: 2px 5px; text-align: right; }
fieldset { padding: 0px 10px 5px 5px; }
select, input, button { font: 11px Tahoma,Verdana,sans-serif; }
button { width: 70px; }
.space { padding: 2px; }

.title { background: #ddf; color: #000; font-weight: bold; font-size: 120%; padding: 3px 10px; margin-bottom: 10px;
border-bottom: 1px solid black; letter-spacing: 2px;
}
form { padding: 0px; margin: 0px; }
</style>
<style type="text/css">
<!--
.buttonHover {
	border: 1px solid;
	border-color: ButtonHighlight ButtonShadow ButtonShadow ButtonHighlight;
	cursor: hand;
}
.buttonOut
{
	border: 1px solid ButtonFace;
}

.separator {
  position: relative;
  margin: 3px;
  border-left: 1px solid ButtonShadow;
  border-right: 1px solid ButtonHighlight;
  width: 0px;
  height: 16px;
  padding: 0px;
}
.manager
{
}
.statusLayer
{
	background:#FFFFFF;
	border: 1px solid #CCCCCC;
}
.statusText {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	font-weight: bold;
	color: #6699CC;
	text-decoration: none;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function pviiClassNew(obj, new_style) { //v2.6 by PVII
  obj.className=new_style;
}
function goUpDir() 
{
	var selection = document.forms[0].dirPath;
	var dir = selection.options[selection.selectedIndex].value;
	if(dir != '/')
	{
		imgManager.goUp();	
		changeLoadingStatus('load');
	}
	
}

function updateDir(selection) 
{
	var newDir = selection.options[selection.selectedIndex].value;
	imgManager.changeDir(newDir);
	changeLoadingStatus('load');
}

function newFolder() 
{
	var selection = document.forms[0].dirPath;
	var dir = selection.options[selection.selectedIndex].value;
	Dialog("newFolder.html", function(param) {
		if (!param) {	// user must have pressed Cancel
			return false;
		}
		else
		{
			var folder = param['f_foldername'];
			if (folder && folder != '') {
				imgManager.newFolder(dir,folder); 
			}
		}
	}, null);
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function P7_Snap() { //v2.62 by PVII
  var x,y,ox,bx,oy,p,tx,a,b,k,d,da,e,el,args=P7_Snap.arguments;a=parseInt(a);
  for (k=0; k<(args.length-3); k+=4)
   if ((g=MM_findObj(args[k]))!=null) {
    el=eval(MM_findObj(args[k+1]));
    a=parseInt(args[k+2]);b=parseInt(args[k+3]);
    x=0;y=0;ox=0;oy=0;p="";tx=1;da="document.all['"+args[k]+"']";
    if(document.getElementById) {
     d="document.getElementsByName('"+args[k]+"')[0]";
     if(!eval(d)) {d="document.getElementById('"+args[k]+"')";if(!eval(d)) {d=da;}}
    }else if(document.all) {d=da;} 
    if (document.all || document.getElementById) {
     while (tx==1) {p+=".offsetParent";
      if(eval(d+p)) {x+=parseInt(eval(d+p+".offsetLeft"));y+=parseInt(eval(d+p+".offsetTop"));
      }else{tx=0;}}
     ox=parseInt(g.offsetLeft);oy=parseInt(g.offsetTop);var tw=x+ox+y+oy;
     if(tw==0 || (navigator.appVersion.indexOf("MSIE 4")>-1 && navigator.appVersion.indexOf("Mac")>-1)) {
      ox=0;oy=0;if(g.style.left){x=parseInt(g.style.left);y=parseInt(g.style.top);
      }else{var w1=parseInt(el.style.width);bx=(a<0)?-5-w1:-10;
      a=(Math.abs(a)<1000)?0:a;b=(Math.abs(b)<1000)?0:b;
      x=document.body.scrollLeft + event.clientX + bx;
      y=document.body.scrollTop + event.clientY;}}
   }else if (document.layers) {x=g.x;y=g.y;var q0=document.layers,dd="";
    for(var s=0;s<q0.length;s++) {dd='document.'+q0[s].name;
     if(eval(dd+'.document.'+args[k])) {x+=eval(dd+'.left');y+=eval(dd+'.top');break;}}}
   if(el) {e=(document.layers)?el:el.style;
   var xx=parseInt(x+ox+a),yy=parseInt(y+oy+b);
   if(navigator.appName=="Netscape" && parseInt(navigator.appVersion)>4){xx+="px";yy+="px";}
   if(navigator.appVersion.indexOf("MSIE 5")>-1 && navigator.appVersion.indexOf("Mac")>-1){
    xx+=parseInt(document.body.leftMargin);yy+=parseInt(document.body.topMargin);
    xx+="px";yy+="px";}e.left=xx;e.top=yy;}}
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}

function changeLoadingStatus(state) 
{
	var statusText = null;
	if(state == 'load') {
		statusText = 'Loading file';	
	}
	else if(state == 'upload') {
		statusText = 'Uploading File';
	}
	if(statusText != null) {
		var obj = MM_findObj('loadingStatus');
		obj.innerHTML = statusText;
		MM_showHideLayers('loading','','show')		
	}
}
//-->
</script>
</head>
<body onload="Init(); P7_Snap('dirPath','loading',120,70);">
<div class="title">Link to file</div>
<form action="files.php" name="form1" method="post" target="imgManager" enctype="multipart/form-data">
<div id="loading" style="position:absolute; left:200px; top:130px; width:184px; height:48px; z-index:1" class="statusLayer">
  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center"><span id="loadingStatus" class="statusText">Loading files</span><img src="images/dots.gif" width="22" height="12"></div></td>
    </tr>
  </table>
</div>
  <table width="100%" border="0" align="center" cellspacing="2" cellpadding="2">
    <tr>
      <td align="center">	  <fieldset>
	  <legend>File Manager</legend>
        <table width="99%" align="center" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td><table border="0" cellspacing="1" cellpadding="3">
                <tr> 
                  <td>Directory</td>
                  <td>
				  <select name="dirPath" id="dirPath" style="width:30em" onChange="updateDir(this)">
				  <option value="/">/</option>
<?php


function dirs($dir,$abs_path) 
{
	$d = dir($dir);
		$dirs = array();
		while (false !== ($entry = $d->read())) {
			if(is_dir($dir.'/'.$entry) && substr($entry,0,1) != '.') 
			{
				$path['path'] = $dir.'/'.$entry;
				$path['name'] = $entry;
				$dirs[$entry] = $path;
			}
		}
		$d->close();
	
		ksort($dirs);
		for($i=0; $i<count($dirs); $i++) 
		{
			$name = key($dirs);
			$current_dir = $abs_path.'/'.$dirs[$name]['name'];
			echo "<option value=\"$current_dir\">$current_dir</option>\n";
			dirs($dirs[$name]['path'],$current_dir);
			next($dirs);
		}
}

if($no_dir == false) {
	dirs($BASE_DIR.$BASE_ROOT,'');	
}
?>
				</select>
				  </td>
				  <!-- history.back(); does not work in dialog mode --
				  <td class="buttonOut" onMouseOver="pviiClassNew(this,'buttonHover')" onMouseOut="pviiClassNew(this,'buttonOut')">
				  <a href="javascript:;" onClick="javascript:goBack();"><img src="btnBack.gif" width="15" height="15" border="0" alt="Back"></a></td>-->
                  <td class="buttonOut" onMouseOver="pviiClassNew(this,'buttonHover')" onMouseOut="pviiClassNew(this,'buttonOut')">
				  <a href="#" onClick="javascript:goUpDir();"><img src="images/btnFolderUp.gif" width="15" height="15" border="0" alt="Up"></a></td>
                  <td><div class="separator"></div></td>
                  <td class="buttonOut" onMouseOver="pviiClassNew(this,'buttonHover')" onMouseOut="pviiClassNew(this,'buttonOut')">
				  <a href="#" onClick="javascript:newFolder();"><img src="images/btnFolderNew.gif" width="15" height="15" border="0" alt="New Folder"></a></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td align="center" bgcolor="white"><div name="manager" class="manager">
        <iframe src="files.php" name="imgManager" id="imgManager" width="520" height="150" marginwidth="0" marginheight="0" align="top" scrolling="auto" frameborder="0" hspace="0" vspace="0" background="white"></iframe>
		</div>
			</td>
          </tr>
        </table>
        </fieldset></td>
    </tr>
    <tr>
      <td><table border="0" align="center" cellpadding="2" cellspacing="2">
          <tr> 
            <td nowrap><div align="right">File name </div></td>
            <td><input name="url" id="f_url" type="text" style="width:20em" size="30"></td>
            <td rowspan="3">&nbsp;</td>
          </tr>
	     <tr> 
            <td nowrap><div align="right">Description </div></td>
            <td><input type="text" style="width:20em" name="description" id="f_description"></td>
          </tr>
          <tr> 
            <td><div align="right">Upload </div></td>
            <td><input type="file" name="upload" id="upload"> 
              <input type="submit" style="width:5em" value="Upload" onClick="javascript:changeLoadingStatus('upload');" />
			 </td>
          </tr>
          <tr> 
            <td colspan="3">&nbsp;</td>
          </tr>
        </table>
        
      </td>
    </tr>
    <tr>
      <td><div style="text-align: right;"> 
          <hr />
          <button type="button" ID="btnOK" name="btnOK">OK</button>
          <button type="button" name="cancel" onClick="window.close();">Cancel</button>
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
