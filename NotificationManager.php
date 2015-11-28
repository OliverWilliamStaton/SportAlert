<?php
	
	$to = 'oliver.william.staton@gmail.com';
	$subject = 'Sport Alert';
	$message = 'Message Goes Here';

	print "Start";

	if( mail ( $to , $subject , $message)) {
		print "Successfully sent email";
	}
	else {
		die("ERROR: unable to send email");
	}

	print "End";

?>