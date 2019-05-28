<?php
	session_start();

	require('helper/api.php');
	if(isset($_SESSION['login'])){
		if($_SESSION['login'] == true){
			header('location: admin/');
		}
	}

	if(isset($_POST['login'])){

		$data_array =  array(
			"email"        => $_POST['email'],
			"password"         => $_POST['password']
	 	);
  		

	  $call_api = callAPI('POST', 'http://127.0.0.1:8000/api/auth/login/', json_encode($data_array));
	  $response = json_decode($call_api, true);
	  
	  //error handle
	  $error = isset($response['error']) ? $response['error'] : "";

	  if(isset($response['data']) AND isset($response['meta'])){

	  		$_SESSION['id']    =  $response['data']['id'];
	  		$_SESSION['name']  = $response['data']['name'];
	  		$_SESSION['email'] = $response['data']['email'];
	  		$_SESSION['token'] = $response['meta']['token'];
	  		$_SESSION['login'] = true;

	  		header('location: admin/index.php');
	  }
	 
	 }

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif; background:#f2f2f2;}
form {border: 3px solid #f1f1f1; background:white;}

.container{
	width:80%;
	margin:20px auto;
}
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 20%;
  border-radius: 50%;
}

.container {
  padding: 14px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.error{
	background: rgba(255,0,0,0.2);
	padding:10px;
	text-align: center;
	color:red;
	font-weight: bold;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

	<div class="container">

		<form action="" method="post">
		  	<?php if(!empty($error)): ?>
		  		<div class="error"><?= $error?></div>
			<?php endif; ?>
		  	<div class="imgcontainer">
		    	<img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
		  	</div>
		  	<div class="container">
		    	<label for="uname"><b>email</b></label>
		    	<input type="text" placeholder="Enter Username" name="email" required>

		    	<label for="psw"><b>password</b></label>
		    	<input type="password" placeholder="Enter Password" name="password" required>
		        
		    	<button type="submit" name="login">Login</button>
		  	</div>		 
		</form>
	</div>

</body>
</html>
