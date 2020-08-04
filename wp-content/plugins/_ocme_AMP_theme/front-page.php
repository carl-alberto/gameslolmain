<!-- FRONT PAGE -->

<?php amp_title(); ?>
<?php amp_content(); ?>


<?php if ( is_active_sidebar( 'sidebar-widgets' ) )
		{ 
			dynamic_sidebar( 'sidebar-widgets' );
		} 
?>

<?php if ( is_active_sidebar( 'homepage-widgets' ) )
		{ 
			dynamic_sidebar( 'homepage-widgets' );
		} 
?>

