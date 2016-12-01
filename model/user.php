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

//get user info
$query='SELECT id, username, email, admin, blocked FROM users WHERE id = :id;';
$prep=$db->prepare($query);
$prep->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$prep->execute();
$results = $prep->fetch();

//if a superadmin, redirect
if ($results['admin'] == 2) {
    header('Location:index.php?page=admin');
}

//if an admin and your are not superadmin, redirect
if ($results['admin'] == 1 && $_SESSION['admin'] == 1) {
    header('Location:index.php?page=admin');
}

//if you: redirect
if ($results['id'] == $_SESSION['id']) {
	header('Location:index.php?page=admin');
}

if ($results['admin'] == 1) {
	$checkedadmin = 'checked';
	$checkeduser = '';
}

if ($results['admin'] == 0) {
	$checkedadmin = '';
	$checkeduser = 'checked';
}

if ($results['blocked'] == 1) {
    $checkedblocked = 'checked';
    $checkedunblocked = '';
}

if ($results['blocked'] == 0) {
    $checkedblocked = '';
    $checkedunblocked = 'checked';
}



if (isset($_POST['update-button'])) {

    if ($_SESSION['admin'] == 2) {
    	if ($_POST['admin'] != $results['admin']) {
    		$req=$db->prepare('UPDATE users SET admin = :admin_number WHERE id = :id;');
    		try{
    			$req->execute(array(
    				'id' => $_GET['id'],
    				'admin_number' => $_POST['admin']
    			));
    			if ($_POST['admin'] == 1) {
    				$adm = 'an admin';
    			}else{
    				$adm = 'a simple user';
    			}
    			$message=$results['username']." is now ".$adm." ";
    			if ($_POST['admin'] == 1) {
    				$checkedadmin = 'checked';
    				$checkeduser = '';
    			}

    			if ($_POST['admin'] == 0) {
    				$checkedadmin = '';
    				$checkeduser = 'checked';
    			}

    		}catch(Exception $e){
    			die('Erreur : ' . $e->getMessage());
    		}
    	}
    }

    if ($_POST['blocked'] != $results['blocked']) {
        $req=$db->prepare('UPDATE users SET blocked = :blocked_number WHERE id = :id;');
        try{
            $req->execute(array(
                'id' => $_GET['id'],
                'blocked_number' => $_POST['blocked']
            ));
            if ($_POST['blocked'] == 1) {
                $bck = 'blocked';
            }else{
                $bck = 'unblocked';
            }

            if (isset($message)) {
                $message = $message.'<br>'.$results['username']." is now ".$bck." ";
            }else{
                $message = $results['username']." is now ".$bck." ";
            }

            if ($_POST['blocked'] == 1) {
                $checkedblocked = 'checked';
                $checkedunblocked = '';
            }

            if ($_POST['blocked'] == 0) {
                $checkedblocked = '';
                $checkedunblocked = 'checked';
            }

        }catch(Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
}