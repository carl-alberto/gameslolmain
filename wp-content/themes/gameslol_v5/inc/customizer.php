<?php

/* MULTISELECT & TINYMCE EDITOR FOR CUSTOMIZER */

add_action( 'customize_register', 'register_custom_controls' );
function register_custom_controls($wp_customize) {

	class MultiSelect_Custom_control extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 */
		public $type = 'multiple-select';

		/**
		 * Displays the multiple select on the customize screen.
		 */
		public function render_content() {

		if ( empty( $this->choices ) )
			return;
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<select <?php $this->link(); ?> size="10" multiple="multiple" style="height: 100%;">
					<?php
						foreach ( $this->choices as $value => $label ) {
							$selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
							echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
						}
					?>
				</select>
			</label>
		<?php }
	}
	
	class TinyMCE_Custom_control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'tinymce_editor';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue(){
			wp_enqueue_script( 'skyrocket-custom-controls-js', trailingslashit( get_template_directory_uri() ) . 'js/customizer.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'skyrocket-custom-controls-css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
			wp_enqueue_editor();
		}
		/**
		 * Pass our TinyMCE toolbar string to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['skyrockettinymcetoolbar1'] = isset( $this->input_attrs['toolbar1'] ) ? esc_attr( $this->input_attrs['toolbar1'] ) : 'bold italic bullist numlist alignleft aligncenter alignright link image';
			$this->json['skyrockettinymcetoolbar2'] = isset( $this->input_attrs['toolbar2'] ) ? esc_attr( $this->input_attrs['toolbar2'] ) : '';
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="tinymce-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<textarea id="<?php echo esc_attr( $this->id ); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
			</div>
		<?php
		}
	}
	
}

/* NEW CUSTOMIZER SETTINGS */

new theme_customizer();

class theme_customizer
{
    public function __construct()
    {
	    // add_action ('admin_menu', array(&$this, 'customizer_admin'));
        add_action( 'customize_register', array(&$this, 'ocmegames_customize_manager' ));
    }
	
    /**
     * Add the Customize link to the admin menu
     * @return void
     */
    public function customizer_admin() {
        add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
    }

    /**
     * Customizer manager
     * @param  WP_Customizer_Manager $wp_manager
     * @return void
     */
    public function ocmegames_customize_manager( $wp_manager )
    {
		
        $this->section_addfavicon( $wp_manager );
        $this->section_ocmegames_settings( $wp_manager );
        $this->section_ocmegames_socialmedia( $wp_manager );
        $this->section_ocmegames_footer( $wp_manager );
		
    }

	public function section_addfavicon( $wp_manager )
    {
		// SITE FAVICON
        $wp_manager->add_setting( 'setting_favicon', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'setting_favicon', array(
            'label'   => 'Site Favicon',
            'section' => 'title_tagline',
            'settings'   => 'setting_favicon'
        ) ) );
		
		// SITE LOGO
        $wp_manager->add_setting( 
		'setting_logo', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'setting_logo', array(
            'label'   => 'Site Logo',
            'section' => 'title_tagline',
            'settings'   => 'setting_logo'
        ) ) );

	}
	
	
	public function section_ocmegames_settings( $wp_manager )
    {
        $wp_manager->add_section( 'section_ocmegames_settings', array(
            'title'          => 'Default Header Banners',
            'priority'       => 151,
        ) );
		
		
		// DEFAULT BANNER
        $wp_manager->add_setting( 
		'default_banner', array(
            'default'        => '',
        ) );
		
        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'default_banner', array(
            'label'   => 'Games & Minigames Default Banner',
            'section' => 'section_ocmegames_settings',
            'settings'   => 'default_banner'
        ) ) );

		// DEFAULT BANNER
        $wp_manager->add_setting( 
		'default_banner_app', array(
            'default'        => '',
        ) );
		
        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'default_banner_app', array(
            'label'   => 'Apps Default Banner',
            'section' => 'section_ocmegames_settings',
            'settings'   => 'default_banner_app'
        ) ) );
		
		
	}
	
	
	public function section_ocmegames_socialmedia( $wp_manager )
    {
        $wp_manager->add_section( 'section_ocmegames_socialmedia', array(
            'title'          => 'Social Media Buttons',
            'priority'       => 151,
        ) );
		
		// LINK #1
		
		$wp_manager->add_setting( 'footer_sm_1_icon', array(
            'default'        => '',
        ) );

			$wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'footer_sm_1_icon', array(
				'label'   => 'Icon #1',
				'section' => 'section_ocmegames_socialmedia',
				'settings'   => 'footer_sm_1_icon'
			) ) );
		
        $wp_manager->add_setting( 'footer_sm_1_title', array(
            'default'        => '',
        ) );
			$wp_manager->add_control( 'footer_sm_1_title', array(
				'label'   => 'Title',
				'section' => 'section_ocmegames_socialmedia',
				'type'    => 'text'
			) );
		
        $wp_manager->add_setting( 'footer_sm_1_link', array(
            'default'        => '',
        ) );
			$wp_manager->add_control( 'footer_sm_1_link', array(
				'label'   => 'URL',
				'section' => 'section_ocmegames_socialmedia',
				'type'    => 'text'
			) );
		
		
		// LINK #2
        $wp_manager->add_setting( 'footer_sm_2_icon', array(
            'default'        => '',
        ) );

			$wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'footer_sm_2_icon', array(
				'label'   => 'Icon #2',
				'section' => 'section_ocmegames_socialmedia',
				'settings'   => 'footer_sm_2_icon'
			) ) );
		
        $wp_manager->add_setting( 'footer_sm_2_title', array(
            'default'        => '',
        ) );
			$wp_manager->add_control( 'footer_sm_2_title', array(
				'label'   => 'Title',
				'section' => 'section_ocmegames_socialmedia',
				'type'    => 'text'
			) );
		
        $wp_manager->add_setting( 'footer_sm_2_link', array(
            'default'        => '',
        ) );
			$wp_manager->add_control( 'footer_sm_2_link', array(
				'label'   => 'URL',
				'section' => 'section_ocmegames_socialmedia',
				'type'    => 'text'
			) );
		
		
		// LINK #3
	
       $wp_manager->add_setting( 'footer_sm_3_icon', array(
            'default'        => '',
        ) );

			$wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'footer_sm_3_icon', array(
				'label'   => 'Icon #3',
				'section' => 'section_ocmegames_socialmedia',
				'settings'   => 'footer_sm_3_icon'
			) ) );
		
        $wp_manager->add_setting( 'footer_sm_3_title', array(
            'default'        => '',
        ) );
			$wp_manager->add_control( 'footer_sm_3_title', array(
				'label'   => 'Title',
				'section' => 'section_ocmegames_socialmedia',
				'type'    => 'text'
			) );
		
        $wp_manager->add_setting( 'footer_sm_3_link', array(
            'default'        => '',
        ) );
			$wp_manager->add_control( 'footer_sm_3_link', array(
				'label'   => 'URL',
				'section' => 'section_ocmegames_socialmedia',
				'type'    => 'text'
			) );
		
		
		// LINK #4
		
       $wp_manager->add_setting( 'footer_sm_4_icon', array(
            'default'        => '',
        ) );

			$wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'footer_sm_4_icon', array(
				'label'   => 'Icon #4',
				'section' => 'section_ocmegames_socialmedia',
				'settings'   => 'footer_sm_4_icon'
			) ) );
		
        $wp_manager->add_setting( 'footer_sm_4_title', array(
            'default'        => '',
        ) );
			$wp_manager->add_control( 'footer_sm_4_title', array(
				'label'   => 'Title',
				'section' => 'section_ocmegames_socialmedia',
				'type'    => 'text'
			) );
		
        $wp_manager->add_setting( 'footer_sm_4_link', array(
            'default'        => '',
        ) );
			$wp_manager->add_control( 'footer_sm_4_link', array(
				'label'   => 'URL',
				'section' => 'section_ocmegames_socialmedia',
				'type'    => 'text'
			) );
	}
	
	public function section_ocmegames_footer( $wp_manager )
    {
        $wp_manager->add_section( 'section_ocmegames_footer', array(
            'title'          => 'Footer Settings',
            'priority'       => 152,
        ) );
		
		// FOOTER TEXT
		$wp_manager->add_setting( 'footer_text', array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'wp_kses_post'
		));
		
			$wp_manager->add_control( new TinyMCE_Custom_control( $wp_manager, 'footer_text',
			   array(
				  'label' => __( 'Custom Footer Text' ),
				  'section' => 'section_ocmegames_footer',
				  'input_attrs' => array(
					 'toolbar1' => 'bold italic link alignleft aligncenter alignright alignjustify'
				  )
			   )
			) );
		
		// COPYRIGHT TEXT
		
		$wp_manager->add_setting( 'footer_copyright', array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'wp_kses_post'
		));
		
			$wp_manager->add_control( new TinyMCE_Custom_control( $wp_manager, 'footer_copyright',
			   array(
				  'label' => __( 'Custom Copyright Text' ),
				  'section' => 'section_ocmegames_footer',
				  'input_attrs' => array(
					 'toolbar1' => 'bold italic link alignleft aligncenter alignright alignjustify'
				  )
			   )
			) );
		
	}

}

?>