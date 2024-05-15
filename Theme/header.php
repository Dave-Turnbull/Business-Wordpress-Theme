<!doctype html>
<html lang="en">
  <head>
 <!--functions.php removes the need for hard coded title
 <title><?php echo get_bloginfo( 'name' ); ?></title>-->

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="<?php echo get_bloginfo( 'name' ); ?>" />
    <meta name="description" content="A wordpress website"/>
    <meta name="author" content="David Turnbull">

    <!-- og:metas-->
    <meta property='og:title' content="<?php echo get_bloginfo( 'name' ); ?>" />
    <meta property="og:description" content="A wordpress website" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link href="<?php echo get_bloginfo('template_directory'); ?>/css/styles.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <?php wp_head(); ?>  
  </head>
  <body>
    <section class="fullpage container-fluid d-flex flex-column" id="homepage">
        <div class="container mx-auto pt-5 header-section mb-5">
            <div class="row">
                <div class="col-12 p-3 bg-white d-flex flex-column text-center header-outer">
                    <div class="row">
                        <div class="col-12 col-md-10">
                                <h1>Welcome to <?php echo get_bloginfo( 'name' ); ?></h1>
                                <p>
                                <?php echo get_bloginfo( 'description' ); ?>
                                </p>
                                <?php
                                    $value = get_theme_mod('second_tagline');
                                    if (!empty($value)) { 
                                ?>
                                    <div class="alert alert-danger p-1 mb-0" role="alert">
                                            <p class="mb-0"><?php echo get_theme_mod( 'second_tagline' ); ?></p>
                                    </div>
                                <?php
                                    } 
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container content-section mb-5">
            <div class="row">
                <nav class="navbar navbar-expand-lg py-2 py-lg-0 px-2 mx-auto mx-lg-0 d-flex justify-content-between" id="nav">
                <div class="container-fluid px-0 ">
                        <button class="navbar-toggler mb-1" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#navbarToggler" aria-controls="navbarToggler" 
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="collapse navbar-collapse text-center d-flex justify-content-between" id="navbarToggler">
		                	<?php
                            wp_nav_menu( array(
                            'theme_location'    => 'main-navigation',
                            'depth'             => 2,
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse',
                            'container_id'      => 'navbarToggler',
                            'menu_class'        => 'nav navbar-nav d-flex justify-content-between',
                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'            => new WP_Bootstrap_Navwalker(),
                            ) );
                            ?>
                        </div>
                    </div>
                </nav>