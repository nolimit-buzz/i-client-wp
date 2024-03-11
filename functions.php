<?php
/**
 * Account planner functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Account Planner
 * @since Account Planner 1.0
 */

/**
 * Register block styles.
 */

 require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.


 
if ( ! function_exists( 'accountplanner_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function accountplanner_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}

endif;

// add_action( 'after_setup_theme', 'accountplanner_support' );
 


// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);



add_action('wp_ajax_handle_login','handle_login' );
add_action('wp_ajax_nopriv_handle_login','handle_login' );

 

function handle_login(){
    // print_r($_POST);
    
  
    $creds = array(
    'user_login'    => sanitize_user($_POST['log']),
    'user_password' => esc_attr($_POST['pwd']),
    'remember'      => true
    );

  $user = wp_signon( $creds, false );

    if(!is_wp_error($user)){  
      
      // If login is successful, set authentication cookies
    wp_set_auth_cookie($user->ID, true);
    wp_set_current_user($user->ID);

    // Manually set other authentication-related cookies
    $secure_cookie = is_ssl() ? true : false;

    // Set wordpress_sec_{hash} cookie
    $secure_cookie ? setcookie('wordpress_sec_' . COOKIEHASH, $user->sec, 0, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie) : false;

    // Set wp-settings-{user_id} cookie
    setcookie('wp-settings-' . $user->ID, 'library=1&uploader=1&editor=html', time() + 3600, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie);

    // Set wordpress_logged_in_{hash} cookie
    $secure_cookie ? setcookie('wordpress_logged_in_' . COOKIEHASH, $user->logged_in_cookie, 0, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie) : false;
  
        $result = "success";
     

    }else{
     $result =   $user->get_error_message();
    }

    echo $r;


}

// functions.php
function custom_login_endpoint() {
    register_rest_route('wp/v2', '/users/login/', array(
        'methods' => 'POST',
        'callback' => 'custom_login_callback',
    ));
}

function custom_login_callback($data) {
    $user = wp_signon(array(
        'user_login'    => $data['log'],
        'user_password' => $data['pwd'],
        'remember'      => true,
    ), false);

    if (is_wp_error($user)) {
        return array('result' => $user->get_error_message());
    }

   // If login is successful, set authentication cookies
    wp_set_auth_cookie($user->ID, true);
    wp_set_current_user($user->ID);

    // // Manually set other authentication-related cookies
    // $secure_cookie = is_ssl() ? true : false;

    // // Set wordpress_sec_{hash} cookie
    // $secure_cookie ? setcookie('wordpress_sec_' . COOKIEHASH, $user->sec, 0, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie) : false;

    // // Set wp-settings-{user_id} cookie
    // setcookie('wp-settings-' . $user->ID, 'library=1&uploader=1&editor=html', time() + 3600, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie);

    // // Set wordpress_logged_in_{hash} cookie
    // $secure_cookie ? setcookie('wordpress_logged_in_' . COOKIEHASH, $user->logged_in_cookie, 0, COOKIEPATH, COOKIE_DOMAIN, $secure_cookie) : false;


    return array('result' => "success");
}

add_action('rest_api_init', 'custom_login_endpoint');



// functions.php
if ((current_user_can('subscriber') || current_user_can('author') ) && !is_admin()) {
    add_filter('show_admin_bar', '__return_false');
}

function redirect_login_page() {

    $user = get_user_by('id',get_current_user_id());
 
    // if(  current_user_can('author') || current_user_can('subscriber') ){

        $login_url  = home_url( '/register' );
        $url = basename($_SERVER['REQUEST_URI']); // get requested URL

        ( ($url === "wp-admin") || isset( $_REQUEST['redirect_to']) || isset($_REQUEST['loggedout']) ) ? ( $url   = "wp-login.php" ): 0; // if users ssend request to wp-admin
        if( $url  == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET')  {
            wp_redirect( $login_url );
            exit;
         }
    // }

}
// add_action('init','redirect_login_page');
  

// Logout users when they click on the logout link
function logout_redirect_home() {
    wp_redirect(home_url('/register'));
    exit;
}
add_action('wp_logout', 'logout_redirect_home');
 

// Restrict access to wp-login.php and admin for non-admin users
function restrict_access_to_admin_pages() {
    // Check if user is not logged in
    if (!is_user_logged_in() && !is_page('register') && !is_front_page() ) {
        // Redirect non-logged-in users to home page
        wp_redirect(home_url('/register'));
        exit;

       
    }

}
add_action('template_redirect', 'restrict_access_to_admin_pages');

// Restrict access to wp-admin for non-admin users
function restrict_admin_access() {
    if (!current_user_can('administrator') && is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX )) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('init', 'restrict_admin_access');


/**
 * Classes
 */
// src\classes\Init::init();



AccountPlannerWP\Classes\AccountPlanner::get_instance();
// require get_template_directory() . '/src/Classes/AccountPlanner.php';
require get_template_directory() . '/src/Classes/PostTypes.php';