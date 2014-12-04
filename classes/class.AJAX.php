<?php
namespace Scripts;

class AJAX
{

    //private $DB;

    private $data = array(
        1 => array('id' => '1', 'headline' => 'jupiter', 'content' => 'bla jupiter bla'),
        2 => array('id' => '2', 'headline' => 'juno', 'content' => 'bla juno bla'),
        3 => array('id' => '3', 'headline' => 'minimoog', 'content' => 'bla minimoog bla'),
        4 => array('id' => '4', 'headline' => 'ms20', 'content' => 'bla ms20 bla'),
        5 => array('id' => '5', 'headline' => 'monopoly', 'content' => 'bla monopoly bla')
    );


    /**
     * Konstruktor der Klasse
     */
    public function __construct()
    {
        //Globales Datenbankobjekt holen
        //$this->DB = $GLOBALS['DB'];

    }

    /**
     * Bindet die JavaScript-Datei ein.
     *
     * Ebenfalls enthalten ist ein Noscript-Hinweis.
     */
    public function addJavaScript()
    {
        //Einbinden der externen JavaScript-Datei
        echo "<script src='".
            "classes/AJAXJavaScript.js'".
            " type='text/javascript'>";
        echo "</script>";
        //Die Java-Script-Datei muss den Pfad zur Datei kennen
        //Als globale JavaScript-Variable setzen
        echo "<script type='text/javascript'>";
        echo "dirToSearchScript =  '"."searchBlog.php';";
        echo "</script>";
        //Sollte der Benutzer JavaScript abgeschaltet haben,
        //erscheint folgende Fehlermeldung
        echo "<noscript>";
        echo "<div>";
        echo "Ohne aktiviertes JavaScript lässt sich ".
            "die Suchfunktion nicht benutzen!";
        echo "</div>";

        echo "</noscript>";

    }

    /**
     * Zeigt ein Suchformular an
     */
    public function displaySearchForm()
    {

        echo "<fieldset style='margin:2px;padding:5px;width:400px;background-color:white;border:1px solid gray;'>";
        //Ergebnisauswahlliste
        echo "Ergebnisse:<br />";
        echo "<select onClick='loadEntry();' id='results' style='border:1px solid gray;width:250px;background-color:white;' size=6>";
        echo "</select><br />";
        //Textfeld für den Suchbegriff
        echo "Suchbegriff:<br />";
        echo "<input id='name' onKeyup='actualize();' type='text' value=''><br />";

        echo "</fieldset>";

    }

    /**
     * Zeigt den Ergebnis-Iframe an
     */
    public function displayResultIframe()
    {
        //Hinzufügen des IFrames
        echo "<iframe id='entryContent' src='entryContent.php' style='padding:5px;margin:2px;width:400px;border:1px solid gray;' frameborder=0></iframe>";
    }

    /**
     * Sucht nach einem Ergebnis in der Tabelle
     *
     * @return boolean Wird als false zurückgegeben, wenn abgebrochen werden musste
     */
    public function getSearchResult()
    {

        //Suchparameter aus der GET-Variablen holen
        if ((isset ($_GET['name'])) && ($_GET['name'] != ""))
        {
            $searchString = $_GET['name'];
        }
        else
        {
            //Kein Suchbegriff gesetzt -> Skript beenden.
            return false;
        }


        /***
        //Die Tabelle des Blogs durchsuchen
        $sql = "SELECT DISTINCT id,headline FROM blog WHERE "."content LIKE '%".$this->DB->escapeString($searchString)."%' OR "."headline LIKE '%".$this->DB->escapeString($searchString)."%' OR "."name LIKE '%".$this->DB->escapeString($searchString)."%';";

        //Suche ausführen
        $data = $this->DB->query($sql);

        //Wenn Datensätze gefunden wurden...
        if (count($data) == 0)
        {
            return false;
        }

         */



        //Als JSON-codiertes Array zurückgeben
        echo json_encode($this->getDataByString($searchString));

    }

    /**
     * Zeigt einen passenden Eintrag an.
     *
     * @return boolean Wird als false zurückgegeben, wenn abgebrochen werden musste
     */
    public function displayEntry()
    {

        //Überprüfen, ob die Nummer des Eintrags angegeben wurde.
        if (isset ($_GET['id']) && ($_GET['id'] != ""))
        {
            //Nummer und Suchbegriff holen
            $id = $_GET['id'];
            $search = $_GET['search'];
        }
        else
        {
            //Kein EIntrag gewählt
            echo "Kein Eintrag ausgewählt.";
            return false;
        }

        /*
        $sql = "SELECT * FROM blog WHERE id = '".$this->DB->escapeString($id)."'";

        $result = $this->DB->query($sql);
        */

        $result = $this->getDataById($id);

        //Falls eine nicht vorhandene Nummer übergeben wurde.
        if (count($result) != 1)
        {
            echo "Eintrag mit der Nummer ".$id." nicht vorhanden.";
            return false;
        }

        //Überschrift ausgeben:
        echo "<div style='border-bottom:1px solid gray;'>";
        echo "<span style='color:steelblue;font-weight:bold;'>Überschrift: ";
        $this->colorizeString($result[0]['headline'], $search);
        echo "</span>";
        echo "<br />";
        //Autorname ausgeben:
        echo "<span style='color:steelblue;'>Name: ";
        $this->colorizeString($result[0]['name'], $search);
        echo "</span>";
        echo "</div>";
        //HTML-Zeilenumbrüche hinzufügen
        $text = nl2br($result[0]['content']);
        //Text ausgeben
        $this->colorizeString($text, $search);

    }

    /**
     * Rekursive Methode zum einfärben eines bestimmten Wortes innerhalb eines Textes
     *
     * @param text Der einzufärbende Text
     * @param varchar Das gesuchte einzufärbende Wort (oder Zeichen)
     */
    private function colorizeString($text, $searchterm)
    {

        //Stelle finden!
        $pos = stripos($text, $searchterm);

        //Wurde nichts gefunden
        if ($pos === false)
        {
            //Suchbegriff nicht gefunden: Text ausgeben
            echo $text;
        }
        else
        {
            //Text vor der gesuchten Stelle des Suchbegriffs
            echo substr($text, 0, $pos);
            echo "<span style='background-color:orange'>";
            //Suchbegriff:
            echo substr($text, $pos, strlen($searchterm));
            echo "</span>";

            //Position direkt hinter dem Suchbegriff
            $behindSearchterm = $pos +strlen($searchterm);
            //Erneut mit Reststring rekursiv aufrufen
            $this->colorizeString(substr($text, $behindSearchterm, strlen($text) - $behindSearchterm), $searchterm);
        }
    }

    private function getDataByString($searchString)
    {
        $data = $this->data;


        $return = array();

        foreach ($data as $element)
        {
            if(stripos($element['headline'],$searchString) === 0) {
                $return[] = $element;
            }
        }

        return $return;

        //TODO: search array for user input
    }

    private function getDataById($id)
    {
        return $this->data[$id];
    }

}
