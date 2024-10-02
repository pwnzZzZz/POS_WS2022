<?php
    
    //var_dump($_POST);

    if (isset($_POST['studiname']))
    {
        $studiname = $_POST['studiname'];
        if (checkName($studiname) === true)
        {
            echo 'Validierung hat funktioniert';
           
            //Maskieren gefährlicher Zeichen, z.B. < >
            echo htmlspecialchars($studiname);
        }
        else
        {
            echo 'Validierung fehlgeschlagen';
        }

    }


    /**
     * Die Funktion bekommt einen zu prüfenden Wert und checkt, ob
     * keine Ziffern vorkommen
     * @param $name String Der zu prüfende Wert
     * @return Boolean true, wenn Prüfung erfolgreich.
     */
    function checkName($name)
    {

        //TODO: RegEx anpassen (JavaScript, SQL, etc.)
        $regex = '/\D{3,255}/m';

        if (preg_match($regex,$name) === 1)
        {
            return true;
        }

        return false;
    }


    //TODO: Eingabedaten validieren und Ausgabedaten maskieren
    //echo $studiname;

?>