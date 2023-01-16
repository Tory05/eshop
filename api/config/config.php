<?php

error_reporting(E_ALL);



include "controller/ProductsQueryController.php";
include "services/Database.php";
include "services/Session.php";
include "models/pdoDBGateway.php";
include "models/ProductTypesQuery.php";
include "models/ProductsByIDQuery.php";
include "views/JsonView.php";
include "models/ProductByArticleID.php";

define("DBHost", "localhost");
define("DBName", "eshop");
define("DBPassword", "eshop155555555");
define("DBUsername", "eshop");
