<?php

 

// print_r(get_users(
//     array('role'    => 'subscriber',
//         'orderby' => 'ID',
//         'order'   => 'ASC'
//     )
// ));

$subscribers = get_users(
    array('role'    => 'subscriber',
        'orderby' => 'ID',
        'order'   => 'ASC'
    )
);


// print_r($subscribers);


?>


<div class="tab-content users">



<div class="user-header">
                <div class="left-header">
                    <div class=""> <img src="<?php echo $user_icon  ?>" alt=""></div>
                    <div>Users</div>
                </div>

                <div class="right-header">
                    <div class="add-user">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0003 4.66602C8.84833 4.66602 4.66699 8.84735 4.66699 13.9993C4.66699 19.1514 8.84833 23.3327 14.0003 23.3327C19.1523 23.3327 23.3337 19.1514 23.3337 13.9993C23.3337 8.84735 19.1523 4.66602 14.0003 4.66602ZM17.7337 14.9327H14.9337V17.7327C14.9337 18.246 14.5137 18.666 14.0003 18.666C13.487 18.666 13.067 18.246 13.067 17.7327V14.9327H10.267C9.75366 14.9327 9.33366 14.5127 9.33366 13.9993C9.33366 13.486 9.75366 13.066 10.267 13.066H13.067V10.266C13.067 9.75268 13.487 9.33268 14.0003 9.33268C14.5137 9.33268 14.9337 9.75268 14.9337 10.266V13.066H17.7337C18.247 13.066 18.667 13.486 18.667 13.9993C18.667 14.5127 18.247 14.9327 17.7337 14.9327Z" fill="white"/></svg>
                        <span>Add New User</span>
                    </div>
                </div>

            </div>


           

            <div class="user-cards">

                <div class="user-cards-header">
                    <span>Username</span>
                    <span>First Name</span>
                    <span>Last name</span>
                    <span>Email</span>
                </div>
                <div class="user-cards-body">
                  
                
                <?php
                foreach ($subscribers as $key => $subscriber) {
                    $user_id = $subscriber->ID;
                    $email = $subscriber->user_email;
                    $display = $subscriber->display_name;
                    $username = $subscriber->user_login;
                    $firstname = $subscriber->first_name;
                    $lastname = $subscriber->last_name;
               
                
                   echo "<div class='user-card'>
             
                   <span class='username'>$username</span>
                   <span class='firstname'>$firstname</span>
                   <span class='lastname'>$lastname</span>
                   <span class='user-email-colum email' >$email</span>
               
                   <span class='user-controls'>
                       <span class='control user_id' title='ID: ($user_id)'>$user_id</span>
                       <span class='control edit_user'> edit</span>
                       <span class='control delete_user'> delete</span> 
                   </span> 
                </div>";
                }
                   ?>
                </div>
              
            </div>
</div>




