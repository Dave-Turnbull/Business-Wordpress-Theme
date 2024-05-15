<div class="container-fluid px-0 d-flex mt-auto text-left text-lg-center" id="nav-outer">
            <div class="container bg-white py-3" id="nav-container">
                <?php
                    wp_nav_menu( array(
                    'theme_location'    => 'footer-menu',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'nav',
                    'container_id'      => 'navbarfooter',
                    'menu_class'        => 'nav d-flex',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback', 
                    'walker'            => new WP_Bootstrap_Navwalker(),
                    ) );
                ?>
            </div>
        </div>
    </section>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="<?php echo get_bloginfo('template_directory'); ?>/scripts/script.js"></script>
  </body>
</html>
<?php wp_footer(); ?>
