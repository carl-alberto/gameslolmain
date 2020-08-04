<!doctype html>
<html xmlns="//www.w3.org/1999/xhtml" class="js no-touch csstransforms csstransitions js no-touch csstransforms csstransitions" lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="robots" content="noindex, follow">

<!-- PAGE TITLE -->
<title><?php echo bloginfo('name'); ?> - Review: <?php the_title(); ?></title>

<!-- STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Irish+Grover" rel="stylesheet">
<style>
	body { min-height: 100vh; overflow: hidden; }
	* {
		font-family: Open Sans, Arial, Helvetica, sans-serif;
		font-size: 12pt;
	}
	table{ width:100%; }
	.rr_review_form .form_table .rr_form_row .rr_form_heading { width: 100px; padding: 5px 15px 5px 0; }
	input, textarea {
		display: block;
		width: 100% !important; 
		padding: 3px;
	}
	textarea { height: 150px;  }
	input[type="submit"]{ width: auto !important; background: #018400; color: white; border: none; padding: 10px 30px; border-radius: 5px; }
</style>
<!-- FAVICON -->
<link rel="shortcut icon" type="image/png" href="<?php echo get_theme_mod( 'setting_favicon'); ?>"/> 
<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<?php wp_head(); ?>
</head>

<body>
	<div class="container-fluid">
		<?php 	
				global $post;
				$post_id = get_query_var('rrID');
				$post = get_post($post_id);
				if( !empty($post) ){
					setup_postdata( $post );
					echo do_shortcode('[RICH_REVIEWS_FORM category="post"]');
				}
		?>
	</div>
<?php wp_footer(); ?>	
</body>
</html>