<?php
  /*declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

    if(!isset($conn)){
        exit();
    }

    if ($conn->connect_errno) {
        echo "0,Cannot connect Server maybe off or you dont have a network connection";
        exit();
    }

    else {
        if(!mysqli_set_charset($conn,"utf8")){
            echo "0,Cannot connect Charset error";
            mysqli_close($conn);
            exit();
        }
    }

$user_name = mysqli_real_escape_string($conn,$_REQUEST['username']);
$user_pass = mysqli_real_escape_string($conn,$_REQUEST['password']);

$sql_query = sprintf("SELECT password FROM RESTAURANT.USERS WHERE username='%s';", $user_name);
mysqli_real_escape_string($conn, $sql_query);
$result = mysqli_query($conn, $sql_query);

if (mysqli_num_rows($result) == 1 && password_verify($user_pass,mysqli_fetch_assoc($result)['password'])){
    setcookie('logged','true');
    $user = User::getUserWithPassword($db, $user_name);
    if ($user) {
      $session->setId($user->id);
      $session->setFname($user->firstName);
      $session->setLname($user->lastName);
      $session->setUsername($user->username);
      $session->addMessage('success', 'Login successful!');
    }
    header('Location: /../pages/restaurant.php');
} else {
    setcookie('error_log','true');
    $session->addMessage('error', 'Wrong password!');
    header('Location: /../pages/index.php');
}

mysqli_close($conn);*/

  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

  if ($user) {
    $session->setId($user->id);
    $session->setFname($user->firstName);
    $session->setLname($user->lastName);
    $session->setUsername($user->username);
    $session->setRole($user->role);
    $session->setAddress($user->address);
    $session->setPhone($user->phone);
    $session->addMessage('success', 'Login successful!');
    header('Location: /../pages/restaurant.php');
  } else {
    $session->addMessage('error', 'Wrong password!');
    header('Location: /../pages/index.php');
  }


?>


