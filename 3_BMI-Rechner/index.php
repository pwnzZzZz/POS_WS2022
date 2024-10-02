<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Body-Mass-Index-Rechner</title>

    <script type="text/javascript" src="js/index.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-3">Body-Mass-Index-Rechner</h1>

        <?php 
        
        require "lib/func.inc.php";
        

        $name = "";
        $date = "";
        $height ="";
        $weight = "";

        if(isset($_POST['submit'])){
            $name = isset($_POST['name']) ? $_POST['name'] : "";
            $date = isset($_POST['date']) ? $_POST['date'] : "";
            $height = isset($_POST['height']) ? $_POST['height'] : "";
            $weight = isset($_POST['weight']) ? $_POST['weight'] : "";

            if(validate($date, $name, $height, $weight)){
                $bmi = calculateBMI($height, $weight);

                if($bmi < 18.5)
                echo "<p class='alert alert-warning'> BMI: " . calculateBMI($height, $weight) . " - Untergewicht</p>";
                else if($bmi >= 18.5 && $bmi <= 24.9)
                echo "<p class='alert alert-success'> BMI: " . calculateBMI($height, $weight) . " - Normalgewicht</p>";
                else if($bmi >= 25.0 && $bmi <= 29.9)
                echo "<p class='alert alert-warning'> BMI: " . calculateBMI($height, $weight) . " - Übergewicht</p>";
                else if($bmi >= 30.0)
                echo "<p class='alert alert-danger'> BMI: " . calculateBMI($height, $weight) . " - Adipositas</p>";
            }else{
                echo "<div class='alert alert-danger'><p>Die eingegebenen Daten sind fehlerhaft!</p><ul>";
            foreach ($errors as $key => $value) {
                echo "<li>" . $value . "</li>";
            }
            echo "</ul></div>";
            }
        }


        ?>

        <form id="form_grade" action="index.php" method="post">
            <div class="row">
                <div class="col-sm-9 form-group">
                    <div class="row">
                        <div class="col-sm-8 form-group">
                            <label for="name">Name*</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" maxlength="25" required="required" >
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="date">Messdatum*</label>
                            <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date) ?>" onchange="validateDate(this)" required="required">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="height">Größe (cm)*</label>
                            <input type="number" name="height" class="form-control" value="<?= htmlspecialchars($height) ?>" min="1" max="300" required="required">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="weight">Gewicht (kg)*</label>
                            <input type="number" name="weight" class="form-control" value="<?= htmlspecialchars($weight) ?>" min="1" max="500" required="required">
                        </div>
                    </div>

                </div>
                <div class="col-sm-3 form-group">
                    <h2>Info zum BMI</h2>
                    <p>
                        Unter 18.5 Untergewicht <br>
                        18.5 - 24.9 Normal <br>
                        25.0 - 29.9 Übergewicht <br>
                        30.0 und darüber Adipositas <br>
                    </p>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-3 mb-3">
                    <input type="submit" name="submit" class="btn btn-primary btn-block " value="Speichern" />
                </div>
                <div class="col-sm-3">
                    <a href="index.php" class="btn btn-secondary btn-block ">Löschen</a>
                </div>

            </div>
        </form>

    </div>


</body>

</html>