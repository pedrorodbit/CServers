<?php
require 'includes/bootstrap.inc.php';

if (isset($_SESSION['user_token'])) {
  $userData = $user->getUserData($_SESSION['user_token']);
  $template->assign('userData', $userData);

  if (!$userData) {
    header('Location: /logout');
    exit;
  }
}

$template->assign('page', $page ?? null);
$template->assign('csrfToken', $csrf->set());
