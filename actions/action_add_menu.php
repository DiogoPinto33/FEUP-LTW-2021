<?php

  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  //require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  // Setting variables
  $menu_name = $_POST['name_menu'];
  $menu_price = $_POST['price'];
  $menu_info = $_POST['info_menu'];
  $menu_store_res = $_POST['store_menu'];

  $get_id = $db->prepare('
        SELECT RestaurantId FROM FOOD_COMPANY WHERE name = ?
');

$get_id->execute(array($menu_store_res));
$inter = $get_id->fetch();
$menu_store= $inter['RestaurantId'];


  //check empty fields
  if ($menu_name  == '' ||$menu_price  == '' || $menu_store  == '') {
      $session->addMessage('error', 'Campos Vazios!');
      exit();
  }

  //check if unique variables are unique
  $menun = $db->prepare('
    SELECT name FROM MENU WHERE lower(name) = ?
  ');

  $menun->execute(array(strtolower($menu_name)));

  if( $menun->fetch()){
      $session->addMessage('error', 'Restaurante já existe!');
      exit();
  }

  $stmt = $db->prepare('
      INSERT INTO MENU (name, store, cost, information) 
      VALUES(:name, :store, :cost, :information)
  ');

  $stmt->bindParam(':name', $menu_name);
  $stmt->bindParam(':store', $menu_store);
  $stmt->bindParam(':cost', $menu_price);
  $stmt->bindParam(':information', $menu_info);

  // Check if the execution of query is success
  if($stmt->execute()){
      $session->addMessage('success', 'Adicionou Menu!');
      //$_SESSION['success'] = "Successfully created an account";
  }
  else {
      $session->addMessage('error', 'Algo deu errado!');
  }

  $id_menu = $db->lastInsertId();

  //---------------------------------------------

  $stmt_i = $db->prepare("INSERT INTO MENU_IMAGES VALUES(NULL, ?, ?)");
  $stmt_i->execute(array($_POST['title'], $id_menu));

  $id_image = $db->lastInsertId();

  if (!is_dir('images')) mkdir('images');
  if (!is_dir('images/menus')) mkdir('images/menus');

  $originalFileName = "images/menus/$id_image.jpg";

  move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

  $original = imagecreatefromjpeg($originalFileName);
  if (!$original) $original = imagecreatefrompng($originalFileName);
  if (!$original) $original = imagecreatefromgif($originalFileName);

  if (!$original) die();

  header('Location: /../pages/restaurant.php');
?>
