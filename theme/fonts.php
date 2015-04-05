<?php // laste updated 28/04/2015

add_action('admin_menu', array( 'tn_fonts', 'setup' ) );

class tn_fonts {

    static function setup() {
        add_theme_page( 'Fonts', 'Fonts', 'manage_options' , ns_.'_fonts', 'settings' );
    	add_action( 'admin_init', 'register' );
    }


    static function register() {
        register_setting( 'theme_fonts_group', 'theme_fonts');
    }

    static function settings() {

        $theme_fonts = get_option('theme_fonts');
        if( !is_array( $theme_fonts ) ) $theme_fonts = array();

        echo '<div class="wrap">'."\n";
        echo '  <form method="post" action="options.php">'."\n";
        echo '      <h2>Google Fonts</h2>'."\n".'      <hr style="margin: 20px 0;border: 0; height: 1px; background:#ddd; "/>'."\n";
        echo '      <a style="font-size:0.8em;position: relative;top: -15px;" href="https://www.google.com/fonts">https://www.google.com/fonts</a>'."\n";
        tn_new_field( array( 'title' => 'Primary Font', 'group' => 'theme_fonts', 'name' => ns_.'gf1', 'type' => 'text', 'size' => '100%', 'max_width' => '600px', 'placeholder' => 'http://...', 'default' => 'http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,800,700,900') );
        tn_new_field( array( 'title' => 'Secondary Font', 'group' => 'theme_fonts', 'name' => ns_.'gf2', 'type' => 'text', 'size' => '100%', 'max_width' => '600px', 'placeholder' => 'http://...', 'default' => 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' ) );
        tn_new_field( array( 'title' => 'Tertiary Font', 'group' => 'theme_fonts', 'name' => ns_.'gf3', 'type' => 'text', 'size' => '100%', 'max_width' => '600px', 'placeholder' => 'http://...' ) );
        echo '      <h2 style="margin-top:40px;">Fonts Icons</h2>'."\n".'      <hr style="margin: 20px 0;border: 0; height: 1px; background:#ddd; "/>'."\n";
        tn_new_field( array( 'title' => 'Font Awesome', 'group' => 'theme_fonts', 'name' => ns_.'fa430', 'type' => 'checkbox', 'description' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/">http://fortawesome.github.io/Font-Awesome/icons/</a>' ) );

        submit_button();
        settings_fields( 'theme_fonts_group' );

        echo '  </form>'."\n";
        echo '</div>'."\n";

    }

}

?>