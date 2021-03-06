<?php 
$title = 'Login';
$menutype = NULL;
include_once("includes/core.php");
include("functions/encryption.php");
if (isset($_GET['timeout'])){
	array_push($errors, 'You were logged out automatically for being inactive.');
}
if (isset($_SESSION['logged_in'])) {
	header('Location: index.php');
} else {
if (isset($_POST['username']) && (isset($_POST['password']))) {
		$username = trim($_POST['username']);
		$password = encrypt(trim($_POST['password']));
		$query = "SELECT * FROM users WHERE username = :username AND password = :password";
		$query_params = array(
         ':username' => $username,
         ':password' => $password
      	);
		$db->DoQuery($query, $query_params);
		$num = $db->fetch();
		if ($num) {
			if ($num['activated'] == 1) {
				if ($num['banned'] == 0) {
					$user_id = $num['id'];
					$forename = $num['forename'];
					$surname = $num['surname'];
					// //user entered correct details
					setcookie('userdata[loggedin]', TRUE, $timeout, '', '', '', TRUE);
					setcookie('userdata[user_id]', $user_id, $timeout, '', '', '', TRUE);
					setcookie('userdata[forename]', $forename, $timeout, '', '', '', TRUE);
					setcookie('userdata[surname]', $surname, $timeout, '', '', '', TRUE);
					header('Location: welcome.php');
					exit();
				} 
				else {
				array_push($errors, "You have been banned.");
				}
			}
			else {
				array_push($errors, "You didn't activate your account!");
			}
		} else {
			array_push($errors, 'The username and password combination is not recognised, try again!');
		}					
}
include('includes/header.php');
?>

<div id="left">
	<h1>New here?</h1>
	<p>You'll need an account to book an appointment. Registration will open in a new window. You can come when you have registered!</p>
	<a href="register.php"><button type="register">Register</button></a>
</div>
	
<div id="right">
	<h1>Have an account?</h1>
	
	<form action="login.php" method="post" autocomplete="off">
		<input type="text" name="username" placeholder="Username" /><br>
		<input type="password" name="password" placeholder="Password" /><br>
		<input type="submit" value="Login" id="submit"/>
		<a href="forgot.php" class="login-link">Forgot your password?</a>
	</form>
</div>

</div>
<?php
}
?>