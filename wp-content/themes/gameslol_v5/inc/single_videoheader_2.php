<!--- SINGLE TEMPLATE 2 ---->


<style type="text/css">
/*** MODIFIED VIDEO HEADER ***/
#single_header{ background-image: url(<?php echo $feat_img; ?>) !important; background-size:contain; }
.modal-content { background-color: #555; }
</style>




		<?php if($game_info['banner'] <> "" ){ ?>
			

<section id="gamebanner" class="container-fluid">													
				
			 <?php
					if($game_info['header_video'] <> ""){
					?>
							<button class="goDownload downloadbtn ybtn" data-template="ybtn" data-ga-category="Game" data-ga-action="Center-Banner-Download"><span class="btn_text">PLAY NOW!</span></button>

							<video class="video_overlay" autoplay muted loop >
								<source src="<?php echo $game_info['header_video']; ?>" type="video/mp4">
								<!--<?php echo site_url(); ?>/wp-content/uploads/2018/05/FNFA2_2.mp4-->
								Your browser does not support the video tag.
							</video>
				<?php
				}
				else{
				?>
					<img class="banner" src="<?php echo $game_info['banner']; ?>"
								alt="<?php echo $game_info['banner_alt']; ?>"
								title="<?php echo $game_info['banner_alt'];  ?>" >
					<div class="overlay">
						<?php if($game_info['floatingbutton'] <> "" ){ ?>
						<div class="gameimg">
							<img src="<?php echo $game_info['floatingbutton']; ?>"
										alt="<?php echo $game_info['floatingbutton_alt']; ?>"
										title="<?php echo $game_info['floatingbutton_alt'];  ?>" >
						</div>
						<?php } ?>

							<button class="goDownload downloadbtn" data-template="2" data-ga-category="Game" data-ga-action="Center-Banner-Download">
									<span class="btn_text">PLAY NOW</span>
							</button>
					</div>
		<?php
				}
		?>
			</section>
		<?php } ?>