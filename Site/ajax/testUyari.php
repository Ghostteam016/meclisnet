<style type="text/css">

#reklam01{
position:absolute;
border-left: 0px solid #009900;
border-right: 0px solid #009900;
border-top: 0px solid #009900;
border-bottom: 0px solid #009900;
padding: 0px;
background-color: #882211;
width: 300px;
visibility: hidden;
z-index: 200;
}

</style>

<script type="text/javascript">
var persistclose=0 //set to 0 or 1. 1 means once the bar is manually closed, it will remain closed for browser session
var startX = 100 //set x offset of bar in pixels
var startY = 100 //set y offset of bar in pixels
var verticalpos="frombottom" //enter "fromtop" or "frombottom"

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function get_cookie(Name) {
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) {
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function closebar(){
if (persistclose)
document.cookie="remainclosed=1"
document.getElementById("reklam01").style.visibility="hidden"
}

function staticbar(){
barheight=document.getElementById("reklam01").offsetHeight
var ns = (navigator.appName.indexOf("Netscape") != -1) || window.opera;
var d = document;
function ml(id){
var el=d.getElementById(id);
if (!persistclose || persistclose && get_cookie("remainclosed")=="")
el.style.visibility="visible"
if(d.layers)el.style=el;
el.sP=function(x,y){this.style.left=x+"px";this.style.top=y+"px";};
el.x = startX;
if (verticalpos=="fromtop")
el.y = startY;
else{
el.y = ns ? pageYOffset + innerHeight : iecompattest().scrollTop + iecompattest().clientHeight;
el.y -= startY;
}
return el;
}
window.stayTopLeft=function(){
if (verticalpos=="fromtop"){
var pY = ns ? pageYOffset : iecompattest().scrollTop;
ftlObj.y += (pY + startY - ftlObj.y)/5;
}
else{
var pY = ns ? pageYOffset + innerHeight - barheight: iecompattest().scrollTop + iecompattest().clientHeight - barheight;
ftlObj.y += (pY - startY - ftlObj.y)/5;
}
ftlObj.sP(ftlObj.x, ftlObj.y);
setTimeout("stayTopLeft()", 8);
}
ftlObj = ml("reklam01");
stayTopLeft();
}

if (window.addEventListener)
window.addEventListener("load", staticbar, false)
else if (window.attachEvent)
window.attachEvent("onload", staticbar)
else if (document.getElementById)
window.onload=staticbar
</script>
<div id="reklam01">
<div align="center">

MERHABA,<br/>
Sitemiz hala test aşamasında olduğu için <br/>
herhangi bir sorunla karşılaşırsanız <br/>
destek@meclisnet.com adresine <br/>
hata içeriğini ve ekran görüntüsünü gönderebilirsiniz. <br/>

<a href="" onClick="closebar(); return false">
<font size="1">>DUYURUYU KAPAT<</font></a>
</div>
</td>
</div>