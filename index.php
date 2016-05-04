<?php
$include_path = '../../karlit-app/';
$pages = array(
	// API
	'api/person/similar'=>'pages/api/person/similar.php',
	'api/group/add'=>'pages/api/group/add.php',
	'api/group/delete'=>'pages/api/group/delete.php',
	'api/group/insert'=>'pages/api/group/insert.php',
	'api/publication/list'=>'pages/api/publication/list.php',
	'api/person/update'=>'pages/api/person/update.php',
	'api/wikidata'=>'pages/api/wikidata.php',
	'api/reddot'=>'pages/api/reddot.php',
	// Authorize
	'activate'=>'pages/auth/activate.php',
	'register'=>'pages/auth/register.php',
	'login'=>'pages/auth/login.php',
	'logout'=>'pages/auth/logout.php',
	'password'=>'pages/auth/forgot-pass.php',
	// Start
	'dashboard'=>'pages/dashboard.php',
	''=>'pages/dashboard.php',
	// Persons
	'person'=>'pages/person/list.php',
	'person/by-name'=>'pages/person/list.php',
	'person/by-department'=>'pages/person/by-department.php',
	// Publications
	'publication'=>'pages/publication/list.php',
	'publication/new'=>'pages/publication/new/index.php',
	'publication/new/form'=>'pages/publication/new/form.php',
	// Publisher
	'publisher'=>'pages/publisher/list.php',
	// Qualitätssicherung
	'qa/404stats'=>'pages/qa/404stats.php',
	'qa/duplicate-persons'=>'pages/qa/duplicates.php',
	'qa/erroneous-pubs'=>'pages/qa/erroneous-pubs.php',
	'qa/still-in-press'=>'pages/qa/in-press.php',
	// Listen
	'lists/ifgg'=>'pages/lists/ifgg.php',
	'lists/vegetation'=>'pages/lists/vegetation.php',
	'lists/gesellschaft'=>'pages/lists/gesellschaft.php',
	'lists/schmidtlein'=>'pages/lists/schmidtlein.php',
	// Dokumentation
	'doc/scripts'=>'pages/doc/scripts.php',
	'doc/tutorial'=>'pages/doc/tutorial.php',
	'doc/wiki'=>'pages/doc/wiki.php',
	'doc/wiki/edit'=>'pages/doc/wiki/edit.php',
	'doc/wiki/versions'=>'pages/doc/wiki/versions.php',
);
define('CURRENT_PATH', trim(isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'', '/'));

require_once $include_path.'src/include/init.php';

$matches = 0;
if (preg_match('#^publisher/([0-9]+)$#', CURRENT_PATH, $matches) && file_exists($include_path.'pages/publisher/properties.php')) {
	define('PUBLISHER_ID', intval($matches[1]));
	require_once $include_path.'pages/publisher/properties.php';
} else if (preg_match('#^person/([0-9]+)$#', CURRENT_PATH, $matches) && file_exists($include_path.'pages/person/properties.php')) {
	define('PERSON_ID', intval($matches[1]));
	require_once $include_path.'pages/person/properties.php';
} else if (preg_match('#^person/([0-9]+)/publications$#', CURRENT_PATH, $matches) && file_exists($include_path.'pages/person/publications.php')) {
	define('PERSON_ID', intval($matches[1]));
	require_once $include_path.'pages/person/publications.php';
} else if (preg_match('#^publication/([0-9]+)$#', CURRENT_PATH, $matches) && file_exists($include_path.'pages/publication/properties.php')) {
	define('PUBLICATION_ID', intval($matches[1]));
	require_once $include_path.'pages/publication/properties.php';
} else if (preg_match('#^publication/([0-9]+)/edit$#', CURRENT_PATH, $matches) && file_exists($include_path.'pages/publication/edit.php')) {
	define('PUBLICATION_ID', intval($matches[1]));
	require_once $include_path.'pages/publication/edit.php';
} else if (preg_match('#^reddot/([0-9a-fA-F]{32})$#', CURRENT_PATH, $matches) && file_exists($include_path.'pages/reddot/select.php')) {
	define('REDDOT_GUID', $matches[1]);
	require_once $include_path.'pages/reddot/select.php';
} else if (preg_match('#^reddot/([0-9a-fA-F]{32})/(person|dptm)/([1-9]+[0-9]*)$#', CURRENT_PATH, $matches) && file_exists($include_path.'pages/reddot/associate.php')) {
	define('REDDOT_GUID', $matches[1]);
	define(($matches[2]==='person'?'PERSON_ID':'DPTM_ID'), intval($matches[3]));
	require_once $include_path.'pages/reddot/associate.php';
} else if (isset($pages[CURRENT_PATH]) && file_exists($include_path.$pages[CURRENT_PATH])) {
	require_once $include_path.$pages[CURRENT_PATH];
} else {
	require_once $include_path.'pages/error/404.php';
}
?>
