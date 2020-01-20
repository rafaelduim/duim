<?php 
class PsnNewsletter
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;

        $this->tableNewsletter = $wpdb->prefix . 'psn_newsletter';
        
    }
    public function urlSite()
    {
        return get_bloginfo("url");
    }
    public function urlPlugin()
    {
        return plugins_url( '', dirname(__FILE__) );
    }
    public function tableNewsletter()
    {
        return $this->tableNewsletter;
    }

    public function createsTables()
    {
        $PsnNewsletter = new PsnNewsletter();
        // $newsletter
        $tableNewsletter = $PsnNewsletter->tableNewsletter();

        $tableNewsletter = $this->wpdb->prepare( "CREATE TABLE $tableNewsletter (
            newsletter_id integer primary key auto_increment,
            newsletter_stats int(1),
            newsletter_name TEXT,
            newsletter_email TEXT,
            newsletter_city int(99),
            newsletter_state int(99),
            newsletter_created date
        )" , "");        
        $this->wpdb->query($tableNewsletter);
    }
    
    public function removeTables()
    {
        $PsnNewsletter = new PsnNewsletter();
        $tableNewsletter = $PsnNewsletter->tableNewsletter();
        
        // Del
        $sql_del = "DROP TABLE IF EXISTS $tableNewsletter";
        $this->wpdb->query($sql_del);
    }


    public function createUser($stats,$name,$email,$city='',$state='') {
        
        if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
        }

        $data = array(
            'newsletter_stats' => 1,
            'newsletter_name' => $name,
            'newsletter_email' => $email,
            'newsletter_city' => $city,
            'newsletter_state' => $state,
            'newsletter_created' => date('Y-m-d  H:i:s')
        );

        if(class_exists('PsnHelper')){
            $PsnHelper = new PsnHelper();
            $addLog = $PsnHelper->addLine($data,$this->tableNewsletter);
    
            if($addLog['stats'] == 1){
                $configuration_email_newsletter = get_option('configuration_email_newsletter');
                $send_email_newsletter = get_option('send_email_newsletter');
                $return = array(
                    'stats' => 1,
                    'id' => $addLog['id'],
                    'message' => 'Adicionado com sucesso'
                );
                if($PsnLog){
                    $PsnLog->createdLog(1,'Adicionando usuário ao newsletter','PsnNewsletter',$data,$addLog);
                }
                if($configuration_email_newsletter && $send_email_newsletter){

                    $PsnHelper = new PsnHelper();

                    $user = $PsnHelper->searchUser($this->tableNewsletter,'newsletter_email',$email);
                    
                    /*
                    * Plugin PsnMail
                    * @param string $title 
                    * @param string $html 
                    * @param string $sendTo 
                    * @param boolean $return 
                    * @return array
                    */
                    if(class_exists('PsnMail') && $user['stats'] == 1){ 
                        $sendTo = $send_email_newsletter;

                        $title = 'Novo Cadastro Newsletter';
                        $html .= '<p><strong>Nome:</strong> '. $user['field']->newsletter_name .'</p>';
                        $html .= '<p><strong>E-mail:</strong> '. $user['field']->newsletter_email .'</p>';
                        if(class_exists('PsnLocation')){
                            $PsnLocation = new PsnLocation();
                            if($city) {
                                $html .= '<p><strong>Cidade:</strong> '. $PsnLocation->getNameCity($user["field"]->newsletter_city) .'</p>';
                            }
                            if($state) {
                                $html .= '<p><strong>Estado:</strong> '. $PsnLocation->getNameState($user["field"]->newsletter_state) .'</p>';
                            }
                        }
        
                        $sendEmail = new PsnMail();
                        $sendEmail = $sendEmail->send($title, $html, $sendTo,false);
                        if($PsnLog){
                            $PsnLog->createdLog(1,'Enviando e-mail de novo usuário','PsnNewsletter',$html,$sendEmail);
                        }
                    }
        
                }
            }else{
                $return = array(
                    'stats' => 0,
                    'message' => 'Erro ao adicionar'
                );
                if($PsnLog){
                    $PsnLog->createdLog(0,'Adicionando usuário ao newsletter','PsnNewsletter',$data,$addLog);
                }
            }
        }else{
            $return = array(
                'stats' => 0,
                'message' => 'Erro plugin PsnHelper não encontrado'
            );
            if($PsnLog){
                $PsnLog->createdLog(0,'Adicionando usuário ao newsletter','PsnHelper','','Erro plugin PsnHelper não encontrado');
            }
        }

        return $return;
    }

    public function removeUser($id) {
		if(class_exists('PsnLog')){
            $PsnLog = new PsnLog();
        }

        $data = array(
            'newsletter_id' => $id,
        );

        if(class_exists('PsnHelper')){
            $PsnHelper = new PsnHelper();
            
            $removeUser = $PsnHelper->removeLine($this->tableNewsletter,$data);

            if($PsnLog){
                $PsnLog->createdLog(1,'Removendo usuário do newsletter','PsnNewsletter',$data,$removeUser);
            }
        }

		return true;
    }
    
    public function setMailChimp($name,$email){
		/*
		* Plugin MailChimp
		*/
		if(class_exists('mailChimp')):
			// MAILCHIMP ALL USERS
			$configuration_mailchimp_list_all = get_option('configuration_mailchimp_list_all');
			$configuration_mailchimp_apikey_all = get_option('configuration_mailchimp_apikey_all');
			$configuration_mailchimp_interest_newsletter = get_option('configuration_mailchimp_interest_newsletter');

			if($configuration_mailchimp_list_all && $configuration_mailchimp_apikey_all):

				$merge_fields = array('FNAME' => $name );

				$stats = 'subscribed'; // "subscribed" or "unsubscribed" or "cleaned" or "pending"
		        $list_id = $configuration_mailchimp_list_all; // where to get it read above
		        $api_key = $configuration_mailchimp_apikey_all; // where to get it read above
				$mailChimp = new mailChimp();

				if($configuration_mailchimp_interest_newsletter)
					$interests = array($configuration_mailchimp_interest_newsletter=>true);
				else
					$interests = '';

				$mailChimpReturn = $mailChimp->setUser($email, $stats, $list_id, $api_key, $merge_fields,$interests);
				
			endif;

			$stats =  array( 'mailChimp' => $mailChimpReturn  );

			$return = json_encode($stats);

			return $return;

		endif;

    }
    
}

?>