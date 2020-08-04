<?php
	$the_tax = get_queried_object();
	$tax_terms = get_option( "taxonomy_term_".$the_tax->term_id );
?>

<div id="archivepage"
	 class="container-fluid page archivepage"
		data-os="PC" >
	<div id="pageheader" class="container-fluid section_bg">
		<div class="row">
			<div class="col-12 col-md-3">
			</div>
			<div class="col">
				<h2 align="center" class="archive_subtitle">
					<?php echo single_term_title( '', false ); ?>
				</h2>
			</div>
			<div id="archive_share" class="col-12 col-md-3 text-center text-md-right">
				<?php echo do_shortcode("[addtoany]"); ?>
			</div>
		</div>
	</div>
	<div id="pagecontent" class="container">
		<h1 id="page_title" align="center">
		<?php if($tax_terms['custom_title'] <> "") {
				echo $tax_terms['custom_title'];
			  } else {
				echo single_term_title( '', false );
				}
		?></h1>

		<div id="term_description" class="container" align="center">
			<p>
			<?php echo term_description($the_tax->term_id); ?>
			</p>
		</div>

		<?php if($tax_terms['video_url'] <> "" ){ 
				$video_link = explode('/', $tax_terms['video_url']);
				$video_id = $video_link[4];
				$video_link_watch = "https://www.youtube.com/watch?v=" . $video_id;
			 $video_thumbnail = "https://i.ytimg.com/vi/". $video_id ."/hqdefault.jpg";
		?>
			<style>
					#term_video.mobile {
					background-image: url('<?php echo $video_thumbnail; ?>');
					}
			</style>
		<div id="term_video" class="container-fluid text-center">
				
				<iframe width="853" height="505" border="0" style="border: none;"
                	src="https://www.youtube.com/embed/<?php echo $video_id; ?>?autoplay=0&">
                </iframe>
				<div id="video_player_link">
						<a href="<?php echo $video_link_watch; ?>" target="_blank">
								<span class="fa fa-play"></span><br/>
								Click here for video
						</a>
				</div>
		</div>
			
		<?php } ?>
		
		<?php 
		// 	include ( locate_template ('inc/term_floating_carousel.php') ); 
		?>
			
		<div id="term_top_posts" class="grid grid_game container cq">
		<?php
			$args = array(
					'orderby'        => 'postdate',
					'post_type'		 => 'post',
					'posts_per_page' => 20,
					'order'			 => 'DESC',
				 	'cat'  			 => $the_tax->term_id
				);
				
				if( is_post_type_archive('unblockedgame') | get_query_var( 'post_type' ) == 'unblockedgame' ){
						$args['post_type'] = 'unblockedgame';
				}

				$the_query = get_posts( $args ); 
				foreach ( $the_query as $post ) : setup_postdata( $post ); ?>
				
				<?php include( locate_template( 'loop/content_grid_game.php', false, false ) ); ?>

				<?php endforeach; ?>
			
		</div>
		
		
		<br /><br />	
		
		<div id="term_content" class="container">
			<?php $the_content = stripslashes($tax_terms['custom_content']);
				echo apply_filters('the_content', $the_content); ?>
			
		</div>
			
			
		<?php
		
		if(have_posts()) : ?>
		<div id="term_all_posts" class="grid grid_game container">
		<?php 
		$cardCounter = 0;
		while(have_posts()) : the_post(); 
			$cardCounter++; 
          if($cardCounter <= 200){
              include( locate_template( 'loop/content_grid_game.php', false, false ) );
          }
		endwhile;?>
		</div>
		<div id="pagination" align="center" class="container-fluid">
			<!-- Display pagination, if applicable -->
			<?php get_the_archive_pages(); ?>
		</div>
		<br>
		
			<p align="center"><br>
				<?php if( is_post_type_archive('unblockedgame') | get_query_var( 'post_type' ) == 'unblockedgame' ){
					?><a href="<?php echo get_the_permalink(get_page_by_path('android')->ID); ?>" class="btn btn-sm btn-warning">Back to All Unblocked Games</a>
					<?php
				  } 
				?>
			</p>
		<!----- LIGHTBOX FOR DOWNLOAD ----->
		
		<?php 
			$arrowlogo = get_theme_mod( 'setting_logo');
			$lightboxicon = get_theme_mod( 'setting_logo');
			include 'inc/game_lightbox.php'; ?>
		
			<!----- LIGHTBOX FOR PLAY ----->
			<?php
			include( locate_template( 'inc/minigame_popup.php', false, false ) );
			?>	
		
	<?php else : ?>
	<p align="center">No posts found.</p>
	<?php endif; ?>	
			
			
	</div>
	
</div>