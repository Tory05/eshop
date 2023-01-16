<!DOCTYPE html>
<html lang="en">

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Webshop</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
  </script>
  <!-- BootStrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
  
<?php

require_once("api/services/Database.php");

$database = new Database("localhost", "eshop", "eshop", "eshop155555555");
$sqlTypes = "SELECT id, name FROM product_types ORDER BY name;";
$types = $database->executeDBQuery($sqlTypes);
$sqlProd = "SELECT P.*, T.name AS type FROM `products` P JOIN `product_types` T ON P.id_product_types = T.id;";
$products = $database->executeDBQuery($sqlProd);

if (isset($_POST["create"])) {
  $newType = $_POST["newtype"];
  $sql = "INSERT INTO `product_types`(`name`) VALUES ('$newType')";
  $database->insert($sql);
  header("Location: admin.php");
  exit();
}
if (isset($_GET["deletetype"])) {
    $deleteTypeId = $_GET["deletetype"];
    $sql = "DELETE FROM product_types WHERE id = '$deleteTypeId'";
    $database->executeDBQuery($sql);
    header("Location: admin.php");
    exit();
  }
  if (isset($_GET["deleteproduct"])) {
    $deleteProductId = $_GET["deleteproduct"];
    $sql = "DELETE FROM products WHERE id = '$deleteProductId'";
    $database->executeDBQuery($sql);
    header("Location: admin.php");
    exit();
  }

?>

<body class="container">
<ul class="nav justify-content-left">
    <li class="nav-item">
      <a class="nav-link" href="/">Kilépés</a>
    </li>
  </ul>

  <hr>
  <h1>Adminisztráció</h1>
<br/>
  <div class="row">
  <h2>Termék típusok</h2>
    <div class="col-md-6">
    <table class="table table-sm">
  <thead>
    <th>Típus</th>
    <th></th>
  </thead>

  <?php foreach ($types as $type) : ?>
  <tr>
    <td><?= $type['name'] ?></td>
    <td>
      <a class="btn btn-sm btn-danger" href="?deletetype=<?= $type['id'] ?>">
        <i class="bi bi-trash"></i>
      </a>
    </td>
  </tr>
  <?php endforeach ?>
</table>
      <form action="" method="post">
      <div class="mb-3">
        <label class="form-label">Új típus:</label>
        <br/>
        <input class="form-control" type="text" id="newtype" name="newtype" class="from">
  </div>
        <input class="btn btn-primary" type="submit" name="create" id="" value="Létrehoz">
      </form>
    </div>
  </div>
<br/>
<hr/>
<br/>
<h2>Termékek</h2>
<div class="row">
<div class="mb-3">
<a href="newproduct.php" class="btn btn-primary">Új termék felvétele</a>
  </div>
<table class="table table-sm">
  <thead>
    <th>Név</th>
    <th>Alapár</th>
    <th>Alapegység</th>
    <th>Leírás</th>
    <th>Típus</th>
    <th></th>
  </thead>

  <?php foreach ($products as $product) : ?>
  <tr>
    <td><?= $product['name'] ?></td>
    <td><?= $product['price_of_sale'] ?></td>
    <td><?= $product['base_unit'] ?></td>
    <td><?= $product['description'] ?></td>
    <td><?= $product['type'] ?></td>
    <td>
      <a class="btn btn-sm btn-warning me-1" href="editproduct.php?id=<?= $product['id'] ?>">
        <i class="bi bi-pencil"></i>
      </a>
      <a href="?deleteproduct=<?= $product['id'] ?>" class="btn btn-sm btn-danger" href="">
        <i class="bi bi-trash"></i>
      </a>
    </td>
  </tr>
  <?php endforeach ?>
</table>
  </div>
</body>

</html>