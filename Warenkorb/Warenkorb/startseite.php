<?php
require_once('book.class.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Article List</title>
  </head>
  <body>
    <h1>Article List</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Price</th>
          <th>Stock</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $data = Book::getAllBooks();

        foreach ($data as $article) {
        ?>
          <tr>
            <td><?php echo $article->getId(); ?></td>
            <td><?php echo $article->getTitle(); ?></td>
            <td><?php echo $article->getPrice(); ?></td>
            <td><?php echo $article->getStock(); ?></td>
            <td> <button type="submit" name="add" value="yesplease" class="btn btn-secondary">Hinzufügen</button> </td>
          </tr>
        <?php
        }
        
        ?>

        
      </tbody>
    </table>
  </body>
</html>