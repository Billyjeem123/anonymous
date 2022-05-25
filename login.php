<?php


require_once("vendor/init.php");

$database = new Database();
$user = new Users();

 

if (isset($_POST['username']) or !empty($_POST['password'])) {


$user->username = trim($_POST['username']);
$user->password = $database->escape_string($_POST['password']);

$find_user =  $user->LogUser($user->username);
$rows = $database->rows($find_user);

if ($rows > 0) {



    foreach ($find_user as $key) {

        if (password_verify($user->password, $key['password'])) {

            $array = [
                'success' => true,
                'message' => 'Logged in successfully',
                'username' => $user->username
            ];
            $return = json_encode($array);
            echo "$return";
            exit();
        } else {
            $array = [
                'success' => false,
                'message' => 'Username and Password Doesnt Match',
                'username' => $user->username
            ];
            $return = json_encode($array);
            echo "$return";
            exit();
        }
    }
} else {

    $array = [
        'success' => false,
        'message' => 'Username or password does not exist in our database',
    ];
    $return = json_encode($array);
    echo "$return";
    exit();
}

}else{

    $array = [
                'success' => true,
                'message' => 'Username or Password must not be empty',
                
            ];
            $return = json_encode($array);
            echo "$return";
            exit();


}
