<!doctype html>
<html xmlns="//www.w3.org/1999/xhtml" class="js no-touch csstransforms csstransitions js no-touch csstransforms csstransitions" lang="en">
<head>
<script>
/*
(function(){
if(location.href != 'https://games.lol/' && location.href != 'https://games.lol') return;
function writeCookie (key, value, days) {
        var date = new Date();
        days = days || 365;
        date.setTime(+ date + (days * 86400000)); //24 * 60 * 60 * 1000
        window.document.cookie = key + "=" + value + "; expires=" + date.toGMTString() + "; path=/";
        return value;
};
function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
}
if(getCookie('designType') === undefined) {
        if(Math.floor((Math.random() * 100) + 1) <= 50)
                writeCookie('designType', 0); // old design
        else
                writeCookie('designType', 1); // new design
}
if(getCookie('designType') == 1) location.href = '/new';
})()
*/
</script>
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







<header>
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
	<div class="container justify-content-between container-expand">
		<?php 
			$site_url = site_url('','https');
			if(check_chromeOS()) { $site_url = get_post_type_archive_link( 'minigame' ); }
		?>
		<a id="navbar-logo" class="navbar-brand" rel="home" href="<?php echo $site_url; ?>">
		   <?php if( get_theme_mod( 'setting_logo') <> "" ) { ?>
			<img alt="<?php echo bloginfo('name'); ?> free game download website logo" title="<?php echo bloginfo('name'); ?> free game download website logo" src="<?php echo get_theme_mod( 'setting_logo'); ?>" />
			<?php } else {
			?><?php echo bloginfo('name'); ?><?php
			}
			?><br/>
			<span class="navbar-brand-caption">
			<?php 
				if(check_chromeOS()) {
					echo 'Play Free Online Games';
				} else {
					echo 'Download Free PC & Mac Games';
				}
			?>
			</span>
		</a>
	  	<button id="navbar-button" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fa fa-bars"></i>
	  	</button>  
	  	<div class="collapse navbar-collapse" id="navbar-menu">
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
			<a id="nav-search" class="nav-search" data-toggle="collapse" href="#nav-searchform" role="button" aria-expanded="false" aria-controls="nav-searchform">
				<!-- <i class="fa fa-search"></i><span class="menu-caption">&nbsp;Search</span> -->
				<svg class="svg-icon" viewBox="0 0 20 20" style="width: 1.5em;fill: #b6dce2;stroke: #b6dce2;stroke-width: 1;">
							<path d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"></path>
						</svg>
			</a>
			<div id="nav-searchform" class="collapse nav-searchform">
				<form class="mega-search" action="<?php echo site_url('','https'); ?>/">
					<input type="text" name="s" placeholder="Search for games and hit Enter" required value="<?php echo get_query_var('s'); ?>">
				</form>
			</div>
		</div>
	</div>
</header>
<section id="content">