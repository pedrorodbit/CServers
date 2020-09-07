<?php
$page = [
  'name' => 'Server',
  'id' => 'server'
];

require 'global.inc.php';

if (!isset($_SESSION['user_token'])) {
  header('Location: /');
  exit;
}

$IdCrypto = $input->g['id'] ?? null;
$id = $crypto->decrypt($IdCrypto);

if (isset($input->p)) {
  $console = $input->p['console'] ?? null;
  $changeMap = $input->p['changeMap'] ?? null;
  $changeMode = $input->p['changeMode'] ?? null;

  if (isset($changeMode, $changeMap)) {
    if ($changeMode == 'competitive') {
      $gm = 'game_type 0; game_mode 1; exec gamemode_competitive';
    } elseif ($changeMode == 'deathmatch') {
      $gm = 'game_type 1; game_mode 2; exec gamemode_deathmatch';
    } elseif ($changeMode == 'arms_race') {
      $gm = 'game_type 1; game_mode 0; exec gamemode_armsrace';
    } elseif ($changeMode == 'wingman') {
      $gm = 'game_type 0; game_mode 2; exec gamemode_competitive';
    }

    $cmd = $gm . ';' . 'map ' . $changeMap;
  }

  if (isset($input->p['retakes_enable'])) {
    $cmd = 'sm_retakes_enabled 1';
  } elseif (isset($input->p['retakes_disable'])) {
    $cmd = 'sm_retakes_enabled 0';
  }

  if (isset($input->p['pause_enable'])) {
    $cmd = 'mp_pause_match';
  } elseif (isset($input->p['pause_disable'])) {
    $cmd = 'mp_unpause_match';
  }

  if (isset($input->p['warmup_start'])) {
    $cmd = 'mp_warmup_start; mp_warmup_pausetimer 1';
  } elseif (isset($input->p['warmup_end'])) {
    $cmd = 'mp_warmup_end';
  }

  if (isset($input->p['bot_add'])) {
    $cmd = 'bot_add';
  } elseif (isset($input->p['bot_kick'])) {
    $cmd = 'bot_kick';
  }

  if (isset($input->p['cheats_enable'])) {
    $cmd = 'sv_cheats 1';
  } elseif (isset($input->p['cheats_disable'])) {
    $cmd = 'sv_cheats 0';
  }

  if (isset($console)) {
    $cmd = $console;
  }
}

$serverData = $user->getServerData($id);

$s = $server->connect($serverData['ip'], $serverData['port'], $serverData['rcon_pass']);

if ($s) {
  if (isset($cmd)) {
    $s->Rcon($cmd);
  }

  $template->assign('serverInfo', $s->GetInfo());
  $template->assign('players', $s->GetPlayers());
}

$template->assign('serverData', $serverData);

$template->assign('success', $success ?? null);
$template->assign('error', $error ?? null);

$template->display('page_viewServer.tpl');
