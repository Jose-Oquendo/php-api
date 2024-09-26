<?php
declare(Strict_types=1);
namespace Api\Test\Resources;
require_once APP_DIRECTORY.'\launch.php';
require_once APP_DIRECTORY.'\config\conn.php';

use Conn;

final class Repository
{   
    private $conn; 

    public function __construct() 
    {
        //db name
        $this->conn =  new Conn('db_name');
    }

    private function validParams($params)
    {
        foreach ($params as $key => $value) {
            if (strpos(strval($value), '=') || strpos(strval($value), '{') || strpos(strval($value), ';')) {
                $params = [];
                break;
            }
        }
        return $params;
    }

    public function consult_in_db(): Object
    {
        //make consult
        $sql = "";
        $params = $this->validParams($params);
        if(is_array($params)){
            $query = $this->conn->sql($sql, $params);
            if(is_array($query)){
                return $query;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

};
