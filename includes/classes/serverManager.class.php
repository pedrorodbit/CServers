<?php

use xPaw\SourceQuery\SourceQuery;

class serverManager {

  public function __construct($db) {
    $this->db = $db;
  }

  public function connect($ip, $port, $rconPass) {
    try {
      $query = new SourceQuery();

      $query->Connect($ip, $port, 15);
      $query->SetRconPassword($rconPass);

      return $query;
    } catch (\Exception $e) {
      return false;
    }

  }

  public function testConn($ip, $port, $rconPass) {
    $conn = $this->connect($ip, $port, $rconPass);

    if ($conn) {
      $conn->Rcon('say CS:GO Server Manager TEST');

      return true;
    }

    return false;

  }

}
