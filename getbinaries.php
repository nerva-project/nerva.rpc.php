<?php 
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

//todo: pull from external source
define('CLI_VERSION', "v0.1.3.6");
define('CLI_CODENAME', 'Pewee');
define('GUI_VERSION', 'v0.0.2.0');
define('GUI_CODENAME', 'Beta-1');
define('UBUNTU_LINKS', array('16.04', '17.10', '18.04'));
define('FEDORA_LINKS', array('26', '27', '28'));
define('DEBIAN_LINKS', array('stable', 'testing', 'unstable'));
define('ANDROID_LINKS', array('armv7', 'arm64v8a'));

$x = new stdClass();
$x->cli_version = CLI_VERSION . ": " . CLI_CODENAME;
$x->gui_version = GUI_VERSION . ": " . GUI_CODENAME;
$x->binary_url = "https://getnerva.org/content/";
$x->windows = "nerva-" . CLI_VERSION . "_windows-x64.zip";
$x->linux = "nerva-" . CLI_VERSION . "_linux-x64.zip";
$x->gui = "nerva-gui-" . GUI_VERSION . ".zip";

$ubuntu = array();
$fedora = array();
$debian = array();
$android = array();

foreach(UBUNTU_LINKS as $y)
    $ubuntu[$y] = "nerva-" . CLI_VERSION . "_ubuntu-" . $y . ".zip";
    
foreach(FEDORA_LINKS as $y)
    $fedora[$y] = "nerva-" . CLI_VERSION . "_fedora-" . $y . ".zip";
    
foreach(DEBIAN_LINKS as $y)
    $debian[$y] = "nerva-" . CLI_VERSION . "_debian-" . $y . ".zip";

foreach(ANDROID_LINKS as $y)
    $android[$y] = "nerva-" . CLI_VERSION . "_android-" . $y . ".zip";

$x->ubuntu = $ubuntu;
$x->fedora = $fedora;
$x->debian = $debian;
$x->android = $android;
$x->bootstrap = array_slice(scandir("./content/bootstrap/"), 2);

echo json_encode($x, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
