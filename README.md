

---

>"JavaScript wird sich als Programmiersprache nie durchsetzen" [GAMP 2010]

---

# Mitschrift POS Wintersemester 2022

In der Mitschrift werden wichtige Unterrichtskonzepte notiert, ebenso währende der Bearbeitung der Arbeitsaufträge auftauchende Fragen.


## 20.9.2022: Einleitung PHP  - Teil 1
Kurze Einleitung in die Konzepte von PHP als Server-seitige Skriptsprache auf der Command Line und als Interpreter für eingebetteten Code in HTML-Dokumenten. 

![Überblick](https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/PHP_funktionsweise.svg/780px-PHP_funktionsweise.svg.png?20121129070241)

Tags: HTTP-Request-Response, dynamische Inhalte mit serverseitiger Programmierung

Besprochene Konzepte:
- Schwache, dynamische Typisierung von PHP. Optionale Typangaben.
- Variablen (Definition, Wertzuweisung, Literalschreibweisen, Variablensubstitution)
- Fertige Funktionen verwenden (Doku lesen, call-by-value vs. call-by-reference)
- Eigene Funktionen definieren und aufrufen
- Einfache Klassen definieren und verwenden
- Standard-konforme Dokumentation schreiben
- Indizierte Arrays verwenden

````php
//Definieren von Variablen
$name = 'Michael';
echo "Username $name";

//Definition Mit Datentyp
String $nachname = 'Gamper';

/**
 * Diese Funktion bildet aus einem Vornamen und einem Nachnamen einen String
 * @param String Vorname
 * @param String Nachname
 * @param String Anrede Optionaler Parameter. Wenn nicht angegeben, ist die Anrede 'Herr'
 * @return String Fullname
 */
function getFullname($vname, $nname, $anrede='Herr')
{
    //TODO: Parameter validieren
    
    return $anrede .' ' . $vname.' '.$nname;
}

//Aufruf der Funktion
getFullname('Michael','Gamper')

````

## 27.9.2022: Einleitung PHP  - Teil 2

### Formularverarbeitung

Möchte man über eine HTML Seite Formulare verarbeiten, so hat das zunächst noch nichts mit PHP zutun. Erst wenn ein Formular ausgewertet werden soll, kommt PHP ins Spiel.

Ein Formular kann z.B. folgendermaßen aussehen:

```` html
<form action="php/register.php" method="POST">
        <label for="studiname">Name Studierende/r*</label>
        <input name="studiname" type="text" required="" placeholder="Max Mustermann" />
</form>
````

Die wichtigsten Teile eines HTML-Formulars sind "action" & "method".

- *action:* Die Datei, die als Pfad angegeben wird, wird aufgerufen, nachdem der Besucher auf den Absendebutton des Formulars klickt.
- *method:* Hier wird die Methode angegeben, mit die Variablen des Formulars verschickt werden. Man unterscheidet **get** und **post**.

### Unterschied **get** & **post**

Grundsätzlich funktioniert die Übertragung der Variablen mit **get** sowie mit **post**. Jedoch sollte beim erstellen des Formulars unbedingt darauf geachtet werden, welche Daten vom Server angefordert werden.

#### **get**

Verwendet man get als Methode zur Übertragung, werden die Daten, die an den Server gesendet werden, direkt in die URL geschrieben. 

>
www.example.com/register.php?firstname=peter&name=miller&age=55&gender=male 
>

- Fügt Formulardaten in Name/Wert-Paaren an die URL an
- Die Länge einer URL ist begrenzt (ca. 3000 Zeichen)
- Verwenden Sie niemals GET, um sensible Daten zu senden! (wird in der URL sichtbar)
- Nützlich für Formularübermittlungen, bei denen ein Benutzer das Ergebnis mit einem Lesezeichen versehen möchte
- GET ist besser für nicht sichere Daten wie Abfragezeichenfolgen in Google

#### **post**

Wird die Methode "post" verwendet, werden die zu übertragenden Daten in den HTTP-Request für den Server geschrieben.

- Fügt Formulardaten in den Hauptteil der HTTP-Anfrage ein (Daten werden nicht in der URL angezeigt)
- Hat keine Größenbeschränkungen
- Formularübermittlungen mit POST können nicht mit einem Lesezeichen versehen werden

### Validierung am Client

Um bereits bei der Benutzereingabe Fehler zu vermeiden, wird beim Erstellen des Formulars bereits angegeben, welche Daten der Benutzer im entsprechenden Feld mitgeben wird.
Beispiel:
````html
<label for="email">Email*</label>
<input name="email" type="email" required="" placeholder="maxmustermann@tsn.at" />
````
Der Browser weiß nun, dass der Benutzer eine Email Adresse eingeben muss. Er erwartet also eine beliebige Anzahl an Zeichen, ein @-Symbol und anschließend erneuert eine beliebige Anzahl an Zeichen. Der Benutzer kann also nich nur einen Namen eingeben - er wird gleich vom Browser darauf hingewiesen, dass es sich um eine Email-Adresse handeln muss.
Ob es sich bei dieser Adresse jedoch um eine tatsächliche Email-Adresse handelt, muss Serverseitig validiert werden.

### Validierung am Server

Hier kommt nun die Vorhin im Formular angegebene Datei "action="php/register.php"" zum Einsatz. Sendet der Benutzer sein ausgefülltes Formular ab, wird diese Datei aufgerufen. Es kann nun, wie in folgendem Beispiel, überprüft werden, ob der mitgegebene Name den Voraussetzungen, die der Programmierer gesetzt hat, entspricht:
````php
if(isset($_POST['studiname'])){
        $studiname = $_POST['studiname'];
        if(checkName($studiname) == true){
            echo 'Validierung hat funktioniert';
            //Maskieren gefährlicher Zeichen
            echo htmlspecialchars($studiname);
        } else {
            echo 'Validierung hat nicht funktioniert';
        }
    }
function checkName($name) {
        $regex = '/\D{3,255}/m';
        if(preg_match($regex, $name) === 1) {
            return true;
        }
        return true;
    }
````
Mit der Syntax ````$_POST['variable']```` kann dem Formular eine Beliebige Variable zur überprüfung entnommen werden. Hingegen ````var_damp($_POST)```` gibt alle Informationen als Array aus.

Die if-Abfrage prüft zunächst, ob im Formular der Name des Studierenden, hier "studiname", überhaupt gesetzt wurde. Ist dies der Fall, wird eine neue Variable erstellt, in die eben dieser Name gespeichert wird. Es wird nun in der nächsten if-Abfrage mittels einer Funktion überprüft, ob der eingegebene Name keine Ziffern enthält. Dazu wird der entsprechende Regex verwendet. Hält der "studiname" diesen Überprüfungen stand, wird er mit "htmlspecialchars($studiname)" maskiert (dadurch wird verhindert, dass der Benutzer beispielsweise HTML-Code als Name eingibt) und zurückgegeben.

Diese Art der Validierung kann auf jede beliebige Variable angewendet werden. Anschließend stehen die Daten des Formulars zur weiteren Verarbeitung zur Verfügung.


## 04.10.2022: Einleitung PHP  - Notenerfassung 2.0
---
1. Formular erstellen
2. Eingabefelder definieren
3. Clientseitige Validierung
4. Serverseitige Validierung
5. Datenverarbeitung
6. Ausgabe der Ergebnisse
---

### **1. Formular erstellen**
Das HTML-Formular soll in die Starseite index.php integriert werden. Die Übermittlung der Daten soll mittels http Post im selben Skript erfolgen (action & method-Parameter).

Das HTML ````<form>````-Element wird verwendet, um ein HTML-Formular für Benutzereingaben zu erstellen:
````html
<form>
.
form elements
.
</form>
````
Das ````<form>```` Element ist ein Container für verschiedene Arten von Eingabeelementen, wie z. B.: Textfelder, Kontrollkästchen, Optionsfelder, Senden-Schaltflächen usw.

````html
<form id="form_grade" action="index.php" method="post">
````

Das *method* Attribut gibt an, wie Formulardaten gesendet werden (die Formulardaten werden an die im *action* Attribut angegebene Seite gesendet).

Die Formulardaten können als URL-Variablen (mit method="get") oder als HTTP-Posttransaktion (mit method="post") gesendet werden.


### **2. Eingabefelder definieren**
Für jedes Eingabefeld muss ein eigenes HTML-Input-Element erstellt werden. Für die spätere Datenverarbeitung ist es wichtig, dass jedes Element einen eindeutigen Parameter *name* besitzt. Zur Formularübermittlung wird ein Submit-Button benötigt und zum Leeren des Formulares eine Reset-Button, Link auf index.php oder JavaScript.

Das HTML- ````<input>```` Element ist das am häufigsten verwendete Formularelement.

Ein ````<input>```` Element kann je nach type Attribut auf viele Arten dargestellt werden.

````html
                <input type="text"
                       name="name"
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($name) ?>"
                       maxlength="20"
                       required="required"
                />
 ````


### **3. Clientseitige Validierung**
Die clientseitige Validierung verhindert fehlerhafte Benutzereingaben und ermöglicht eine sofortige Rückmeldung während der Eingabe.
- Name: type=text, maxlength=25, required
- Prüfungsdatum: type=date, required
- Fach: Select-Element, required, option für jedes Fach, value wird abgekürzt, z.B. „m“
- Note: type=number, min=1, max=5, required

Das Datum überprüfen wir mit JavaScript, indem wir eine dafür entsprechende Funktion erstellen. Das JavaScript-file muss im index.php eingebunden werden.
Jede Benutzereingabe sollte überprüft werden, damit z.B. bei *value* kein schadhafter Code eingeschleußt werden kann. In unserem Fall werden mit der Funktion ````value="<?= htmlspecialchars($name) ?>"```` alle Sonderzeichen wie z.B. <, >, & etc. in die jeweiligen HTML-Codierungen umgewandelt.



### **4. Serverseitige Validierung**
Die serverseitige Validierung verhindert die Weiterverarbeitung und Speicherung fehlerhafter Daten.
- Die Formulardaten werden aus dem $_POST-Array im index.php-Skript entnommen
- Die weitere Validierung und Verarbeitung erfolgt mittels Funktionen in einem eigenen PHP-File
- Neben einer Gesamt-Validierungsfunktion muss für jedes Eingabefeld eine eigene Validierungsfunktion erstell werden (Rückgabetyp boolean)
- Alle Validierungsfehler werden in einem assoziativen Fehlerarray gespeichert

Es wird im HTML-Code vor dem ````<form>````-Teil PHP-Code eingebaut. Dieser wird zur Validierung verwendet und behält die eingegebenen
Daten nach Absenden in den Datenfeldern.

````php
<?php

require "lib/func.inc.php";

$name = ""; 
$email = "";
$examDate = "";
$grade = "";
$subject = "";

````
Wenn die Variablen nicht vorher initialisiert wurden, erscheint eine Fehlermeldung im Input-Feld.


### **5. Datenverarbeitung**


### **6. Ausgabe der Daten**
Bei Validierungsfehler soll im Formular jeweils bei dem fehlerhaften Eingabefeld eine sinnvolle Fehlermeldung ausgegeben werden.


## 04.10.2022: Notenerfassung 2.0 - Reflexion
Was habe ich im Rahmen des Kurses gelernt? PHP, Server-,Clientseitige Validierungen, Formularverarbeitung.

Vorher hatte ich wenig Ahnung. Aber jetzt weiß ich, dass es nie nur eine clientseitige Validierung geben darf.

Mir war manches rätselhaft. Aber jetzt verstehe ich den Unterschied zu HTTP GET und POST.

Was ich dazugelernt habe und jetzt besser kann: Im Browser den Debugger zu benutzen und nachvollziehen zu können.

Schwer gefallen ist mir die Syntax von PHP (Warum?) Weil die Syntax für mich nicht auf Anhieb zu verstehen war.

Was war mein größtes Aha-Erlebnis? Wie einfach die clientseitige Validierung ausgehebelt werden kann.

Was habe ich noch überhaupt nicht verstanden? Das GRID-System, obwohl ich es schon von letztem Semester beherrschen sollte.

Welche Fragen sind für mich noch offen geblieben? Wie ich in einem PHP echo eine Funktion einbauen kann.

Welche der Lernziele habe ich bereits erreicht? Lernziele Teil 1 - Formularverarbeitung / Datenvalidierung.

Welche der Expertenstatements kann ich bereits interpretieren und wie sieht meine Interpretation dazu aus?
Wie wird es weitergehen? Es wird die Datenverarbeitung/Speicherung Serverseitig.

... d.h. was möchtest du als nächstes lernen, was muss du nochmals wiederholen, wie kannst du deinen Lernfortschritt weiter verbessern? Indem ich ständig wiederhole und mitarbeite!

## 15.11.2022 Benutzerdaten suchen


## 22.11.2022: Cookies, Sessions und OO

* Cookies: Speicher von Infos am Client
* Sessions: Speichern von Infos am Server
* Anwendungsfälle für Cookies und Sessions aus der Praxis

### Cookie

### Session

#### Login mit Hilfe von Sessions realisieren

1) Login-Formular herrichten
2) Login Daten prüfen
3) Session befüllen
4) Benutzerrollen mit Hilfe der Session verwalten
5) Fehlermeldungen 

## Übersicht der Projekte

* [Startseite](index.html)
* [Formular](1_notenerfassung/index.php)
* [Validierung_Name](1_notenerfassung/php/register.php)
* [Notenerfassung_2.0](2_notenerfassung_2.0/index.php)
