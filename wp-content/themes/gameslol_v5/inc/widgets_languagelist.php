<?php

/* Language List Menu */

class ocmeGames_LanguageList extends WP_Widget {
  
	public function __construct() {
	$widget_options = array( 
	  'classname' => 'ocme_languagelist_custom',
	  'description' => 'Display a list of linked language sites',
	);
		parent::__construct( 'ocme_languagelist_custom', '*OCME Games: Language Link List', $widget_options );
	}
	
	public function widget( $args, $instance ) {
    
    $countposts = (int) esc_attr( get_option('lang_count') );
	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
	$langlist = array();
	for ($x = 1; $x <= $countposts; $x++) {
		$prefix = "lang_".$x;
		$langlist[$x] = array(
						'flag' => 		esc_attr( get_option($prefix."_flag") ),
						'language' =>	esc_attr( get_option($prefix."_language") ),
						'hreflang' => 	esc_attr( get_option($prefix."_hreflang") ),
						'title' => 		esc_attr( get_option($prefix."_title") ),
						'url' =>		esc_attr( get_option($prefix."_url") ),
						'show' => 		$instance[$prefix."_show"]
			);
	}
    
	echo $args['before_widget'];   ?>
	
 	<div class="widget_languagelist">
	<?php echo $args['before_title'] . $title . $args['after_title'] ;  ?>
	<div class="clearfix"></div>
		<div class="list list_languages">
			<ul class="languagelist"><?php 
		
					
		
					$currentpath = $_SERVER['REQUEST_URI'];
					foreach($langlist as $lang){
						
						if($lang['show'] == "true"){
							
							if(is_404()){
								$new_url = $lang['url'];
							} else {
								$new_url = $lang['url'].$currentpath;
							}
						?>
						<li>
							<?php
		
							if ( function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint() ) {
							?>
								<a title="<?php echo $lang['title']; ?>" target="_blank"
							   href="<?php echo $new_url; ?>" rel="external"
							   hreflang="<?php echo $lang['hreflang']; ?>">
									<?php echo $lang['language']; ?>
								</a>
							<?php
							}else{ 
							?>
								<a title="<?php echo $lang['title']; ?>" target="_blank"
								   href="<?php echo $new_url; ?>" rel="external"
								   hreflang="<?php echo $lang['hreflang']; ?>">
								   <img src="<?php echo $lang['flag']; ?>">
									<?php echo $lang['language']; ?>
								</a>
							<?php
							} 
							?>
                        </li>
						<?php
						}
					}
				 ?>
			</ul>
   		</div>
    </div>
	<?php 
	 echo $args['after_widget'];
	
	}

	public function form( $instance ) {
		
    	$countposts = (int) esc_attr( get_option('lang_count') );
		
		$langlist = array();
		for ($x = 1; $x <= $countposts; $x++) {
			$prefix = "lang_".$x;
			$langlist[$x] = array(
					'flag' => 		esc_attr( get_option($prefix."_flag") ),
					'language' =>	esc_attr( get_option($prefix."_language") ),
					'hreflang' => 	esc_attr( get_option($prefix."_hreflang") ),
					'title' => 	esc_attr( get_option($prefix."_title") ),
					'url' =>	esc_attr( get_option($prefix."_url") ),
					'show' => $instance[$prefix."_show"]
				);
		}

		  $title = !empty( $instance['title'] ) ? $instance['title'] : '';  ?>
		  <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		  </p>
		  <p>Select which languages to show: </p>
			<table class="languagelist" style="margin-left: 20px;">
			<?php 
			foreach ($langlist as $x=>$lang) {
				$fieldname = "lang_" . $x . "_show";
				if($lang['language'] <> ""){
				?>
				<tr>
				<td>
					<input name="<?php echo $this->get_field_name( $fieldname ); ?>" 
	 					   id="<?php echo $this->get_field_id( $fieldname ); ?>"
						   type="checkbox" value="true"
						   <?php if($instance[$fieldname] == "true"){ echo 'checked'; } ?> >
				</td>
				<td><img src="<?php echo $lang['flag']; ?>"></td>
				<td><?php echo $lang['language']; ?></td>
				
				</tr>
			<?php
				}
			}?>
			</table><br>
		  <?php 
	}
	
	
	public function update( $new_instance, $old_instance ) {
		
      $countposts = (int) esc_attr( get_option('lang_count') );
	  $instance = $old_instance;
	  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		for ($x = 1; $x <= $countposts; $x++) {
			$fieldname = "lang_".$x."_show";
			$instance[$fieldname] = strip_tags( $new_instance[$fieldname] );
		}
	  return $instance;
	} 
	
}

function register_ocmeGames_LanguageList() { 
  register_widget( 'ocmeGames_LanguageList' );
}

add_action( 'widgets_init', 'register_ocmeGames_LanguageList' );

?>