<!-- Header -->
<?php /*
Template Name: Archives
*/
get_header(); ?>
    <div class="col-12 text-left bg-white" id="content">
        <div class="row">
        
            <?php if ( have_posts() ) : ?>
                <div class="col-12 p-3">
                            <div class="header-text pb-2 mb-2 pt-3 ps-1">
                                <?php the_archive_title( '<h3 class="mb-0">', '</h3>' ); ?>
                            </div>
                            <p class="ps-1">By clicking on a file link it will download to your device.</p>

                    <!-- the loop-->
                    <div class="row m-0 py-3" id="downloads">
                        <?php while ( have_posts() ) : the_post();?>
                            <div class="downloads">
                                <a 
                                    title=
                                        "<?php echo strip_tags( $post->post_excerpt ); ?>" 
                                    href=
                                        "<?php 
                                            $file_url = get_post_meta( get_the_ID(), 'download', true );
                                            echo !empty($file_url['file']) ? $file_url['file'] : '';
                                        ?>" 
                                    class=
                                        "download-button btn d-inline-block" download>
                                    <i class="fas fa-file-download"></i>
                                    <p class="mb-0">
                                        <?php the_title(); ?>
                                    </p>
                                </a>
                        <?php
                        endwhile;
                        else :
                        // No Post Found
                        endif;
                        ?>
                    </div>
                    <!-- Content -->

                </div>  
            </div>
            </div>                  
        </div>
    </div>
</div>
</div>    
<!-- Footer -->
<?php get_footer(); ?>
