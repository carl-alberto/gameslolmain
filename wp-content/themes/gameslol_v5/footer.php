</section>

<?php

if(!check_chromeOS()) {

	if ( is_active_sidebar( 'footer1-widgets' ) | is_active_sidebar( 'footer2-widgets' ) | is_active_sidebar( 'footer3-widgets' ) )
	{ ?>

		<section id="footer-widgets" class="container-fluid">
			<div class="container-fluid">
				<div class="row justify-content-center">
			
			<?php 
	 			if ( is_active_sidebar( 'footer1-widgets' ) ) { ?>
	 			<div id="footer_widgets_1" class="col-12 col-md-6 col-lg-3">
					 <?php dynamic_sidebar( 'footer1-widgets' ); ?>
				</div>
			<?php } ?>
			
			<?php 
	 			if ( is_active_sidebar( 'footer2-widgets' ) ) { ?>
	 			<div id="footer_widgets_2" class="col-12 col-md-6 col-lg-3">
					 <?php dynamic_sidebar( 'footer2-widgets' ); ?>
				</div>
			<?php } ?>
			
			<?php 
	 			if ( is_active_sidebar( 'footer3-widgets' ) ) { ?>
	 			<div id="footer_widgets_3" class="col-12 col-md-6 col-lg" style="display:none;">
					 <?php dynamic_sidebar( 'footer3-widgets' ); ?>
				</div>
			<?php } ?>
			
			<?php 
	 			if ( is_active_sidebar( 'footer4-widgets' ) ) { ?>
	 			<div id="footer_widgets_4" class="col-12 col-md-12 col-lg-6">
					 <?php dynamic_sidebar( 'footer4-widgets' ); ?>
				</div>
			<?php } ?>
				</div>
			</div>
		</section>
		<section id="footer-widgets" class="container-fluid">
			<div class="container">
			<p>Games.lol is your No. 1 download site for <a href="<?php echo $site_url;?>" title="<?php bloginfo('name');?>">free online games</a> for PC, Mac, and APK. We have popular 
			games such as <a title="Granny Download | Play Online on PC | #1 Best Free Horror Games" href="/granny/">Granny</a>, <a title="Subway Surfers Free Download for PC | #1 Online Unblocked Game" href="/subway-surfers/">Subway Surfers</a>, <a title="Pixel Gun 3D Download for PC | Pocket Edition Updates, Hack, Cheats &amp; Guns" href="/pixel-gun-3d-pocket-edition/">Pixel Gun 3D</a>, <a title="Play 8 Ball Pool for PC online | Free Unblocked Download" href="/8-ball-pool/">8 Ball Pool</a>, <a title="Download Mobile Legends Bang Bang Game for PC | Guide, Heroes and Hacks | Games.lol" = href="/mobile-legends-bang-bang/">Mobile Legends Bang Bang</a> and others. Games.lol 
			provides cheats, tips, hacks, tricks and walkthroughs for all games.</p>
			</div>
		</section>
		
<?php }
}?>

<footer class="container-fluid" role="footer">
	<div class="container text-light container-expand">
		<?php 
			$site_url = site_url('','https');
			if(check_chromeOS()) { $site_url = get_post_type_archive_link( 'minigame' ); }
		?>
		<div class="copyright notranslate">Copyright &copy; <?php echo date("Y"); ?> <?php bloginfo('name');?>. All Rights Reserved. <br/>
			<span style="color:#CCC;">611 Gateway Blvd <br/>South San Francisco, CA 94080 USA <br/><br/></span>
		</div>
		<div class="footermenu">
			<?php
					if ( has_nav_menu( 'footer-menu' ) ) {
					  wp_nav_menu( array( 
						'theme_location' => 'footer-menu',
						'container' => false,
						'depth' => 1  ) );
				} ?>
		</div>
	</div>
</footer>

<!-- INCLUDE SCHEMA, GOOGLE ANALYTICS, ETC -->
<?php include( locate_template( 'footer_more.php', false, false ) ); ?>

<?php	
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
</body>
</html>