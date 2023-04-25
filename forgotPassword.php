<?php include "../inc/dbinfo.inc"; ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Forgot Password</title>
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
	h2 {
		text-align: center;
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
    <h2>Enter information below</h2>
<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table>
    <tr>
      <td>Username:</td>
      <td><input type="text" name="Username"></td>
    </tr>
    <tr>
      <td>Current Password:</td>
      <td><input type="password" name="OldPass"></td>
    </tr>
    <tr>
      <td>New Password:</td>
      <td><input type="password" name="NewPass"></td>
    </tr>
    <tr>
      <td>Re-type Password:</td>
      <td><input type="password" name="reNewPass"></td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" value="Change Password">
      </td>
    </tr>
  </table>

  <p style="text-align:right">Back to Log In? <a href="https://ec2-54-82-112-252.compute-1.amazonaws.com/login.php">Click Here</a></p>
</form> 


    <?php
      /* Connect to MySQL and select the database. */
      $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

      if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

      $database = mysqli_select_db($connection, DB_DATABASE);

      $username = htmlentities($_POST['Username']);
      $oldPass = htmlentities($_POST['OldPass']);
      $newPass = htmlentities($_POST['NewPass']);
      $renewPass = htmlentities($_POST['reNewPass']);

      if(strlen($username) && strlen($newPass) && strlen($oldPass) && strlen($renewPass)) {
        if (strcmp($newPass,$renewPass)===0){
        $us = mysqli_real_escape_string($connection, $username);
        $ol = mysqli_real_escape_string($connection, $oldPass);
        $ne = mysqli_real_escape_string($connection, $newPass);

        if (checkPass($connection, $us, $ol)){
          $query = "UPDATE user_details SET password='$ne' WHERE username = '$us';";
          mysqli_query($connection,$query);
          header("Location: login.php");
        } else {
          echo "<script>alert('Your current password is incorrect! Please try again!');</script>";
        }
        } else {
          echo "<script>alert('Your new password does not match! Please try again!');</script>";
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

    $query = "SELECT password FROM user_details WHERE username='$u';";
    $result = mysqli_query($connection, $query);

    $query_data = mysqli_fetch_row($result);
    if(strcmp($query_data[0],$password)===0) {
      return true;
    } else {
      return false;
    }
  }
?>

