<?php
  declare(strict_types = 1);

  class Menu {
    public int $id;
    public string $name;
    public int $store;
    public float $cost;
    public string $information; 

    public function __construct(int $id, string $name, int $store, float $cost, string $information)
    {
      $this->id = $id;
      $this->name = $name;
      $this->store = $store;
      $this->cost = $cost;
      $this->information = $information;
    }

    static function getRestaurantMenus(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT MenuId, name, store, cost, information
        FROM MENU
        WHERE store = ?
      ');
      $stmt->execute(array($id));
  
      $menus = array();
  
      while ($menu = $stmt->fetch()) {
        $menus[] = new Menu(
          $menu['MenuId'],
          $menu['name'],
          $menu['store'],
          $menu['cost'],
          $menu['information']
        );
      }
  
      return $menus;
    }

    static function getMenu(PDO $db, int $id) : Album {
      $stmt = $db->prepare('
        SELECT MenuId, name, store, cost, information 
        FROM MENU 
        WHERE MenuId = ?
        GROUP BY MenuId
      ');
      $stmt->execute(array($id));
  
      $menu = $stmt->fetch();
  
      return new Menu(
        $menu['MenuId'],
        $menu['name'],
        $menu['store'],
        $menu['cost'],
        $menu['information']
      );
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE MENU SET name = ?
        WHERE MenuId = ?
      ');

      $stmt->execute(array($this->name, $this->id));
    }
  
  }
?>