<?php
require_once('cart.php');
require_once('book.php')

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Online-Shop</title>
</head>

<body>
    <?php

    $cart = new Cart();

    if(isset($_POST['delete'])) {
        $cart->remove($_POST['id'], $_POST['count']);
        header("Location: warenkorb.php");
    }
    
    
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mt-3">Warenkorb</h1>
            </div>
            <div class="col-sm-4 mt-4">
                <a href="index.php" class="btn btn-success">Zurück zum Shop</a>
            </div>
        </div>
        
        
        <?php
        

        foreach($cart->getCartitems() as $cartitem) {
            echo "<div class='row'>
            <div class='col-sm-12'>
                <div class='row'>
                    <h4>" . $cartitem->getBook()->getTitle() ."</h4>
                </div>
                <form action='warenkorb.php' method='POST'>
                    <div class='row'>
                        <div class='col-sm-4'>
                            <p>" . $cartitem->getTotalPrice() ."€</p>
                        </div>
                        <div class='col-sm-4'>
                            <label for='count'>Menge:</label>
                            <select name='count' id='count'>";
                            for($i=1; $i<=$cartitem->getCount();$i++) {
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }
                                
            echo            "</select>
                        </div>
                        <div class='col-sm-4'>
                            <input name='id' type='hidden' value='" . $cartitem->getBook()->getId() ."'>
                            <button name='delete' class='btn btn-info'>löschen</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>";
        }

        echo "<div class='row'>
        <h3>Gesamtsumme: " . $cart->getEndPrice() ."€</h3>
        </div>";
        ?>

    </div>


</body>

</html>