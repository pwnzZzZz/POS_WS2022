<!doctype html>
<html lang="en">
    
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Notenerfassung</title>

    <!-- java script wird verlinkt -->
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>

<div class="container">

    <!-- Abstand margin top und margin bottom -->
    <h1 class="mt-5 mb-3">Notenerfassung</h1>

    <?php

    // einbinden/laden der Validierungsfunktionen
    require "lib/func.inc.php";

    // Formularvariablen definieren (in PHP nicht zwingend notwendig)
    
    /*
        Wenn man die Variablen nicht vorher initialisiert, kommt auf der Website eine Fehlermeldung im Input-Feld.
        Im input-Feld wird mit "value="<?= htmlspecialchars($name)" ein Wert ins Feld eingefügt - 
        ladet man die Website neu, so macht diese eine GET-Abfrage. Da die Variablen aber in einer IF-Abfrage
        mit Voraussetzung einer POST-Abfrage stehen, werden diese nicht aufgerufen und wurden somit nie initialisiert.
        */
    $name = "";
    $email = "";
    $examDate = "";
    $grade = "";
    $subject = "";

    // Formularverarbeitung (HTTP POST Request)
    if (isset($_POST['submit'])) {

        // double-check: zuerst pruefen ob die Daten im Request enthalten sein, dann auslesen
        // isset - wenn vorhanden, dann diesen Wert verwenden - wenn nicht vorhanden: default
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $examDate = isset($_POST['examDate']) ? $_POST['examDate'] : "";
        $grade = isset($_POST['grade']) ? $_POST['grade'] : "";
        $subject = isset($_POST['subject']) ? $_POST['subject'] : "";

        // Validierung der Daten und Ausgabe des Ergebnisses (an der aktuellen Stelle in der HTML-Seite)
        if (validate($name, $email, $examDate, $subject, $grade)) {
            echo "<p class='alert alert-success'>Die eingegebenen Daten sind in Ordnung!</p>";
        } else {
            echo "<div class='alert alert-danger'><p>Die eingegebenen Daten sind fehlerhaft!</p><ul>";
            foreach ($errors as $key => $value) {
                echo "<li>" . $value . "</li>";
            }
            echo "</ul></div>";
        }
    }

    ?>

    <!-- method normalerweise immer post, action ist das Ziel, hier das selbe Skript -->
    <form id="form_grade" action="index.php" method="post">

        <div class="row">
            <!-- 6 Spalten für Name -->
            <div class="col-sm-6 form-group">
                <!-- label wird mit name verbunden -->
                <label for="name">Name*</label>
                <input type="text"
                       name="name"
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($name) ?>"
                       maxlength="20"
                       required="required" />
                        <!--Möchte man in ein Input-Feld den eingegebenen Wert des Users einfügen, kann dies mit Value geschehen.
                        Die Syntax öffnet ein kurzes PHP-File, das dann die bereits erstellte Variable $name einfügt.
                        Ist diese noch nicht gesetzt bzw. hat der User noch keine Daten eingegeben, wird der vorhin gewählte Dummy-Wert eingefügt.
                        Wird ein Name eingegeben, der nicht der Validierung entspricht, wird nun mit "class="form-control..."" geprüft, ob die globale Variable
                        $errors gesetzt ist. Ist dies der Fall, wird das Feld auf Invalid gesetzt und bekommt einen roten Rand.-->
            </div>
            <!-- 6 Spalten für email -->
            <div class="col-sm-6 form-group">
                <label for="email">E-Mail</label>
                <input type="email"
                       name="email"
                       class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($email) ?>"
                />
            </div>

        </div>

        <div class="row">

            <div class="col-sm-4 form-group">
                <label for="subject">Fach*</label>
                <select name="subject"
                        class="custom-select <?= isset($errors['subject']) ? 'is-invalid' : '' ?>"
                        required="required">
                    <option value="" hidden>- Fach auswählen -</option>
                    <option value="m" <?php if ($subject == 'm') echo "selected='selected'"; ?> >Mathematik</option>
                    <option value="d" <?php if ($subject == 'd') echo "selected='selected'"; ?> >Deutsch</option>
                    <option value="e" <?php if ($subject == 'e') echo "selected='selected'"; ?> >Englisch</option>
                    <!--Möchte man, dass auch das Fach nach absenden des Formulars stehen bleibt, muss dies erneuert mit PHP-Code programiert werden.
                    Es wird also abgefragt, welchen Value das eingegebene Fach hat - dieses wird dann anschließend weiter in der Select-Box stehen bleiben.
                    Wurde noch kein Fach ausgewählt, wird weiterhin der Dummy-Text verwendet.-->
                </select>
            </div>

            <div class="col-sm-4 form-group">

                <label for="grade">Note*</label>
                <input type="number"
                       name="grade"
                       class="form-control <?= isset($errors['grade']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($grade) ?>"
                       min="1"
                       max="5"
                       required="required"
                />
            </div>


            <div class="col-sm-4 form-group">
                <label for="examDate">Prüfungsdatum*</label>
                <input type="date"
                       name="examDate"
                       class="form-control <?= isset($errors['examDate']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($examDate) ?>"
                       onchange="validateExamDate(this)"
                       required="required"
                />
            </div>

        </div>

        <div class="row mt-3">

            <div class="col-sm-3 mb-3">
                <input type="submit"
                       name="submit"
                       class="btn btn-primary btn-block"
                       value="Validieren"
                />
            </div>

            <div class="col-sm-3">
                <a href="index.php" class="btn btn-secondary btn-block">Löschen</a>
            </div>

        </div>

    </form>

</body>
</html>
