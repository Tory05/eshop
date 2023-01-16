<?php


class ProductsByIDQuery
{
    private $typeID;
    private $database;
    private $sqlStatement;
    private $js;

    public function __construct($typeID){
        $this->typeID = array($typeID);
        $this->js = new JsonView();
        $this->database = new pdoDBGateway();
        $this->sqlStatement = "SELECT t.name AS productTypeName, p.name AS productName, p.id AS pid, p.base_unit AS baseUnit, p.image, p.price_of_sale AS productPrice, p.description AS productDescription FROM product_types t JOIN products p ON t.id = p.id_product_types WHERE t.id = ?";
    }


    public function executeQuery()
    {
        $result = $this->database->executeDBQuery($this->sqlStatement, $this->typeID);
        return $this->formatQueryData($result);
    }


    private function formatQueryData($result){
        $productData = array();

        $backUrl = "http://localhost:8080/api/index.php?action=listtypes";
        foreach($result as $row){
            $row["url"] = $backUrl;
            array_push($productData,  $row);

        }
        return $productData;
    }
}
