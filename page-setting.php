<?php
/*
Template Name: Setting
*/ 

get_header();

$logo = get_template_directory_uri()."/img/logo.svg";
$challenges_logo = get_template_directory_uri()."/img/challenges.svg";
$insight_logo = get_template_directory_uri()."/img/insight.svg";
$capability_logo = get_template_directory_uri()."/img/capacity.svg";
$impact_logo = get_template_directory_uri()."/img/impact.svg";
$value_logo = get_template_directory_uri()."/img/value.svg";
$ham = get_template_directory_uri()."/img/ham.svg";
?>


<!-- header section -->
<?php get_template_part( "template-parts/header","section");  ?>

<section class="body">
    <div class="body-container">
        <div class="nav">

            <!-- sidemenu -->
            <?php get_template_part( "template-parts/sidemenu","section");  ?>

        </div>
        <div class="content">

            <div class="setting-nav">
                <div class="the-left">
                    <div class="s-nav-ite"><svg width="15" height="18" viewBox="0 0 15 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.5429 16.1948H0.9064C0.667014 16.1948 0.437433 16.2899 0.268161 16.4592C0.0988896 16.6284 0.00379361 16.858 0.00379361 17.0974C0.00379361 17.3368 0.0988896 17.5664 0.268161 17.7356C0.437433 17.9049 0.667014 18 0.9064 18H13.5429C13.7823 18 14.0119 17.9049 14.1811 17.7356C14.3504 17.5664 14.4455 17.3368 14.4455 17.0974C14.4455 16.858 14.3504 16.6284 14.1811 16.4592C14.0119 16.2899 13.7823 16.1948 13.5429 16.1948ZM0.9064 14.3896H0.987635L4.7515 14.0466C5.16381 14.0055 5.54944 13.8238 5.84366 13.5321L13.9671 5.40864C14.2824 5.07554 14.4528 4.63105 14.441 4.17255C14.4291 3.71405 14.236 3.27894 13.9039 2.96257L11.4308 0.48943C11.108 0.186241 10.685 0.012275 10.2424 0.000625288C9.79967 -0.0110245 9.36814 0.140455 9.02986 0.426248L0.9064 8.54971C0.614647 8.84393 0.432987 9.22955 0.391914 9.64186L0.00379361 13.4057C-0.00836544 13.5379 0.00878894 13.6712 0.0540338 13.796C0.0992786 13.9208 0.1715 14.0341 0.26555 14.1278C0.349889 14.2115 0.449912 14.2777 0.559884 14.3226C0.669855 14.3675 0.787611 14.3903 0.9064 14.3896ZM10.1762 1.75308L12.6403 4.2172L10.8351 5.97728L8.41609 3.55829L10.1762 1.75308Z"
                                fill="#1C344F" />
                        </svg></div>


                            <?php
                            $user = get_user_by('id',get_current_user_id());
                            // print_r($user);


                            if(  array_intersect($user->roles,['subscriber','author','administrator']) ){
                                echo"
                                <div class='s-nav-item active'>Profile</div>";
                                }

                                if( array_intersect($user->roles,['author','subscriber','administrator']) ){
                                    echo"<div class='s-nav-item'>Prompts </div>";
                                    }

                            if(  array_intersect($user->roles,['author','administrator'])){
                            echo"
                            <div class='s-nav-item '>Users</div>";
                            }

                           


                            if( array_intersect($user->roles,['author','administrator']) ){
                            echo" <div class='s-nav-item'>API Settings </div>";
                            }

                          
                            ?>
                            
                </div>

                <div class="the-right">

                    <div class="save-btn">
                        <span><svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16.6814 10.915C16.7187 10.6163 16.7467 10.3177 16.7467 10.0003C16.7467 9.68299 16.7187 9.38433 16.6814 9.08566L18.6507 7.54566C18.8281 7.40566 18.8747 7.15366 18.7627 6.94833L16.8961 3.71899C16.7841 3.51366 16.5321 3.43899 16.3267 3.51366L14.0027 4.44699C13.5174 4.07366 12.9947 3.76566 12.4254 3.53233L12.0707 1.05899C12.0427 0.834992 11.8467 0.666992 11.6134 0.666992H7.88006C7.64673 0.666992 7.45073 0.834992 7.42273 1.05899L7.06806 3.53233C6.49872 3.76566 5.97606 4.08299 5.49073 4.44699L3.16673 3.51366C2.95206 3.42966 2.70939 3.51366 2.59739 3.71899L0.730725 6.94833C0.609392 7.15366 0.665392 7.40566 0.842725 7.54566L2.81206 9.08566C2.77473 9.38433 2.74673 9.69233 2.74673 10.0003C2.74673 10.3083 2.77473 10.6163 2.81206 10.915L0.842725 12.455C0.665392 12.595 0.618725 12.847 0.730725 13.0523L2.59739 16.2817C2.70939 16.487 2.96139 16.5617 3.16673 16.487L5.49073 15.5537C5.97606 15.927 6.49872 16.235 7.06806 16.4683L7.42273 18.9417C7.45073 19.1657 7.64673 19.3337 7.88006 19.3337H11.6134C11.8467 19.3337 12.0427 19.1657 12.0707 18.9417L12.4254 16.4683C12.9947 16.235 13.5174 15.9177 14.0027 15.5537L16.3267 16.487C16.5414 16.571 16.7841 16.487 16.8961 16.2817L18.7627 13.0523C18.8747 12.847 18.8281 12.595 18.6507 12.455L16.6814 10.915ZM9.74673 13.267C7.94539 13.267 6.48006 11.8017 6.48006 10.0003C6.48006 8.19899 7.94539 6.73366 9.74673 6.73366C11.5481 6.73366 13.0134 8.19899 13.0134 10.0003C13.0134 11.8017 11.5481 13.267 9.74673 13.267Z"
                                    fill="white" />
                            </svg></span>
                        <span>Save</span>
                    </div>
                </div>

            </div>

            <div class="setting-content-cover">
                <!-- user template -->
                <?php
                 if( array_intersect($user->roles,['author','subscriber','administrator']) ){
                    get_template_part( "template-parts/settings/setting","profile"); 
                }

                if( array_intersect($user->roles,['author','subscriber','administrator']) ){
                    get_template_part( "template-parts/settings/setting","prompt");   
                }

                if( array_intersect($user->roles,['author','administrator']) ){
                    get_template_part( "template-parts/settings/setting","users");  
                    }

                   
               
                


                    if( array_intersect($user->roles,['author','administrator']) ){ 
                        get_template_part( "template-parts/settings/setting","api");  
                    }
                ?>

            </div>
        </div>
    </div>
</section>


<!-- Add user Popup process -->

<section class="popup-process create_user">
    <div class="popup-process-container">
        <div class="pclose">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="28" height="28" rx="14" fill="#E6E7EA"></rect>
                <path d="M18 18L10 10" stroke="#3B3D40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path d="M18 10L9.99998 18" stroke="#3B3D40" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </div>

        <div class=" ">
            <div class="prompt-header">
                <div>ADD USER</div>
            </div>


            <div class="api-cards">
                <form action="" method="post" id="create_user">

                    <div class="setting-column">
                        <div class="profile-card">
                            <span class="api-label">First Name</span>
                            <input type="text" name="first_name" placeholder="Olamide">
                        </div>

                        <div class="profile-card">
                            <span class="api-label">last Name</span>
                            <input type="text" name="last_name" placeholder="samuel">
                        </div>
                    </div>


                    <div class="setting-column">
                        <div class="profile-card">
                            <span class="api-label">Username</span>
                            <input type="text" name="username" placeholder="Samuel">
                            <input type="hidden" name="action" value="create_user" placeholder="Samuel">
                        </div>

                        <div class="profile-card">
                            <span class="api-label">Email </span>
                            <input type="email" autocomplete="off" name="email" placeholder="Segun">

                        </div>
                    </div>

                    <div class="setting-column">
                        <div class="profile-card">
                            <span class="api-label">Password</span>
                            <input type="text" name="password" placeholder="****">
                        </div>

                    </div>

                    <div class="setting-column">
                        <div class="profile-card">
                            <input type="submit" value="Create User" name="create_user">
                        </div>

                    </div>

                </form>


            </div>

        </div>

    </div>
</section>
<!-- END Add user Popup process -->







<!-- Add user Popup process -->

<section class="popup-process edit_user">
    <div class="popup-process-container">
        <div class="pclose">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="28" height="28" rx="14" fill="#E6E7EA"></rect>
                <path d="M18 18L10 10" stroke="#3B3D40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
                <path d="M18 10L9.99998 18" stroke="#3B3D40" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </div>

        <div class=" ">
            <div class="prompt-header">
                <div>EDIT USER</div>
            </div>


            <div class="api-cards">
                <form action="" method="post" id="edit_user">

                    <div class="setting-column">
                        <div class="profile-card">
                            <span class="api-label">First Name</span>
                            <input type="text" name="first_name" placeholder="Olamide">
                        </div>

                        <div class="profile-card">
                            <span class="api-label">last Name</span>
                            <input type="text" name="last_name" placeholder="samuel">
                        </div>
                    </div>


                    <div class="setting-column">
                        <div class="profile-card">
                            <span class="api-label">Username</span>
                            <input type="text" name="username" placeholder="Samuel">
                            <input type="hidden" name="action" value="edit_user">
                        </div>

                        <div class="profile-card">
                            <span class="api-label">Email </span>
                            <input type="email" autocomplete="off" name="email" placeholder="Segun">

                        </div>
                    </div>

                    <div class="setting-column">
                        <div class="profile-card">
                            <span class="api-label">Set Password</span>
                            <input type="text" name="password" placeholder="****">
                        </div>

                    </div>

                    <div class="setting-column">
                        <div class="profile-card">
                            <input type="hidden" name="user_id">

                            <input type="submit" value="Update User" name="create_user">
                        </div>

                    </div>

                </form>


            </div>

        </div>

    </div>
</section>
<!-- END Add user Popup process -->






<?php
get_footer();