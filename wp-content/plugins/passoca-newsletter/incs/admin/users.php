<?php
    global $wpdb;

    //Create an instance of our package class...
    $testListTable = new Users_List_Table_News();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    // Action
    $actionPage = $_GET['action'];
    
?>
    <div class="wrap">
        <h1>Usuários</h1>
        <form id="users-filter" method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" /> 
            <input type="hidden" name="action" value="search" /> 
            <?php 
            $testListTable->search_box('Buscar', 'search_id'); 
            $testListTable->display();
            ?>
        </form>
    </div>
<?php
?>