<?php


require  '../vendor/autoload.php';
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
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "INSERT INTO users ( email, password) VALUES ('$email', '$password')";
if (mysqli_query($conn, $sql)) {

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


$client = new MongoDB\Client("mongodb://localhost:27017");
$guvidb = $client->selectCollection('guvidb', 'users');
$user = array(
    'name'=> $_POST['name'],
    'email'=>$_POST['email'],
);


$errorMessage = '';
foreach ($user as $key => $value) {
    if (empty($value)) {
        $errorMessage .= $key . ' field is empty<br />';
    }
}


if ($errorMessage) {
    echo '<span style="color:red">' . $errorMessage . '</span>';
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
} else {
    $guvidb->insertOne($user);
    echo "User registered successfully in database.";
}
mysqli_close($conn);
exit;


?>
