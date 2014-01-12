<?php
/*
* Template Name: Full Width Template
*
* Special template file for nano blogger
* developed by: nanodesigns
*
*/
get_header(); ?>
        
                <div id="container">    
                        <div id="content" style="width: 980px;">
                        
								<?php the_post(); ?>
                                
                                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                
                                        <h1 class="entry-title"><?php the_title(); ?></h1>
                                        
                                        <div class="entry-content">
                                        	<?php the_post_thumbnail(); ?>
											<?php the_content(); ?>
                                            <div class="clear"></div>
											<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'nano-blogger' ) . '&after=</div>') ?>                                       
                                            <?php edit_post_link( __( 'Edit', 'nano-blogger' ), '<span class="edit-link">', '</span>' ) ?>
                                        </div><!-- .entry-content -->
                                        
                                </div><!-- #post-<?php the_ID(); ?> -->                 
                        
								<?php comments_template( '', true ); ?>
                        
                        </div><!-- #content -->    
                             
                </div><!-- #container -->
                
<?php get_footer(); ?>