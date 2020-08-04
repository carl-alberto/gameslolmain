<!doctype html>
<html xmlns="//www.w3.org/1999/xhtml" class="js no-touch csstransforms csstransitions js no-touch csstransforms csstransitions" lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">	

<!-- PAGE TITLE -->
<title>Now Playing: <?php the_title(); ?> | <?php echo bloginfo('name'); ?></title>

<!-- STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Irish+Grover" rel="stylesheet">
<style>
	body { min-height: 100vh; overflow: hidden; }
	* {
		font-family: Open Sans, Arial, Helvetica, sans-serif;
		font-size: 12pt;
	}
	.playerframe { width: 100%; height: 100vh; }
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
		
$slug = get_query_var('slug');

$args = array(
  'name'        => $slug,
  'post_type'   => 'minigame',
  'post_status' => 'publish',
  'numberposts' => 1
);
$posts = get_posts($args);
		
if( !empty($posts) ) {
	$post = $posts[0];
	setup_postdata( $post );
	
if( !empty($post) ){
	
$game_info = get_the_minigame_info(get_the_ID());
	
?>
<div class="playerframe">
<?php 
	switch( $game_info['embed_src'] ){
	case 'softgames': ?>
		
 		<?php if( $game_info['embed_name'] <> '' && $game_info['embed_name'] <> '' ) { ?>
			<script type='text/javascript' id=<?php echo $game_info['embed_id']; ?>>
				(function(d, gn,scriptId){
				var prop = {'agent': 'pub-12233-14774',
							'bgcolor':'#fff',
							'wrapperwidth':'100%',
							'wrapperheight':'100%',
							'gamewidth':'100%',
							'gameheight':'100%',
							'game_fullscreen_on_mobile':'true',
							'locale':'en'
						   };
				jsid = 'sgEmbedJS';
				if( d.getElementById(jsid) ) {
					embed(d,scriptId,gn, prop); 
				} else {
					var s = d.createElement('script'); s.id = jsid; s.type = 'text/javascript'; s.onload = function(){embed(d,scriptId,gn, prop);};
				s.src='//dop3jnx8my3ym.cloudfront.net/embedder.js'; d.getElementsByTagName('head')[0].appendChild(s);}
				}(document,'<?php echo $game_info['embed_name']; ?>',<?php echo $game_info['embed_id']; ?>));
			</script>
		<?php } else { ?>
			<br/>
			<p align="center">No player code found!</p>
		<?php }
	break;
	case 'gamepix': 
	?>
		<iframe style="height: 100%; width: 100%;" src="https://games.gamepix.com/play/<?php echo $game_info['embed_id']; ?>?sid=110861" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
		<?php 
	
	break;
	case 'gamedistribution': 
	?>
		<iframe style="height: 100%; width: 100%;" src="https://html5.gamedistribution.com/<?php echo $game_info['embed_id']; ?>" width="100%" height="100%" frameborder="0" scrolling="none"></iframe>
		<?php 
		}
	}
}	
?>
</div>	
<?php wp_footer(); ?>	
</body>
</html>