<?php
if (!empty($_SESSION['id'])) {
	header('Location:index.php?page=home');
}

if(isset($_POST['login'], $_POST['password'])){
	$login=$_POST['login'];
	$password=$_POST['password'];
	$salt=$arrayIni['password_salt'];
	$password=sha1($password.$salt);
	if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$login)){
		$login_word = 'email adress';
		$query='SELECT id,username,password,email,admin,blocked FROM users WHERE email=:login;';

	}else{
		$login_word = 'username';
		$query='SELECT id,username,password,email,admin,blocked FROM users WHERE username=:login;';
		
	}
	$prep=$db->prepare($query);
	$prep->bindValue(':login',$login,PDO::PARAM_INT);
	$prep->execute();
	$count=$prep->rowCount();
	$arrayUserInfo=$prep->fetchAll();
	$prep->closeCursor();
	$prep=NULL;
	if ($count == 1 and $arrayUserInfo[0]['password'] == $password) {
		//echo "hello ".$arrayUserInfo[0]['username']."<br>";
		$id=$_SESSION['id']=$arrayUserInfo[0]['id'];
		$username=$_SESSION['username']=$arrayUserInfo[0]['username'];
		$email=$_SESSION['email']=$arrayUserInfo[0]['email'];
		$admin=$_SESSION['admin']=$arrayUserInfo[0]['admin'];
		$blocked=$_SESSION['blocked']=$arrayUserInfo[0]['blocked'];
		header('Location: index.php?page=home');
	}else{
		$message="The $login_word or password you entered is incorrect";
	}
}
?>
