<?php
$usersTratado = new Users($users->user_name,$users->user_email,$users->user_cpf,'',$users->user_date_birth);

if($users->user_stats == 0)
    $statsusers = 'Não ativado';

if($users->user_stats == 1)
    $statsusers = 'Ativado';

if($users->user_stats == 3)
    $statsusers = 'Bloqueado';
?>

<h1>Usuário</h1>
<div class="stuffbox">
    <div id="profile-page" class="inside">
        
        <div class="box-person">
            <div class="col">
                <h2>Informações Pessoais</h2>
                <div class="form-group">
                    <p>Nome</p>
                    <p class="input"><?php echo $usersTratado->getName(); ?></p>
                </div>
                <div class="form-group">
                    <p>E-mail</p>
                    <p class="input"><?php echo $usersTratado->getEmail(); ?></p>
                </div>
                <div class="half">
                    <div class="form-group">
                        <p>CPF</p>
                        <p class="input"><?php echo $usersTratado->getCPF(); ?></p>
                    </div>
                    <div class="form-group">
                        <p>Data de nascimento</p>
                        <p class="input"><?php echo date('d/m/Y', strtotime($usersTratado->getDateBirth())); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <p>stats</p>
                    <p class="input"><?php echo $statsusers; ?></p>
                </div>
            </div>
            <div class="col">
                <h2>Membro</h2>
                <p>Esse usuário é algum dos membros do grupo? Se for selecione o membro abaixo:</p>
                <div class="form-group">
                    <p>Membro</p>
                    <form data-form="vincularAreaRestrita">
                        <input type="hidden" name="usersID" value="<?php echo $users->user_id; ?>">
                        <input type="hidden" name="action" value="psn_area_restrita_vincular" >
                        <select name="membro" id="" class="form-control margin-top-10">
                            <option value="0">Nenhum</option>
                            <?php 
                            $args = array(
                                'post_type' => 'equipe',
                                'posts_per_page' => -1 ,
                                'order' => 'ASC'
                            );
                            $loop = new WP_Query($args);
                        
                            if ($loop->have_posts()) {
                                while($loop->have_posts()) { 
                                    $loop->the_post();
                                    if($users->user_member == get_the_ID() ){
                                        echo '<option selected value="'. get_the_ID() .'">' . get_the_title() . '</option>';
                                    }
                                    else {
                                        echo '<option value="'. get_the_ID() .'">' . get_the_title() . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                        <div class="clearfix margin-top-10"></div>
                        <button type="submit" class="button button-primary">Vincular</button>
                    </form>
                    <script>
                    jQuery(window).load(function() {
                        jQuery('[data-form="vincularAreaRestrita"]').submit(function(event){
                            
                            event.preventDefault();

                            var _form = jQuery(this);
                            var _data = _form.serialize();
                            jQuery.ajax({
                                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                                type: 'POST',
                                dataType: 'JSON',
                                data: _data,
                                beforeSend: function() {
                                    
                                },
                                success: function(data, stats) {
                                    // location.reload();
                                    if(data.stats == 1)
                                        location.reload();
                                    else
                                        alert('Erro ao vincular');
                                }
                            });
                        });
                    });
                </script>
                </div>
            </div>
            <?php 
            if($users->user_stats != 3){
            ?>
                <div class="col">
                    <h2>Bloquear</h2>
                    <div class="form-group">
                        <form data-form="bloquearAreaRestrita">
                            <input type="hidden" name="usersID" value="<?php echo $users->user_id; ?>">
                            <input type="hidden" name="action" value="psn_area_restrita_bloquear" >
                            <div class="clearfix margin-top-10"></div>
                            <button type="submit" class="button button-primary">Bloquear</button>
                        </form>
                        <script>
                        jQuery(window).load(function() {
                            jQuery('[data-form="bloquearAreaRestrita"]').submit(function(event){
                                
                                event.preventDefault();

                                var _form = jQuery(this);
                                var _data = _form.serialize();
                                jQuery.ajax({
                                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: _data,
                                    beforeSend: function() {
                                        
                                    },
                                    success: function(data, stats) {
                                        // location.reload();
                                        if(data.stats == 1)
                                            location.reload();
                                        else
                                            alert('Erro ao bloquear');
                                    }
                                });
                            });
                        });
                    </script>
                    </div>
                </div>
            <?php 
            }else{
            ?>
                <div class="col">
                    <h2>Desbloquear</h2>
                    <div class="form-group">
                        <form data-form="desbloquearAreaRestrita">
                            <input type="hidden" name="usersID" value="<?php echo $users->user_id; ?>">
                            <input type="hidden" name="action" value="psn_area_restrita_desbloquear" >
                            <div class="clearfix margin-top-10"></div>
                            <button type="submit" class="button button-primary">Desbloquear</button>
                        </form>
                        <script>
                        jQuery(window).load(function() {
                            jQuery('[data-form="desbloquearAreaRestrita"]').submit(function(event){
                                
                                event.preventDefault();

                                var _form = jQuery(this);
                                var _data = _form.serialize();
                                jQuery.ajax({
                                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: _data,
                                    beforeSend: function() {
                                        
                                    },
                                    success: function(data, stats) {
                                        // location.reload();
                                        if(data.stats == 1)
                                            location.reload();
                                        else
                                            alert('Erro ao desbloquear');
                                    }
                                });
                            });
                        });
                    </script>
                    </div>
                </div>
            <?php 
            } ?>
        </div>

        <p class="submit text-center">
            <a href="?page=<?php echo $_REQUEST['page']; ?>" class="button button-primary" >Voltar</a>
            <a href="?page=<?php echo $_REQUEST['page']; ?>&action=delete&user=<?php  ?>" class="button button-primary" >Deletar</a>
        </p>

    </div>
</div>