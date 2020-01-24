<?php 

class PsnThemes {
    function __construct() {
        $this->template_name = 'Duim';
        $this->slug = 'duim';
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
            
        }
        add_action('customize_register', 'psn_theme_settings');

        function psn_theme_settings_social($wp_customize) {

            $wp_customize->add_section( 'psn_theme_settings_social' , array(
                'title'      => __( 'PsnThemes - Mídias Sociais', '' ),
                'priority'   => 30,
            ) );

            
            $optionsArray = array(
                array(
                    'key' => 'psn_themes_social_facebook',
                    'text' => __( 'Facebook', '' ),
                    'type' => 'url'
                ),
                array(
                    'key' => 'psn_themes_social_twitter',
                    'text' => __( 'Twitter', '' ),
                    'type' => 'url'
                ),
                array(
                    'key' => 'psn_themes_social_instagram',
                    'text' => __( 'Instagam', '' ),
                    'type' => 'url'
                ),
                array(
                    'key' => 'psn_themes_social_linkedin',
                    'text' => __( 'Linkedin', '' ),
                    'type' => 'url'
                )
            );

            foreach ($optionsArray as $value) {
                $wp_customize->add_setting($value['key']);
                $wp_customize->add_control(
                    $value['key'], 
                    array(
                        'label'    => $value['text'],
                        'section'  => 'psn_theme_settings_social',
                        'settings' => $value['key'],
                        'type'     => $value['type']
                    )
                ); 
            }        
        }
        add_action('customize_register', 'psn_theme_settings_social');

        function psn_theme_settings_about($wp_customize) {

            $wp_customize->add_section( 'psn_theme_settings_about' , array(
                'title'      => __( 'PsnThemes - Quem Somos', '' ),
                'priority'   => 30,
            ) );

            
            $optionsArray = array(
                array(
                    'key' => 'psn_themes_about_title',
                    'text' => __( 'Título', '' ),
                    'type' => 'text'
                ),
                array(
                    'key' => 'psn_themes_about_excerpt',
                    'text' => __( 'Chamada', '' ),
                    'type' => 'text'
                )
            );

            foreach ($optionsArray as $value) {
                $wp_customize->add_setting($value['key']);
                $wp_customize->add_control(
                    $value['key'], 
                    array(
                        'label'    => $value['text'],
                        'section'  => 'psn_theme_settings_about',
                        'settings' => $value['key'],
                        'type'     => $value['type']
                    )
                ); 
            }        
        }
        add_action('customize_register', 'psn_theme_settings_about');

        function psn_theme_settings_services($wp_customize) {

            $wp_customize->add_section( 'psn_theme_settings_services' , array(
                'title'      => __( 'PsnThemes - Serviços', '' ),
                'priority'   => 30,
            ) );

            
            $optionsArray = array(
                array(
                    'key' => 'psn_themes_services_title',
                    'text' => __( 'Título', '' ),
                    'type' => 'text'
                ),
                array(
                    'key' => 'psn_themes_services_excerpt',
                    'text' => __( 'Chamada', '' ),
                    'type' => 'text'
                )
            );

            foreach ($optionsArray as $value) {
                $wp_customize->add_setting($value['key']);
                $wp_customize->add_control(
                    $value['key'], 
                    array(
                        'label'    => $value['text'],
                        'section'  => 'psn_theme_settings_services',
                        'settings' => $value['key'],
                        'type'     => $value['type']
                    )
                ); 
            }   
            $wp_customize->add_setting('psn_themes_services_image');
            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'psn_themes_services_image',
                    array(
                        'label' => 'Imagem Banner',
                        'section' => 'psn_theme_settings_services',
                        'settings' => 'psn_themes_services_image',
                    ) 
                )
            );   
        }
        add_action('customize_register', 'psn_theme_settings_services');

        function psn_theme_settings_projects($wp_customize) {

            $wp_customize->add_section( 'psn_theme_settings_projects' , array(
                'title'      => __( 'PsnThemes - Projetos', '' ),
                'priority'   => 30,
            ) );

            
            $optionsArray = array(
                array(
                    'key' => 'psn_themes_projects_title',
                    'text' => __( 'Título', '' ),
                    'type' => 'text'
                ),
                array(
                    'key' => 'psn_themes_projects_excerpt',
                    'text' => __( 'Chamada', '' ),
                    'type' => 'text'
                )
            );

            foreach ($optionsArray as $value) {
                $wp_customize->add_setting($value['key']);
                $wp_customize->add_control(
                    $value['key'], 
                    array(
                        'label'    => $value['text'],
                        'section'  => 'psn_theme_settings_projects',
                        'settings' => $value['key'],
                        'type'     => $value['type']
                    )
                ); 
            }
            
            $wp_customize->add_setting('psn_themes_projects_image');
            $wp_customize->add_control( 
                new WP_Customize_Image_Control( 
                    $wp_customize, 
                    'psn_themes_projects_image',
                    array(
                        'label' => 'Imagem Banner',
                        'section' => 'psn_theme_settings_projects',
                        'settings' => 'psn_themes_projects_image',
                    ) 
                )
            );
        }
        add_action('customize_register', 'psn_theme_settings_projects');

        function psn_theme_settings_footer($wp_customize) {

            $wp_customize->add_section( 'psn_theme_settings_footer' , array(
                'title'      => __( 'PsnThemes - Rodapé', '' ),
                'priority'   => 30,
            ) );

            
            $optionsArray = array(
                array(
                    'key' => 'psn_themes_footer_number',
                    'text' => __( 'Número', '' ),
                    'type' => 'text'
                ),
                array(
                    'key' => 'psn_themes_footer_email',
                    'text' => __( 'E-mail', '' ),
                    'type' => 'email'
                ),
                array(
                    'key' => 'psn_themes_footer_copy',
                    'text' => __( 'Copyright', '' ),
                    'type' => 'text'
                )
            );

            foreach ($optionsArray as $value) {
                $wp_customize->add_setting($value['key']);
                $wp_customize->add_control(
                    $value['key'], 
                    array(
                        'label'    => $value['text'],
                        'section'  => 'psn_theme_settings_footer',
                        'settings' => $value['key'],
                        'type'     => $value['type']
                    )
                ); 
            }        
        }
        add_action('customize_register', 'psn_theme_settings_footer');
    }

    public function createLink($href,$title,$text,$target=''){
        if($target)
            $target = 'target="'. $target .'"';


        $link = "<a href='$href' alt='$title' title='$title' $target>$text</a>";
        return $link;
    }

}
?>