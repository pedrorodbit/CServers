<?php
$page = [
  'name' => 'Home',
  'id' => 'home'
];

require 'global.inc.php';

if (isset($_SESSION['user_token'])) {
  header('Location: /MyServers');
  exit;
}

$template->display('page_home.tpl');
