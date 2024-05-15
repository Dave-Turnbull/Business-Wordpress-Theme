<!-- Header -->
<?php get_header(); ?>
        <div class="col-12 text-left bg-white" id="content">
            <div class="row">
                <!-- Content -->
                <div class="col-12 col-lg-8 pt-3 ps-3 ps-lg-4">
                    <!-- Post loop -->
                    <?php
	            		if ( have_posts() ) : while ( have_posts() ) : the_post();
                            get_template_part( 'content', get_post_format() );
	             		endwhile; endif;
	        		?>
                    
                </div>
                <!--Check for front page-->
                <?php if ( is_front_page() ) { ?>
                    <!-- Sidebar -->
                    <div class="col-12 col-lg-4 pt-3">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
                </div>
            </div>
            </div>
        </div>
        <!-- Footer -->
        <?php get_footer(); ?>
