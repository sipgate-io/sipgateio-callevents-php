<?php
// Autoload files using composer
require_once __DIR__ . '/../vendor/autoload.php';
use Steampixel\Route;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$BASE_URL = $_ENV['WEBHOOK_URL'];

Route::add('/newcall', function ($request, $response) {

	$response->getBody()->write('<Response onAnswer="' . $GLOBALS['BASE_URL'] . '/on-answer" onHangup="' . $GLOBALS['BASE_URL'] . '/on-hangup" />');
	$response.header("Content-Type: application/xml; charset=UTF-8");
	return $response;
}, 'POST');

Route::add('/on-answer', function ($request, $response) {
	$caller = $_POST['from'];
	$callee = $_POST['to'];

	print("$callee answered call from $callee");
	return $response->withStatus(200);
}, 'POST');


Route::add('/on-hangup', function ($request, $response) {

	print("The call has been hung up");
	return $response->withStatus(200);
}, 'POST');

Route::run('/');

