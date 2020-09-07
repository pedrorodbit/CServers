<?php

class databaseManager {

  private $_Engine;

  public function __construct(array $config) {
    try {
      $this->DatabaseType = $config['type'];
      $this->DatabaseHost = $config['host'];
      $this->DatabasePort = $config['port'];
      $this->DatabaseUser = $config['user'];
      $this->DatabasePass = $config['pass'];
      $this->DatabaseName = $config['name'];
      $this->DatabaseChar = $config['char'];
      $this->Process = null;

      self::Connect();
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  private function Connect() {
    $uri = $this->DatabaseType . ':host=' . $this->DatabaseHost . ';port=' . $this->DatabasePort . ';dbname=' . $this->DatabaseName;

    $options = [
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $this->DatabaseChar
    ];

    $this->_Engine = new PDO($uri, $this->DatabaseUser, $this->DatabasePass, $options);
    $this->_Engine->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function Query($query) {
    $this->Process = $this->_Engine->prepare($query);
    return $this;
  }

  public function Bind($param, $value, $type = null) {
    if (is_null($type)) {
      if (is_int($value)) {
        $type = PDO::PARAM_INT;
      } elseif (is_bool($value)) {
        $type = PDO::PARAM_BOOL;
      } elseif (is_null($value)) {
        $type = PDO::PARAM_NULL;
      } else {
        $type = PDO::PARAM_STR;
      }
    }

    $this->Process->bindValue($param, $value, $type);
  }

  public function Execute() {
    return $this->Process->execute();
  }

  public function Single($type = false) { // PDO::FETCH_ASSOC
    self::Execute();
    return $this->Process->fetch($type);
  }

  public function resultSet($type = false) {
    self::Execute();
    return $this->Process->fetchAll($type);
  }

  public function rowCount() {
    self::Execute();
    return $this->Process->rowCount();
  }

  public function Evaluate($default_value = 'undefined') {
    self::Execute();
    return (self::rowCount() < 1) ? $default_value : $this->Process->fetchColumn();
  }

  public function lastInsertId($param = false) {
    return $this->_Engine->lastInsertId($param);
  }

  private function Disconnect() {
    $this->_Engine = null;
  }

  public function __destruct() {
    self::Disconnect();
  }

}
