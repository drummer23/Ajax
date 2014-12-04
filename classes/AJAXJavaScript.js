
function actualize() { 
   
   try { 
   // Gecko-Engines unterstuetzen XMLHttpRequest. 
   // IE benutzt ActiveX.  
 
   xmlhttp = window.XMLHttpRequest?
             new XMLHttpRequest(): 
             new ActiveXObject("Microsoft.XMLHTTP"); 
             } catch (e) { 
             
             // Fehler: der Browser kommt mit AJAX nicht klar
             alert('AJAX wird von diesem Browser nicht unterstuetzt!'); 
             return false;
            } 
  
    
  //Das xmlhttp-Objekt soll bei jeder Status?nderung eine Funktion ausl?sen
  //dies ist hier die Funktion triggered()  
  xmlhttp.onreadystatechange = triggered; 
  
  //Parameter steht im Textfeld:
  var name = document.getElementById('name').value;
  
  //open() ruft das angegebene Skript auf und sendet per GET die Parameter
  xmlhttp.open('GET',dirToSearchScript + '?name=' + escape(name));
   
  //Die Anfrage senden:
  xmlhttp.send(null);  
  
 }
 
 
 function triggered(){ 
  
   if ((xmlhttp.readyState != 4) || (xmlhttp.status != 200)) {
    return false;
    } 
   
      
     //in xmlhttp.responseText steht die Antwort des aufgerufenen Skriptes
     //als JSON Objekt

     //alert(xmlhttp.responseText);
     //var results = eval('xmlhttp.responseText');
     var results = JSON.parse(xmlhttp.responseText);


        
     //Die Select Liste an eine Variabel binden
     var resultField = document.getElementById('results');
     //SelectListe leeren
     var optionCount = resultField.options.length;
    
     for (var i = 0; i < optionCount; i++){
        
        resultField.options[0] = null;
        
     }
     
     if(typeof results=='undefined' || results.length == 0){
      return false;
      }
      
     
     //Alle gefundenen Einträge einfügen
     for (var i = 0; i < results.length; i++){
       
    	 //Neuen Eintrag erstellen
         resultField.options[i] = new Option(unescape(results[i].headline),results[i].id);
         
        }
   }
  
  
  function loadEntry(){
  
     //Ausgewählter Eintrag....
     var id = document.getElementById('results').value;
     var search = document.getElementById('name').value;
     //Seite in den iframe laden
     document.getElementById('entryContent').src = 'entryContent.php?id=' + id + '&search=' + search;
     
  }

 