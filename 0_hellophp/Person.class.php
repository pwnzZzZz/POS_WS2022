<?php


class Person
{
    //Datenfelder
    private String $vorname;
    private String $nachname;

    public function __construct($vorname, $nachname)
    {
        $this->vorname = $vorname;
        $this->nachname = $nachname;
    }

    /**
     * Getter-Methode für den Vornamen
     * @return String Der Vorname der Person
     */
    public function getVorname(): string
    {
        return $this->vorname;
        

        
    
    }
}
