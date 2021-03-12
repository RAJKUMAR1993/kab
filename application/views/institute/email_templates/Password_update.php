<html>
<body>Your password has been updated, please login with below details. <br>
	<small>User ID : <?php echo $user_email; ?></small><br> 
	<small>Password : <?php echo $this->institute_login_model->api_key_crypt($password,"d")?></small>
</body>
</html>