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
    	<input type="hidden" name="page_options" value="configuration_email_area_restrita,send_email_area_restrita" />
        <table class="form-table">
            <tr>
                <th scope="row">E-mail</th>
                <td> 
                    <fieldset>
                        <legend class="screen-reader-text"><span>E-mail</span></legend>
                        <label for="configuration_email_area_restrita">
                            <?php
                            $configuration_email_area_restrita = get_option('configuration_email_area_restrita');
                            ?>
                            <input name="configuration_email_area_restrita" id="configuration_email_area_restrita" type="checkbox" <?php echo ($configuration_email_area_restrita == 1 ? 'checked="checked"' : ''); ?> value="1">Ativar recebimento de e-mail
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="send_email_area_restrita">Endereço do email</label>
                </th>
                <td><input name="send_email_area_restrita" class="regular-text code" id="send_email_area_restrita" aria-describedby="send_email_area_restrita" type="email" value="<?php echo get_option('send_email_area_restrita'); ?>">
                <p class="description" id="send_email_area_restrita">Informe o e-mail que deseja receber as inscrições.</p></td>
            </tr>

          
            
        </table>
        <div style="clear: both;">

            <?php submit_button(); ?>

        </div>
    </form>
</div>
<?php
?>