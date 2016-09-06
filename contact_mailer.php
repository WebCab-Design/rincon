<?php
	//Check form is alive :D
	if(isset($_POST['contact_first_name'])) {

		//Edit as required
		$email_to = "
			jburns@webcabdesign.com
		";
		$email_subject = "New Contact Form submission from Rincon Recovery home page contact form";
		$email_from = "NoReply@rinconrecoveryaz.com";

		//Check if vaidated feilds exist
		if(

			!isset($_POST['contact_first_name']) || //required
			!isset($_POST['contact_last_name']) || //required
			!isset($_POST['contact_phone']) || //required
			!isset($_POST['contact_email']) || //required
			!isset($_POST['contact_subject']) || //required
			!isset($_POST['contact_message']) //required

		) {

			//Destruction method output... This should idealy never show up since we have front-end validation.
			echo('<p>We are sorry, but there appears to be a problem with the form you submitted.</p>');
			exit(1);

		} else {

			//Server side vaidation; Escape any nasty that people might try to throw in.
			$contact_first_name_submitted = htmlspecialchars($_POST['contact_first_name']);
			$contact_last_name_submitted = htmlspecialchars($_POST['contact_last_name']);
			$contact_phone_submitted = htmlspecialchars($_POST['contact_phone']);
			$contact_email_submitted = $_POST["contact_email"];
			$contact_subject_submitted = htmlspecialchars($_POST['contact_subject']);
			$contact_message_submitted = htmlspecialchars($_POST['contact_message']);

			//Sucess output. Change as required.
			echo('<h3>Thank you for contacting us '.$contact_first_name_submitted.' '.$contact_last_name_submitted.'. Your form submission has submitted successfully.</h3>');

			$email_message = "Form details below.\n\n";

			function clean_string($string) {

			  $bad = array("content-type","bcc:","to:","cc:","href");
			  return str_replace($bad,"",$string);

			}

			$email_message .= "First Name: ".clean_string($contact_first_name_submitted)."\n";
			$email_message .= "Last Name: ".clean_string($contact_last_name_submitted)."\n";
			$email_message .= "Phone Number: ".clean_string($contact_phone_submitted)."\n";
			$email_message .= "Email Address: ".clean_string($contact_email_submitted)."\n";
			$email_message .= "Subject: ".clean_string($contact_subject_submitted)."\n";
			$email_message .= "Message: ".clean_string($contact_message_submitted)."\n";


			// create email headers
			$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$contact_email_submitted."\r\n" .
			'X-Mailer: PHP/' . phpversion();

			//SEND EMAIL! :)
			@mail($email_to, $email_subject, $email_message, $headers);
		}

	}
?>
