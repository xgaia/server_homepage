<?php
if (empty($_SESSION['id'])) {
	header('Location:index.php?page=login');
}
if ($_SESSION['blocked'] == 0) {
	header('Location:index.php?page=home');
}