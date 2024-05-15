<!-- Header -->
<?php /*
Template Name: Archives
*/
get_header(); ?>
    <div class="col-12 text-left bg-white" id="content">
        <div class="row">
        
            <?php if ( have_posts() ) : ?>
                <div class="col-12">
                            <div class="header-text pb-2 mb-2 pt-3 ps-3 ps-lg-4">
                                <?php the_archive_title( '<h3 class="mb-0">', '</h3>' ); ?>
                            </div>

                    <!-- the loop-->
                    <div class="row text-center m-0 py-3 justify-content-center" id="staff-cards">
                        <?php while ( have_posts() ) : the_post();?>
                            <div class="col-12 col-md-6 col-xl-4 mb-3">
                                <div class="staff-info d-block w-100 bg-white shadow p-3">
                                    <div class="staff-img d-block mx-auto mb-2">
                                        <?php if ( has_post_thumbnail() ): ?>
                                            <div class="archive-post-thumbnail-container">
                                                <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail(); ?>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                        <div class="empty-archive-post-thumbnail-container">
                                                <a href="<?php the_permalink(); ?>">
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>">
                                        <h4><?php the_title(); ?></h4>
                                    </a>
                                    <?php the_excerpt(); ?>
                                    <hr>
                                    <p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        else :?>
                            <div class="col-12 col-md-6 col-xl-4 mb-3">
                            <div class="staff-img d-block mx-auto mb-2" style='padding:10px; margin-top:10px;'>
                                <h4>There isn't anything here.</h4>
                                <a href="javascript:window.history.back();">
                                    <h5>Go Back</h5>
                                </a>
                            </div>
                            </div>
                        <?php endif;
                        ?>
                    </div>
                    <!-- Content -->
                </div>                    
        </div>
    </div>
</div>
</div>    
<!-- Footer -->
<?php get_footer(); ?>
