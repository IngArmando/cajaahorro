<?php
require_once('../../modelo/MBrowser.php');
$OBrow = new Browser();
echo $OBrow -> getBrowser()." V".$OBrow ->getVersion();
?>