<?php /*require_once(__DIR__ . '/../database/connection.db.php');

if(!isset($conn)){
    exit();
}

if ($conn->connect_errno) {
    echo "0,Cannot connect Server maybe off or you dont have a network connection";
    exit();
}

if(!mysqli_set_charset($conn,"utf8")){
    echo "0, Cannot connect Charset error";
    mysqli_close($conn);
    exit();
}

$user_name = mysqli_real_escape_string($conn,$_REQUEST['username']);
$user_pass = mysqli_real_escape_string($conn,$_REQUEST['password']);
$user_fname = mysqli_real_escape_string($conn,$_REQUEST['firstname']);
$user_lname = mysqli_real_escape_string($conn,$_REQUEST['lastname']);
$user_address = mysqli_real_escape_string($conn,$_REQUEST['address']);
$user_city = mysqli_real_escape_string($conn,$_REQUEST['city']);
$user_country = mysqli_real_escape_string($conn,$_REQUEST['country']);
$user_postalcode = mysqli_real_escape_string($conn,$_REQUEST['postalcode']);
$user_phone = mysqli_real_escape_string($conn,$_REQUEST['phone']);
$user_email = mysqli_real_escape_string($conn,$_REQUEST['email']);

if ($user_name == '' || $user_pass == '' || $user_fname == '' || $user_lname == '' || $user_address == '' || $user_city == '' || $user_country == '' || $user_postalcode == '' || $user_phone == '' || $user_email == '') {
    setcookie('error_reg',true);
    header('Location: /../pages/signin.php');
    mysqli_close($conn);
    exit();
}

$sql_query = sprintf("SELECT username FROM RESTAURANT.USERS WHERE username='%s';",$user_name);
$result = mysqli_query($conn,$sql_query);

if (mysqli_num_rows($result) == 1) {
    setcookie('error_reg',true);
    header('Location: /../pages/signin.php');
    mysqli_close($conn);
    exit();
}

$sql_query = sprintf("SELECT Email FROM RESTAURANT.USERS WHERE Email='%s';",$user_email);
$result = mysqli_query($conn,$sql_query);

if (mysqli_num_rows($result) == 1) {
    setcookie('error_reg',true);
    header('Location: /../pages/signin.php');
    mysqli_close($conn);
    exit();
}

$sql_query = sprintf("SELECT Phone FROM RESTAURANT.USERS WHERE Phone='%s';",$user_phone);
$result = mysqli_query($conn,$sql_query);

if (mysqli_num_rows($result) == 1) {
    setcookie('error_reg',true);
    header('Location: /../pages/signin.php');
    mysqli_close($conn);
    exit();
}

$hash = password_hash($user_pass, PASSWORD_DEFAULT);

$sql_query = sprintf("INSERT INTO RESTAURANT.USERS (FirstName, LastName, username, role, Address, City, Country, PostalCode, Phone, Email, password) VALUES ('%s', '%s', '%s', 1, '%s', '%s', '%s', '%s', '%s', '%s', '%s');",$user_fname, $user_lname, $user_name, $user_address, $user_city, $user_country, $user_postalcode, $user_phone, $user_email, $hash);
$result = mysqli_query($conn,$sql_query);

if ($result) {
    header('Location: /../pages/index.php');
} else {
    setcookie('error_reg',true);
    header('Location: /../pages/signin.php');
}

mysqli_close($conn);*/

declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');

$db = getDatabaseConnection();

//session_start();

    // Setting variables
    $user_name = $_POST['username'];
    $user_role;
    $role_value = $_POST['role'];

    if($role_value == "customer"){
        $user_role = 1;
    }
    elseif($role_value == "owner"){
        $user_role = 2;
    }
    elseif($role_value == "driver"){
        $user_role = 3;
    }
    
    $user_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_fname = $_POST['firstname'];
    $user_lname = $_POST['lastname'];
    $user_address = $_POST['address'];
    $user_city = $_POST['city'];
    $user_country = $_POST['country'];
    $user_postalcode = $_POST['postalcode'];
    $user_phone = $_POST['phone'];
    $user_email = $_POST['email'];

    //check empty fields
    if ($user_name == '' || $user_pass == '' || $user_fname == '' || $user_lname == '' || $user_address == '' || $user_city == '' || $user_country == '' || $user_postalcode == '' || $user_phone == '' || $user_email == '') {
        header('Location: /../pages/signin.php');
        exit();
    }


    //check if unique variables are unique

    $usr = $db->prepare('
      SELECT username FROM USERS WHERE lower(username) = ?
    ');

    $usr->execute(array(strtolower($user_name)));

    if( $usr->fetch()){
        header('Location: /../pages/signin.php');
        exit();
    }

    $ml = $db->prepare('
      SELECT Email FROM USERS WHERE Email = ?
    ');

    $ml->execute(array($user_email));

    if( $ml->fetch()){
        header('Location: /../pages/signin.php');
        exit();
    }

    $ph = $db->prepare('
      SELECT Phone FROM USERS WHERE Phone = ?
    ');

    $ph->execute(array($user_phone));

    if( $ph->fetch()){
        header('Location: /../pages/signin.php');
        exit();
    }

    $stmt = $db->prepare('
        INSERT INTO USERS (FirstName, LastName, username, role, Address, City, Country, PostalCode, Phone, Email, password) 
        VALUES(:firstname, :lastname, :username, :role, :address, :city, :country, :postalcode, :phone, :email, :password)
    ');

    $stmt->bindParam(':username', $user_name);
    $stmt->bindParam(':password', $user_pass);
    $stmt->bindParam(':firstname', $user_fname);
    $stmt->bindParam(':lastname', $user_lname);
    $stmt->bindParam(':role', $user_role);
    $stmt->bindParam(':address', $user_address);
    $stmt->bindParam(':city', $user_city);
    $stmt->bindParam(':country', $user_country);
    $stmt->bindParam(':postalcode', $user_postalcode);
    $stmt->bindParam(':phone', $user_phone);
    $stmt->bindParam(':email', $user_email);

    // Check if the execution of query is success
    if($stmt->execute()){
        //setting a 'success' session to save our insertion success message.

        $session->addMessage('success', 'Signup successful!');
        //$_SESSION['success'] = "Successfully created an account";

        //redirecting to the index.php 
        header('Location: /../pages/index.php');
    }
    else {
        $session->addMessage('error', 'Something Wrong!');
    }

?>