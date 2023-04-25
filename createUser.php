<?php include "../inc/dbinfo.inc"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration</title>
	<style>
		body {
			background-color: #F2F2F2;
		}
		h2 {
			text-align: center;
		}
		form {
			background-color: white;
			border: 2px solid #F2F2F2;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			margin: 50px auto;
			padding: 20px;
			max-width: 400px;
			width: 100%;
		}
		table {
			margin-top: 20px;
			margin-bottom: 20px;
			width: 100%;
			border-collapse: collapse;
		}
		td {
			padding: 10px;
			text-align: right;
			vertical-align: middle;
			border-bottom: 1px solid #ddd;
		}
		input[type="text"],
		input[type="password"] {
			border: 1px solid #CCCCCC;
			border-radius: 5px;
			font-size: 16px;
			height: 30px;
			padding: 5px;
			width: 100%;
		}
		input[type="submit"] {
			background-color: #3e8e41;
			border: none;
			border-radius: 5px;
			color: white;
			cursor: pointer;
			font-size: 16px;
			height: 40px;
			margin-top: 10px;
			width: 100%;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
		button {
			background-color: #4CAF50;
			color: white;
			border: none;
			cursor: pointer;
			padding: 10px;
			border-radius: 5px;
			margin-right: 5px;
		}
		button:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<h2>Enter New User Information</h2>
	<!-- Input form -->
	<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
		<table>
			<tr>
				<td><label for="username">Username:</label></td>
				<td><input type="text" name="username" id="username"></td>
			</tr>
			<tr>
				<td><label for="password">Password:</label></td>
				<td><input type="password" name="password" id="password"></td>
			</tr>
			<tr>
				<td><label for="password">Re-type Password:</label></td>
				<td><input type="password" name="repassword" id="repassword"></td>
			</tr>
			<tr>
				<td><label for="fullname">Full Name:</label></td>
				<td><input type="text" name="fullname" id="fullname"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Create"></td>
			</tr>
		</table>

			<p style="text-align:right">Back to Log In? <a href="https://ec2-54-82-112-252.compute-1.amazonaws.com/login.php">Click Here</a></p>
	</form>

    <?php
      /* Connect to MySQL and select the database. */
      $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

      if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

      $database = mysqli_select_db($connection, DB_DATABASE);

      $username = htmlentities($_POST['username']);
      $password = htmlentities($_POST['password']);
      $repassword = htmlentities($_POST['repassword']);
      $fullname = htmlentities($_POST['fullname']);

      if(strlen($username) && strlen($password) && strlen($repassword) && strlen($fullname)) {
        if (strcmp($password,$repassword)===0) {
          $us = mysqli_real_escape_string($connection, $username);
          $pa = mysqli_real_escape_string($connection, $password);
          $re = mysqli_real_escape_string($connection, $repassword);
          $fu = mysqli_real_escape_string($connection, $fullname);
          $query = "INSERT INTO user_details (username,password,full_name) VALUES ('$us', '$pa','$fu');";
          mysqli_query($connection,$query);
          header("Location: login.php");
        } else {
	  echo "<script>alert('Your password does not match! Please try it again!');</script>";
        }
      }
    ?>


  <!-- Clean up. -->
  <?php
    mysqli_free_result($result);
    mysqli_close($connection);
  ?>
  </body>
</html>
                                                                                    
