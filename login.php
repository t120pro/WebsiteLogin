<!DOCTYPE>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style>
		#red {color: red;
			font-weight: bold;}
	</style>
</head>
<body>

	<?php 
	session_start();
	
	if(isset($_POST['submit'])) {
		$usernames = array("PP3918", "PP91008", "PP2011", "PP5402", "PP9981");	//list of valid usernames and passwords
		$passwords = array("hwIm1Prog", "ifnelseSrX", "cBtisTg2882", "cSisr49Elw", "pHhtcs3bLe");

		function doesUserExist($username, $usernames){	//checks if username is valid
			$index = 0;
			
			foreach ($usernames as $user){
				if($user == $username){
					return $index;
				}
				$index++;
			}
			return -1;
		}

		function isPasswordCorrect($password, $passwords, $index){	//based on username, checks if the password matches
			$passwordCorrect = FALSE;
			if($password == $passwords[$index]){
				$passwordCorrect = TRUE;
			}
			return $passwordCorrect;
		}

		if($_SESSION['numLogin'] == 1) {
			$_SESSION['numLogin']--;
		}
		else { //if there remains additional login attempts

			$password = $_POST['password'];
			$username = $_POST['username'];

			$index = doesUserExist($username, $usernames);
			if (($index > -1) and (isPasswordCorrect($password, $passwords, $index))){	//if password and username match sends to the login_results website
				$_SESSION['success']= TRUE; 
				header('location: login_results.php');
                die;
			}
			else{
				$_SESSION['numLogin']--;
				if($index > -1){	//if username is valid but password is false
					echo "<p id='red'>* The password entered is not valid. Please Try Again. You have " . $_SESSION['numLogin'] . " more attempts left. *</p>";
				}
				else {	//if username doesn't exist					
					echo "<p id='red'>* $username is not a valid username. Please Try Again. You have " . $_SESSION['numLogin'] ." more attempts left. *</p>";
				}
			}
		}
	}
	else{
		if(!isset($_SESSION['numLogin'])){	//first time customer
		$_SESSION['numLogin']= 3;		//numLogin cookie indicated amount of login attempts left, starts at 3
		$_SESSION['success']= FALSE;	//success cookie indicates if user entered correct password
		}
	}
	if ($_SESSION['numLogin'] > 0) {	//prints out the form login attempts not used up
	?>
		<h2>Please Login:</h2>
		<form  name="login" action="login.php" method="post">
			User Name: <input type="text" name="username"><br/><br/>
			Password: <input type="password" name="password"><br/><br/>
			<input type="submit" name="submit" value="Login">
		</form>

		<?php
	} else {	//if login attempts used up
		echo "<h4>Sorry, you may not enter our website.<h4>";
	}
		?>
</body>
</html>