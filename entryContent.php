<?php

require_once "classes/class.HTML.php";
require_once "classes/class.AJAX.php";

$AJAX = new Scripts\AJAX();

//Einfaches HTML-Dokument
System\HTML::printHead();
System\HTML::printBody("background-color:white;background-image:none;",false);

//Blog-Eintrag anzeigen
$AJAX->displayEntry();


System\HTML::printFoot();