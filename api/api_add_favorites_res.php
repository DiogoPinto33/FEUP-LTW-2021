<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');

  $db = getDatabaseConnection();

  $customer = $session->getId();
  $restaurant_name = $_REQUEST["restaurant"];

  $get_id = $db->prepare('
        SELECT RestaurantId FROM FOOD_COMPANY WHERE name = ?
');

$get_id->execute(array($restaurant_name));
$inter = $get_id->fetch();
$restaurant= $inter['RestaurantId'];

    //add favorite
    $stmt = $db->prepare('
        INSERT INTO FAVORITES_RESTAURANT (CustomerId, RestaurantId) 
        VALUES(:customer, :restaurant)
    ');

    $stmt->bindParam(':customer', $customer);
    $stmt->bindParam(':restaurant', $restaurant);

    // Check if the execution of query is success
    if($stmt->execute()){
        //setting a 'success' session to save our insertion success message.
        $session->addMessage('success', 'Favorite Added!');
    }
    else {
        $session->addMessage('error', 'Something Wrong!');
    }

?>