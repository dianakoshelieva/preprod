<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
// Please set to false in a production environment
$app['debug'] = true;

$toys = array(
    '00001' => array(
        'name' => 'Racing Car',
        'quantity' => '53',
        'description' => '...',
        'image' => 'racing_car.jpg',
    ),
    '00002' => array(
        'name' => 'Raspberry Pi',
        'quantity' => '13',
        'description' => '...',
        'image' => 'raspberry_pi.jpg',
    ),
);

$app->get('/', function () use ($toys) {
    return json_encode($toys);
});

$app->post('/feedback', function () {
    $request = Request::createFromGlobals();
    $data = json_decode($request->getContent(), true);
    $request->request->replace(is_array($data) ? $data : array());
    $title = $request->request->get('title');
    return "";
});

$app->post('/', function () use ($toys) {

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "pomodoro";

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    echo "Connected successfully";

    $query = "INSERT INTO pet (name,owner) VALUES ('Stuttgart','Stuttgart')";
    if ($mysqli->query($query) === TRUE) {
        echo "New record created successfully";
        return "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $mysqli->error;
        return "Error: " . $query . "<br>" . $mysqli->error;
    }
    $mysqli->close();
    return json_encode($toys);
});

$app->get('/{stockcode}', function (Silex\Application $app, $stockcode) use ($toys) {
    if (!isset($toys[$stockcode])) {
        $app->abort(404, "Stockcode {$stockcode} does not exist.");
    }
    return json_encode($toys[$stockcode]);
});


$app->run();






