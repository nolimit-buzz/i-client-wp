<!doctype html>
<html>

<head>
  
  

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
        <?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?>
    </title>
    <!-- Font Awesome CDN via https://fontawesomecdn.com/ -->
    <!-- <script src="https://use.fontawesome.com/f225807e61.js"></script> -->
    <!-- <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <!-- font -->
    <!-- <link href="https://fonts.cdnfonts.com/css/avenir" rel="stylesheet"> -->

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <?php if ($post->ID == 21737) { echo '<meta name="robots" content="noindex,nofollow">'; } ?>
    <!-- <script src="https://use.fontawesome.com/f225807e61.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
    <?php wp_head(); ?>
</head>

<body>
 