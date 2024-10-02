<?php

    class GradeEntry{
        private $studiname;
        private string $fach;
        private $email;
        private $note;
        private $datum;
        private $fehlerliste = array();


        public function __construct($sname,$fach,$mail,$note,$date){
            //TODO: Validieren, indem die richtigen Setter-Methoden verwenden
            $this->setStudiname($sname);
            $this->fach = $fach;
            $this->email = $mail;
            $this->note = $note;
            $this->datum = $date;
        }

        public function saveToSession(){
            $_SESSION['grades'][] = serialize($this->note);
        }


        public function saveToFile($filename){
            file_put_contents($filename, serialize($this));
        }

        public static function getEntryFromFile($filename){
            $gradeEntry = unserialize(file_get_contents($filename));
            return $gradeEntry;
        }


        public static function getAllEntries(){
            echo "Aufruf funktioniert";
        }


        //Rückgabewert SOLLTE angegeben werden -> kein MUSS!
        //public function getStudiname() : string

        /**
         * Getter-Methode für den Student:innen-Namen
         * @return String Der Name des Studenten
         */
        public function getStudiname(){
            return $this->studiname;
        }
        

        /**
         * Setzt den Studentennamen auf einen neuen Wert
         * @param String Der neue Name des Studenten (wird geprüft)
         * @throws Exception Falls die Validierung fehlschlät
         */
        public function setStudiname($newStudiName){
            if(strlen($newStudiName) < 3){
                //return -1 wird oft verwende für Fehler, NICHT verwenden!
                throw new Exception("Validierung! Nicht lang genug!");
            }else{
                $this->studiname = $newStudiName;
                return $this->studiname;
            }
        }



/**
     * Setter-Methode, die den Studentennamen auf einen neuen Wert setzt und dabei prüft, ob der mitgegebene String
     * kleiner als 3 Zeichen ist.
     * @param String $newStudiName Der neue Name des Studenten
     * @throws Exception Falls die Validierung fehlschlagt...
     */
    public function setStudiName2($newStudiName)
    {
        if (strlen($newStudiName) < 3)
        {
            throw new Exception("Validierung fehgeschlagen. Der Name muss mindestens 3 Zeichen lang sein");
        }
        elseif(preg_match('/\d/', $newStudiName) == 1)
        {
            throw new Exception("Validierung fehgeschlagen. Der Name darf keine zahlen beinhalten");
        }
        else{
            $this->studiName = $newStudiName; 
        }
        
    }





    
	/**
	 * @return string
	 */
	public function getFach(): string {
		return $this->fach;
	}
	
	/**
	 * @param string $fach 
	 * @return self
	 */
	public function setFach(string $fach): self {
		$this->fach = $fach;
		return $this;
	}
}

?>