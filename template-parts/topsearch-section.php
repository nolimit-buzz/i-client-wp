<div class="user">
<?php 


 

 $user_id = get_current_user_id();  
 $attachment_id = get_user_meta($user_id, 'profile_image', true);
   echo wp_get_attachment_image($attachment_id, 'thumbnail');
    ?>
    <div class="user-welcome">
        <div class="welcome">Welcome</div>
        <h5><?php echo ucfirst(get_user_by( "id", get_current_user_id() )->display_name);   ?></h5>
    </div>
</div>


<?php
 $model = get_option( "model");
 $max_tokens = get_option( "max_tokens");
 $temperature = get_option( "temperature");
$api_key = get_option( "api_key");
$presence_penalty = get_option( "presence_penalty");
 $frequency_penalty = get_option( "fequency_penalty");

if( 
    empty($model) ||  empty($max_tokens) || empty( $temperature) ||
    empty($api_key) ||  (  $presence_penalty < 0  ) || (  $frequency_penalty < 0 )
){
    echo "<div class='api-credential-missing'><b>Search Error!</b> Admin needs to setup API credentials</div>";
}else{
    echo '
    <div class="search"> <input type="text" name="internal_company" placeholder="Our Company"> </div>
    <div class="search"> <input type="text" name="external_company" placeholder="Customer Account"> </div>
    <div class="search-btn">
        <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M18.0006 16.0006H17.2106L16.9306 15.7306C18.1306 14.3306 18.7506 12.4206 18.4106 10.3906C17.9406 7.61063 15.6206 5.39063 12.8206 5.05063C8.59063 4.53063 5.03063 8.09063 5.55063 12.3206C5.89063 15.1206 8.11063 17.4406 10.8906 17.9106C12.9206 18.2506 14.8306 17.6306 16.2306 16.4306L16.5006 16.7106V17.5006L20.7506 21.7506C21.1606 22.1606 21.8306 22.1606 22.2406 21.7506C22.6506 21.3406 22.6506 20.6706 22.2406 20.2606L18.0006 16.0006ZM12.001 16.0006C9.51098 16.0006 7.50098 13.9906 7.50098 11.5006C7.50098 9.01061 9.51098 7.00061 12.001 7.00061C14.491 7.00061 16.501 9.01061 16.501 11.5006C16.501 13.9906 14.491 16.0006 12.001 16.0006Z"
                fill="white" />
        </svg>
        <span>Start Research </span>
    </div>
    ';
}

?>


