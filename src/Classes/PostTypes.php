<?php 

// Register Custom Post Type
function create_search_result_post_type() {
    $labels = array(
        'name'                  => _x( 'Search Results', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Search Result', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Search Results', 'text_domain' ),
        'all_items'             => __( 'All Search Results', 'text_domain' ),
        'add_new_item'          => __( 'Add New Search Result', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Search Result', 'text_domain' ),
        'edit_item'             => __( 'Edit Search Result', 'text_domain' ),
        'update_item'           => __( 'Update Search Result', 'text_domain' ),
        'view_item'             => __( 'View Search Result', 'text_domain' ),
        'search_items'          => __( 'Search Search Result', 'text_domain' ),
    );

    $args = array(
        'label'                 => __( 'search_result', 'text_domain' ),
        'description'           => __( 'Custom Search Result Post Type', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-search',
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'search-results' ),
    );

    register_post_type( 'search_result', $args );
}
add_action( 'init', 'create_search_result_post_type' );

// Add Custom Fields
function add_search_result_custom_fields() {
    add_post_type_support( 'search_result', 'custom-fields' );
    add_meta_box( 'search_result_meta_box', 'Search Result Custom Fields', 'display_search_result_meta_box', 'search_result', 'normal', 'high' );
}
add_action( 'admin_init', 'add_search_result_custom_fields' );

// Display Meta Box
function display_search_result_meta_box( $post ) {
    // Use nonce for verification
    wp_nonce_field( basename( __FILE__ ), 'search_result_nonce' );

    // Custom fields array
    $custom_fields = array(
        'challenges' => 'Challenges',
        'insight'   => 'Insights',
        'capability' => 'Capability',
        'impact'     => 'Impact',
        'hypothesis' => 'Hypothesis',
        // 'company_name' => 'Company name',
        'external_company' => 'About client company',
        'external_company' => 'About client company',
        'internal_company_logo' => 'About internal company logo',
        'external_company_logo' => 'About external company logo',
        'both_company' => 'Both company',
        'about_company' => 'About company',
    );

    // Display custom fields
    foreach ( $custom_fields as $field_key => $field_label ) {
        $field_value = get_post_meta( $post->ID, $field_key, true );
        echo '<label for="' . $field_key . '">' . $field_label . '</label>';
        echo '<textarea id="' . $field_key . '" name="' . $field_key . '" style="width: 100%;" rows="4">' . esc_textarea( $field_value ) . '</textarea><br>';
    }
}

// Save Custom Fields
function save_search_result_custom_fields( $post_id ) {
    // Verify nonce
    if ( !isset( $_POST['search_result_nonce'] ) || !wp_verify_nonce( $_POST['search_result_nonce'], basename( __FILE__ ) ) ) {
        return;
    }

    // Save custom fields
    $custom_fields = array(
        'challenges',
        'insight',
        'capability',
        'impact',
        'hypothesis',
        // 'company_name', 
        'external_company',  
        'internal_company',  
        'internal_company_logo',  
        'external_company_logo',  
        'both_company',  
        'about_company',  
    );

    foreach ( $custom_fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post', 'save_search_result_custom_fields' );
