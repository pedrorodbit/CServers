<?php

class userManager {

  function __construct($db, $site) {
    $this->db = $db;
    $this->site = $site;
  }

  public function genToken($steamId) {
    return sha1($steamId . $this->site->genRandomString() . microtime(true));
  }

  public function userExists($steamId) {
    $userExists = $this->db->Query('SELECT `id` FROM `users` WHERE `steam_id` = :steam_id LIMIT 1;');
    $userExists->Bind(':steam_id', $steamId, PDO::PARAM_STR);
    return $userExists->Evaluate(0);
  }

  public function getUserIdByToken($token) {
    $getUserId = $this->db->Query('SELECT `id` FROM `users` WHERE `token` = :token LIMIT 1;');
    $getUserId->Bind(':token', $token, PDO::PARAM_STR);
    return $getUserId->Evaluate(0);
  }

  public function getUserData($token) {
    $getUserData = $this->db->Query('SELECT * FROM `users` WHERE `token` = :token LIMIT 1;');
    $getUserData->Bind(':token', $token, PDO::PARAM_STR);
    return $getUserData->Single(PDO::FETCH_ASSOC);
  }

  public function doLogin(array $data) {
    $token = $this->genToken($data['response']['players'][0]['steamid']);

    $doLogin = $this->db->Query('UPDATE `users` SET `steam_name` = :steam_name, `token` = :token, `country` = :country, `last_login` = :last_login WHERE `steam_id` = :steam_id;');
    $doLogin->Bind(':steam_id', $data['response']['players'][0]['steamid'], PDO::PARAM_STR);
    $doLogin->Bind(':steam_name', $data['response']['players'][0]['personaname'], PDO::PARAM_STR);
    $doLogin->Bind(':token', $token, PDO::PARAM_STR);
    $doLogin->Bind(':country', $data['response']['players'][0]['loccountrycode'], PDO::PARAM_STR);
    $doLogin->Bind(':last_login', time(), PDO::PARAM_INT);
    $doLogin->Execute();

    return $token;
  }

  public function doRegister(array $data) {
    $token = $this->genToken($data['response']['players'][0]['steamid']);

    $doRegister = $this->db->Query('INSERT INTO `users` (steam_id, steam_name, token, country, last_login, timestamp) VALUES (:steam_id, :steam_name, :token, :country, :last_login, :timestamp);');
    $doRegister->Bind(':steam_id', $data['response']['players'][0]['steamid'], PDO::PARAM_STR);
    $doRegister->Bind(':steam_name', $data['response']['players'][0]['personaname'], PDO::PARAM_STR);
    $doRegister->Bind(':token', $token, PDO::PARAM_STR);
    $doRegister->Bind(':country', $data['response']['players'][0]['loccountrycode'] ?? 'XX', PDO::PARAM_STR);
    $doRegister->Bind(':last_login', time(), PDO::PARAM_INT);
    $doRegister->Bind(':timestamp', time(), PDO::PARAM_INT);
    $doRegister->Execute();

    return $token;
  }

  public function getUserServers($userId) {
    $getUserServers = $this->db->Query('SELECT * FROM `servers` WHERE `owner_id` = :owner_id;');
    $getUserServers->Bind(':owner_id', $userId, PDO::PARAM_INT);
    return $getUserServers->resultSet(PDO::FETCH_ASSOC);
  }

  public function getServerData($id) {
    $getServerData = $this->db->Query('SELECT * FROM `servers` WHERE `id` = :id LIMIT 1;');
    $getServerData->Bind(':id', $id, PDO::PARAM_INT);
    return $getServerData->Single(PDO::FETCH_ASSOC);
  }

  public function addServer($ownerId, $name, $ip, $port, $rconPass) {
    $addServer = $this->db->Query('INSERT INTO `servers` (owner_id, name, ip, port, rcon_pass) VALUES (:owner_id, :name, :ip, :port, :rcon_pass);');
    $addServer->Bind(':owner_id', $ownerId, PDO::PARAM_INT);
    $addServer->Bind(':name', $name, PDO::PARAM_STR);
    $addServer->Bind(':ip', $ip, PDO::PARAM_STR);
    $addServer->Bind(':port', $port, PDO::PARAM_INT);
    $addServer->Bind(':rcon_pass', $rconPass, PDO::PARAM_STR);
    $addServer->Execute();
  }

  public function serverExists($ip) {
    $serverExists = $this->db->Query('SELECT `id` FROM `servers` WHERE `ip` = :ip LIMIT 1;');
    $serverExists->Bind(':ip', $ip, PDO::PARAM_STR);
    return $serverExists->Evaluate(0);
  }

}
