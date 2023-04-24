<?php
session_start();
require_once('inc/config/constants.php');
require_once('inc/config/db.php');


$loginUsername = '';
$loginPassword = '';
$hashedPassword = '';
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$loginUsername = $_POST['loginUsername'];
	$loginPassword = $_POST['loginPassword'];
	
	if(!empty($loginUsername) && !empty($loginUsername)){
		
		// Sanitize username
		$loginUsername = filter_var($loginUsername, FILTER_SANITIZE_STRING);
		
		// Check if username is empty
		if($loginUsername == ''){
			echo 'Please enter Username';
			
		}
		
		// Check if password is empty
		if($loginPassword == ''){
			$errors ='Please enter Password';
			
		}
		
		// Encrypt the password
		$hashedPassword = md5($loginPassword);
		
		// Check the given credentials
		$checkUserSql = 'SELECT * FROM user WHERE username = :username AND password = :password';
		$checkUserStatement = $conn->prepare($checkUserSql);
		$checkUserStatement->execute(['username' => $loginUsername, 'password' => $hashedPassword]);
		
		// Check if user exists or not
		if($checkUserStatement->rowCount() > 0){
			// Valid credentials. Hence, start the session
			$row = $checkUserStatement->fetch(PDO::FETCH_ASSOC);

			$_SESSION['loggedIn'] = '1';
			if ($row['usertype'] == 'Admin') {
				$_SESSION['admin_name'] = $row['fullName'];
				
				echo '<script>window.location.href="Admin/index.php"</script>';
				

				}elseif ($row['usertype'] == 'User') {
				$_SESSION['user_name'] = $row['fullName'];
				
				echo '<script>window.location.href="index.php"</script>';
				}else{
					$errors[] = 'incorrect email or password!';
				}
			
			
			$errors [] = 'Login success! Redirecting you to home page...';
			
		} else {
			$errors[] = 'Incorrect Username / Password>';
			
		}
		
		
	} else {
		$errors [] ='Please enter Username and Password</div>';
		
	}
}
require_once('inc/header.html');
?>
  <body>



	<!-- Default Page Content (login form) -->
    <div class="container">
      <div class="row justify-content-center">
		  <div class="col-sm-12 col-md-5 col-lg-5">
		  <img src="mlogo.png" alt="" srcset="" width="50%">
		<div class="card">
		  <div class="card-header">
			Login
		  </div>
		  <div class="card-body">
			<form method="POST">
			<?php if (!empty($errors)): ?>
								<div class="alert alert-danger">
									<?php foreach ($errors as $error): ?>
										<div><?php echo $error ?></div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
			<div id="loginMessage"></div>
			  <div class="form-group">
				<label for="loginUsername">Username</label>
				<input type="text" class="form-control" id="loginUsername" name="loginUsername">
			  </div>
			  <div class="form-group">
				<label for="loginPassword">Password</label>
				<input type="password" class="form-control" id="loginPassword" name="loginPassword">
			  </div>
			  <button type="submit" id="login" class="btn btn-primary">Login</button>
			  
			  <button type="reset" class="btn">Clear</button>
			</form>
		  </div>
		</div>
		</div>
      </div>
    </div>
<?php
	require 'inc/footer.php';
?>
  </body>
</html>
