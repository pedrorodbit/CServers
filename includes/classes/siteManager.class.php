<?php

class siteManager {

  public function __construct($db) {
    $this->db = $db;
  }

  public static function genRandomString(int $length = 16) {
    return str_shuffle(substr(str_repeat(hash('md5', mt_rand()), 2 + $length / 32), 0, $length));
  }

  private static function isSSL() {
    if (isset($_SERVER['HTTPS'])) {
      if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') {
        return true;
      }
    }
    if ($_SERVER['SERVER_PORT'] && $_SERVER['SERVER_PORT'] === '443') {
      return true;
    }
    if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
      return true;
    }
    return false;
  }

  public function siteURL() {
    $protocol = $this->isSSL() ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'];
  }

  public function pageGeneratedIn() {
    $scriptStart = $_SERVER['REQUEST_TIME_FLOAT'];
    $scriptEnd = microtime(true);

    $time = $scriptEnd - $scriptStart;

    $executionTime = number_format($time, 4);

    return $executionTime;
  }

}
