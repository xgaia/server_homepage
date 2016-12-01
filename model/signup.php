    <?php
    if(isset($_POST['username'], $_POST['password'], $_POST['password2'], $_POST['email']) and $_POST['username']!=''){
    	$username=$_POST['username'];
    	$password=$_POST['password'];
    	$password2=$_POST['password2'];
    	$email=$_POST['email'];
    	if ($password == $password2){
    		if (strlen($password)>=8) {
                //check if username is uniq
                $query='SELECT id FROM users WHERE username=:username;';
                $prep=$db->prepare($query);
                $prep->bindValue(':username', $username, PDO::PARAM_INT);
                $prep->execute();
                $count=$prep->rowCount();
                $prep->closeCursor();
                $prep=NULL;
                if($count==0){
        			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$email)){
        				//list($compte,$domaine)=split("@", $email,2);
        				//if (checkdnsrr($domaine,"MX") and checkdnsrr($domaine,"A")) {
                        if(checkdnsrr(array_pop(explode("@",$email)),"MX")){
        					$query='SELECT id FROM users WHERE email=:email;';
        					$prep=$db->prepare($query);
        					$prep->bindValue(':email', $email, PDO::PARAM_INT);
        					$prep->execute();
        					$count=$prep->rowCount();
        					//$arrAll = $prep->fetchAll();
        					//print_r($arrAll);
        					$prep->closeCursor();
        					$prep=NULL;
        					if($count==0){
        							$query='SELECT max(id) FROM users;';
        							$arrayResult=$db->query($query)->fetch();
        							$num=$arrayResult[0];
                                    if ($num == '') {
                                        $num=1;
                                        $admin=2;
                                        $blocked=0;
                                    }else{
        							    $id=$num+1;
                                        $admin=0;
                                        $blocked=1;
                                    }
                                    $salt=$arrayIni['password_salt'];
        							$user_key=random(20);
        							$req=$db->prepare('INSERT INTO users(id, username, password, email, signup_date, admin, blocked, user_key) VALUES(:id, :username, :password, :email, :signup_date, :admin, :blocked, :user_key);');
        							try{$req->execute(array(
        							    'id' => $id,
        							    'username' => $username,
        							    'password' => sha1($password.$salt),
        							    'email' => $email,
        							    'signup_date' => date("Y-m-d H:i:s"),
        							    'admin' => $admin,
        							    'blocked' => $blocked,
        							    'user_key' => $user_key
        							    ));
        							}catch(Exception $e){
        								$form=true;
        								$class='danger';
        								$message="Registration failure";
        								//die('Erreur : ' . $e->getMessage());
        							}
        							$form=false;
        							$class='success';
        							$message="You have been registerd !";
        							//Prevent admin
        							header("Refresh: 3;URL=index.php?page=login");
        					}else{
        						$form=true;
        						$class='danger';
        						$message="This email is already registered";
        					}
        				}else{
        					$form=true;
        					$class='danger';
        					$message="This domain doesn't accept email";
        				}
        			}else{
        				$form=true;
        				$class='danger';
        				$message="This email is not valid";
        			}
                }else{
                    $form=true;
                    $class='danger';
                    $message="This username is already registered";
                }
    		}else{
    			$form=true;
    			$class='danger';
    			$message="The password must be at least 8 characters";
    		}     
    	}else{
    		$form=true;
    		$class='danger';
    		$message="The passwords are not the same";
    	}
    }else{
    	$form=true;
    	$class='danger';
    }


function random($car) {
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy0123456789";
    srand((double)microtime()*1000000);
    for($i=0; $i<$car; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
}
