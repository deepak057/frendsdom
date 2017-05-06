<?php

    require  'vendor/autoload.php';

    // post.php ???
    // This all was here before  ;)
    $entryData = array(
        'category' => "ss",
       'title'    => "sdsds",
       'article'  => "sdsdsdsdsds",
       'when'     => time()
    );

    /*$pdo->prepare("INSERT INTO blogs (title, article, category, published) VALUES (?, ?, ?, ?)")
        ->execute($entryData['title'], $entryData['article'], $entryData['category'], $entryData['when']);
*/


    // This is our new stuff
  //  $context = new ZMQContext();
//    $socket = $context->getSocket(ZMQ::SOCKET_PUSH);
    //$socket->connect("tcp://127.0.0.1:5555");
//echo json_encode($entryData);
   // $socket->send(json_encode($entryData));
$loop = React\EventLoop\Factory::create();

$context = new React\ZMQ\Context($loop);

$push = $context->getSocket(ZMQ::SOCKET_PUSH);
$push->connect('tcp://127.0.0.1:5555');


$i = 0;
$loop->addPeriodicTimer(1, function () use (&$i, $push,$entryData) {
    $i++;
    echo "sending $i\n";
    $push->send(json_encode($entryData));
});


//$push->send(json_encode($entryData));

$loop->run();
