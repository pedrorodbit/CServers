<?php
session_name('cservers');
session_start();

unset($_SESSION['user_token']);

header('Location: /');
exit;
