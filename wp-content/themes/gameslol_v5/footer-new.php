</section>

<!-- MARCH UPDATE: CHANGE FOOTER ON HOMEPAGE -->
<!-- NEW FOOTER -->
<footer class="new_theme">
	<!-- LOGO & SOCMED -->
	<div class="container-fluid">
		<div class="footer_branding row justify-content-between">
			<div class="footer_logo col-auto">
				<a href="<?php echo $site_url; ?>">
				<?php if( get_theme_mod( 'setting_logo') <> "" ) { ?>
				<img alt="<?php echo bloginfo('name'); ?> free game download website logo" title="<?php echo bloginfo('name'); ?> free game download website logo" src="<?php echo get_theme_mod( 'setting_logo'); ?>" />
				<?php } else {
				?><?php echo bloginfo('name'); ?><?php
			}
				?>
				</a>
			</div>
			<div class="footer_socmed col-auto">
					<a class="socialmedia" title="<?php echo get_theme_mod('footer_sm_1_title'); ?>" target="_blank"
					   href="<?php echo get_theme_mod('footer_sm_1_link'); ?>">
						<img src="<?php echo get_theme_mod('footer_sm_1_icon'); ?>" alt="<?php echo get_theme_mod('footer_sm_1_title'); ?>"></a>
					
					<a class="socialmedia" title="<?php echo get_theme_mod('footer_sm_2_title'); ?>" target="_blank"
					   href="<?php echo get_theme_mod('footer_sm_2_link'); ?>">
						<img src="<?php echo get_theme_mod('footer_sm_2_icon'); ?>" alt="<?php echo get_theme_mod('footer_sm_2_title'); ?>"></a>
				
					<a class="socialmedia" title="<?php echo get_theme_mod('footer_sm_3_title'); ?>" target="_blank"
					   href="<?php echo get_theme_mod('footer_sm_3_link'); ?>">
						<img src="<?php echo get_theme_mod('footer_sm_3_icon'); ?>" alt="<?php echo get_theme_mod('footer_sm_3_title'); ?>"></a>
				
					<a class="socialmedia" title="<?php echo get_theme_mod('footer_sm_4_title'); ?>" target="_blank"
					   href="<?php echo get_theme_mod('footer_sm_4_link'); ?>">
						<img src="<?php echo get_theme_mod('footer_sm_4_icon'); ?>" alt="<?php echo get_theme_mod('footer_sm_4_title'); ?>"></a>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-sm-12 col-lg-5 footer-left">
				<?php 
	 			if ( is_active_sidebar( 'newtheme-widgets-left' ) ) { ?>
	 			<div id="newtheme-widgets-left" class="container-fluid">
					 <?php dynamic_sidebar( 'newtheme-widgets-left' ); ?>
				</div>
				<?php } ?>
			</div>
			<div class="col-sm-12 col-lg-7 footer-right d-flex align-items-start flex-column">
					<?php 
					if ( is_active_sidebar( 'newtheme-widgets-right' ) ) { ?>
					<div id="newtheme-widgets-right" class="container-fluid">
						<div class="row">
						 <?php dynamic_sidebar( 'newtheme-widgets-right' ); ?>
						</div>
					</div>
					<?php } ?>
				  <div class="footer_text container-fluid mt-auto">
					<?php echo wpautop(wp_kses_post(get_theme_mod('footer_text'))); ?>	  
				  </div>
				  <div class="footer_copyright container-fluid text-center ">
					<?php echo wpautop(wp_kses_post(get_theme_mod('footer_copyright'))); ?>	  
				  </div>
				  <div class="footer_menu container-fluid ">
							<?php
									if ( has_nav_menu( 'footer-menu' ) ) {
									  wp_nav_menu( array( 
										'theme_location' => 'footer-menu',
										'container' => false,
										'depth' => 1  ) );
								} ?>
						</div>
				</div>
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