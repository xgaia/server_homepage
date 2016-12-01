<?php
if (empty($_SESSION['id'])) {
	header('Location:index.php?page=login');
}
if ($_SESSION['blocked'] == 1) {
	header('Location:index.php?page=blocked');
}
if ($_SESSION['admin'] == 0) {
	header('Location:index.php?page=home');
}
if ($_SESSION['admin'] == 2) {
	$superadmin = true;
}else{
	$superadmin = false;
}

$query='SELECT id, username, email, admin, blocked FROM users ORDER BY id;';
$arrayResult=$db->query($query)->fetchAll();

foreach ($arrayResult as $key => $value) {
	if ($value['blocked'] == 0) {
		$blocked='Lock';
		$color_button='default';
	}else{
		$blocked='Unlock';
		$color_button='primary';
	}
	if ($value['admin'] == 1) {
		$adminGlyph='knight';
		$glyph_color='orange';
	}elseif ($value['admin'] == 0){
		$adminGlyph='pawn';
		$glyph_color='grey';
	}elseif ($value['admin'] == 2){
		$adminGlyph='king';
		$glyph_color='red';
	}
	if ($value['id'] == $_SESSION['id']) {
		$class='class="warning"';
		$you=' (you)';
	}else{
		$class='';
		$you='';
	}

	if ($_SESSION['admin'] == 2) {
		if ($value['id'] == $_SESSION['id']) {
			$class='class="warning"';
			$you=' (you)';
			$unlock = false;
		}else{
			$class='';
			$you='';
			$unlock = true;
		}
	}

	if ($_SESSION['admin'] == 1){
		if ($value['id'] == $_SESSION['id']) {
			$class='class="warning"';
			$you=' (you)';
		}else{
			$class='';
			$you='';
		}
		if ($value['id'] == $_SESSION['id'] || $value['admin'] > 0) {
			$unlock = false;
		}else{
			$unlock = true;
		}
	}

	if ($_SESSION['admin'] == 0){
		$unlock = false;
		if ($value['id'] == $_SESSION['id']) {
			$class='class="warning"';
			$you=' (you)';
		}else{
			$class='';
			$you='';
		}
	}


	$arrayDisplay= array(
		'id' => $value['id'],
		'username' => $value['username'],
		'email' => $value['email'],
		'blocked' => $value['blocked'],
		'admin' => $value['admin'],
		'adminGlyph' => $adminGlyph,
		'glyph_color' => $glyph_color,
		'class' => $class,
		'you' => $you,
		'color_button' => $color_button,
		'unlock' => $unlock
		);
	$arrayFinal[]=$arrayDisplay;
}

if (isset($_POST['shutdown-button'])) {
        shell_exec('sudo shutdown +3');
        $message = 'server will be halted in 3 minutes ! Use shutdown -c to cancel';
        $destination = 'Hypnos';
        $tg = "(echo 'dialog_list';sleep 5;echo 'msg Hypnos Hypnos will be halted in 3 minutes! use shutdown -c to cancel'; echo 'safe_quit') | /tg/bin/telegram-cli";
        $log = shell_exec($tg);
}
