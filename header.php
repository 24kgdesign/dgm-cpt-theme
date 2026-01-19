<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Title -->
  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

  <!-- Styles & Fonts -->
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- header.php -->
<div class="bg-img" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/danny_hero_1024.jpg');"></div>
<div class="grid-container">


<!-- Header & Navbar -->
<header>
  <nav class="navbar">
    <div id="nav-logo">
      <a href="<?php echo home_url(); ?>" class="nav-logo-link">
        
        <h2>Danny Godinez</h2>
      </a>
    </div>

    <ul class="nav-menu">
      <li class="nav-item"><a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link">Home</a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('/#events-div')); ?>" class="nav-link">Shows</a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('/#music-title')); ?>" class="nav-link">Music</a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('/#videos-title')); ?>" class="nav-link">Videos</a></li>
      <li class="nav-item"><a href="<?php echo esc_url(get_permalink( get_page_by_path( 'gallery' ) ) ); ?>" class="nav-link">Gallery</a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('/#about-title')); ?>" class="nav-link">About</a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('/#contact-title')); ?>" class="nav-link">Contact</a></li>
    </ul>

    <!-- Hamburger Icon -->
    <div class="hamburger">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
  </nav>


</header>
