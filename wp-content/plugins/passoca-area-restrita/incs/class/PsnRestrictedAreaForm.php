<?php 
class PsnRestrictedAreaForm
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        
    }

    public function login() {
        $template = '';
            $template .= '<form data-form="psn-restricted-area" class="form-area-restrita">';
                $template .= '<input type="hidden" name="action" value="psn_area_restrita">';
                $template .= wp_nonce_field('psn_area_restrita', 'verify' , true , false);
                $template .= '<input type="text" required="required" name="usersPsnRestrictedArea" placeholder="Usuário">';  
                $template .= '<input type="password" required="required" name="senhaPsnRestrictedArea" placeholder="Senha">';                  
                $template .= '<input type="submit" value="Login">';                  
                $template .= '<a href="#" class="recupearSenhaPsnRestrictedArea">Recuperar Senha</a>';                  
            $template .= '</form>';
        echo $template;
    }

    public function recoveryPassword() {
        $template = '';
            $template .= '<form data-form="psn-restricted-area-esqueceu-senha" class="form-area-restrita-esqueceu-senha">';
                $template .= '<input type="hidden" name="action" value="psn_area_restrita_esqueceu_senha">';
                $template .= wp_nonce_field('psn_area_restrita_esqueceu_senha', 'verify_esqueceu_senha' , true , false);
                $template .= '<input type="text" required="required" name="usersPsnRestrictedArea" placeholder="Usuário">';  
                $template .= '<input type="submit" value="Recuperar Senha">';                  
            $template .= '</form>';
        echo $template;
    }

    public function newPasswordRecoveryPassword() {
        $template = '';
            $template .= '<form data-form="psn-restricted-area-esqueceu-senha-nova" class="form-area-restrita-esqueceu-senha-nova">';
                $template .= '<input type="hidden" name="action" value="psn_area_restrita_nova_senha">';
                $template .= '<input type="hidden" name="tokenPsnRestrictedArea" value="'. $_GET["token"] .'">';
                $template .= wp_nonce_field('psn_area_restrita_nova_senha', 'verify_nova_senha' , true , false);
                $template .= '<input type="password" required="required" name="novaSenhaPsnRestrictedArea" placeholder="Nova Senha">';
                $template .= '<input type="password" required="required" name="novaSenhaConfirmacaoPsnRestrictedArea" placeholder="Confirmar Nova Senha">';
                $template .= '<input type="submit" value="Salvar Senha">';                  
            $template .= '</form>';
        echo $template;
    }
    public function register() {
        $template = '';
            $template .= '<form data-form="psn-restricted-area-cadastro" class="form-area-restrita-cadastro">';
                $template .= '<input type="hidden" name="action" value="psn_area_restrita_cadastro">';
                $template .= wp_nonce_field('psn_area_restrita_cadastro', 'verify_cadastrar' , true , false);
                $template .= '<input type="text" required="required" name="usersPsnRestrictedArea" placeholder="Usuário">';
                $template .= '<input type="email" required="required" name="emailPsnRestrictedArea" placeholder="E-mail">';
                $template .= '<input type="text" required="required" name="cpfPsnRestrictedArea" placeholder="CPF">';
                $template .= '<input type="date" required="required" name="dataNascimentoPsnRestrictedArea" placeholder="CPF">';
                $template .= '<input type="password" required="required" name="senhaPsnRestrictedArea" placeholder="Senha">';                  
                $template .= '<input type="password" required="required" name="confirmarSenhaPsnRestrictedArea" placeholder="Confirmar Senha">';                  
                $template .= '<input type="submit" value="Cadastrar">';               
            $template .= '</form>';
        echo $template;
    }
}

?>