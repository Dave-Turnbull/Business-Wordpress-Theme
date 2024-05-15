<!-- Header -->
<?php get_header(); ?>
        <div class="col-12 text-left bg-white" id="content">
            <div class="row">
                <!--Check for front page-->
                <?php if ( is_front_page() ) { ?>
                    <!-- Content -->
                    <div class="col-12 col-lg-8 pt-3 ps-3 ps-lg-4">
                        <!-- Post loop -->
                        <?php the_content(); ?>
                        
                    </div>
                    <!-- Sidebar -->
                    <div class="col-12 col-lg-4 pt-3">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } else { ?>
                    <!-- Content -->
                    <div class="col-12 pt-3 ps-3 ps-lg-4 pb-4">
                        <div class="header-text pb-2 mb-2 pt-3 ps-1">
                            <h3 class="mb-0"><?php the_title(); ?></h2>
                        </div>
                        <!-- Post loop -->
                        <?php the_content(); ?>
                        
                    </div>
                <?php } ?>
                </div>
            </div>
            </div>
        </div>
        <!-- Footer -->
        <?php get_footer(); ?>
