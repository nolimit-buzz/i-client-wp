<?php
/*
Template Name: Register
*/ 

get_header();
$logo = get_template_directory_uri()."/img/logo.svg";
$ham = get_template_directory_uri()."/img/ham.svg";

// Logout user
// wp_set_current_user(0);÷

?>

 

<div class="register-section">

    <section class="register-section-container">
        <div class="banner ">
            <h3 class="banner-text">Be Productive</h3>
            <p class="banner-text">Finish daily task the smart way</p>
            
        </div>
        
        <div class="login-content">
        
            <div class="center">
                <div class="logo"> <img src="<?php echo $logo  ?>" alt=""></div>
                <h5 class="register-welcome-text">Welcome to Account Planner</h5>
                <div class="login-register-switch">
                    <span id="login-btn" class="login-btn register-login-btn active">LOGIN</span>
                    <span id="register-btn" class="register-btn register-login-btn " >REGISTER</span>
                </div>
            </div>

                <div class="login-room">
                    <p class="registerinstruction"></p>

                    <p class='login-error' > </p>

                    <div class="register-form">
                        <form method="POST" action="" id="login_user">
                         

                            <div class="username-field">
                                <label for="username">User name</label>
                                <input id="username" name="log" type="text" placeholder="Enter your User name">
                            </div>

                            <div class="password-field">
                                <label for="password">Password</label>
                                <input id="password" name="pwd" type="password" placeholder="Enter your password">
                                <input   name="action" value="handle_login" type="hidden">
                                <!-- <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_517_7195)">
                                <path d="M8.86279 6.14899L11.4395 8.72568L11.4518 8.59071C11.4518 7.23691 10.3516 6.13672 8.99776 6.13672L8.86279 6.14899Z" fill="#1C344F"/>
                                <path d="M8.99795 4.50005C11.2556 4.50005 13.0879 6.33238 13.0879 8.59005C13.0879 9.11765 12.9816 9.62072 12.7976 10.0829L15.1902 12.4755C16.4254 11.4448 17.3988 10.1115 18 8.59005C16.5808 4.99906 13.092 2.45508 8.99798 2.45508C7.85278 2.45508 6.75669 2.65956 5.73828 3.02766L7.50515 4.79043C7.96727 4.61048 8.47034 4.50005 8.99795 4.50005Z" fill="#1C344F"/>
                                <path d="M0.817983 2.27146L2.68301 4.13649L3.05521 4.50869C1.70552 5.56391 0.638037 6.96678 0 8.59048C1.41515 12.1815 4.90798 14.7254 8.99797 14.7254C10.2659 14.7254 11.4765 14.48 12.5849 14.0342L12.9326 14.3819L15.317 16.7704L16.36 15.7316L1.86093 1.22852L0.817983 2.27146ZM5.34153 6.7909L6.60533 8.0547C6.56852 8.23059 6.54398 8.40643 6.54398 8.59048C6.54398 9.94427 7.64417 11.0445 8.99797 11.0445C9.18202 11.0445 9.3579 11.0199 9.52968 10.9831L10.7935 12.2469C10.2495 12.5169 9.64421 12.6805 8.99797 12.6805C6.7403 12.6805 4.90798 10.8481 4.90798 8.59048C4.90798 7.94427 5.07159 7.33894 5.34153 6.7909Z" fill="#1C344F"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_517_7195">
                                <rect width="18" height="18" fill="white"/>
                                </clipPath>
                                </defs>
                                </svg> -->
                            </div>

                            <div class="register-button">
                                <!-- <input type="hidden" name="action" value="account_planner_login" /> -->
                                <input class="register-btn"  value="LOGIN"  type="submit">
                            </div>


                        </form>

                    </div>
                </div>

                <div class="register-room">
                    <p class="registerinstruction"></p>
                    <p class='register-error' > </p>

                    <div class="register-form">
                        <form method="POST" action="#" id="register_user">
                            <div class="email-field">
                                <label for="email">Email Address</label>
                                <input  type="hidden" name="action" value="create_user" >
                                <input required name="email" type="email" placeholder="Enter your Email Address">
                            </div>

                            <div class="username-field">
                                <label for="username">User name</label>
                                <input required id="username" name="username" type="text" placeholder="Enter your User name">
                            </div>

                            <div class="password-field">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" placeholder="Enter your password">
                                <!-- <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_517_7195)">
                                <path d="M8.86279 6.14899L11.4395 8.72568L11.4518 8.59071C11.4518 7.23691 10.3516 6.13672 8.99776 6.13672L8.86279 6.14899Z" fill="#1C344F"/>
                                <path d="M8.99795 4.50005C11.2556 4.50005 13.0879 6.33238 13.0879 8.59005C13.0879 9.11765 12.9816 9.62072 12.7976 10.0829L15.1902 12.4755C16.4254 11.4448 17.3988 10.1115 18 8.59005C16.5808 4.99906 13.092 2.45508 8.99798 2.45508C7.85278 2.45508 6.75669 2.65956 5.73828 3.02766L7.50515 4.79043C7.96727 4.61048 8.47034 4.50005 8.99795 4.50005Z" fill="#1C344F"/>
                                <path d="M0.817983 2.27146L2.68301 4.13649L3.05521 4.50869C1.70552 5.56391 0.638037 6.96678 0 8.59048C1.41515 12.1815 4.90798 14.7254 8.99797 14.7254C10.2659 14.7254 11.4765 14.48 12.5849 14.0342L12.9326 14.3819L15.317 16.7704L16.36 15.7316L1.86093 1.22852L0.817983 2.27146ZM5.34153 6.7909L6.60533 8.0547C6.56852 8.23059 6.54398 8.40643 6.54398 8.59048C6.54398 9.94427 7.64417 11.0445 8.99797 11.0445C9.18202 11.0445 9.3579 11.0199 9.52968 10.9831L10.7935 12.2469C10.2495 12.5169 9.64421 12.6805 8.99797 12.6805C6.7403 12.6805 4.90798 10.8481 4.90798 8.59048C4.90798 7.94427 5.07159 7.33894 5.34153 6.7909Z" fill="#1C344F"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_517_7195">
                                <rect width="18" height="18" fill="white"/>
                                </clipPath>
                                </defs>
                                </svg> -->
                            </div>

                            <div class="register-button">
                                <input class="register-btn"  value="REGISTER"  type="submit">
                            </div>


                        </form>

                    </div>
                </div>

        </div>
    </section>

</div>


<?php
get_footer();