<?php
if (empty($_SESSION['id'])) {
	header('Location:index.php?page=login');
}
if ($_SESSION['blocked'] == 1) {
	header('Location:index.php?page=blocked');
}

require_once('Disk.php');
require_once('WelcomeMessage.php');

//welcome message
$welcomeMessage=new welcomeMessage();

//disk space
foreach ($arrayIni['disk'] as $key => $value) {
	$newDisk=new Disk($value);
	if ($newDisk->exist()) {
		$diskStatus='<p><b>'.$value.'</b> : '.$newDisk->getPfull().'% Full - <font class="text-danger">'.$newDisk->getBusy().' used</font> - <font class="text-success">'.$newDisk->getAvailable().' available</font></p>';
		$diskBar='<div class="progress"><div class="progress-bar progress-bar-'.$newDisk->getColor().'" style="width: '.$newDisk->getPfull().'%"></div></div>';
		$bar=$bar."\n".$diskStatus.$diskBar;
	}
}

//quote
$quote=shell_exec('/usr/games/fortune -a -s');





