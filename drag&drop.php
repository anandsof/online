<?php
 include('config.inc');

  $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $scoreid = $_GET['scoreid'];
  $questionid = $_GET['questionid'];

    $result= mysqli_query($db_connect,"SELECT * FROM question WHERE questionid = '$questionid'");
 while ($row = mysqli_fetch_row($result))
 {
  $i = 0;
  $question = $row[1];
   for ($col = 2, $a = 'a' ; $col <= 7 ; $col++,$a++)
   {
     if ($row[$col])
     {
	if($row[14] == 'dd') 
      	{
        	$match = explode(" -1-1-1- ",$row[$col]);
        	$Q[$i] = $match[0];
        	$A[$i] = $match[1];
                $i++;
      	}
     }
   } 
 } 
$i = 0;
?>


<html>
<head>

<title>Drag And Drop</title>

<style type="text/css">

body {
	font-family: Geneva,Arial;
	background-color: #ffffff;
	color: #000000;
}

div.Titles {
	position: absolute;
	left: 10%;
	width: 80%;
	text-align: center;
	top: 5px;
}

td.NavBar{
	background-color: #fa8400;
	text-align: center;
}

div.CardStyle {
	position: absolute;
	font-family: Geneva,Arial;
	padding: 5px;
	border-style: solid;
	border-width: 1px;
	color: #000000;
	background-color: #bfcfdf;
	left: -50px;
	top: -50px;
	overflow: visible;
}

div.Feedback {
	background-color: #ffffff;
	left: 1px;
	top: 1px;
	z-index: 1;
	border-width: 1px;
	border-style: none;
	text-align: center;
	color: #000000;
	padding: 5px;
	position: absolute;
}

</style>



<script language="javascript" type="text/javascript"> 

<!--

PopUpURL    = "The right click options are disabled for this window";

isIE=document.all;
isNN=!document.all&&document.getElementById;
isN4=document.layers;

if (isIE||isNN)
{
 document.oncontextmenu=checkV;
}
else
{
 document.captureEvents(Event.MOUSEDOWN || Event.MOUSEUP);
 document.onmousedown=checkV;
} 

function checkV(e)
{
	if (isN4)
	 {
	if (e.which==2||e.which==3)
		{
		dPUW=alert(PopUpURL);
		return false;
		}
	}
	else
	{
	dPUW=alert(PopUpURL);
	return false;
	}
}

function BrowserCheck() {
	var b = navigator.appName
	this.mac = (navigator.appVersion.indexOf('Mac') != -1)
	if (b=="Netscape") this.b = 'ns'
	else if (b=="Microsoft Internet Explorer") this.b = 'ie'
	else this.b = b
	this.version = navigator.appVersion
	this.v = parseInt(this.version)
	this.ns = (this.b=="ns" && this.v>=5)
	this.ns5 = (this.b=="ns" && this.v==5)
	this.ns6 = (this.b=="ns" && this.v==5)
	this.ie = (this.b=="ie" && this.v>=4)
	this.ie4 = (this.version.indexOf('MSIE 4')>0)
	this.ie5 = (this.version.indexOf('MSIE 5')>0)
	if (this.mac) this.ie = this.ie5
	this.ie5mac = (this.ie5 && this.mac);
	this.min = (this.ns||this.ie)
}

is = new BrowserCheck();

if ((is.min == false)||(is.ie5mac)){
	alert('Your browser can\'t handle this page. You need NS6 or IE5 on Windows, or NS6 on Mac.');
//	history.back();
}

function Card(ID){
	this.elm=document.getElementById(ID);
	this.name=ID;
	this.css=this.elm.style;
	this.elm.style.left = 0 +'px';
	this.elm.style.top = 0 +'px';
	this.HomeL = 0;
	this.HomeT = 0;
	this.tag=-1;
	this.index=-1;
//	this.obj=ID+'Card';
//	eval(this.obj+'=this');
}

function CardGetL(){return parseInt(this.css.left)}
Card.prototype.GetL=CardGetL;

function CardGetT(){return parseInt(this.css.top)}
Card.prototype.GetT=CardGetT;

function CardGetW(){return parseInt(this.elm.offsetWidth)}
Card.prototype.GetW=CardGetW;

function CardGetH(){return parseInt(this.elm.offsetHeight)}
Card.prototype.GetH=CardGetH;

function CardGetB(){return this.GetT()+this.GetH()}
Card.prototype.GetB=CardGetB;

function CardGetR(){return this.GetL()+this.GetW()}
Card.prototype.GetR=CardGetR;

function CardSetL(NewL){this.css.left = NewL+'px'}
Card.prototype.SetL=CardSetL;

function CardSetT(NewT){this.css.top = NewT+'px'}
Card.prototype.SetT=CardSetT;

function CardSetW(NewW){this.css.width = NewW+'px'}
Card.prototype.SetW=CardSetW;

function CardSetH(NewH){this.css.height = NewH+'px'}
Card.prototype.SetH=CardSetH;

function CardInside(X,Y){
	var Result=false;
	if(X>=this.GetL()){if(X<=this.GetR()){if(Y>=this.GetT()){if(Y<=this.GetB()){Result=true;}}}}
	return Result;
}
Card.prototype.Inside=CardInside;

function CardSwapColours(){
	var c=this.css.backgroundColor;
	this.css.backgroundColor=this.css.color;
	this.css.color=c;
}
Card.prototype.SwapColours=CardSwapColours;

function CardHighlight(){
	this.css.backgroundColor='#000000';
	this.css.color='#bfcfdf';
}
Card.prototype.Highlight=CardHighlight;

function CardUnhighlight(){
	this.css.backgroundColor='#bfcfdf';
	this.css.color='#000000';
}
Card.prototype.Unhighlight=CardUnhighlight;

function CardOverlap(OtherCard){
	var smR=(this.GetR()<(OtherCard.GetR()+10))? this.GetR(): (OtherCard.GetR()+10);
	var lgL=(this.GetL()>OtherCard.GetL())? this.GetL(): OtherCard.GetL();
	var HDim=smR-lgL;
	if (HDim<1){return 0;}
	var smB=(this.GetB()<OtherCard.GetB())? this.GetB(): OtherCard.GetB();
	var lgT=(this.GetT()>OtherCard.GetT())? this.GetT(): OtherCard.GetT();
	var VDim=smB-lgT;
	if (VDim<1){return 0;}
	return (HDim*VDim);	
}
Card.prototype.Overlap=CardOverlap;

function CardDockToR(OtherCard){
	this.SetL(OtherCard.GetR() + 5);
	this.SetT(OtherCard.GetT());
}

Card.prototype.DockToR=CardDockToR;

function CardSetHome(){
	this.HomeL=this.GetL();
	this.HomeT=this.GetT();
}
Card.prototype.SetHome=CardSetHome;

function CardGoHome(){
	this.SetL(this.HomeL);
	this.SetT(this.HomeT);
}

Card.prototype.GoHome=CardGoHome;

var CorrectResponse = 'Correct! Well done.';
var IncorrectResponse = 'Sorry! Try again. Incorrect matches have been removed.';
var YourScoreIs = 'Your score is ';
var Correction = '[strCorrection]';
var DivWidth = 400; //default value
var FeedbackWidth = 200; //default
var ExBGColor = '#bfcfdf';
var PageBGColor = '#ffffff';
var TextColor = '#000000';
var TitleColor = '#000000';
var Penalties = 0;

var CurrDrag = -1;
var topZ = 100;

function PageDim(){
//Get the page width and height
	this.W = 600;
	this.H = 400;
	if (is.ns) this.W = window.innerWidth;
	if (is.ie) this.W = document.body.clientWidth;
	if (is.ns) this.H = window.innerHeight;
	if (is.ie) this.H = document.body.clientHeight;
}

var pg = null;
var DivWidth = 600;
var DragWidth = 200;
var LeftColPos = 100;
var RightColPos = 500;
var DragTop = 120;



//Fixed and draggable card arrays
FC = new Array();
DC = new Array();

function doDrag(e) {
	if (CurrDrag == -1) {return};
	if (is.ie){var Ev = window.event}else{var Ev = e}
	var difX = Ev.clientX-window.lastX; 
	var difY = Ev.clientY-window.lastY; 
	var newX = DC[CurrDrag].GetL()+difX; 
	var newY = DC[CurrDrag].GetT()+difY; 
	DC[CurrDrag].SetL(newX); 
	DC[CurrDrag].SetT(newY);
	window.lastX = Ev.clientX; 
	window.lastY = Ev.clientY; 
	return false;
} 


function beginDrag(e, DragNum) { 
	CurrDrag = DragNum;
	if (is.ie){
		var Ev = window.event;
		document.onmousemove=doDrag;
		document.onmouseup=endDrag;
	}
	else{
		var Ev = e;
		window.onmousemove=doDrag; 
		window.onmouseup=endDrag;
	} 
	DC[CurrDrag].Highlight();
	topZ++;
	DC[CurrDrag].css.zIndex = topZ;
	window.lastX=Ev.clientX; 
	window.lastY=Ev.clientY;
	return true;  
} 

function endDrag(e) { 
	if (CurrDrag == -1) {return};
	DC[CurrDrag].Unhighlight();
	if (is.ie){document.onmousemove=null}else{window.onmousemove=null;}
	onEndDrag();	
	CurrDrag = -1;
	return true;
} 

function onEndDrag(){ 
//Is it dropped on any of the fixed cards?
	var Docked = false;
	var DropTarget = DroppedOnFixed(CurrDrag);
	if (DropTarget > -1){
//If so, send home any card that is currently docked there
		for (var i=0; i<DC.length; i++){
			if (DC[i].tag == DropTarget+1){
				DC[i].GoHome();
				DC[i].tag = 0;
				D[i][2] = 0;
			}
		}
//Dock the dropped card
		DC[CurrDrag].DockToR(FC[DropTarget]);
		D[CurrDrag][2] = F[DropTarget][1];
		DC[CurrDrag].tag = DropTarget+1;
		Docked = true;
	}

	if (Docked == false){
		DC[CurrDrag].GoHome();
		DC[CurrDrag].tag = 0;
		D[CurrDrag][2] = 0;
	}
} 

function DroppedOnFixed(DNum){
	var Result = -1;
	var OverlapArea = 0;
	var Temp = 0;
	for (var i=0; i<FC.length; i++){
		Temp = DC[DNum].Overlap(FC[i]);
		if (Temp > OverlapArea){
			OverlapArea = Temp;
			Result = i;
		}
	}
	return Result;
}

function StartUp(){

//Calculate page dimensions and positions
	pg = new PageDim();
	DivWidth = Math.floor((pg.W*4)/5);
	DragWidth = Math.floor((DivWidth*3)/10);
	LeftColPos = Math.floor(pg.W/10);
	RightColPos = pg.W - (DragWidth + LeftColPos);
	DragTop = parseInt(document.getElementById('TitleDiv').offsetHeight) + 10;

//Position the feedback div
	var CurrDiv = document.getElementById('FeedbackDiv');
	CurrDiv.style.top = DragTop + 5 + 'px';
	CurrDiv.style.left = Math.floor((pg.W)/3) + 'px';
	CurrDiv.style.width = Math.floor(pg.W/3) + 'px';
	CurrDiv.style.display = 'none';

//Shuffle the items on the right
	D = Shuffle(D);

	var CurrTop = DragTop;
	var TempInt = 0;
	var DropHome = 0;
	var Widest = 0;

	for (var i=0; i<F.length; i++){
		FC[i] = new Card('F' + i);
//		FC[i].SetW(DragWidth);
		FC[i].elm.innerHTML = F[i][0] + '<br clear="all" />'; //required for Navigator rendering bug with images

		if (FC[i].GetW() > Widest){
			Widest = FC[i].GetW();
		}
	}

	if (Widest > DragWidth){Widest = DragWidth;}

	CurrTop = DragTop;

	DragWidth = Math.floor((DivWidth-Widest)/2) - 24;
	RightColPos = DivWidth + LeftColPos - (DragWidth + 14);
	var Highest = 0;
	var WidestRight = 0;

	for (i=0; i<D.length; i++){
		DC[i] = new Card('D' + i);
		DC[i].elm.innerHTML = D[i][0] + '<br clear="all" />'; //required for Navigator rendering bug with images
		if (DC[i].GetW() > DragWidth){DC[i].SetW(DragWidth);}
		DC[i].css.cursor = 'move';
		DC[i].css.backgroundColor = '#bfcfdf';
		DC[i].css.color = '#000000';
		TempInt = DC[i].GetH();
		if (TempInt > Highest){Highest = TempInt;}
		TempInt = DC[i].GetW();
		if (TempInt > WidestRight){WidestRight = TempInt;}
	}

	var HeightToSet = Highest;
	if (is.ns||is.ie5mac){HeightToSet -= 12;}
	var WidthToSet = WidestRight;
	if (is.ns||is.ie5mac){WidthToSet -= 12;}

	for (i=0; i<D.length; i++){
		DC[i].SetT(CurrTop);
		DC[i].SetL(RightColPos);
		if (DC[i].GetH() < Highest){
			DC[i].SetH(HeightToSet);
		}
		if (DC[i].GetW() < WidestRight){
			DC[i].SetW(WidthToSet);
		}
		DC[i].SetHome();
		DC[i].tag = -1;
		CurrTop = CurrTop + DC[i].GetH() + 5;
	}

	CurrTop = DragTop;

	for (var i=0; i<F.length; i++){
		FC[i].SetW(Widest);
		if (FC[i].GetH() < Highest){
			FC[i].SetH(HeightToSet);
		}
		FC[i].SetT(CurrTop);
		FC[i].SetL(LeftColPos);
		FC[i].SetHome();
		TempInt = FC[i].GetH();
		CurrTop = CurrTop + TempInt + 5;
	}


}




F = new Array();
D = new Array();

<?php 
 for ($i = 0; $i < count($Q) ; $i++)
 {
$j = $i+1;
print <<< DD
  F[$i] = new Array();
  F[$i][0] = '$Q[$i]';
  F[$i][1] = $j;
  D[$i] = new Array();
  D[$i][0]='$A[$i]';
  D[$i][1] = $j;
  D[$i][2] = 0;
DD;
 }
?>


function Shuffle(InArray){
	Temp = new Array();
	var Len = InArray.length;

	var j = Len;

	for (var i=0; i<Len; i++){
		Temp[i] = InArray[i];
	}

	for (i=0; i<Len; i++){
		Num = Math.floor(j  *  Math.random());
		InArray[i] = Temp[Num];

		for (var k=Num; k < j; k++) {
			Temp[k] = Temp[k+1];
		}
		j--;
	}
	return InArray;
}

function TimerStartUp(){
	setTimeout('StartUp()', 300);
}

function CheckAnswer(){
       
//for each fixed, check to see if the tag value for the draggable is the same as the fixed
	var i, j;

	for (i=0; i<D.length ; i++)
        {
          document.form.elements[i+1].value = ""+D[i][2]+"-"+D[i][0]+"";
 //         alert(document.form.elements[i+1].value);
	}

      document.form.submit();
}

//-->

//]]>

</script>





</head> 

<body onload="TimerStartUp()" background=""> 

<div class="Titles" id="TitleDiv">
<center>


<h3>Drag And Drop</h3>
Match the function on the right with the one on the left.<br>
<font color="RED"><small>Click the options (boxes) below to drag-and-drop them into the correct slots.</small></font>
<br>

<form name="form" method="POST" action="dragDropAdd.php">
<input type="button" value="Submit" onclick="CheckAnswer()"></input>

<?php

 for ($i = 0; $i < count($Q) ; $i++)
 {
  print ("<input type=\"hidden\" name=\"dd$i\" value=\"$i\">\n");
 }

  print ("<input type=\"hidden\" name=\"questionid\" value=\"$questionid\">\n");

  print ("<input type=\"hidden\" name=\"scoreid\" value=\"$scoreid\">\n");
?>

</form>
</center></div>

<div class="Feedback" id="FeedbackDiv"></div>
<script language="javascript" type="text/javascript">
//<![CDATA[

<!--

for (var i=0; i<F.length; i++){
	document.write('<div id="F' + i + '" class="CardStyle"></div>');
}

for (var i=0; i<D.length; i++){
	document.write('<div id="D' + i + '" class="CardStyle" onmousedown="beginDrag(event, ' + i + ')"></div>');
}

//-->

//]]>
</script>

</body>
</html>
