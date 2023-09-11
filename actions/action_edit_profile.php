<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getId());

  if ($user) {
    $user->firstName = $_POST['first_name'];
    $user->lastName = $_POST['last_name'];
    $user->address = $_POST['address'];
    $user->phone = $_POST['phone'];
    
    $user->save($db);

    $session->setFName($user->firstName);
    $session->setLName($user->lastName);
    $session->setAddress($user->address);
    $session->setPhone($user->phone);
  }

  header('Location: /../pages/restaurant.php');
?>