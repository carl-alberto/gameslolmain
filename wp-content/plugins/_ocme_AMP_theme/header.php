<?php amp_header_core() ?>
<header class="header">
 <div class="container">
  <div class="header-logo">
  	<a href="<?php echo site_url(); ?>/amp">
	<amp-img class="amp-logo" src="<?php echo get_theme_mod('setting_logo'); ?>"
				alt="<?php echo bloginfo('name'); ?>"
				layout="fixed" width="250" height="39">

				<?php /*
				<img
				src="<?php echo get_theme_mod('setting_logo'); ?>"
				alt="<?php echo bloginfo('name'); ?>">
				*/ ?>

				<?php 
				/* <noscript><img
				// src="<?php echo get_theme_mod('setting_logo'); ?>"
				// alt="<?php echo bloginfo('name'); ?>"></noscript>
				*/ ?>
				</amp-img>
	</a>
  </div>
  <div class="header-right">
		<?php amp_sidebar(['action'=>'open-button']); ?>
  </div>
  </div>
</header>

<div class="clearfix"></div>


<?php /* amp_sidebar(['action'=>'start',
    'id'=>'sidebar',
    'layout'=>'nodisplay',
    'side'=>'right'
] );*/ ?>
<amp-sidebar id="sidebar" layout="nodisplay" side="right">
<?php amp_sidebar(['action'=>'close-button']); ?>
<?php amp_menu(); ?>
<?php //amp_search();?>
<?php // amp_social(); ?> 
<?php //amp_sidebar(['action'=>'end']); ?>
</amp-sidebar>

<div class="content-wrapper">