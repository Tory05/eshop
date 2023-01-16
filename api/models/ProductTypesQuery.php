<?php


class ProductTypesQuery
{
    private $database;
    private $sqlStatement;

    public function __construct(){
        $this->database = new pdoDBGateway();
        $this->sqlStatement = "SELECT id, name FROM product_types ORDER BY name;";
    }


    public function executeQuery()
    {
        $result = $this->database->executeDBQuery($this->sqlStatement);
        return($this->formatQueryData($result));
    }


    private function formatQueryData($result)
    {
        $productNames = array();

        for($x = 0; $x<count($result); $x++) {
            $a = ["productType" => $result[$x]['name'], "url" => "http://localhost:8080/api/index.php?action=listProductsByTypeId&typeId=" . $result[$x]['id'] . ""];
            array_push($productNames, $a);
        }
        return $productNames;
    }
}
