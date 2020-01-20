<?php
global $wpdb,$stats, $page;
if($_GET['settings-updated'] == true)
        echo '<div class="notice notice-success is-dismissible"><p><strong>Seus dados foram salvos com sucesso!</strong></p></div>';
?>
<div class="wrap">
    <h1>Configurações</h1>
    <form id="formulario" action="options.php" method="post" enctype="multipart/form-data"  >
        <?php wp_nonce_field('update-options') ?>
        <input type="hidden" name="action" value="update" />
    	<input type="hidden" name="page_options" value="configuration_email_newsletter,send_email_newsletter,configuration_mailchimp_interest_newsletter" />
        <table class="form-table">
            <tr>
                <th scope="row">E-mail</th>
                <td> 
                    <fieldset>
                        <legend class="screen-reader-text"><span>E-mail</span></legend>
                        <label for="configuration_email_newsletter">
                            <?php
                            $configuration_email_newsletter = get_option('configuration_email_newsletter');
                            ?>
                            <input name="configuration_email_newsletter" id="configuration_email_newsletter" type="checkbox" <?php echo ($configuration_email_newsletter == 1 ? 'checked="checked"' : ''); ?> value="1">Ativar recebimento de e-mail
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="send_email_newsletter">Endereço do email</label>
                </th>
                <td><input name="send_email_newsletter" class="regular-text code" id="send_email_newsletter" aria-describedby="send_email_newsletter" type="email" value="<?php echo get_option('send_email_newsletter'); ?>">
                <p class="description" id="send_email_newsletter">Informe o e-mail que deseja receber as inscrições.</p></td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="configuration_mailchimp_interest_newsletter">Interest Mailchimp</label>
                </th>
                <td><input name="configuration_mailchimp_interest_newsletter" class="regular-text code" id="configuration_mailchimp_interest_newsletter" aria-describedby="configuration_mailchimp_interest_newsletter" type="text" value="<?php echo get_option('configuration_mailchimp_interest_newsletter'); ?>"></td>
            </tr>

            
        </table>
        <div style="clear: both;">

            <?php submit_button(); ?>

        </div>
    </form>
</div>
<?php
?>