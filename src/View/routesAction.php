<?php
declare(Strict_types=1);
namespace Api\Test\View;

use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Api\Test\Controller\ApiController;

final class RoutesAction
{   
    private ApiController $api;

    public function __construct() 
    { }

    public function handleState(Request $request): Array
    {
        if($_SERVER['REQUEST_URI'] == '/php-api/app/state'){
            $this->api = new ApiController($request);
            if ($request->getMethod() === 'POST') {
                //Validate credentials of header consumer
                $valid_user = $request->headers->get('consumer') == $_ENV['USER_FLAG'];
                if($valid_user){
                    if(count($request->toArray()) >= 10){
                        $create_token =  $this->api->authQuery($request->toArray());
                        return $create_token;
                    } else {
                        return [ 'result' => 'Datos necesarios, no recibidos.', 'status' => 401 ];
                    }
                } else {
                    return [ 'result' => 'Ruta no esta disponible.', 'status' => 401 ];
                }
            } else {
                return [ 'result' => 'Método no permitido', 'status' => 405 ];
            }
        } else {
            return [];
        }
    }

    public function handleUser(Request $request): Array
    {
        if($_SERVER['REQUEST_URI'] == '/php-api/app/user'){
            $this->api = new ApiController($request);
            if ($request->getMethod() === 'POST') {
                //Validate credentials of header authorization for security Token
                $validation = strpos($_SERVER['HTTP_AUTHORIZATION'], $_ENV['API_KEY']);
                //Validate credentials of header consumer
                $valid_user = $request->headers->get('consumer') == $_ENV['USER_FLAG'];
                if($validation){
                    if($valid_user){
                        $clientConsult = $this->api->handleResponse($request->toArray());
                        // success status 200
                        return $clientConsult;
                        // if($clientConsult['status'] == 200){
                        // } else {
                        // }
                    } else {
                        return [ 'result' => 'Consumidor no se ha especificado o no autorizado.', 'status' => 403 ];
                    }
                } else {
                    return [ 'result' => 'LLave no admitida.', 'status' => 401 ];
                }
            } else {
                return [ 'result' => 'Método no permitido', 'status' => 405 ];
            }
        } else {
            return [];
        }
    }
}