<?php
declare(Strict_types=1);
namespace Api\Test\Controller;

date_default_timezone_set('America/Bogota');
require_once APP_DIRECTORY.'\launch.php';

use Api\Test\Resources\Repository;
use Symfony\Component\HttpFoundation\Request;

final class ApiController
{   
    private Request $request; 
    private Repository $repository; 

    public function __construct(Request $request) 
    {
        $this->request = $request;
        $this->repository = new Repository();
    }

    public function authQuery(Array $params): Array
    {  
        // change for authorization method
        $response = $this->repository->consult_in_db();
        return [ 'result' => 'Token generado', 'status' => $response->getStatusCode(), 'data' => $response->getContent() ];
    }

    public function handleResponse($response, $params): Array
    {
        $this->saveLog($response, $params);
        $data = $response->toArray();
        $query = $this->repository->consult_in_db();

        if(is_array($query) && count($query) > 0){
            return [ 'result' => 'Conssulta exitosa', 'status' => 201];
        } else {
            return [ 'result' => 'Ah ocurrido un error con la informacion.', 'status' => 502];
        }
    }

    public function saveLog($response, $params)
    {
        //function to save log
        $archivo = APP_DIRECTORY.'\src\assets\notes.txt';
        $fp = fopen($archivo, "a");
        fwrite($fp, PHP_EOL.strval(date('Y-m-d H:i:s')).'||'.strval(json_encode($response->getContent())));
        fclose($fp);
    }

}