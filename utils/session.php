<?php
  class Session {
    private array $messages;

    public function __construct() {
      session_start();

      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['id']);    
    }

    public function logout() {
      session_destroy();
    }

    public function getId() : ?int {
      return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
    }

    public function getRole() : ?int {
      return isset($_SESSION['role']) ? $_SESSION['role'] : null;    
    }

    public function getFName() : ?string {
      return isset($_SESSION['fname']) ? $_SESSION['fname'] : null;
    }

    public function getLName() : ?string {
      return isset($_SESSION['lname']) ? $_SESSION['lname'] : null;
    }
    
    public function getUsername() : ?string {
      return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function getAddress() : ?string {
      return isset($_SESSION['address']) ? $_SESSION['address'] : null;
    }

    public function getPhone() : ?string {
      return isset($_SESSION['phone']) ? $_SESSION['phone'] : null;
    }

    public function setId(int $id) {
      $_SESSION['id'] = $id;
    }

    public function setFName(string $fname) {
      $_SESSION['fname'] = $fname;
    }

    public function setLName(string $lname) {
      $_SESSION['lname'] = $lname;
    }

    public function setUsername(string $username) {
      $_SESSION['username'] = $username;
    }

    public function setAddress(string $address) {
      $_SESSION['address'] = $address;
    }

    public function setPhone(string $phone) {
      $_SESSION['phone'] = $phone;
    }

    public function setRole(int $role) {
      $_SESSION['role'] = $role;
    }

    public function addMessage(string $type, string $text) {
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
      return $this->messages;
    }
  }
?>