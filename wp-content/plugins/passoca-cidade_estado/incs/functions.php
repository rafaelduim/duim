<?php 

add_action('wp_ajax_nopriv_recovery_states', 'recovery_states');  
add_action('wp_ajax_recovery_states', 'recovery_states');
function recovery_states() {	
	
	$psnLocation = new PsnLocation();

	$response = $psnLocation->listAllState();

	$response = json_encode($response);

	if (is_array($response)) {
        print_r($response);
    } else {
        echo $response;
    }
	
    die;
}

add_action('wp_ajax_nopriv_recovery_cities', 'recovery_cities');  
add_action('wp_ajax_recovery_cities', 'recovery_cities');
function recovery_cities(){
    $state = trim($_POST["cod_states"]);
    if ($state) :
       
       	$psnLocation = new PsnLocation();

		$response = $psnLocation->listCityState($state);

		if($response):
            $template = '<option value="">Selecione a cidade</option>';
            foreach ($response as $c):
                $template .= '<option value="'. $c->cod_city .'">'. $c->name .'</option>';
            endforeach;

            $stats =  array( 'cod' => 1 , 'template' => $template , 'message' => 'Estado encontrado' );
        else:
            $stats =  array( 'cod' => 2 , 'template' => $template , 'message' => 'Estado não encontrado' );
        endif;

		$response = json_encode($stats);

		if (is_array($response)) {
			print_r($response);
		} else {
			echo $response;
		}		
    endif;	
	die;
}


 ?>