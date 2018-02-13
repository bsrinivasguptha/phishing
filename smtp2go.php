<?php
// Imports
require_once "Mail.php";
require_once "Mail/mime.php";
require_once "db.php";
require_once "config.php";

$sql = "SELECT * FROM reports WHERE mailsent='0'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    	$user_id = $row["id"];
    	$user_email = $row["target-email"];
		$track_user = '?user-id='.$user_id;

		//------------------------------------ Content ----------------------------------------------
		$subject = "Hi!";
		$text = "Hi, It is a text message";
		$html = "
		<html>
			<body>
				<h1>Cool</h1>
				<a href='http://waalpix.com/".$track_user."'>Click Here</a>
			</body>
		</html>
		";
		$mime = new Mail_mime();
		$mime->setHTMLBody($html);
		$mime->setTXTBody($text);
		$body = $mime->get();
		//------------------------------------ Content ----------------------------------------------



    	if($user_email != "target-email"){
			$headers = array ('From' => $from,
			'To' => $user_email,
			'Subject' => $subject);
			$headers = $mime->headers($headers);
			$smtp = Mail::factory('smtp',
			array ('host' => $host,
			'port' => $port,
			'auth' => true,
			'username' => $username,
			'password' => $password));

			$mail = $smtp->send($user_email, $headers, $body);

			if (PEAR::isError($mail)) {
			echo("
			" . $mail->getMessage() . "

			");
			} else {
				mysqli_query($conn, "UPDATE reports SET mailsent='1' WHERE id='$user_id' LIMIT 1");
				echo("
				Message successfully sent! to <b>".$user_email."</b>
				<br>
				");
			}
	    	sleep(1);
    	}else{
    		mysqli_query($conn, "DELETE FROM reports WHERE id='$user_id' LIMIT 1");
    	}
    }
}
mysqli_close($conn);
?>