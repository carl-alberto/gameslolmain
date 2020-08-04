<?php

add_action( 'admin_menu', 'ocmegames_themesettings' );

function ocmegames_themesettings(){

  // Add Menu Pages
  add_menu_page( 'Games.lol Theme Settings', 'Theme Settings', 'manage_options', 'theme-options', 'ocmegames_themesettings_header', 'dashicons-art' , 61);
  add_submenu_page( 'theme-options', 'Post Type Archive Page Settings', 'Post Type Archives', 'manage_options', 'post_type_options.php', 'ocmegames_themesettings_archives');
  add_submenu_page( 'theme-options', 'Theme Shortcode Reference', 'Shortcodes Guide', 'manage_options', 'theme_shortcodes.php', 'ocmegames_themesettings_shortcodes');
  add_submenu_page( 'theme-options', 'Theme Language Links', 'Language Links', 'manage_options', 'theme_languages.php', 'ocmegames_themesettings_languages');
  add_submenu_page( 'theme-options', 'Customize', 'Customize Theme', 'edit_theme_options', 'customize.php');

  // Add Settings Groups
  add_action( 'admin_init', 'ocmegames_themesettings_register' );
}


function ocmegames_themesettings_register() {
	//register our settings
	register_setting( 'ocmegames-themesettings_header', 'header_more' );
	
	$post_types = array( 'minigame', 'article', 'review' ); 
	foreach($post_types as $pt){
		register_setting( 'ocmegames-themesettings_archives', $pt.'_meta_title' );
		register_setting( 'ocmegames-themesettings_archives', $pt.'_meta_desc' );
		register_setting( 'ocmegames-themesettings_archives', $pt.'_page_title' );
		register_setting( 'ocmegames-themesettings_archives', $pt.'_page_subtitle' );
		register_setting( 'ocmegames-themesettings_archives', $pt.'_page_content' );
	}
	
	register_setting( 'ocmegames-themesettings_language', 'lang_main' );
	register_setting( 'ocmegames-themesettings_language', 'lang_count' );
	$count = get_option('lang_count');
	$x = 1;
	for($x = 1; $x <= $count; $x++){
		register_setting( 'ocmegames-themesettings_language', 'lang_'.$x.'_flag' );
		register_setting( 'ocmegames-themesettings_language', 'lang_'.$x.'_language' );
		register_setting( 'ocmegames-themesettings_language', 'lang_'.$x.'_hreflang' );
		register_setting( 'ocmegames-themesettings_language', 'lang_'.$x.'_title' );
		register_setting( 'ocmegames-themesettings_language', 'lang_'.$x.'_url' );
		register_setting( 'ocmegames-themesettings_language', 'lang_'.$x.'_showonheader' );
		
	}
	
}

function ocmegames_themesettings_header(){
  ?>
	<style>
		h3 {
			color: darkblue;
		}
	</style>
	<div class="wrap">
        <h1>Games.lol Theme Settings</h1>
		<form method="post" action="options.php">
		<?php settings_fields( 'ocmegames-themesettings_header' ); ?>
		<?php do_settings_sections( 'ocmegames-themesettings_header' ); ?>
		<hr>
        <h2>ADDITIONAL HEADER CODES</h2>
		<p>Add any additional header codes (meta tags, verification, google analytic codes) here:</p>
		
		<table class="form-table">
			<tr>
			<td><textarea name="header_more"
						  rows="25" cols="120"><?php echo esc_attr( get_option('header_more') ); ?></textarea>
			</td>
			</tr>
		</table>
			
		<?php submit_button(); ?>

	</form>
	</div>
  <?php
}

function ocmegames_themesettings_archives(){
  ?>
	<style>
		h3 {
			color: darkblue;
		}
	</style>
	<div class="wrap">
        <h1>Games.lol Theme Settings</h1>
		<form method="post" action="options.php">
		<?php settings_fields( 'ocmegames-themesettings_archives' ); ?>
		<?php do_settings_sections( 'ocmegames-themesettings_archives' ); ?>
		<hr>
        <h2>CUSTOM POST TYPE ARCHIVE PAGES</h2>

		<h3>Mini Games Archive</h3>
		<?php ocmegames_themesettings_page_ptform( 'minigame' ); ?>
		
		<h3>Unblocked Games Archive</h3>
		<?php 
		$page = get_page_by_path("android");
		if($page){ ?>
		<p>Edit your existing Unblocked Games archive page: <a href="../wp-admin/post.php?post=<?php echo $page->ID; ?>&action=edit">here</a></p>
  		<?php } else { ?>
		<p>To create archive page, <a href="../wp-admin/post-new.php?post_type=page">create a new page</a> and assign slug <b>'android'</b> with page template <b>'Custom Game Archive Page'</b>.</p>
		<?php } ?>
		
		<h3>Unblocked Apps Archive</h3>
		<?php 
		$page = get_page_by_path("apps");
		if($page){ ?>
		<p>Edit your existing Unblocked Apps archive page: <a href="../wp-admin/post.php?post=<?php echo $page->ID; ?>&action=edit">here</a></p>
  		<?php } else { ?>
		<p>To create Unblocked Apps archive page, <a href="../wp-admin/post-new.php?post_type=page">create a new page</a> and assign slug <b>'apps'</b> with page template <b>'Custom Unblocked App Archive Page'</b>.</p>
		<?php } ?>
			
		
		<h3>Articles Archive</h3>
		<?php ocmegames_themesettings_page_ptform( 'article' ); ?>
		
		<h3>Reviews Archive</h3>
		<?php ocmegames_themesettings_page_ptform( 'review' ); ?>
		
		<h3>Walkthroughs Archive</h3>
		<?php 
		$page = get_page_by_path("walkthroughs");
		if($page){ ?>
		<p>Edit your existing Walkthroughs archive page: <a href="../wp-admin/post.php?post=<?php echo $page->ID; ?>&action=edit">here</a></p>
  		<?php } else { ?>
		<p>To create Walkthroughs archive page, <a href="../wp-admin/post-new.php?post_type=page">create a new page</a> and assign slug <b>'walkthroughs'</b> with page template <b>'Custom Walkthrough Archive Page'</b>.</p>
		<?php } ?>
		
		<h3>FAQs Archive</h3>
		<?php 
		$page = get_page_by_path("faq");
		if($page){ ?>
		<p>Edit your existing FAQ archive page: <a href="../wp-admin/post.php?post=<?php echo $page->ID; ?>&action=edit">here</a></p>
  		<?php } else { ?>
		<p>To create FAQ archive page, <a href="../wp-admin/post-new.php?post_type=page">create a new page</a> and assign slug <b>'faq'</b> with page template <b>'Custom FAQ Archive Page'</b>.</p>
		<?php } ?>
			
		<?php submit_button(); ?>

	</form>
	</div>
  <?php
}


function ocmegames_themesettings_page_ptform( $pt ){
	?>

		<table class="form-table">
			<tr valign="top">
			<th scope="row">Page Title</th>
			<td><input type="text" name="<?php echo $pt; ?>_page_title" value="<?php echo esc_attr( get_option($pt.'_page_title') ); ?>" size="70" /></td>
			</tr>
			<?php if($pt == 'minigame'){ ?>
		
			<tr valign="top">
			<th scope="row">Page Subtitle</th>
			<td><textarea name="<?php echo $pt; ?>_page_subtitle"
						  rows="3" cols="70"><?php echo esc_attr( get_option($pt.'_page_subtitle') ); ?></textarea>
			</td>
			</tr>
			<?php } ?>
			<tr valign="top">
			<th scope="row">Page Content</th>
			<td>
				<div style="max-width: 600px">
				<?php 
					$settings = array(
						'teeny' => true
						);
					wp_editor( get_option($pt.'_page_content') , $pt.'_page_content', $settings ); ?>
				</div>
			</td>
			</tr>
			<tr valign="top">
			<th scope="row">Meta Title</th>
			<td><input type="text" name="<?php echo $pt; ?>_meta_title" size="70"
					   value="<?php echo esc_attr( get_option($pt.'_meta_title') ); ?>" /></td>
			</tr>
			<tr valign="top">
			<th scope="row">Meta Description</th>
			<td>
				<textarea name="<?php echo $pt; ?>_meta_desc"
						  rows="3" cols="70"><?php echo esc_attr( get_option($pt.'_meta_desc') ); ?></textarea>
			</td>
			</tr>
		</table>

	<?php
}


function ocmegames_themesettings_shortcodes(){
?>
	<style>
		blockquote { 
			background: #dedede;
			padding: 5px 10px;
			font-family: Courier;
		}
		blockquote .note {
			color: gray;
		}
	</style>
	<div class="wrap">
        <h1>Theme Shortcode Reference</h1>
        <hr>
        <h2>[gameslol_slider]</h2>
        <p><i> - displays the screenshot slider of a post including the video trailer</i></p>
		<p><b>EXAMPLE:</b></p>
			<blockquote>
				<p><span class="note">//To display current post screenshots</span><br>
				<strong>[gameslol_grid]</strong></p>

				<p><span class="note">//To display number of columns in slider</span><br>
				<strong>[gameslol_grid columns=2]</strong></p>

				<p><span class="note">//To display screenshots of specific post with provided number of columns. Accepts only one (1) id.</span><br>
				<strong>[gameslol_grid id="13260" columns=2]</strong></p>
			</blockquote>
		<p><b>OPTIONS:</b></p>
			<ul style="margin-left: 20px">
				<li><strong>id</strong> - Post ID<br>
				<small>(optional, default: current post)</small></li>
				<li><strong>columns</strong> - number of columns in slider including video<br>
				<small>(optional, default: 2)</small></li>
			</ul>
		<p><strong>IMPORTANT:</strong></p>
			<ul style="margin-left: 20px">
			 <li>two (2) is the default and minimum number of columns.</li>
			</ul>
		<hr>
        <h2>[gameslol_grid]</h2>
		<p><i> - display grid of posts according to options provided</i></p>
		<p><b>EXAMPLE:</b></p>
			<blockquote>
				<p><span class="note">//To display grid of 6 games with PLAY NOW buttons and MORE GAMES button:</span><br>
				<strong>[gameslol_grid type="game" count="6" offset="0" quickdownload="true" infinite="true"]</strong></p>
				
				<p><span class="note">//To display grid of ALL games without PLAY NOW buttons:</span><br>
				<strong>[gameslol_grid type="game" count="all" offset="0" quickdownload="false"]</strong></p>
				
				<p><span class="note">//To display grid of 4 mini games without PLAY NOW buttons, skipping 2 records:</span><br>
				<strong>[gameslol_grid type="minigame" count="4" offset="2" quickdownload="false"]</strong></p>
				
				<p><span class="note">//To display grid of specific mini games with PLAY NOW buttons:</span><br>
				<strong>[gameslol_grid type="minigame" posts="13260,13264,13270" quickdownload="true"]</strong></p>
			</blockquote>
		<p><b>OPTIONS:</b></p>
			<ul style="margin-left: 20px">
				<li><strong>type</strong> - 'game' or 'minigame'<br>
				<small>(optional, default: game)</small></li>
				<li><strong>count</strong> - # of posts to show, enter 'all' to show all posts<br>
				<small>(required)</small></li>
				<li><strong>offset</strong> - # of posts to offset<br>
				<small>(optional, default: 0)</small></li>
				<li><strong>quickdownload</strong> - 'true' or 'false' - display clickable 'PLAY NOW' button. if 'game', game will be downloaded, if 'minigame', game player will be launched.<br>
				<small>(optional, default: false)</small></li>
				<li><strong>infinite</strong> - 'true' or 'false' - display 'MORE GAMES' button that will load more games in the page<br>
				<small>(optional, default: false)</small></li>
				<li><strong>posts</strong> - comma-separated IDs of posts to be loaded<br>
				<small>(optional, default: none)</small></li>
			</ul>
		<p><strong>IMPORTANT:</strong></p>
			<ul style="margin-left: 20px">
			 <li>If <strong>posts</strong> is specified, shortcode will <u>ignore</u> <strong>count, offset and infinite</strong>.</li>
			 <li><strong>infinite</strong> is not applicable for grids with specified posts or for grids with ALL posts.</li>
			 <li><strong>infinite</strong> is not yet available for minigames.</li>
		</ul>
		 
	</div>
<?php	
}


function ocmegames_themesettings_languages(){
  ?>
	<style>
		.flag {
			display: inline-block;
			margin: 1px;
			height: 20px;
			width: 20px;
			background: #dfdedf;
			float: left;
			padding: 2px;
		}
		
		.languages tr:nth-child(even){
			background: white;
		}
		.languages td {
			padding: 5px;
		}
		.languages .th {
			background: #dadada;
		}
		
		.languages .th td {
			padding: 5px;
		}
		
		.languages .th td input {
			width: 100%;
		}
	</style>
	<div class="wrap">
        <h1>GAMES.LOL LANGUAGE LINKS</h1>
		<form method="post" action="options.php">
		<?php settings_fields( 'ocmegames-themesettings_language' ); ?>
		<?php do_settings_sections( 'ocmegames-themesettings_language' ); ?>
		<hr><p><b>Content Language: </b> <input type="text" name="lang_main" required value="<?php echo esc_attr( get_option('lang_main') ); ?>"> </p>
		<p><b>Language links to generate: </b> <input type="number" name="lang_count" min="1" max="50" value="<?php echo esc_attr( get_option('lang_count') ); ?>"> <?php submit_button( 'Update', 'small' , 'submit', false ); ?></p>
			
        <h2>LANGUAGE LINKS</h2>
		
		<table class="form-table languages">
			<tr class="th">
				<td style="width: 20px;"><strong>#</strong></td>
				<td style="width: calc(20% - 20px);"><strong>Flag</strong></td>
				<td style="width: 10%;" ><strong>hreflang</strong></td>
				<td style="width: 15%;" ><strong>Language</strong></td>
				<td style="width: 20%;" ><strong>Title</strong></td>
				<td style="width: 30%;" ><strong>URL</strong></td>
				<td style="width: 10%;" ><strong>Show on &lang;head&rang;?</strong></td>
			</tr>
			<?php
				$count = get_option('lang_count');
				$x = 1;
				for($x = 1; $x <= $count; $x++){
					?>
					<tr>
					<td><strong><?php echo $x; ?></strong></td>
					<td><img class="flag"
							 src="<?php echo esc_attr( get_option("lang_".$x."_flag") ); ?>" >
						<input name="lang_<?php echo $x; ?>_flag" type="url" style="width: 80px;"
							   value="<?php echo esc_attr( get_option("lang_".$x."_flag") ); ?>"></td>
					<td><input name="lang_<?php echo $x; ?>_hreflang" type="text"  style="width: 100%;"
							   value="<?php echo esc_attr( get_option("lang_".$x."_hreflang") ); ?>"></td>
					<td><input name="lang_<?php echo $x; ?>_language" type="text"   style="width: 100%;"
							   value="<?php echo esc_attr( get_option("lang_".$x."_language") ); ?>"></td>
					<td><input name="lang_<?php echo $x; ?>_title" type="text"  style="width: 100%;"
							   value="<?php echo esc_attr( get_option("lang_".$x."_title") ); ?>"></td>
					<td><input name="lang_<?php echo $x; ?>_url" type="url"   style="width: 100%;"
							   placeholder="http://"
							   value="<?php echo esc_attr( get_option("lang_".$x."_url") ); ?>"></td>
					<td><input name="lang_<?php echo $x; ?>_showonheader" type="checkbox" value="true"
						   <?php if( esc_attr( get_option("lang_".$x."_showonheader") ) == "true"){ echo 'checked'; } ?> ></td>
					</tr>
					<?php
				}
			?> 
			
		</table>
			
		<?php submit_button(); ?>
			
		<p>To display list of links in the site, go to <a href="widgets.php">Widgets</a> and create a new Language List for any of the widget areas.</p>

	</form>
	</div>
  <?php
}

?>