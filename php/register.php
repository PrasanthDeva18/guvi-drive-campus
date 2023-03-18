<?php

require '../vendor/autoload.php';
// Connect to MySQL database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'guvi';
$conn = mysqli_connect($host, $user, $password, $dbname);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email'";
$res = mysqli_query($conn, $query);
$d =mysqli_num_rows($res);

if ($d  > 0) {
    echo "Email already exits";
} else {
    // Insert data into MySQL table
    $sql = "INSERT INTO users ( email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        // echo "User registered successfully in MySQL database.";
        // header("Location: ../login.html");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}




$client = new MongoDB\Client("mongodb://localhost:27017");
$guvidb = $client->selectCollection('guvidb', 'users');
// $result = $guvidb->createCollection('users');
// var_dump($result);
// echo "db connectes succesfully";

// $db = $client->guvidb
$user = array(
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'phoneno' => $_POST['phone'],
    'dob' => $_POST['dob'],
    'age' => $_POST['age']
);


$errorMessage = '';
foreach ($user as $key => $value) {
    if (empty($value)) {
        $errorMessage .= $key . ' field is empty<br />';
    }
}


if ($errorMessage || $d > 0) {
    echo '<span style="color:red">' . $errorMessage . '</span>';
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
} else {
    $guvidb->insertOne($user);
    // echo "<font color='green'>Data added successfully.";
    echo "User registered successfully in database.";
    // echo "mass";
    // echo "<br/><a href='index.php'>View Result</a>";
}





// Close MySQL database connection
mysqli_close($conn);
exit;

?>