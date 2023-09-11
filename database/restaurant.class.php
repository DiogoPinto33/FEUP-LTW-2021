<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $id;
    public string $name;
    public string $address;
    public int $phone;
    public string $information;
    public int $owner;

    public function __construct(int $id, string $name, string $address, int $phone, string $information, int $owner)
    { 
      $this->id = $id;
      $this->name = $name;
      $this->address = $address;
      $this->phone = $phone;
      $this->information = $information;
      $this->owner = $owner;
    }

    static function getRestaurants(PDO $db, int $count) : array {
      $stmt = $db->prepare('SELECT RestaurantId, name, address, phone, information, owner FROM FOOD_COMPANY');
      $stmt->execute();
  
      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          $restaurant['RestaurantId'],
          $restaurant['name'],
          $restaurant['address'],
          $restaurant['phone'],
          $restaurant['information'],
          $restaurant['owner']
        );
      }
  
      return $restaurants;
    }

    static function getRestaurantsByFavorite(PDO $db, int $customer) {
      $stmt = $db->prepare('SELECT FOOD_COMPANY.RestaurantId, name, address, phone, information, owner 
      FROM FOOD_COMPANY
      JOIN FAVORITES_RESTAURANT
      ON FAVORITES_RESTAURANT.RestaurantId = FOOD_COMPANY.RestaurantId
      WHERE FAVORITES_RESTAURANT.CustomerId = ?');
      $stmt->execute(array($customer));
  
      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          $restaurant['RestaurantId'],
          $restaurant['name'],
          $restaurant['address'],
          $restaurant['phone'],
          $restaurant['information'],
          $restaurant['owner']
        );
      }
  
      return $restaurants;
    }

    static function searchRestaurants(PDO $db, string $search, int $count) : array {
      $stmt = $db->prepare('SELECT RestaurantId, name, address, phone, information, owner FROM FOOD_COMPANY WHERE name LIKE ? LIMIT ?');
      $stmt->execute(array($search . '%', $count));
  
      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
            $restaurant['RestaurantId'],
            $restaurant['name'],
            $restaurant['address'],
            $restaurant['phone'],
            $restaurant['information'],
            $restaurant['owner']
        );
      }
  
      return $restaurants;
    }


    static function getRestaurant(PDO $db, int $id) : Restaurant {
      $stmt = $db->prepare('SELECT RestaurantId, name, address, phone, information, owner FROM FOOD_COMPANY WHERE RestaurantId = ?');
      $stmt->execute(array($id));
  
      $restaurant = $stmt->fetch();
  
      return new Restaurant(
        $restaurant['RestaurantId'],
        $restaurant['name'],
        $restaurant['address'],
        $restaurant['phone'],
        $restaurant['information'],
        $restaurant['owner']
      );
    }  

    static function getRestaurantsByOwner(PDO $db, int $owner, int $count) : array {
      $stmt = $db->prepare('SELECT RestaurantId, name, address, phone, information, owner FROM FOOD_COMPANY WHERE owner = ? LIMIT ?');
      $stmt->execute(array($owner, $count));
  
      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          $restaurant['RestaurantId'],
          $restaurant['name'],
          $restaurant['address'],
          $restaurant['phone'],
          $restaurant['information'],
          $restaurant['owner']
        );
      }
  
      return $restaurants;
    } 
  }
?>