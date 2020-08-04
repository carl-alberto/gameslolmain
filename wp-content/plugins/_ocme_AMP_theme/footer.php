</div>
	<?php
	if ( is_active_sidebar( 'footer1-widgets' ) | is_active_sidebar( 'footer2-widgets' ) | is_active_sidebar( 'footer3-widgets' ) )
	{ ?>
		
<div class="footer-widgets">
<div class="container">
<?php 
	if ( is_active_sidebar( 'footer1-widgets' ) ) { ?>
		 <?php dynamic_sidebar( 'footer1-widgets' ); ?>
<?php } ?>

<?php 
	if ( is_active_sidebar( 'footer2-widgets' ) ) { ?>
		 <?php dynamic_sidebar( 'footer2-widgets' ); ?>
<?php } ?>

<?php 
	if ( is_active_sidebar( 'footer3-widgets' ) ) { ?>
		 <?php dynamic_sidebar( 'footer3-widgets' ); ?>
<?php } ?>

</div>
</div>
		
<?php } ?>
<footer class="footer">
	<div class="container">
		Copyright &copy; 2018 <a href="<?php echo site_url(); ?>"><?php echo bloginfo('name'); ?></a><br/>
		All Rights Reserved. <br/>
		<a href="<?php echo site_url(); ?>" class="view-non-amp">View Non-AMP Version</a>
	</div>
</footer>
<?php amp_footer_core(); ?>