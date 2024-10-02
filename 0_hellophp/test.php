<?php

require_once('Person.class.php');

//Variable deklarieren und Wert zuweisen
$vorname = 'Michael';
$nachname = "Gamper";

//Stringverknüpfung
//echo $name . ' ' . $nachname;

//Variablensubstituion
//echo "Name: $vorname $nachname";

/**
 * Diese Funktion bildet aus einem Vornamen
 * und einem Nachnamen einen String
 * @param String Vorname
 * @param String Nachname
 * @return String Fullname
 */
function getFullname($vname, $nname, $anrede='Herr')
{
    //TODO: Parameter validieren
    
    return $anrede .' ' . $vname.' '.$nname;
}

//echo getFullname('Michael','Gamper');
//echo getFullname('Sarah','Gosch', 'Frau');
//$personen = ['Sarah', 'Daniel'];
//array_push($personen, ['Michael']);
//var_dump($personen);

$person = new Person('Michael', 'Gamper');
echo $person->getVorname();

?>