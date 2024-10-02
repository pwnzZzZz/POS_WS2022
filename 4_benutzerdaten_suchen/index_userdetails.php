<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Benutzerdetails</title>

    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-3">Benutzerdetails</h1>



        <div class="mb-4 ml-2" >
        <a href="index.php">zurück</a>
            <?php


            ?>
        </div>
          

            <div class="row">
                <div class="col-sm-12 form-group">
                    <table class="table">

                        <tbody>
                            <?php
                            require_once("lib/db.data.php");
                            $id = $_GET['id'];
                            $data = getDataPerId($id);
                            echo "<tr>";
                            echo "<td>";
                            echo "Vorname";
                            echo "</td>";
                            echo "<td>" . $data['firstname'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>";
                            echo "Nachname";
                            echo "</td>";
                            echo "<td>" . $data['lastname'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>";
                            echo "Geburtsdatum";
                            echo "</td>";
                            echo "<td>" . date("d.m.Y", strtotime($data['birthdate'])) . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>";
                            echo "E-Mail";
                            echo "</td>";
                            echo "<td>" . $data['email'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>";
                            echo "Telefon";
                            echo "</td>";
                            echo "<td>" . $data['phone'] . "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>";
                            echo "Straße";
                            echo "</td>";
                            echo "<td>" . $data['street'] . "</td>";
                            echo "</tr>";
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>


    </div>

</body>

</html>

</div>

</body>

</html>