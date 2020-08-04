<?php

function taxonomy_custom_fields($tag) {  
    $t_id = $tag->term_id; 
    $term_meta = get_option( "taxonomy_term_$t_id" );  
?>  
  
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="custom_title"><?php _e('Archive Heading'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="term_meta[custom_title]" id="term_meta[custom_title]" value="<?php echo $term_meta['custom_title'] ? $term_meta['custom_title'] : ''; ?>" style="font-size: 18pt;" placeholder="Custom Title"><br />
        <span class="description"><?php _e('Custom text for the archive\'s H1 title'); ?></span>  
    </td>  
</tr>  
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="tag_color"><?php _e('Category/Tag color'); ?></label>  
    </th>  
    <td>  
        <input type="color" name="term_meta[tag_color]" id="term_meta[tag_color]" value="<?php echo $term_meta['tag_color'] ? $term_meta['tag_color'] : '#000000'; ?>"><br />  
        <span class="description"><?php _e('The category/tag color'); ?></span>  
    </td>  
</tr>  
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="video_url"><?php _e('YouTube Video URL'); ?></label>  
    </th>  
    <td>  
        <input type="url" name="term_meta[video_url]" id="term_meta[video_url]" value="<?php echo $term_meta['video_url'] ? $term_meta['video_url'] : ''; ?>" placeholder="https://www.youtube.com/embed/[your-video-ID-here]"><br />
        <span class="description"><?php _e('Example: https://www.youtube.com/embed/<b>hrxR6sFiq04</b>'); ?></span>  
    </td>  
</tr>  
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="custom_content"><?php _e('Content'); ?></label>  
    </th>  
    <td>  
        <?php
			$content = stripslashes( htmlspecialchars_decode($term_meta['custom_content']) ) ;
            wp_editor(  $content,  'custom_content', array(
                    'wpautop'       =>      true,
                    'textarea_name' =>      'term_meta[custom_content]',
            ));
        ?>
    </td>  
</tr>  
<?php  
} 

function save_taxonomy_custom_fields( $term_id ) {  
    if ( isset( $_POST['term_meta'] ) ) {  
        $t_id = $term_id;  
        $term_meta = get_option( "taxonomy_term_$t_id" );  
        $cat_keys = array_keys( $_POST['term_meta'] );  
            foreach ( $cat_keys as $key ){  
            if ( isset( $_POST['term_meta'][$key] ) ){  
                $term_meta[$key] = $_POST['term_meta'][$key];  
            }  
        }  
        //save the option array  
        update_option( "taxonomy_term_$t_id", $term_meta );  
    }  
}  



add_action( 'category_edit_form_fields', 'taxonomy_custom_fields', 10, 2 );
add_action( 'post_tag_edit_form_fields', 'taxonomy_custom_fields', 10, 2 );
add_action( 'minigame_tag_edit_form_fields', 'taxonomy_custom_fields', 10, 2 );
add_action( 'app_category_edit_form_fields', 'taxonomy_custom_fields', 10, 2 );

add_action( 'edited_category', 'save_taxonomy_custom_fields', 10, 2 );
add_action( 'edited_post_tag', 'save_taxonomy_custom_fields', 10, 2 );
add_action( 'edited_minigame_tag', 'save_taxonomy_custom_fields', 10, 2 );
add_action( 'edited_app_category', 'save_taxonomy_custom_fields', 10, 2 );

function get_the_term_banner($term_id){
		
		if (function_exists('get_wp_term_image'))
		{ $meta_image = get_wp_term_image($term_id); }
		
		if($meta_image == ""){
				$meta_image = get_theme_mod('default_banner');
		}
		
		return $meta_image;

}

?>