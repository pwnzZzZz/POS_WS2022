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

    if(isset($_POST['add'])) {
        $cart->add(Book::getById($_POST['id']), $_POST['stock']);
        header("Location: index.php");
    }
    
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mt-3">Bücher</h1>
            </div>
            <div class="col-sm-4 mt-4">
                <a href="warenkorb.php" class="btn btn-success">Warenkorb: <?= $cart->getTotalCount() ?></a>
            </div>
        </div>
        
        
        <?php
        $books = Book::getAll();

        foreach($books as $key => $book) {
            echo "<div class='row'>
            <div class='col-sm-12'>
                <div class='row'>
                    <h4>" . $book->getTitle() ."</h4>
                </div>
                <form action='index.php' method='POST'>
                    <div class='row'>
                        <div class='col-sm-4'>
                            <p>" . $book->getPrice() ."€</p>
                        </div>
                        <div class='col-sm-4'>
                            <label for='stock'>Menge:</label>
                            <select name='stock' id='stock'>";
                            for($i=1; $i<=$book->getStock();$i++) {
                                echo "<option value='" . $i . "'>" . $i . "</option>";
                            }
                                
            echo            "</select>
                        </div>
                        <div class='col-sm-4'>
                            <input name='id' type='hidden' value='" . $book->getId() ."'>
                            <button name='add' class='btn btn-info'>hinzufügen</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>";
        }
        ?>

    </div>


</body>

</html>