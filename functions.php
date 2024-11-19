<?php
	function email_exists($email, $con)
	{
		$result = mysqli_query($con, "select u_id from tbl_user where u_email = '$email'");
		if(mysqli_num_rows ($result) == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function logged_in()
	{
		if(isset($_SESSION['email']) || isset($_COOKIE['email']))
		{
			return true;

		}
		else
		{
			return false;
		}
	}

	function validate_mobile_no($phone)
	{
		return preg_match('^/01\d{9}', $phone);
	}
?>
