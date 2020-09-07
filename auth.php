<?php
require 'global.inc.php';

use Ehesp\SteamLogin\SteamLogin;

$login = new SteamLogin();

if (isset($input->g['validate'])) {
  $apiKey = $config['steam']['api_key'];

  try {
    $steamId = $login->validate();

    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . $apiKey .'&steamids=' . $steamId);
    
    if ($response->getStatusCode() == 200) {
      $data = json_decode($response->getBody(), true);

      if ($user->userExists($steamId)) {
        $token = $user->doLogin($data);
      } else {
        $token = $user->doRegister($data);
      }

      // Save user avatar
      $avatar = fopen(ROOTPATH . 'data/avatar/' . $steamId . '.jpg', 'w');
      $client->get($data['response']['players'][0]['avatarfull'], ['save_to' => $avatar]);

      $_SESSION['user_token'] = $token;

      header('Location: /MyServers');
      exit;
    }
  } catch (\Exception $e) {
    header('Location: /logout');
    exit;
  }

} else {
  if (!$csrf->get($input->p['csrfToken'])) {
    header('Location: /');
    exit;
  }
  header('Location: '. $login->url($site->siteURL() . '/auth.php?validate'));
  exit;
}
