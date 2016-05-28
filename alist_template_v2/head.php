<? @session_start(); ?><head>  
  <meta charset="<?php bloginfo( 'charset' ); ?>">  <title>
  <?php if (is_home () ) { bloginfo(‘name’); echo ' | '; echo get_bloginfo ( 'description' ); }
  elseif ( is_category() ) { single_cat_title(); echo ' - '; bloginfo('name'); echo ' | '; echo get_bloginfo ( 'description' ); }
  elseif (is_single() ) { single_post_title(); echo ' | '; echo get_bloginfo ( 'description' );}
  elseif (is_page() ) { single_post_title();echo ' | '; echo get_bloginfo ( 'description' );}
  else { wp_title('', true, right); echo ' | '; echo get_bloginfo ( 'description' );} ?>
  </title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css">
  <?php do_action('wp_head'); ?>
</head>
