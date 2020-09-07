<?php

class CSRFManager {

  public function __construct() {

    if (!isset($_SESSION['security']['csrf'])) {
      $_SESSION['security']['csrf'] = [];
    }

    $this->deleteExpiredTokens();

  }

  public function set(int $time = 60 * 30) {
    $key = hash('sha256', mt_rand() . rand() . time());
    $value = time() + $time;

    $_SESSION['security']['csrf'][$key] = $value;

    return $key;
  }

  public function get($token) {
    $isset = isset($_SESSION['security']['csrf'][$token]);
    if ($isset) {
      $this->delete($token);
    }
    return $isset;
  }

  public function delete(string $token) {
    unset($_SESSION['security']['csrf'][$token]);
  }

  public function deleteExpiredTokens() {
    foreach ($_SESSION['security']['csrf'] as $token => $time) {
      if (time() >= $time) {
        unset($_SESSION['security']['csrf'][$token]);
      }
    }

    if (count($_SESSION['security']['csrf']) > 5) {
      array_shift($_SESSION['security']['csrf']);
    }
  }

}
