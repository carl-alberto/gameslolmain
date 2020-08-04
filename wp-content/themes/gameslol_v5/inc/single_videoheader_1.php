<!--- SINGLE TEMPLATE 1 ---->

<style type="text/css">
#single_header{ background-image: url(<?php echo $feat_img; ?>) !important; background-size:contain; }
.modal-content { background-color: #333; }
</style>




	<?php	if($game_info['banner'] <> "" ){ ?>
			<section id="gamebanner" class="container-fluid">
				
				<div class="slideroverlay">
						<h2><?php the_title(); ?></h2>
							<button class="goDownload downloadbtn nochange" data-template="1" data-ga-category="Game" data-ga-action="Left-Banner-Download">
							<span class="btn_text">PLAY NOW!</span></button>
					</div>

				<video class="video_overlay" autoplay muted loop >
						<source src="<?php echo $game_info['header_video'] ?>" type="video/mp4">
						Your browser does not support the video tag.
				</video>
			</section>
		<?php } ?>
		