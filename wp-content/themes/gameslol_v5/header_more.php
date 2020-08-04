<?php if( get_option('header_more') <> '' ) { ?>

<!-- ADDITIONAL HEADERS -->
<?php echo get_option('header_more'); ?>
<!-- END OF ADDITIONAL HEADERS -->
<?php } ?>

<!-- ALTERNATE LANGUAGE SITES -->

<?php $site_lang = esc_attr( get_option('lang_main') );
if( $site_lang <> "" ){ ?>

<meta http-equiv="content-language" content="<?php echo $site_lang; ?>">
<?php }

$countlang = (int) esc_attr( get_option('lang_count') );
if( $countlang > 0 ) {
		  
	$langlist = array();
	$currentpath = $_SERVER['REQUEST_URI'];
	for ($x = 1; $x <= $countlang; $x++) {
		$prefix = "lang_".$x;
		$lang_language = esc_attr( get_option($prefix."_language") );
		$lang_hreflang = esc_attr( get_option($prefix."_hreflang") );
		$lang_url = esc_attr( get_option($prefix."_url") );
		$lang_show = esc_attr( get_option($prefix."_showonheader") );
		
	
		if( $lang_hreflang <> '' && $lang_url <> '' && $lang_show == 'true' ) {
			
		if(!is_404()){
			$lang_url = $lang_url.$currentpath;
		}
	?>
		<link rel="alternate" href="<?php echo $lang_url; ?>" hreflang="<?php echo $lang_hreflang; ?>" />
	<?php
		}
	}
?>
<!-- END OF ALTERNATE LANGUAGE SITES -->

<?php } 
?>

<!--Schema markup-->
<?php if (is_singular('article')) { 
		$headline = (get_post_meta(get_the_id(), '_yoast_wpseo_title', true) <> '') ? get_post_meta(get_the_id(), '_yoast_wpseo_title', true) : get_the_title();
		$img_featured = get_the_post_thumbnail_url();
		 
		$content = apply_filters( 'the_content', get_post(get_the_ID())->post_content );
		$doc = new DOMDocument();
		$doc->loadHTML($content);
		$images = $doc->getElementsByTagName('img');
		$i = 0;
		$img_more = array();
		foreach($images as $img){
			$img_src = $img->getAttribute('src');
			if(filter_var($img_src, FILTER_VALIDATE_URL)){
			$img_more[$i] = $img_src;
			$i++;
			if($i == 2) break;	
			}
		}
	
		$author_id = get_post_field( 'post_author', get_the_ID() );

		$description = get_post_meta(get_the_id(), '_yoast_wpseo_metadesc', true);
		
	?>
	<!-- SCHEMA FOR ARTICLES -->
	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "NewsArticle",
		"mainEntityOfPage":
		{ "@type": "WebPage", "@id": "<?php the_permalink(); ?>" }
		,
		"headline": "<?php echo $headline; ?>",
		"image": [
		"<?php echo $img_featured; ?>",
		"<?php echo $img_more[0]; ?>",
		"<?php echo $img_more[1]; ?>"
			
		],
		"datePublished": "<?php echo get_the_date('Y-m-d'); ?>",
		"dateModified": "<?php the_modified_date('Y-m-d'); ?>",
		"author":
			{ "@type": "Person", "name": "<?php the_author_meta( 'display_name', $author_id ); ?>" }
		,
		"publisher":
			{
				"@type": "Organization",
				"name": "Games.lol",
				"logo":
				{ "@type": "ImageObject", "url": "<?php echo get_theme_mod( 'setting_logo' ); ?>" }
			}
		,
		"description": "<?php echo $description; ?>",
	  	"offers": { "@type": "Offer", "price": "0" }
	}
	</script>
<?php } elseif ( is_singular( array('post', 'unblockedgame', 'unblockedapp', 'minigame') ) ) { 
	
	$game_info = "";
	if(is_singular(array('post', 'unblockedgame'))) {
		$game_info = get_the_game_info(get_the_id());
	} else {
		$game_info = get_the_minigame_info(get_the_id());
	}
	$title = get_the_title();
	$rating = $game_info['rating'];
	$ratingCount = $game_info['ratingCount'];
	$description = get_post_meta(get_the_id(), '_yoast_wpseo_metadesc', true);
	
	?>
	<!-- SCHEMA FOR GAMES & MINIGAMES (PRODUCT) -->
    <!-- <script type="application/ld+json">
	{
	  "@context": "http://schema.org/",
	  "@type": "Product",
	  "name": "<?php echo $title; ?>",
	  "description": "<?php echo $description; ?>"
		<?php if($ratingCount > 0) { ?>
		  ,"aggregateRating": {
							"@type": "AggregateRating",
							"ratingValue": "<?php echo $rating; ?>",
							"bestRating": "5",
							"ratingCount": "<?php echo $ratingCount; ?>"
					}
		<?php } ?>
	  , "offers": { "@type": "Offer", "price": "0" }
	}
	</script>
-->
<?php } else { ?>
	<!-- SCHEMA FOR REST OF PAGES (GAMES.LOL AS PRODUCT)) -->
	<!-- <script type="application/ld+json">
	{
		"@context" : "http://schema.org",
		"@type" : "Product",
		"name" : "Games.lol",
		"description" : "Games.lol believes in providing quality PC Games content and experience to our users, through our specially developed game suggestion platform. We pride ourselves in only providing the best in Game titles from across the global.",
		"url" : "<?php echo site_url('','https');?>/",
		"brand" :
		{ "@type" : "Brand", "name" : "Games.lol", "logo" : "<?php echo get_theme_mod( 'setting_logo' ); ?>" },
		"offers": 
		{ "@type": "Offer", "price": "0" }
	}
	
	</script>
	-- >

<?php } ?>

<?php
	$post_types = array('minigame', 'article', 'review');

	if( is_post_type_archive( $post_types ) ){ 
		
		foreach($post_types as $pt){
			if( is_post_type_archive($pt) ){
				$meta_title = get_option($pt.'_meta_title');
				$meta_desc = get_option($pt.'_meta_desc');
				break;
			}
		}
	?>
	<!-- OCME GAMES META -->
	<!-- Custom Post Type Meta -->
	<?php if( $meta_title <> '') { ?>
    <meta name="title" content="<?php echo $meta_title; ?>" />
	<?php } ?>
	<?php if( $meta_desc <> '') { ?>
    <meta name="description" content="<?php echo $meta_desc; ?>" />
	<?php } ?>
	<!-- End of OCME GAMES META -->
<?php } ?>