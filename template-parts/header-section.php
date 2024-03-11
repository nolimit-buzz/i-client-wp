<?php

$logo = get_template_directory_uri()."/img/logo.svg";
$ham = get_template_directory_uri()."/img/ham.svg";
$dashboard = get_permalink(get_page_by_path( "register") );
$logout = wp_logout_url($dashboard) ;

$setting = get_permalink(get_page_by_path( "settings") );
$profile = site_url($setting) ;
?>

<section class="header">
   <div class="header-container">
        <div class="header-left">
            <div  class="logo" id="menu-trigger"> <img src="<?php echo $ham  ?>" alt=""></div>
            <div class="logo"> <img src="<?php echo $logo  ?>" alt=""></div>
        </div>

        <div class="header-right">
            <span class="profile"  onclick="window.open('<?php echo $setting  ?>','_self') ">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19 14C20.66 14 21.99 12.66 21.99 11C21.99 9.34 20.66 8 19 8C17.34 8 16 9.34 16 11C16 12.66 17.34 14 19 14ZM11 14C12.66 14 13.99 12.66 13.99 11C13.99 9.34 12.66 8 11 8C9.34 8 8 9.34 8 11C8 12.66 9.34 14 11 14ZM11 16C8.67 16 4 17.17 4 19.5V21C4 21.55 4.45 22 5 22H17C17.55 22 18 21.55 18 21V19.5C18 17.17 13.33 16 11 16ZM19 16C18.71 16 18.38 16.02 18.03 16.05C18.05 16.06 18.06 16.08 18.07 16.09C19.21 16.92 20 18.03 20 19.5V21C20 21.35 19.93 21.69 19.82 22H25C25.55 22 26 21.55 26 21V19.5C26 17.17 21.33 16 19 16Z" fill="#D2D6DC"/></svg>
            </span>
            <span class="logout" onclick="window.open('<?php echo $logout  ?>','_self') ">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.9 21V21.1H3H12H12.1V21V19V18.9H12H5.1V5.1H12H12.1V5V3V2.9H12H3H2.9V3V21ZM15.9274 17.0688L15.9981 17.1433L16.0707 17.0707L21.0707 12.0707L21.1414 12L21.0707 11.9293L16.0707 6.92929L15.9981 6.85668L15.9274 6.93119L14.5524 8.38119L14.4854 8.45185L14.5543 8.52071L16.9336 10.9H9H8.9V11V13V13.1H9H16.9336L14.5543 15.4793L14.4854 15.5481L14.5524 15.6188L15.9274 17.0688Z" fill="#D2D6DC" stroke="#D2D6DC" stroke-width="0.2"/></svg>            
            </span>
        </div>

   </div>
</section>