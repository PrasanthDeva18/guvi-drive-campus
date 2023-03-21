<?php
require '../vendor/autoload.php';

// echo 'hii'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    header('Content-Type: application/json');
    // echo 'hiii';
    // echo 'respone';

    $email = $_GET['email'];
    // $email = 'pr@gmail.com';
    // $email = 'prasanthvennila@gmail.com';   
    // echo $email;
    $redis = new Predis\Client();
    $cacheentry = $redis->get("email");
    // echo $cacheentry;

    if ($cacheentry == null) {
    // $email = $_POST['email'];
    // echo $email;

    $client = new MongoDB\Client("mongodb://localhost:27017");

    $collection = $client->guvidb->users;

    // $cursor = $collection->find([], ['projection' => ['_id' => 0]],);
    // $cursor = $collection->find([
    //     'email' => $cacheentry
    // ]
    // );
    $cursor = $collection->find([
        'email'=>$cacheentry
    ]);

    $data = array();

    foreach ($cursor as $document) {
        $data[] = $document;
    }
    $json =  json_encode($data);
    echo $json;

    $redis->set($data, json_encode($c));
    // die(json_encode(
    //     array(
    //         "email" => $c["email"],
    //         "dob" => $c["dob"],
    //         "age" => $c["age"],
    //         "phoneno" => $c["phone"],
    //         "name" => $c["name"],
    //         "from" => "MongoDB"
    //     )
    // ));

    // exit();


    // } else {
    //     $data = json_decode($cacheentry);
    //     echo 'hiiii';
    //     die(json_encode(
    //         array(
    //             "email" => $data->email,
    //             "dob" => $data->dob,
    //             "age" => $data->age,
    //             "phoneno" => $data->phone,
    //             "name" => $data->name,
    //             "from" => "Redis"
    //         )
    //     ));
    }
}

exit;
?>
