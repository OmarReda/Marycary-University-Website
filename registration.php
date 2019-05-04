<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'registrations');

	// REGISTER USER
	if (isset($_POST['Signup'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }

		// register user if there are no errors in the form
		if (count($errors) == 0) {			
			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO student (username, email, password) 
					  VALUES('$username', '$email', '$password')";// btw this
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: ChooseDepartment.php');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['Login'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);
			
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				if ($row = $results->fetch_assoc()){
					$_SESSION['dept'] = $row['dept_ID'];
				}
				header('location: ChooseDepartment.php');
			}else {
				array_push($errors, "Wrong username/password combination");
				$message = "Wrong username/password combination";
				echo "<script type='text/javascript'>alert('$message');</script>";
				//header('location: login.html');
			}
		}
	}

?>
