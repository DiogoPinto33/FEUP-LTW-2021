<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $username;
    public int $role;
    public string $address;
    public string $city;
    public string $country;
    public string $postalcode;
    public string $phone;
    public string $email;

    public function __construct(int $id, string $firstName, string $lastName, string $username, int $role, string $address, string $city, string $country, string $postalcode, string $phone, string $email)
    {
      $this->id = $id;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->username = $username;
      $this->role = $role;
      $this->address = $address;
      $this->city = $city;
      $this->country = $country;
      $this->postalcode = $postalcode;
      $this->phone = $phone;
      $this->email = $email;
    }

    function name() {
      return $this->firstName . ' ' . $this->lastName;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE USERS SET FirstName = ?, LastName = ?, Address = ?, Phone = ?
        WHERE UserId = ?
      ');

      $stmt->execute(array($this->firstName, $this->lastName, $this->address, $this->phone, $this->id));
    }
    
    /*static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
      $stmt = $db->prepare("SELECT UserId, FirstName, LastName, username, role, Address, City, Country, PostalCode, Phone, Email 
      FROM RESTAURANT.USERS 
      WHERE username=:user;");

      $stmt->bindParam(":user", strtolower($username));
      $stmt->bindParam(":user", sha1($password));

      //$stmt->execute([':name' => 'David', ':id' => $_SESSION['id']]);
      //$stmt->execute(array(strtolower($username), sha1($password)));
      $stmt->execute();
    }*/


    static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
      $stmt = $db->prepare('
      SELECT UserId, FirstName, LastName, username, role, Address, City, Country, PostalCode, Phone, Email, password
      FROM USERS
      WHERE lower(username) = ?
      ');

      $stmt->execute(array(strtolower($username)));
  
      if ($user = $stmt->fetch()) {
        if(password_verify($password, $user['password'])){
          return new User(
            $user['UserId'],
            $user['FirstName'],
            $user['LastName'],
            $user['username'],
            $user['role'],
            $user['Address'],
            $user['City'],
            $user['Country'],
            $user['PostalCode'],
            $user['Phone'],
            $user['Email']
          );
        } else return null;
      } else return null;
    }

    static function getUser(PDO $db, int $id) : User {
      $stmt = $db->prepare('
        SELECT UserId, FirstName, LastName, username, role, Address, City, Country, PostalCode, Phone, Email
        FROM USERS 
        WHERE UserId = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      
      return new User(
        $user['UserId'],
        $user['FirstName'],
        $user['LastName'],
        $user['username'],
        $user['role'],
        $user['Address'],
        $user['City'],
        $user['Country'],
        $user['PostalCode'],
        $user['Phone'],
        $user['Email']
      );
    }

  }
?>