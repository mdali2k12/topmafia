<?php 
	function SendMail($ToEmail, $FromEmail, $FromName, $SubjectSend, $BodySend,$CC="")
	{
		require_once ("class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->Mailer = "mail";
		$mail->Host = "localhost"; // SMTP server
		$mail->AddAddress($ToEmail);
		$mail->Subject = $SubjectSend;
		$mail->From = $FromEmail;
		$mail->FromName = $FromName;
		$mail->Body = $BodySend;
		$mail->ContentType="text/html";
		$mail->WordWrap = 50;
		$mail->AddCC($CC);
		//$mail->attachment=SITE_DOC ."\\".$attach;

		if(!$mail->Send()) return $mail->ErrorInfo;
		else return "";
	}
?>
