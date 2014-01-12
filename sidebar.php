<?php if ( is_active_sidebar('primary_widget_area') ) : ?>
                <div id="primary" class="widget-area">
                        <ul class="xoxo">
                                <?php dynamic_sidebar('primary_widget_area'); ?>
                        </ul>
                </div><!-- #primary .widget-area -->
<?php else: ?>
				<div id="primary" class="widget-area">
                        <ul class="xoxo">
                        
                        	<li id="default-widget-1" class="widget-container default-widgets">
                        		<h3 class="widget-title"><?php _e( 'Archives', 'nano-blogger' ); ?></h3>   
                                <ul>                         
									<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                                </ul>
							</li> <!-- #default-widget-1 -->
                            
                            <li id="default-widget-2" class="widget-container default-widgets">
                        		<h3 class="widget-title"><?php _e( 'Pages', 'nano-blogger' ); ?></h3>   
                                <ul>                         
									<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
                                </ul>
							</li> <!-- #default-widget-2 -->
                            
                        </ul> <!-- .xoxo -->
                </div><!-- #primary .widget-area -->
<?php endif; ?>         
                
<?php if ( is_active_sidebar('secondary_widget_area') ) : ?>
                <div id="secondary" class="widget-area">
                        <ul class="xoxo">
                                <?php dynamic_sidebar('secondary_widget_area'); ?>
                        </ul>
                </div><!-- #secondary .widget-area -->
<?php else: ?>
				<div id="secondary" class="widget-area">
                        <ul class="xoxo">
                        
                        	<li id="default-widget-3" class="widget-container default-widgets">
                        		<h3 class="widget-title"><?php _e( 'Categories', 'nano-blogger' ); ?></h3>                            
								<ul>
									<?php wp_list_categories( 'sort_column=menu_order&title_li=' ); ?>
                                </ul>
							</li> <!-- #default-widget-3 -->
                            
                            <li id="default-widget-4" class="widget-container default-widgets">
                        		<h3 class="widget-title"><?php _e( 'Meta', 'nano-blogger' ); ?></h3>                            
								<ul>
									<?php wp_register(); ?>
                                    <li><?php wp_loginout(); ?></li>
                                    <?php wp_meta(); ?>
                                </ul>
							</li> <!-- #default-widget-4 -->
                            
                        </ul> <!-- .xoxo -->
                </div><!-- #secondary .widget-area -->
<?php endif; ?>