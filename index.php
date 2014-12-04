<?php
//require_once "../../common.php";
require_once "classes/class.HTML.php";
require_once "classes/class.AJAX.php";

//Neues Ajax-Objekt erstellen
$AJAX = new Scripts\AJAX();

//Kopf erstellen
System\HTML::printHead();

//JavaScript einfügen
$AJAX->addJavaScript();

//Body erstellen
System\HTML::printBody();

//Überschrift erstellen
System\HTML::printHeadline("AJAX:");


//Inhalt der Seite:
$AJAX->displaySearchForm();
echo '<br />';
$AJAX->displayResultIframe();

//Ajax funktioniert in diesem Fall nicht über 127.0.0.1
if($_SERVER['SERVER_NAME']=="127.0.0.1")
{
	echo "<br />";
	echo "<br />";
	echo "<div style='padding:3px; width:600px;color:black;background-color:white;border:1px solid red;'>";
	echo "Sollte das Beispiel nicht funktionieren, so öffnen Sie bitte dieses Skript über den folgenden Link (localhost statt 127.0.0.1)<br />";
	$path = pathinfo($_SERVER['SCRIPT_NAME']);
	echo "<a href='http://localhost".$path['dirname']."'>Script über Localhost ausführen</a>";
	echo "</div>";
}

//Ende der Seite 
System\HTML::printFoot();