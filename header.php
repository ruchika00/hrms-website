<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header">

<div class="container header-flex">

    <!-- ✅ LOGO (FORCED FIX) -->
    <div class="logo">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="Logo">
    </div>

    <!-- ✅ NAVBAR -->
    <nav class="menu">
        <a href="#">Home</a>
        <a href="#">Features</a>
        <a href="#">Pricing</a>
        <a href="#">Contact</a>
    </nav>

    <!-- ✅ GET A QUOTE BUTTON -->
    <div class="header-btn">
        <a href="#" class="quote-btn">Get a Quote</a>
    </div>

</div>

</header>