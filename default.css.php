<?php

//Sagen, dass dies eine CSS_Datei ist!
header("Content-type: text/css");
?>
 
 body {
 
 font-size:0.70em;
 font-family: Verdana,'lucida grande',helvetica,verdana, arial, tahoma, verdana, helvetica, sans-serif;
 padding:5px;
 margin:5px;
 background-color:white;
 background-repeat:repeat-x;

  
} 
  
/* Für Formular ohne Ränder und Abstände */
#noSpaces{
  padding:0px;
  margin:0px;
}



/* Diese Stylesheets sind für die Zentrierung zuständig */
#centerBox {

  text-align:center;
  width:100%;

}

#centerObject {
  margin:0px auto;

}  



input.standardField{
   border: 1px solid steelblue;
   background-color: white;
   font-family:Arial;	
   color:black;
   padding:2px;
   width:150px;
   margin:1px;
   vertical-align: middle;
}

textarea.standardTextarea{
   border: 1px solid steelblue;
   background-color: white;
   font-family:Arial;
   color:black;
   padding:2px;
   margin:1px;
}


.standardSubmit{
   border: 1px solid silver;
   cursor: pointer;
   font-weight:bold;
   background-color: #eeeeee;
   font-family:Arial;
   color:black;
   padding:1px;
   margin:1px;
}

a.standardSubmit{
   border: 1px solid silver;
   cursor: pointer;
   font-weight:bold;
   background-color: #eeeeee;
   font-family:Arial;
   color:black;
   padding:1px;
   margin:1px;
   text-decoration:none;
}

select.standardSelect{
   border: 1px solid silver;
   font-weight:bold;
   background-color: #eeeeee;
   font-family:Arial;	
   color:black;
}


table
{
	font-size:1em;	
}

input.linkLookAlike{
   border: 0px;
   cursor: pointer;
   font-weight:bold;
   font-family:Arial;
   width:100%;
   background-color:transparent;
   text-align:left;
   color:black;
}

.headline
{
	font-size:2em;
	font-family:Arial;
	font-weight:bold;
	color:steelblue;
	text-decoration:underline;
	margin-bottom:0.5em;	
	margin-top:0.5em;
}


pre
{
	font-size:8pt;	
}


/* Für ordentliche DIV-Layouts */


.label {
  float: left;
  width: 150px;
  padding-top: 3px;
  padding-right: 5px;
}



code
{
	font-size:8pt;	
}






