<!doctype html>
<html xmlns="//www.w3.org/1999/xhtml" class="js no-touch csstransforms csstransitions js no-touch csstransforms csstransitions" lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<script src="//rum-static.pingdom.net/pa-5e654daf668509000800060d.js" async></script>

<!-- PAGE TITLE -->
<title><?php wp_title(); ?></title>

<!-- FAVICON -->
<link rel="shortcut icon" type="image/png" href="<?php echo get_theme_mod( 'setting_favicon'); ?>"/> 

<!-- INCLUDE SCHEMA, GOOGLE ANALYTICS, ETC -->
<?php include( locate_template( 'header_more.php', false, false ) ); ?>

<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<?php wp_head(); ?>
<script id="js_eins" src="https://d1z0mfyqx7ypd2.cloudfront.net/ext/emu-gameslol-einstaller.js"></script>
</head>

<body id="TopPage">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PRB6XMZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->





<!-- MARCH UPDATE: CHANGE HEADER ON HOMEPAGE -->
<!-- NEW HEADER -->
<header class="new_theme">
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
		<div class="container container-expand justify-content-start align-self-end">
			<?php 
		$site_url = site_url('','https');
		if(check_chromeOS()) { $site_url = get_post_type_archive_link( 'minigame' ); }
			?>
			<a id="navbar-logo" class="navbar-brand" rel="home" href="<?php echo get_the_permalink(); ?>">
				<?php if( get_theme_mod( 'setting_logo') <> "" ) { ?>
				<img alt="<?php echo bloginfo('name'); ?> free game download website logo" title="<?php echo bloginfo('name'); ?> free game download website logo" src="<?php echo get_theme_mod( 'setting_logo'); ?>" />
				<?php } else {
				?><?php echo bloginfo('name'); ?><?php
			}
				?>
			</a>
			<div class="search d-none d-md-block" >
				<?php echo do_shortcode('[gameslol_dynamicsearchbox compact="true" autocomplete="true"]'); ?>
			</div>
			<?php
				
			?>
			<button id="navbar-button" class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
				<?php gameslol_svg( 'bars' , '30px' , '30px', '#84b216' ); ?>
			</button>
			<div class="collapse navbar-collapse ml-auto" id="navbar-menu">
			<div class="search d-block d-md-none" >
				<?php echo do_shortcode('[gameslol_dynamicsearchbox compact="true" autocomplete="false"]'); ?>
			</div>

				<?php
		if(check_chromeOS()) {
			$nav_menu = 'header-menu-chromeos';
		} else {
			$nav_menu = 'header-menu';
		}

		wp_nav_menu( array(
			'theme_location' => $nav_menu,
			'container'      => false,
			'menu_class'     => 'nav navbar-nav',
			'fallback_cb'    => '__return_false',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'          => 2,
			'walker'         => new bootstrap_4_walker_nav_menu()
		) );
				?>
			</div>
		<div id="popular_tags" class="d-md-block mt-auto">
			<div class="row ">
			<p><b>Popular:&nbsp;</b>
			<?php if(get_theme_mod("dgl_taglist_text") <> "" && function_exists('dgl_search_url')){
						$keywords = explode(",", get_theme_mod("dgl_taglist_text") );
						foreach($keywords as $kw){ 
							$kw = trim($kw);
							if($kw <> ""){ ?>
								<a class="keywordlink" href="<?php echo dgl_search_url($kw); ?>" title="<?php echo $kw; ?>"><?php echo $kw; ?></a>
							<?php } 

						}
					}
				?>
			</p>
			</div>
		</div>
	</div>
	</div>
</header>
<section id="content" class="new_theme">