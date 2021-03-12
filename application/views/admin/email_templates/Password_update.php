<html>
<body>Your password has been updated, please login with below details. <br>
	<small>User ID : <?php echo $email; ?></small><br> 
	<small>Password : <?php echo $this->login_model->api_key_crypt($password,"d")?></small>
</body>
</html>