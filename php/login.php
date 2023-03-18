<?php
require '../vendor/autoload.php';
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'guvi';
$conn = mysqli_connect($host, $user, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["email"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM users WHERE email = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $t0 = 0;
    $t1 = 0;


    if ($count == 1) {

        $redis = new Predis\Client();

        $cacheentry = $redis->get('data');

        while ($row = $result->fetch_assoc()) {

            $temp = $row['email'] . ' ' . $row['password'] . '<br/>';
        }
        $redis->set('data', json_encode($temp));

        $res = [
            "msg"=>"success",
            "status"=>"200",
            "user"=>$result


        ];
        echo json_encode($res);
    } else {
        echo "Invalid username or password";
    }
}


mysqli_close($conn);
exit;
?>
