<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Subhash
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.o rg/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">




    <header class="site-header">
        <div class="container">
            <h1 class="school-logo-text float-left"><a href="<?php echo site_url('/') ?>"><strong>Fictional</strong> University</a></h1>
            <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
            <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
            <div class="site-header__menu group">
                <nav class="main-navigation">
                    <?php

                    $args = array(
                        'theme_location' => 'primary',
                        'sort_column' => 'menu_order'
                    );

                    ?>
                    <?php echo wp_get_nav_menu_name(wp_nav_menu(  $args )); ?>
                   <!-- <ul>


                       <!-- <li><a href="#">

                               </a></li>-->
                       <!-- <li><a href="#">Events</a></li>
                        <li><a href="#">Campuses</a></li>
                        <li><a href="#">Blog</a></li>-->

                </nav>
                <div class="site-header__util">
                    <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
                    <a href="#" class="btn btn--small  btn--dark-orange float-left">Sign Up</a>
                    <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </header>
    <div id="content" class="site-content">
