<?php
// Always start this first
session_start();

# create database connection
include 'dbc.php';

$connect = mysqli_connect($servername, $username, $password, $dbname);

if(!empty($_POST["email"])) {
  $query = "SELECT * FROM user WHERE email='" . $_POST["email"] . "' AND pwd='". $_POST["pwd"] ."';";
  $result = mysqli_query($connect,$query);
  $count = mysqli_num_rows($result);
}

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $user = $result->fetch_object();


    $ok = true;
    $messages = array();

    if ( !isset($email) || empty($email) ) {
        $ok = false;
    }

    if ( !isset($password) || empty($password) ) {
        $ok = false;
    }

    if ($ok) {
        if ($count>0) {
            $_SESSION['user_id'] = $user->email;
            $_SESSION['uname'] = $user->username;
            $_SESSION['pwd'] = $user->pwd;
            $_SESSION["to_download"] = 0;
            $ok = true;
            
            $messages[] = 'Successful login!';
        } else {
            $ok = false;
            $messages[] = 'Incorrect email/password combination!';
        }
    }

    echo json_encode(
        array(
            'ok' => $ok,
            'messages' => $messages
        )
    );

?>


