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

$stmt = $db->prepare('
    DELETE FROM FAVORITES_RESTAURANT 
    WHERE CustomerId = ? AND RestaurantId = ?
');

// Check if the execution of query is success
if($stmt->execute(array($customer, $restaurant))){
    //setting a 'success' session to save our insertion success message.
    $session->addMessage('success', 'Favorite Eliminated!');
}
else {
    $session->addMessage('error', 'Something Wrong!');
}

?>