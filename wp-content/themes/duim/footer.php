    </main>
    <?php wp_footer(); 
    
    if($_GET['active'] == "true" && $_GET['token']) {
    
        $PsnRestrictedAreaUsers = new PsnRestrictedAreaUsers();
        $activeUser = $PsnRestrictedAreaUsers->activeUser($_GET['token']);
        
        if($activeUser['stats'] == 1){
        ?>
            <script>
                toastr["success"]("Ativado com sucesso!");
            </script>
        <?
        }else {
        ?>
            <script>
                toastr["error"]("Error ao ativar");
            </script>
        <?
        }
    }
    ?>
</body>