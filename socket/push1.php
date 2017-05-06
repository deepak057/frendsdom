
<?php
/* Server hostname */
$dsn = "tcp://*:5555";

/* Create a socket */
$socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, 'my socket');

/* Get list of connected endpoints */
$endpoints = $socket->getEndpoints();

/* Check if the socket is connected */
if (!in_array($dsn, $endpoints['connect'])) {
    echo "<p>Connecting to $dsn</p>";
    $socket->connect($dsn);
} else {
    echo "<p>Already connected to $dsn</p>";
}

/* Send and receive */
$socket->send("Hello!");
$message = $socket->recv();

echo "<p>Server said: {$message}</p>";
?>

