<?php
// Autoload files using composer
require_once __DIR__ . '/../vendor/autoload.php';
use Steampixel\Route;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$BASE_URL = $_ENV['WEBHOOK_URL'];

Route::add('/newcall', function () {
	$caller = $_POST['from'];
	$callee = $_POST['to'];

	header("Content-Type: application/xml; charset=UTF-8");
	return '<Response onAnswer="' . $GLOBALS['BASE_URL'] . '/on-answer" onHangup="' . $GLOBALS['BASE_URL'] . '/on-hangup" />';
}, 'POST');

Route::add('/on-answer', function () {
	$caller = $_POST['from'];
	$callee = $_POST['to'];

	print("$callee answered call from $callee");
}, 'POST');


Route::add('/on-hangup', function () {

	print("The call has been hung up");
}, 'POST');

Route::run('/');
?>