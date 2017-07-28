<?php

include '../generated/include_dao.php';
include '../autenticacao.php';
require '../Slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');
$app->response()->header('Access-Control-Allow-Origin: *'); 
$app->response()->header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS'); 
$app->response()->header('Access-Control-Allow-Headers: X-Requested-With, content-type, X-Token, x-token');


$app->get('/load/:id','load');
$app->get('/queryAll/','queryAll');
$app->get('/queryAllOrderBy/:orderColumn','queryAllOrderBy');
$app->post('/insert/','insert');
$app->post('/update/','update');
$app->get('/delete/:id','delete');

$app->run();

	 /**
	 * LISTA OS DADOS DE ACORDO COM O ID INFORMADO
	 */
        function load($id){
		    
           if(!autenticacao::autenticar()){
                echo json_encode("error");
           }else{
                $campu = DAOFactory::getCampusDAO()->load($id);
                //header('Access-Control-Allow-Origin: *');
                echo json_encode($campu);
               
       
           }
	}

	
        /**
	 * LISTA TODOS OS DADOS DA TABELA
	 */
	function queryAll(){
	    if(!autenticacao::autenticar()){
                echo json_encode("error");
            }else{	
                $campu = DAOFactory::getCampusDAO()->queryAll();
	         
               //header('Access-Control-Allow-Origin: *');
               echo json_encode($campu);
	    }
        }
	
	
	function queryAllOrderBy($orderColumn){
	 
            if(!autenticacao::autenticar()){
                echo json_encode("error");
            }else{
                $campu = DAOFactory::getCampusDAO()->queryAllOrderBy($orderColumn);
                
	        echo json_encode($campu);	
            }    
	}
	
	
	function delete($id){
            if(!autenticacao::autenticar()){
                echo json_encode("error");
            }else{
                header('Content-Type : application/json;charset=utf-8');
                $campu = DAOFactory::getCampusDAO()->delete($id);
               
	        echo utf8_encode("{'registro excluído com sucesso'}");
            }
	}
	
	
	function insert(){
            if(!autenticacao::autenticar()){
                echo json_encode("error");
            }else{
                 header('Access-Control-Allow-Origin: *');
                 header('Content-Type : application/json;charset=utf-8');
                
                $request = \Slim\Slim::getInstance()->request();
                $campu = json_decode($request->getBody());
                
                $campu = DAOFactory::getCampusDAO()->insert($campu);
                //header('Access-Control-Allow-Origin: *');

               
                echo json_encode($campu);
             }
	}
	
	
	function update(){
            if(!autenticacao::autenticar()){
                echo json_encode("error");
            }else{
                header('Content-Type : application/json;charset=utf-8');
                $request = \Slim\Slim::getInstance()->request();
                $campu = json_decode($request->getBody());
                $campu = DAOFactory::getCampusDAO()->update($campu);
                header('Access-Control-Allow-Origin: *');
                echo json_encode("{'mensagem':'registro alterado com sucesso'}");	
            }
	}

	
	


	
	
	

?>
