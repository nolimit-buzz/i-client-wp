<?php
/**
 * Template Name: Image Upload
 */

get_header();

print_r($_FILES);
require_once(ABSPATH . 'wp-admin/includes/admin.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Image upload logic using media_handle_upload
    $uploaded_image = media_handle_upload('user_image', 0); // 0 is for the user ID (guest user)

    if (!is_wp_error($uploaded_image)) {
        // Image uploaded successfully, store attachment ID in user meta
        update_user_meta(get_current_user_id(), 'profile_image', $uploaded_image);
        echo "File uploaded successfully!";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$user_id = get_current_user_id();
$attachment_id = get_user_meta($user_id, 'profile_image', true);
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <h2>User Profile Image Upload</h2>

                <form action="" method="post" enctype="multipart/form-data">
                    <?php wp_nonce_field("upload_user_image"); ?>
                    <label for="user_image">Choose a profile image:</label>
                    <input type="file" name="user_image" id="user_image" accept="image/*">
                    <br>
                    <input type="submit" name="submit" value="Upload Image">
                </form>

                <?php
                if (!empty($attachment_id)) {
                    echo '<p>Profile Image:</p>';
                    echo wp_get_attachment_image($attachment_id, 'thumbnail');
                } else {
                    echo '<p>No profile image available.</p>';
                }
                ?>
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
