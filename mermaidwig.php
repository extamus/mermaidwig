<?php
   /*
   Plugin Name: Mermaid Wig Machine
   Plugin URI: http://extamus.com
   Description: A machine to put a mermaid wig on almost anything.
   Version: 0.1
   Author: Extamus Media
   Author URI: http://extamus.com
   License: GPL2
   */

  add_action('wp_enqueue_scripts', 'extamus_enqueue_admin_styles');
  function extamus_enqueue_admin_styles()
  {
  
//   Load Animate on Scroll and Google Fonts, enable comments
      $the_theme = wp_get_theme();
      wp_enqueue_style('animate-on-scroll', "https://unpkg.com/aos@2.3.1/dist/aos.css", array(), $the_theme->get('Version'));
      wp_enqueue_style('google-fonts', "", array(), $the_theme->get('Version'));
      if (is_singular() && comments_open() && get_option('thread_comments')) {wp_enqueue_script('comment-reply');
      }
      wp_enqueue_script('AOS', "https://unpkg.com/aos@2.3.1/dist/aos.js", array(), $the_theme->get('Version'), false);
  }

//Be sure to call AOS in footer of page by placing the following in footer:
// <script>
//  AOS.init();
// </script>

//   Enable featured images (post thumbnails)
  add_theme_support('post-thumbnails', array('post', 'page'));

// Add order functionality
function add_new_header_text_column($header_text_columns)
{
    $header_text_columns['menu_order'] = "Order";
    return $header_text_columns;
}
add_action('manage_edit-header_text_columns', 'add_new_header_text_column');

//Style backend and login page **Update Google Fonts link if necessary
function my_admin_theme_style() {
    wp_enqueue_style('custom-admin-theme', plugins_url('/css/styles.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
wp_enqueue_style('custom-admin-theme', plugins_url('/css/styles.css', __FILE__), 99);
wp_enqueue_style('google_font_admin', "https://fonts.googleapis.com/css?family=Crushed|Gothic+A1&display=swap", array());
add_action( 'login_enqueue_scripts', 'my_admin_theme_style');



// Make login logo redirect to homepage
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

// Replace "Powered by Wordpress" text on logo hover
function my_login_logo_url_title() {
    return 'Custom WordPress design by Extamus Media';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// Change login logo 
function my_login_logo() { ?>
<style type="text/css">
    #login h1 a,
    .login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri();
        ?>/img/login.png);
        min-height: 100%;
        width: 100%;
        background-size: contain;
        background-position: center;
        padding-bottom: 30px;
    }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Remove menu pages (uncomment to remove from backend menu)
function custom_remove_menu_pages() {
    if ( ! current_user_can( 'administrator' ) ) {
  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'jetpack' );                    //Jetpack* 
  // remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  // remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings
}}
add_action( 'admin_menu', 'custom_remove_menu_pages' );

// Remove dashboard widgets (uncomment to remove)
function remove_dashboard_meta() {
	if ( ! current_user_can( 'administrator' ) ) {
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	}
}
add_action( 'admin_init', 'remove_dashboard_meta' ); 

// Change number of columns in Dashboard (set $columns to desired number)
function shapeSpace_screen_layout_columns($columns) {
    $columns['dashboard'] = 1;
    return $columns;
    }
    add_filter('screen_layout_columns', 'shapeSpace_screen_layout_columns');
    
    function shapeSpace_screen_layout_dashboard() { return 1; }
    add_filter('get_user_option_screen_layout_dashboard', 'shapeSpace_screen_layout_dashboard');

function add_extamus_welcome()
{
    add_meta_box("extamus-welcome", "Extamus Welcome", "extamus_welcome_message", "dashboard", "normal", "high");
}

add_action("wp_dashboard_setup", "add_extamus_welcome");

// Add welcome message
function extamus_welcome_message(){ 
    ?>

<div class="bg-secondary p-4">
    <h1>Welcome to the new site! As a reminder:</h1>
    <ol class="p-2">
        <li>Dont forget this.</li>
        <li>Or this.</li>
        <li>And especially not this.</li>
    </ol>

    <p>Please dont hesitate to reach out at <a href="mailto:info@extamus.com">info@extamus.com</a> with any questions.
    </p>
</div>
<?php };

// Change footer text in backend
function change_admin_footer(){
	 echo '<span id="footer-note">Please dont hesitate to reach out to your friends at <a href="http://www.extamus.com/" target="_blank">Extamus Media</a> with any questions.</span>';
	}
add_filter('admin_footer_text', 'change_admin_footer');
?>