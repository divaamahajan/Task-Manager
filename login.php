<?php include "../inc/dbinfo.inc"; ?>
<html>
<head>
	<meta charset="UTF-8">    
	<title>Login | Tasks Tracker</title>
	<style>
		body {
			background-color: #F2F2F2;
		}
		h1 {
			font-size: 40px;
			font-weight: bold;
			text-align: center;
			margin-top: 50px;
		}
		form {
			background-color: white;
			border: 2px solid #F2F2F2;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			margin: 50px auto;
			padding: 20px;
			width: 400px;
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
		input[type="text"], input[type="password"] {
			border: 1px solid #CCCCCC;
			border-radius: 5px;
			font-size: 16px;
			height: 30px;
			padding: 5px;
			width: 100%;
		}
		button[type="submit"] {
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
		.button-group {
			display: flex;
			justify-content: space-between;
			margin-top: 20px;
		}
		tr:hover {background-color: #f5f5f5;}
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
	<h1 id="welcome">Welcome to Tasks Manager</h1>

	<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
		<table>
			<tr>
				<td><label for="username">Username:</label></td>
				<td><input type="text" id="username" name="username" maxlength="45" size="30" required/></td>
			</tr>
			<tr>
				<td><label for="password">Password:</label></td>
				<td><input type="password" id="password" name="password" maxlength="45" size="30" required/></td>
			</tr>
		</table>
		<button type="submit" name="loginBtn" class="button">Login</button>
	</form>

       	<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
   		<div class="button-group">
			<button type="submit" name="createBtn" class="button">Sign Up</button>
			<button type="submit" name="forgotBtn" class="button">Forgot Password</button>
		</div> 
	</form>


  <!-- Js function here (Not use. For Example Purpose -->
  <script>
    function createUser(){
      window.location.replace("https://ec2-54-82-112-252.compute-1.amazonaws.com/createUser.php");
    }
    function forgotPass(){
      window.location.replace("https://ec2-54-82-112-252.compute-1.amazonaws.com/forgotPassword.php");
    }
  </script>
    <?php 
      /* Connect to MySQL and select the database. */
      $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

      if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

      $database = mysqli_select_db($connection, DB_DATABASE);

      $username = htmlentities($_POST['username']);
      $password = htmlentities($_POST['password']);

      if (!strlen($username)) $username = "a";

      if (isset($_POST['createBtn']))  header("Location: createUser.php");
      if (isset($_POST['forgotBtn']))  header("Location: forgotPassword.php");

      if (strlen($username) && strlen($password)){
        if( checkPass($connection,$username,$password) && isset($_POST['loginBtn'])) {
          setcookie('username', $username, time() + (86400 * 7), "/");
//          header("Location: index.php");
          header("Location: http://ec2-54-82-112-252.compute-1.amazonaws.com/user/$username");
        } else {
//			echo "<div style='text-align: center;'>Password is not correct! Please try again.</div>";
			echo "<script>alert('Password is incorrect! Please try again!');</script>";
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

<?php
  function checkPass($connection, $username, $password) {
    $u = mysqli_real_escape_string($connection, $username);
    $p = mysqli_real_escape_string($connection, $password);
  //  echo "inside checkPass";
    $query = "SELECT password,full_name FROM user_details WHERE username='$u';";

    $result = mysqli_query($connection, $query);

    $query_data = mysqli_fetch_row($result);
    if(strcmp($query_data[0],$password)===0) {
      setcookie('fullname', $query_data[1], time() + (86400 * 7), "/");
      return true;
    } else {
      return false;
    }
  }
?>
