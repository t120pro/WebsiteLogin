<!DOCTYPE>
<html>
<head>
	<title>Login Results</title>
</head>
<body>

	<?php
		session_start();	//only prints if username and password were entered correctly
		if (isset($_SESSION['success']) && $_SESSION['success'] == TRUE) {
		 echo "<h1>Congratulations, you are now in the web-site</h1>";
		 }
	?>

</body>
</html>