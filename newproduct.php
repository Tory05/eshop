
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
<body>
  <ul class="nav justify-content-center">
    <li class="nav-item">
      <a class="nav-link" href="/admin">Vissza</a>
    </li>
  </ul>

  <hr>
<?php

$error = "";
require_once("api/services/Database.php");

$database = new Database("localhost", "eshop", "eshop", "eshop155555555");
$sqlTypes = "SELECT id, name FROM product_types ORDER BY name;";
$types = $database->executeDBQuery($sqlTypes);

if (
    isset($_POST["name"]) &&
    isset($_POST["price"]) &&
    isset($_POST["description"]) &&
    isset($_POST["pricebase"])
  ) {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $pricebase = $_POST["pricebase"];
    $type = $_POST["type"];
    $filename = date('m_d_y_h_i_s') . ".jpg";
    $target = "assets/" . $filename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
    $sql = "INSERT INTO `products`(`name`, `image`, `price_of_sale`, `base_unit`, `description`, `id_product_types`) VALUES ('$name', '$target', '$price','$pricebase','$description','$type')";
    $database->executeDBQuery($sql);
    header("Location: admin.php");
    exit();
  }
?>

<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-body">
        <h1>Új termék:</h1>
        <p class="text-danger"><?= $error ?></p>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="name" class="form-label">Név</label>
            <input type="name" id="name" class="form-control" name="name">
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Alapár</label>
            <input type="number" id="price" class="form-control" name="price">
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Alapegység</label>
            <input type="number" id="pricebase" class="form-control" name="pricebase">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Leírás</label>
            <input type="text" id="description" class="form-control" name="description">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Típus</label>
            <select class="form-select mb-3" name="type">
                <?php foreach ($types as $type) : ?>
                    <option value="<?= $type['id'] ?>">
                        <?= $type['name'] ?>
                    </option>
                <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Kép</label>
            <input id="image" type="file" name="image" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Létrehoz</button>
        </form>
      </div>
    </div>
  </div>
</div>
                </body>