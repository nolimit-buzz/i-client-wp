<?php
/*
Template Name: Project
*/ 

get_header();

 
use AccountPlannerWP\Classes\AccountPlanner;
 


$searches = AccountPlanner::get_instance()->get_saved_search("");


$logo = get_template_directory_uri()."/img/logo.svg";
$ham = get_template_directory_uri()."/img/ham.svg";
$logo_circle = get_template_directory_uri()."/img/logo-circle.svg";


?>


<section class="header">
   <div class="header-container">
        <div class="header-left">
            <div  class="logo" id="menu-trigger"> <img src="<?php echo $ham  ?>" alt=""></div>
            <div class="logo"> <img src="<?php echo $logo  ?>" alt=""></div>
        </div>

        <div class="header-right">

        </div>

   </div>
</section>

<section class="body">
    <div class="body-container">
        <div class="nav">

          <!-- sidemenu -->
          <?php get_template_part( "template-parts/sidemenu","section");  ?> 


        </div>
        <div class="content">

            <div class="heading">
                <h1> Saved accounts </h1>
               
            </div>


            <div class="project-cards">

            <?php

            if($searches){

                $user_id =  wp_get_current_user()->ID ;

                    foreach ($searches as $key => $search) {
                    $id = $search->ID ;
                    $date = $search->post_date ;
                    $single_project = get_permalink( get_page_by_path( "dashboard"))."?pid=$id&&user_id=$user_id";

                    echo"
                    <a href='$single_project'>
                    <div class='project-card'>
                    <div class='top'> $date</div>
                    <div class='bottom'>
                    <span>$search->post_title</span>
                    <img class='logo-circle' src='$logo_circle' alt=''> 
                    </div>
                    </div></a>";
                    }

                }
            ?>


            </div>
                <?php

                if(empty($searches)){
                    echo "<div style='text-align:center;width:100%'> You have saves accounts </div>";
                }

                ?>

        </div>
    </div>
</section>


<?php
get_footer();