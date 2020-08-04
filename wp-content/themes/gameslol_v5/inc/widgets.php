<?php

/* REGISTER WIDGET AREAS */

if (function_exists('register_sidebar')) { 
	
	register_sidebar(
		array( 'name' => 'Sidebar', 
			  'id' => 'sidebar-widgets', 
			  'description' => 'Widgets for Sidebar', 
			  'before_widget' => '<div id="%1$s" class="home_widget_box">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h2 class="widget_title">',
			  'after_title'   => '</h2>' ));
	
	register_sidebar(
		array( 'name' => 'Homepage Spread', 
			  'id' => 'homepage-widgets', 
			  'description' => 'Widgets for Homepage below the main content and sidebar', 
			  'before_widget' => '<div id="%1$s" class="widget widget_homepage">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h2 class="widget_title">',
			  'after_title'   => '</h2><div class="clearfix"></div>' ));
	
	register_sidebar(
		array( 'name' => 'Footer 1', 
			  'id' => 'footer1-widgets', 
			  'description' => 'Widgets for footer area', 
			  'before_widget' => '<div id="%1$s" class="widget_footer">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h4 class="footer_title">',
			  'after_title'   => '</h4>' ));
	
	
	register_sidebar(
		array( 'name' => 'Footer 2', 
			  'id' => 'footer2-widgets', 
			  'description' => 'Widgets for footer area', 
			  'before_widget' => '<div id="%1$s" class="widget_footer">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h4 class="footer_title">',
			  'after_title'   => '</h4>' ));
	
	register_sidebar(
		array( 'name' => 'Footer 3', 
			  'id' => 'footer3-widgets', 
			  'description' => 'Widgets for footer area', 
			  'before_widget' => '<div id="%1$s" class="widget_footer">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h4 class="footer_title">',
			  'after_title'   => '</h4>' ));
	
	register_sidebar(
		array( 'name' => 'Footer 4', 
			  'id' => 'footer4-widgets', 
			  'description' => 'Widgets for footer area', 
			  'before_widget' => '<div id="%1$s" class="widget_footer">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h4 class="footer_title">',
			  'after_title'   => '</h4>' ));
  
  	/* TEMPORARY WIDGETS FOR NEW FRONTPAGE THEME */
	
	register_sidebar(
		array( 'name' => 'New Homepage Widgets', 
			  'id' => 'new-homepage-widgets', 
			  'description' => 'Widgets for Homepage below the main content and sidebar', 
			  'before_widget' => '<div id="%1$s" class="widget widget_homepage">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h2 class="widget_title">',
			  'after_title'   => '</h2><div class="clearfix"></div>' ));
  
	register_sidebar(
		array( 'name' => 'New Theme Footer (LEFT)', 
			  'id' => 'newtheme-widgets-left', 
			  'description' => 'Widgets for footer area (LEFT SIDE)', 
			  'before_widget' => '<div id="%1$s" class="widget_footer new_theme">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h4 class="footer_title">',
			  'after_title'   => '</h4>' ));

	register_sidebar(
		array( 'name' => 'New Theme Footer (RIGHT)', 
			  'id' => 'newtheme-widgets-right', 
			  'description' => 'Widgets for footer area (RIGHT SIDE)', 
			  'before_widget' => '<div id="%1$s" class="col widget_footer new_theme">',
			  'after_widget'  => '</div>',
			  'before_title'  => '<h4 class="footer_title">',
			  'after_title'   => '</h4>' ));
}

/* WIDGETS */

include 'widgets_languagelist.php';
include 'widgets_trendinglist.php';
include 'widgets_connect.php';
include 'widgets_taglist.php';
include 'widgets_categorylist.php';
include 'widgets_homegrid.php';

?>