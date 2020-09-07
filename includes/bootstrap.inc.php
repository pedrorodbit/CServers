<?php
if (session_status() === PHP_SESSION_NONE) {
  session_name('cservers');
  session_start();
}

error_reporting(-1);

define('ROOTPATH', dirname(dirname(__FILE__)) . '/');

date_default_timezone_set('UTC');

require ROOTPATH . 'includes/config.inc.php';
require ROOTPATH . 'includes/classes/databaseManager.class.php';
require ROOTPATH . 'includes/classes/csrfManager.class.php';
require ROOTPATH . 'includes/classes/inputManager.class.php';
require ROOTPATH . 'includes/classes/cryptoManager.class.php';
require ROOTPATH . 'includes/classes/siteManager.class.php';
require ROOTPATH . 'includes/classes/userManager.class.php';
require ROOTPATH . 'includes/classes/serverManager.class.php';
require ROOTPATH . 'includes/plugins/vendor/autoload.php';
require ROOTPATH . 'includes/plugins/template.inc.php';

$db = new databaseManager($config['database']);
$input = new inputManager;
$crypto = new cryptoManager;
$csrf = new CSRFManager($input);
$site = new siteManager($db);
$user = new userManager($db, $site);
$server = new serverManager($db);

use xPaw\SourceQuery\SourceQuery;
$query = new SourceQuery();
