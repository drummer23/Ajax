<?php

require_once "classes/class.HTML.php";
require_once "classes/class.AJAX.php";

$AJAX = new Scripts\AJAX();

$AJAX->getSearchResult();
