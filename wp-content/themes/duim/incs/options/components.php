<?php
// EDIT PAGENAVI
function wd_pagination($html) {
	$out = '';
 
	//wrap a's and span's in li's
	$out = str_replace("<a","<li class='page-item'><a class='page-link'",$html);	
	$out = str_replace("</a>","</a></li>",$out);
	$out = str_replace("<span","<li class='page-item'><a class='page-link'",$out);	
	$out = str_replace("</span>","</a></li>",$out);
	$out = str_replace("<div class='wp-pagenavi' role='navigation'>","",$out);
	$out = str_replace("</div>","",$out);
 
	return '<div class="text-center">
			<ul class="pagination">'.$out.'</ul>
		</div>';
}
add_filter( 'wp_pagenavi', 'wd_pagination', 10, 2 );


#region REMOVER SLUG FOR POST
function na_remove_slug( $post_link, $post, $leavename ) {
    if ( 'promocoes' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    return $post_link;
}
add_filter( 'post_type_link', 'na_remove_slug', 10, 3 );

function na_parse_request( $query ) {

    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'promocoes', 'page' ) );
    }
}
add_action( 'pre_get_posts', 'na_parse_request' );
#endregion

function formatDate($date,$format) {
    // $date = new DateTime($date);
    // return $date->format($format);

    setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');

	return strftime($format, strtotime( $date ));
}

function softTrim($text, $count, $wrapText='...'){

    if(strlen($text)>$count){
        preg_match('/^.{0,' . $count . '}(?:.*?)\b/siu', $text, $matches);
        $text = $matches[0];
    }else{
        $wrapText = '';
    }
    return $text . $wrapText;
}


add_action('wp_ajax_nopriv_sendContact', 'sendContact');  
add_action('wp_ajax_sendContact', 'sendContact');
function sendContact(){ 	
	global $wpdb;
    $PsnThemes = new PsnThemes();
	$valid = check_ajax_referer('form_contact', 'verify');
	if(isset($_POST) && $valid ) {
		$sendTo = $_POST['enviarPara'];
		$name = $_POST['nomeContato'];
		$email = $_POST['emailContato'];
		$subject = 'Contato Site';
		$phone = $_POST['telefoneContato'];
		$city = $_POST['cidadeContato'];
		$message = $_POST['mensagemContato'];
		$html = '';
		$html .= '<h2>Contato do Site - '. $PsnThemes->getTemplateName() .'</h2>';
		$html .= '<p><strong>Assunto:</strong> '. $subject .'</p>';
		$html .= '<p><strong>Nome:</strong> '. $name .'</p>';
		$html .= '<p><strong>E-mail:</strong> '. $email .'</p>';
        if($phone)
            $html .= '<p><strong>Telefone:</strong> '. $phone .'</p>';
        if($city)
            $html .= '<p><strong>Cidade:</strong> '. $city .'</p>';

        $html .= '<p><strong>Mensagem:</strong> '. $message .'</p>';
        		
		$title = 'Contato Site';		

        if(class_exists('PsnMail')) { 
		    $sendEmail = new PsnMail();
            $sendEmail = $sendEmail->send($title, $html, $sendTo,true);
        }
	}
}

?>