<?php
class pdoDBGateway extends Database {


    /**
     * pdoDBGateway constructor.
     */
    public function __construct()
    {
        parent::__construct(DBHost, DBName, DBUsername, DBPassword);
    }
}

