<?php
    global $wpdb;

    //Create an instance of our package class...
    $testListTable = new Users_List_Table_AreaRestrita();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    // Action
    $actionPage = $_GET['action'];

    $PsnRestrictedArea = new PsnRestrictedArea();
    
    echo '<link rel="stylesheet" href="'.$PsnRestrictedArea->urlPlugin().'/admin/assets/psn-restricted-area-admin.css">';

    if($actionPage == 'view'):
        $idUser = $_GET['user'];
        $PsnRestrictedAreaUsers = new PsnRestrictedAreaUsers();
        if($idUser):
            $buscarusers = $PsnRestrictedAreaUsers->searchUser(1,$idUser);
            $users = $buscarusers['campo']; 
        endif;

        if($users):
            include('partial/partial-users.php'); 
        else:
            wp_die('Ocorreu um erro ao consultar o usuário! Tente novamente.');
        endif;
    else:
    ?>
        <h1>Usuários</h1>
        <form id="users-filter" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" /> 
            <input type="hidden" name="action" value="search" /> 
            <?php 
            $testListTable->search_box('Buscar', 'search_id'); 
            $testListTable->display();
            ?>
        </form>
    <?php 
    endif;
?>