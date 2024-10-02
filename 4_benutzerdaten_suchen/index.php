<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Benutzerdaten anzeigen</title>

    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>
    <?php

    ?>

    <div class="container">
        <h1 class="mt-5 mb-3">Benutzerdaten anzeigen</h1>



        <form id="form_user" action="index.php" method="get">

            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="suche">Suche:</label>
                    <input type="text" name="suche" required="required">
                </div>
                <div class="col-sm-3 form-group">
                    <input type="submit" name="suchen" class="btn btn-primary btn-block " value="Suchen" />
                </div>

                <div class="col-sm-3 form-group">
                    <a href="index.php" class="btn btn-secondary btn-block ">Leeren</a>
                </div>

            </div>
        </form>
        <div class="row">
            <div class="col-sm-12 form-group">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Geburtsdatum</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        require_once("lib/db.data.php");
                        if (isset($_GET['suchen'])) {
                            $data = getFilteredData($_GET['suche']);
                            if(empty($data)){
                                echo "<div class='alert alert-danger'><p>Es wurde kein entsprechender Datensatz gefunden!</p><ul>";
                            }
                        } else {
                            $data = getAllData();
                        }

                        //$tablehtml = "";

                        foreach ($data as $d) {
                            echo "<tr>";
                            echo "<td> <a href='index_userdetails.php?id=" . $d['id'] . "'>" . $d['firstname'] . " " . $d['lastname'] . "</a></td>";
                            echo "<td>" . $d['email'] . "</td>";
                            echo "<td>" . date("d.m.Y", strtotime($d['birthdate'])) . "</td>";
                            echo "</tr>";

                            /*
                            $tablehtml .= "<tr>";
                            $tablehtml .= "<td>" .$user['lastname'] - "</td>";
                            $tablehtml .= "<td>";
                            $tablehtml .= "<td>";
                            $tablehtml .= "<td>";
                            $tablehtml .= "</tr>";
                            */
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

        </form>

    </div>

</body>

</html>