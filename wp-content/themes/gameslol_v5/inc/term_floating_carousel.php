<?php
if( is_category() | is_tag() ){
	
	$the_term_id = get_queried_object()->term_id;;
	if($the_term_id){ ?>

		<div id="term_floating_carousel" class="floating_carousel" >
			<div class="carousel">
			<div class="carousel_box">
				<ul>
				<?php
				
				$args = array(
						'orderby'        => 'rand',
						'post_type'		 => 'post',
						'posts_per_page' => 20,
					//	'order'			 => 'DESC',
					);
			
				if(is_post_type_archive('unblockedgame')){
						$args['post_type'] = 'unblockedgame';
				}
			
				if( is_category() ){
					$args['cat'] = $the_term_id;
				} elseif( is_tag() ) {
					$args['tag_id'] = $the_term_id;
				}

					$the_query = get_posts( $args ); 

					foreach ( $the_query as $post ) : setup_postdata( $post ); ?>

					<?php // include( locate_template( 'loop/content_floating_carousel.php', false, false ) ); ?>

					<?php endforeach; ?>
				</ul>
			</div>
			<!--	<button class="carousel_button prev" data-goto="prev">PREV</button>
					<button class="carousel_button next" data-goto="next">NEXT</button> -->
			</div>
		</div>

<?php }
} ?>