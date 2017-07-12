<?php
require 'vendor/autoload.php';

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
echo "Server running at http://127.0.0.1\n";

$socket->listen(1337);
$loop->run();
