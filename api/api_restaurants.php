<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');

  $db = getDatabaseConnection();

  $restaurants = Restaurant::searchRestaurants($db, $_GET['search'], 9);

  //drawRestaurants($restaurants);

  echo json_encode($restaurants);
?>