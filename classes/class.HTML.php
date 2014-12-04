<?php
//Namespace der Klasse
namespace System;

/**
 * Grundgerüst einer HTML-Seite.
 * 
 */

class HTML
{

	/**
	 * Erstellt den Kopf eines HTML-Dokuments.
	 * 
	 */
	public static function printHead()
	{
		//Workaround für Browser, die ansonsten Darstellungsprobleme 
		//mit UTF-8-codierten Seiten bekommen (bspw. Google Chrome)
        header('Content-Type: text/html; charset=utf-8');
        //Head ausgeben
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">'."\r\n";
		echo '<html>'."\n";
		echo '<head>'."\n";
		echo '<title>Sandbox</title>'."\n";
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">'."\n";
		echo '<link rel="stylesheet" type="text/css" href="default.css.php">'."\n";
		//JQuery einbinden (für die Beispiele)
		//echo '<script src="'.PROJECT_HTTP_ROOT.'/extLibs/jquery/jquery-1.2.6.min.js"></script>';
		//echo '<script src="'.PROJECT_HTTP_ROOT.'/extLibs/jquery/jquery-ui-personalized-1.6rc2.min.js"></script>';
		//echo '<script src="'.PROJECT_HTTP_ROOT.'/inc/js/default.js" type="text/javascript"></script>';
		
	}

	/**
	 * Erstellt den 'Körper' eines HTML-Dokuments.
	 * 
	 * @param varchar Zusätzliche Cascading Stylesheets
	 */
	public static function printBody($css = null,$withConsole = true)
	{
		echo '</head>'."\n";
		echo '<body';
		if ($css != null)
		{
			echo ' style="'.$css.'"';
		}
		echo '>'."\n";
				
		//DebugConsole einbinden (ist derselbe Namespace 'System\', kann also weggelassen werden)
		//if($withConsole AND DEBUG)DebugConsole::displayConsole();
			
	}
	
	
	/**
	 * Beendet ein HTML-Dokument.
	 * 
	 */
	public static function printFoot()
	{

		echo '</body></html>';
	}

	/**
	 * Erstellt eine Überschrift für die Buch-CD
	 * 
	 * @param varchar Überschrifttext
	 * @param boolean Mit oder ohne DEBUG-Leiste
	 */
	public static function printHeadline($headline)
	{
			
		echo '<div class="headline">';
		echo $headline;
		echo '</div>';

	}
	
	/**
	 * Erstellt lesbare Darstellungen von Arrays (für Buch-CD)
	 * 
	 */
	public static function printArray($array = array())
	{
		return highlight_string(print_r($array,true),true);	
	}
	

}
