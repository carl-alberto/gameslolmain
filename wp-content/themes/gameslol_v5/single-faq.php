<?php get_header(); 

if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	$faq_info = get_the_faq_info(get_the_id());
	$game = get_post($faq_info['relatedgame']);
	$relatedgame = get_the_game_info($game->ID);

?>
	<div id="faqpage" class="container-fluid page downloadpage <?php echo $templateclass; ?>"
		data-gametitle="<?php echo get_the_title($game->ID);?>"
		data-postID="<?php echo $game->ID;?>"
		data-downloadlink="<?php echo $relatedgame['link']; ?>"
		data-downloadlink-mac="<?php echo $relatedgame['link_mac']; ?>"
		data-downloadlink-mobile="<?php echo $relatedgame['link_apk']; ?>"
		data-packagename="<?php echo $relatedgame['app_id']; ?>"
		data-os="PC" >
		
		<section id="gameheader" class="container-fluid">
			<div class="sectioncontent container">
				<?php if($relatedgame['icon'] <> "" ){ ?>
				<div id="game_icon">
					<a href="<?php echo get_the_permalink($game->ID); ?>"><img class="game_icon <?php echo $relatedgame['flipped']; ?>" src="<?php echo $relatedgame['icon']; ?>"
							alt="<?php echo $relatedgame['icon_alt']; ?>"
							title="<?php echo $relatedgame['icon_alt'];  ?>" ></a>
				</div>
				<?php } ?>
				<div id="game_meta">
					<div class="meta_title">
					<h2 id="title" class="notranslate"><?php echo get_the_title($game->ID); ?></h2>
					<p class="meta developer"><?php echo $relatedgame['developer']; ?></p>
					</div>
					<?php echo do_shortcode('[addtoany]'); ?>
				</div>
				<div id="game_title">
					<p class="meta categories"><?php the_category(' ', multiple, $game->ID); ?></p>
				</div>
			</div>
		</section>
		<h1 id="page_title" class="container" align="center">
			<?php the_title(); ?>
		</h1>
		<section id="faqcontent" class="container-fluid">
			<div class="sectioncontent container">
				<?php the_content(); ?>
					
					
					<?php 
					if( !wp_get_post_parent_id( get_the_ID() ) ) { ?>

							<?php
							global $FAQ_POSTS_PER_PAGE;
							$posts_per_page = $FAQ_POSTS_PER_PAGE;
    						$current_page = ( get_query_var( 'faqpaged' ) ) ? get_query_var( 'faqpaged' ) : 1;
							$query = new WP_Query( array(
											'post_type' => 'faq',
											'post_parent' => get_the_ID(),
											'posts_per_page' => $posts_per_page,
											'paged' => $current_page
									) );
							
									if ( $query->have_posts() ) : ?>
										<div class="faq-loop container-fluid" id="easyPaginate">
										<?php		
										while ( $query->have_posts() ) : $query->the_post(); 
													include( locate_template( 'loop/content_faq.php', false, false ) );
										endwhile; ?>
											
										<?php get_the_faq_pages($query, true); ?>
										</div>
									<?php endif; ?>
							<?php } ?>

			</div>
		</section>
			<p align="center">
            <?php 
				wp_reset_postdata();
				if( wp_get_post_parent_id( get_the_ID() ) ) { 
					$parent_id = wp_get_post_parent_id( get_the_ID() );
					$relatedgame_id = get_post_meta($parent_id, "faq_relatedgame", "single");
				?>
					<a href="<?php echo get_the_permalink(wp_get_post_parent_id( get_the_ID() )); ?>" class="btn btn-sm btn-secondary">Back to <b><?php echo get_the_title($relatedgame_id); ?></b> FAQ</a>
				<?php } ?>
            <a href="<?php echo get_the_permalink(get_page_by_path('faq')->ID); ?>" class="btn btn-sm btn-warning">Back to All Games FAQ</a></p>
		<?php 
				if($relatedgame['floatingbutton'] <> "") { ?>
				
				<div id="gamebutton" class="stick">
				<img class="gameimg"
					src="<?php echo $relatedgame['floatingbutton']; ?>"
					alt="<?php echo $relatedgame['floatingbutton_alt']; ?>"
					title="<?php echo $relatedgame['floatingbutton_alt'];  ?>" > 
					<button class="goDownload downloadbtn" data-ga-category="Article" data-ga-action="Floating-Button-Download">
						<span class="btn_text">PLAY NOW</span></button>
				
			<?php 
				} ?>
			
				  
			</div>
			
		<!----- LIGHTBOX FOR DOWNLOAD ----->
		<?php 
			$arrowlogo = $relatedgame['floatingbutton'];
			$lightboxicon = $game_info['icon'];
			include 'inc/game_lightbox.php'; ?>
		
</div>

<?php endwhile; else : ?>
	
		<h1>Page not found</h1>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		
<?php endif; 
get_footer(); ?>