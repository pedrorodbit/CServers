<?php
$page = [
  'name' => 'My servers',
  'id' => 'myServers'
];

require 'global.inc.php';

if (!isset($_SESSION['user_token'])) {
  header('Location: /');
  exit;
}

if (isset($input->p['addServer'])) {
  $name = $input->p['server_name'] ?? null;
  $ipPort = $input->p['ip_port'] ?? null;
  $rconPass = $input->p['rcon_pass'] ?? null;

  if (!$csrf->get($input->p['csrfToken'])) {
    $error[] = 'An error occurred. Please try again later.';
  }

  if (!isset($name, $ipPort, $rconPass)) {
    $error[] = 'An error occurred. Please try again later.';
  }

  if (empty($name)) {
    $error[] = 'You cannot leave name field empty.';
  }

  if (strlen($name) < 4) {
    $error[] = 'Name too small.';
  }

  if (strlen($name) > 16) {
    $error[] = 'Name too long.';
  }

  $connData = explode(':', $ipPort);

  if (!filter_var($connData[0], FILTER_VALIDATE_IP) || !is_numeric($connData[1])) {
    $error[] = 'Invalid IP + Port.';
  }

  if (empty($rconPass)) {
    $error[] = 'You cannot leave rcon password field empty.';
  }

  if (!$server->testConn($connData[0], $connData[1], $rconPass)) {
    $error[] = 'We were unable to connect to your server.';
  }

  if (!isset($error)) {
    try {
      $user->addServer($userData['id'], $name, $connData[0], $connData[1], $rconPass);

      $success[] = 'Server successfully added!';
    } catch (\Exception $e) {
      $error[] = 'Internal Server Error!';
    }

  }

}

$userServers = $user->getUserServers($userData['id']);
for ($i = 0; $i < count($userServers); $i++) {
  $userServers[$i]['id'] = $crypto->encrypt($userServers[$i]['id']);
}
$template->assign('userServers', $userServers);

$template->assign('success', $success ?? null);
$template->assign('error', $error ?? null);

$template->display('page_serverList.tpl');
