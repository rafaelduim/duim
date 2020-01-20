<?php 
// MAIL
// -- IMPORT PHPMAILER
require("PHPMailerAutoload.php");

class PsnMail {
	public $title; 
	public $html;
	public $sendTo;
	public $returnstats;

	public function send ($title, $html, $sendTo,$returnstats = true,$fromName = '',$fromEmail = ''){
		global $wpdb;

		$configuration_email_name = get_option('configuration_email_name');
		$configuration_email_mail = get_option('configuration_email_mail');
		$configuration_email_password = get_option('configuration_email_password');
		$configuration_email_host = get_option('configuration_email_host');
		$configuration_email_port = get_option('configuration_email_port');
		$configuration_email_security = get_option('configuration_email_security');

		
		$wrapperHtml = $html;	
		$mail = new PHPMailer();		
		
	    $mail->IsSMTP();
		$mail->Port = $configuration_email_port; 
		$mail->Host = $configuration_email_host;
		$mail->SMTPSecure = $configuration_email_security;
		$mail->SMTPAuth = true; 
	    $mail->Username = $configuration_email_mail; 
	    $mail->Password = $configuration_email_password; 

		
		if(!$fromEmail){
			$fromEmail = $configuration_email_mail;
		}

		if(!$fromName){
			$fromName = $configuration_email_name;
		}

		$mail->From = $fromEmail; 
		$mail->Sender = $fromEmail;
		$mail->FromName = $fromName;
		
		$mail->addReplyTo($fromEmail, $fromName);


	    $sendTo = explode(',', $sendTo);

	    if($sendTo){
	    	$count = 0;
	    	foreach ($sendTo as $m) {
	    		if($count == 0)
	    		{
	    			$mail->AddAddress($m, '');	
	    		}
	    		else
	    		{
	    			$mail->AddCC($m, '');
	    		}
	    		$count++;
	    	}
	    }


		$mail->IsHTML(true); 	
		$mail->CharSet = 'utf-8'; 	
		$mail->Subject = $title;	
		$mail->Body = $wrapperHtml;	
		$enviado = $mail->Send();	
		$mail->ClearAllRecipients();	
		$mail->ClearAttachments();

		if($returnstats):
			$stats = array(); 
			if($enviado)
				$stats =  array( 'cod' => 1 , 'message' =>  'Enviado com sucesso' );
			else
				$stats =  array( 'cod' => 2 , 'message' =>  'Não enviado' );

			$return = json_encode($stats);

			if(is_array($return))
				print_r($return); 
			else
				echo $return;
			
			die;
		  	return false;
		endif;
	}
}

// -- FUNCTION
function psn_email($title, $html, $sendTo,$returnstats = true){	
	global $wpdb;


	$configuration_email_name = get_option('configuration_email_name');
	$configuration_email_mail = get_option('configuration_email_mail');
	$configuration_email_password = get_option('configuration_email_password');
	$configuration_email_host = get_option('configuration_email_host');
	$configuration_email_port = get_option('configuration_email_port');
	$configuration_email_security = get_option('configuration_email_security');

	
	$wrapperHtml = $html;	
	$mail = new PHPMailer();		
	
    $mail->IsSMTP();
	$mail->Port = $configuration_email_port; 
	$mail->Host = $configuration_email_host;
	$mail->SMTPSecure = $configuration_email_security;
	$mail->SMTPAuth = true; 
    $mail->Username = $configuration_email_mail; 
    $mail->Password = $configuration_email_password; 

    $mail->FromName = $configuration_email_name;
	$mail->From = $configuration_email_mail; 
    $mail->Sender = $configuration_email_mail;	

	$mail->AddAddress($sendTo);	
	$mail->IsHTML(true); 	
	$mail->CharSet = 'utf-8'; 	
	$mail->Subject = $title;	
	$mail->Body = $wrapperHtml;	
	$enviado = $mail->Send();	
	$mail->ClearAllRecipients();	
	$mail->ClearAttachments();

	if($returnstats):
		$stats = array(); 
		if($mail)
			$stats =  array( 'cod' => 1 , 'message' =>  'Enviado com sucesso' );
		else
			$stats =  array( 'cod' => 2 , 'message' =>  'Não enviado' );

		$return = json_encode($stats);

		if(is_array($return)) {
			print_r($return); 
		} else {
			echo $return;
		} 
		die;
	  	return false;
	endif;
}
?>