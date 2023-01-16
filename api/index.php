<?php
include "config/config.php";

$requestController = new ProductsQueryController();
$requestController->routeDataRequest();

