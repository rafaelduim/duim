<?php 

class PsnThemes {
    function __construct() {
        $this->template_name = 'NOME DO PROJETO';
        $this->slug = 'slug';
        $this->url_site = get_bloginfo("url");
        $this->url_template = get_template_directory_uri();
   }

   public function getTemplateName(){ 
        return $this->template_name;
   }

   public function getSlug(){
        return $this->slug;
   }

   public function getUrlSite(){
        return $this->url_site;
    }

    public function getUrlTemplate(){
        return $this->url_template;
    }

    public function customizerTemplate(){
        function psn_theme_settings($wp_customize) {

            $wp_customize->add_section( 'psn_themes_options' , array(
                'title'      => __( 'PsnThemes - Opções', '' ),
                'priority'   => 30,
            ) );

            // add a setting for the site logo
            $wp_customize->add_setting('psn_themes_logo');
            // Add a control to upload the logo
            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'psn_themes_logo',
                    array(
                        'label' => 'Upload Logo',
                        'section' => 'psn_themes_options',
                        'settings' => 'psn_themes_logo',
                    ) 
                )
            );
            
            $wp_customize->add_setting('psn_themes_copyright');
            $wp_customize->add_control(
                'psn_themes_copyright', 
                array(
                    'label'    => __( 'Texto do Rodapé', '' ),
                    'section'  => 'psn_themes_options',
                    'settings' => 'psn_themes_copyright',
                    'type'     => 'text'
                )
            );          
            
        }
        add_action('customize_register', 'psn_theme_settings');

        function psn_theme_settings_social($wp_customize) {

            $wp_customize->add_section( 'psn_themes_options_social' , array(
                'title'      => __( 'PsnThemes - Mídias Sociais', '' ),
                'priority'   => 30,
            ) );
            
            $social_media = array(
                'psn_themes_facebook' => __( 'Link do Facebook', '' ),
                'psn_themes_instagram' => __( 'Link do Instagram', '' ),
                'psn_themes_twitter' => __( 'Link do Twitter', '' ),
                'psn_themes_youtube' => __( 'Link do Youtube', '' )
            );

            foreach ($social_media as $key => $value) {
                $wp_customize->add_setting($key);
                $wp_customize->add_control(
                    $key, 
                    array(
                        'label'    => $value,
                        'section'  => 'psn_themes_options_social',
                        'settings' => $key,
                        'type'     => 'text'
                    )
                ); 
            }
            
            
        }
        add_action('customize_register', 'psn_theme_settings_social');
    }

    public function createLink($href,$title,$text,$target=''){
        if($target)
            $target = 'target="'. $target .'"';


        $link = "<a href='$href' alt='$title' title='$title' $target>$text</a>";
        return $link;
    }

}
?>