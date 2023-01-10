<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Page;
use App\Helper\Auth;
use App\Helper\Feedback;
use App\Model\Cliente;
use App\Pagination;

$app->get('/login', function (Request $request, Response $response, $args) {
    if (Auth::checkLogin()) {
        header('Location: /');
        exit;
    }

    $msg = Feedback::showMsg();

	$page = new Page(['template' => false]);
	$html = $page->setTpl('login', [
        'title' => 'Login',
        'msg' => $msg
    ]);

    $response->getBody()->write($html);
    return $response;
});

$app->post('/login', function (Request $request, Response $response, $args) {
    $data = $request->getParsedBody();
	try {
		Auth::login($data['login'], $data['senha']);

		header('Location: /', true, 301);
	} catch (\Exception $e) {
		Feedback::setMsg($e->getMessage(), 'danger');

		header('Location: /login', true, 301);
	} finally {
		exit;
	}

	header('Location: /', true, 301);
	die();
});

$app->get('/logout', function (Request $request, Response $response, $args) {
	Auth::logout();
	
	header('Location: /login', true, 301);
	exit;
});

$app->get('/[{id}]', function (Request $request, Response $response, $args) {
    Auth::verifyLogin();
    $msg = Feedback::showMsg();

	if (isset($args['id'])) {
		$client = new Cliente();
		$client->get((int)$args['id']);
		$input = $client->getValues();
	} else $input = [];

	$pagination = Pagination::beginPaginationSession();
	$data = Cliente::listAll();
	$clients = $pagination->createPagination($data['query'], $data['args'], '/');
	unset($pagination);

	$page = new Page();
	$html = $page->setTpl('index', [
        'title' => 'Página Inicial',
        'msg' => $msg,
        'clients' => $clients['data'],
		'pagination' => $clients['pagination'],
		'input' => $input
    ]);

    $response->getBody()->write($html);
    return $response;
});

$app->post('/', function(Request $request, Response $response, $args) {
	Cliente::save($request->getParsedBody());

	header('Location: /', true, 301);
	die();
});

$app->get('/delete/{id}', function (Request $request, Response $response, $args) {
	Cliente::delete((int)$args['id']);

	header('Location: /', true, 301);
	die();
});