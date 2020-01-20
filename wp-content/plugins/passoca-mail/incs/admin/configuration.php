<?php
global $wpdb,$stats, $page;


$configuration_email_name = get_option('configuration_email_name');
$configuration_email_mail = get_option('configuration_email_mail');
$configuration_email_password = get_option('configuration_email_password');
$configuration_email_host = get_option('configuration_email_host');
$configuration_email_port = get_option('configuration_email_port');
$configuration_email_security = get_option('configuration_email_security');

if($_GET['settings-updated'] == true)
        echo '<div class="notice notice-success is-dismissible"><p><strong>Seus dados foram salvos com sucesso!</strong></p></div>';
?>
<div class="wrap">
    <h1>Configurações</h1>
    <form id="formulario" action="options.php" method="post" enctype="multipart/form-data"  >
        <?php wp_nonce_field('update-options') ?>
        <input type="hidden" name="action" value="update" />
    	<input type="hidden" name="page_options" value="configuration_email_name,configuration_email_mail,configuration_email_password,configuration_email_host,configuration_email_port,configuration_email_security" />
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="configuration_email_mail">Nome</label>
                </th>
                <td><input name="configuration_email_name" class="regular-text code" id="configuration_email_name" aria-describedby="configuration_email_name" type="text" value="<?php echo get_option('configuration_email_name'); ?>">
                <p class="description" id="configuration_email_name">Informe o nome que irá enviar todos os contatos do site.</p></td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="configuration_email_mail">Endereço do email</label>
                </th>
                <td><input name="configuration_email_mail" class="regular-text code" id="configuration_email_mail" aria-describedby="configuration_email_mail" type="text" value="<?php echo get_option('configuration_email_mail'); ?>">
                <p class="description" id="configuration_email_mail">Informe o e-mail que irá enviar todos os contatos do site.</p></td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="configuration_email_password">Senha</label>
                </th>
                <td><input name="configuration_email_password" class="regular-text code" id="configuration_email_password" aria-describedby="configuration_email_password" type="password" value="<?php echo get_option('configuration_email_password'); ?>">
            </tr>
            <tr>
                <th scope="row">
                    <label for="configuration_email_host">Host</label>
                </th>
                <td><input name="configuration_email_host" class="regular-text code" id="configuration_email_host" aria-describedby="configuration_email_host" type="text" value="<?php echo get_option('configuration_email_host'); ?>">
            </tr>
            <tr>
                <th scope="row">
                    <label for="configuration_email_port">Porta</label>
                </th>
                <td><input name="configuration_email_port" class="regular-text code" id="configuration_email_port" aria-describedby="configuration_email_port" type="text" value="<?php echo get_option('configuration_email_port'); ?>">
            </tr>
            <tr>
                <th scope="row">
                    <label for="configuration_email_security">Segurança</label>
                </th>
                <td><input name="configuration_email_security" class="regular-text code" id="configuration_email_security" aria-describedby="configuration_email_security" type="text" value="<?php echo get_option('configuration_email_security'); ?>">
            </tr>
        </table>
        <div style="clear: both;">

            <?php submit_button(); ?>

        </div>
    </form>
</div>
<?php
?>