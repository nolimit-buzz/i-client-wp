
<?php


 $user_id = get_current_user_id();  

// Get user data using user ID
$user_data = get_userdata($user_id);


// print_r($user_data);
if ($user_data) {
    // User email
    $user_email = $user_data->user_email;

    // User first name
    $user_first_name = $user_data->first_name;

    // User last name
    $user_last_name = $user_data->last_name;
    $user_login = $user_data->user_login;

    $password ="";
    $gender =  get_user_meta($user_id, 'gender', true);


 
}

?>

<div class="tab-content api">
        <div class="prompt-header">
            <div>BASIC INFORMATION</div>
        </div>


        <div class="api-cards">
        <form action="" method="post" enctype="multipart/form-data" id="profile_form">


            <div class="setting-column">
                <div class="profile-card"> 
                    <span class="api-label">First Name</span>
                    <input type="text" name="first_name"  value="<?php echo $user_first_name?>" placeholder="Olamide">
                </div>

                <div class="profile-card"> 
                    <span class="api-label">last Name</span>
                    <input type="text" name="last_name"  value="<?php echo $user_last_name?>" placeholder="samuel">
                </div>
            </div>


            <div class="setting-column">
                <div class="profile-card"> 
                    <span class="api-label">Username</span>
                    <input disabled type="text" value="<?php echo $user_login?>"  name="username" placeholder="Samuel">
                </div>

                <div class="profile-card"> 
                    <span class="api-label">Email </span>
                    <input type="email" name="email" value="<?php echo $user_email ?>"  placeholder="Segun" value="<?php echo esc_html($user_email)  ?>">
                    <input type="hidden" value="setting_api" name="action">
                    <input type="hidden" value="profile" name="function_cb">
                </div>
            </div>

            <div class="setting-column">
                <div class="profile-card"> 
                    <span class="api-label">Password</span>
                    <input  type="text" required value="<?php echo $password?>"  name="password" placeholder="*******">
                </div>

                <div class="profile-card"> 
                    <span class="api-label">Gender </span>
                    <select name="gender" >
                        <option <?php echo selected( $gender,"Male" )  ?> value="Male"> Male</option>
                        <option <?php echo selected( $gender,"Female" )  ?> value="Female"> Female</option>
                    </select>
                    
                </div>
            </div>
        

            <div class="setting-column">
                
                <div class="profile-card"> 
                    <span class="api-label">Profile Photo</span>
              
                    <input type="file" name="profile" placeholder="hi@xample">
                </div>
                
                 
            </div>
 
        </form>
       
        </div>

</div>
 


       

