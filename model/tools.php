<?php
if (empty($_SESSION['id'])) {
	header('Location:index.php?page=login');
}
if ($_SESSION['blocked'] == 1) {
	header('Location:index.php?page=blocked');
}
//tools
$listTools='';
foreach ($arrayIni['name'] as $key => $value) {

	if ($arrayIni['admin'][$key] > $_SESSION['admin']) {
		continue;
	}

	$nametool=$value;
	$icontool=$arrayIni['icon'][$key];
	$urltool=$arrayIni['url'][$key];
	$listTools=$listTools."\n".'<a href="'.$url.$urltool.'" target="_blank" class="list-group-item"><img src="icon/'.$icontool.'" alt="" style="width:16px;height:16px;"> '.$nametool.$startbutton.'</a>';
}