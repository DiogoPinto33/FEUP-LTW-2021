<?php

  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  //require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  // Setting variables
  $rest_name = $_POST['name_res'];
  $rest_address = $_POST['address_res'];
  $rest_phone = $_POST['phone_res'];
  $rest_type = $_POST['type_res'];
  $rest_owner = $session->getId();

  //check empty fields
  if ($rest_name  == '' ||$rest_address  == '' || $rest_phone  == '' || $rest_type  == '') {
      $session->addMessage('error', 'Campos Vazios!');
      exit();
  }

  //check if unique variables are unique
  $resn = $db->prepare('
    SELECT name FROM FOOD_COMPANY WHERE lower(name) = ?
  ');

  $resn->execute(array(strtolower($rest_name)));

  if( $resn->fetch()){
      $session->addMessage('error', 'Restaurante já existe!');
      exit();
  }

  $resph = $db->prepare('
      SELECT phone FROM FOOD_COMPANY WHERE phone = ?
  ');

  $resph->execute(array($rest_phone));

  if( $resph->fetch()){
      $session->addMessage('error', 'Número de telefone pertencente a outro restaurante!');
      exit();
  }

  $stmt = $db->prepare('
      INSERT INTO FOOD_COMPANY (name, address, phone, information, owner) 
      VALUES(:name, :address, :phone, :information, :owner)
  ');

  $stmt->bindParam(':name', $rest_name);
  $stmt->bindParam(':address', $rest_address);
  $stmt->bindParam(':phone', $rest_phone);
  $stmt->bindParam(':information', $rest_type);
  $stmt->bindParam(':owner', $rest_owner);

  // Check if the execution of query is success
  if($stmt->execute()){

      $session->addMessage('success', 'Adicionou Restaurante!');
      //$_SESSION['success'] = "Successfully created an account";
  }
  else {
      $session->addMessage('error', 'Algo deu errado!');
  }

  $id_restaurant = $db->lastInsertId();

  //---------------------------------------------

  $stmt_i = $db->prepare("INSERT INTO FOOD_COMPANY_IMAGES VALUES(NULL, ?, ?)");
  $stmt_i->execute(array($_POST['title'], $id_restaurant));

  $id_image = $db->lastInsertId();

  if (!is_dir('images')) mkdir('images');
  if (!is_dir('images/originals')) mkdir('images/originals');

  $originalFileName = "images/originals/$id_image.jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

  $original = imagecreatefromjpeg($originalFileName);
  if (!$original) $original = imagecreatefrompng($originalFileName);
  if (!$original) $original = imagecreatefromgif($originalFileName);

  if (!$original) die();

  header('Location: /../pages/restaurant.php');
?>
