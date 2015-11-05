<?php

	require 'Slim/Slim.php';
	\Slim\Slim::registerAutoloader();

	$app = new \Slim\Slim();

	$app->get('/exemplo/:dados', function($dados) {

		echo "Hello $dados";

	});

	$app->post('/exemplo', function() use ($app) {

		$nome = $app->request()->getBody();

		echo "Hello $nome";

	});


	$app->put('/exemplo', function() use ($app){

		$nome = $app->request()->getBody();

		echo "Tudo bem $nome?";

	});


	$app->delete('/exemplo', function() use ($app){

		$nome = $app->request()->getBody();

		echo "Tchau $nome";

	});


	$app->run();

?>
