<?php 
add_action('init', 'projects');
 
function projects() {
    // Post Type 
    $postTypeInfo = array(
        'name' => 'Projetos',
        'singular_name' => 'Projeto',
        'slug' => 'clientes',
        'term' => 'projects',
        'icon' => 'dashicons-feedback',
        'archive' => true,
        'exclude_search' => false,
        'supports' => array('title','editor','excerpt','thumbnail'),
        'public' => true,
    );
    
    $labels = array(
        'name' => _x($postTypeInfo["name"], 'post type general name'),
        'singular_name' => _x($postTypeInfo["singular_name"], 'post type singular name'),
        'add_new' => _x('Adicionar', 'item'),
        'add_new_item' => __('Adicionar'),
        'edit_item' => __('Editar'),
        'new_item' => __('Novo'),
        'view_item' => __('Ver'),
        'search_items' => __('Procurar'),
        'not_found' =>  __('Nenhum encontrado'),
        'not_found_in_trash' => __('Nenhum na lixeira'),
        'parent_item_colon' => '',
    );
 
    $args = array(
        'labels' => $labels,
        'public' => $postTypeInfo["public"],
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => $postTypeInfo["exclude_search"],
        'query_var' => true,
        'rewrite' => array( 'slug' => $postTypeInfo["slug"] ),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => $postTypeInfo["icon"],
        'has_archive' => $postTypeInfo["archive"],
        'supports' => $postTypeInfo["supports"],
        'show_in_rest' => true
      );

 
    register_post_type( $postTypeInfo['term'] , $args );

    flush_rewrite_rules();

    $label = array(
        'name'                  => ('Categorias'),
        'singular_name'         => ('Categoria'),
        'add_new'               => ('Adicionar'),
        'add_new_item'          => ('Adicionar'),
        'edit_item'             => ('Editar'),
        'new_item'              => ('Nova'),
        'view_item'             => ('Ver'),
        'search_items'          => ('Buscar'),
    );

    register_taxonomy('category_' . $postTypeInfo["term"], array($postTypeInfo["term"]),

    array(
        'labels'                => $label,
        'public'                => true,
        'query_var'             => true,
        'hierarchical'          => true,
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'categoria-projecto', 'with_front' => false ))
    );
}

?>