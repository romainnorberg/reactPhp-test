<?php
require __DIR__ . '/../vendor/autoload.php';

$i = 0;
$app = function ($request, $response) use ($i) {
    $response->writeHead(200, array('Content-Type' => 'text/plain'));
    $response->end("Hello World $i\n");
    $i++;
};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$http->on('request', $app);

$port = getenv('PORT');
$socket->listen($port, '127.0.0.1');
echo "Server listen, go running\n";
$loop->run();
