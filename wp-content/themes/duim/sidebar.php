<div class="m-b-40">
    <h5 class="title mt-0">Categories</h5>
    <ul class="list-icons">
        <?php 
        $args = array('orderby' => 'name', 'order' => 'DESC');
        $categories = get_terms('category', $args );
        if($categories) :
            
            foreach($categories as $category) :
                $cat_id 	= $category->term_id;
                $cat_name 	= $category->name;
                $cat_slug 	= $category->slug;
            ?>
                <li>
                    <a href="<?php echo get_category_link($cat_id); ?>" title="Veja todos os posts da categoria <?php echo $cat_name; ?>"><i class="fa fa-check-circle text-themecolor"></i> <?php echo $cat_name; ?></a>
                </li>
            <?php endforeach;
        endif;
        ?>
    </ul>
</div>