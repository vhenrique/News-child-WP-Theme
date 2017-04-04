<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
  To find another icons, visit: http://elusiveicons.com/icons/
 * */

if (!class_exists('Redux_Framework_sample_config')) {

	class Redux_Framework_sample_config {

		public $args		= array();
		public $sections	= array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if (!class_exists('ReduxFramework')) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if (  true == Redux_Helpers::isTheme(__FILE__) ) {
				$this->initSettings();
			} else {
				add_action('plugins_loaded', array($this, 'initSettings'), 10);
			}

		}

		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();

			if (!isset($this->args['opt_name'])) { // No errors please
				return;
			}
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
		}

		/**

		  This is a test function that will let you see when the compiler hook occurs.
		  It only runs if a field	set with compiler=>true is changed.

		 * */
		function compiler_action($options, $css, $changed_values) {
			echo '<h1>The compiler hook has run!</h1>';
			echo "<pre>";
			print_r($changed_values); // Values that have changed since the last save
			echo "</pre>";
		}

		/**

		  Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		  Simply include this function in the child themes functions.php file.

		  NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		  so you must use get_template_directory_uri() if you want to use any of the built in icons

		 * */
		function dynamic_section($sections) {
			//$sections = array();
			$sections[] = array(
				'title' => __('Section via hook', 'redux-framework-demo'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
				'icon' => 'el-icon-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array()
			);

			return $sections;
		}

		/**

		  Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		 * */
		function change_arguments($args) {
			//$args['dev_mode'] = true;

			return $args;
		}

		/**

		  Filter hook for filtering the default value of any given field. Very useful in development mode.

		 * */
		function change_defaults($defaults) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if (class_exists('ReduxFrameworkPlugin')) {
				remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
			}
		}

		public function setSections() {

			/**
			  Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 * */
			// Background Patterns Reader
			$sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url	= ReduxFramework::$_url . '../sample/patterns/';
			$sample_patterns		= array();

			if (is_dir($sample_patterns_path)) :

				if ($sample_patterns_dir = opendir($sample_patterns_path)) :
					$sample_patterns = array();

					while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

						if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
							$name = explode('.', $sample_patterns_file);
							$name = str_replace('.' . end($name), '', $sample_patterns_file);
							$sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
						}
					}
				endif;
			endif;

			ob_start();

			$ct			 = wp_get_theme();
			$this->theme	= $ct;
			$item_name	  = $this->theme->get('Name');
			$tags		   = $this->theme->Tags;
			$screenshot	 = $this->theme->get_screenshot();
			$class		  = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
			
			?>
			<div id="current-theme" class="<?php echo esc_attr($class); ?>">
			<?php if ($screenshot) : ?>
				<?php if (current_user_can('edit_theme_options')) : ?>
						<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
							<img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
						</a>
				<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
				<?php endif; ?>

				<h4><?php echo $this->theme->display('Name'); ?></h4>

				<div>
					<ul class="theme-info">
						<li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
						<li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
						<li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
			<?php
			if ($this->theme->parent()) {
				printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
			} 
			?>
				</div>
			</div>

			<?php
			$item_info = ob_get_contents();

			ob_end_clean();

			$sampleHTML = '';
			if (file_exists(dirname(__FILE__) . '/info-html.html')) {
				Redux_Functions::initWpFilesystem();
				
				global $wp_filesystem;

				$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
			}



			/*
			********************************************
			**************** THEME PANELS **************
			********************************************
			*/

			// Theme prefix
			global $themePrefix;

			// Header
			$this->sections[] = array(
				'title'		=> 'Header',
				'heading' 	=> 'This section is about the settings of your site header',
				'icon'    	=> 'el-icon-hand-up',
				'desc'		=> '<p class="description">Header settings.</p>',
				'fields'	=> array(
					array( // Logo
						'id'		=> $themePrefix . 'logo_url',
						'type'		=> 'media',
						'title'		=> 'Logo',
						'subtitle'	=> 'Make your logo image upload.'
					),
					array( // Dahicon
						'id'		=> $themePrefix . 'favicon_url',
						'type'		=> 'media',
						'title'		=> 'Favicon',
						'subtitle'	=> 'Upload a small image(16x16) to make your favicon.'
					),
					array( // Divisor
						'id'		=> $themePrefix . 'divider'. str_shuffle('-vhs-'),
						'type'		=> 'divide',						
					),
					array( // Date at site header
						'id'		=> $themePrefix . 'showDate',
						'type'		=> 'switch',
						'title'		=> 'Show date',
						'subtitle'	=>'When it is activated, the date will appear at site header.',
						'default'	=> true
					),
					array( // Weather Forecast at site header
						'id'		=> $themePrefix . 'showWeather',
						'type'		=> 'switch',
						'title'		=> 'Show Weather Forecast',
						'subtitle'	=> 'When it is activated, the weather forecast will appear at site header.',
						'default'	=> true
					),
				)
			);

			// Home
			$this->sections[] = array(
				'title'		=> 'Home',
				'heading' 	=> 'Some settings from site Home page',
				'icon'    	=> 'el-icon-home',
				'desc'		=> '<p class="description">Home settings.</p>',
				'fields'	=> array(
					array( // Main slider size
						'id'			=> $themePrefix . 'limitSlider',
						'type'			=> 'slider',
						'title'			=> 'Limit main slider',
						'subtitle'		=> 'Limit post number on slider.',
						'default'		=> 3,
						'min'			=> 1,
						'max'			=> 10,
						'step'			=> 1,
						'display_value'	=> 'label'
					),
					array( // Slider last news size
						'id'			=> $themePrefix . 'limitLatestNews',
						'type'			=> 'slider',
						'title'			=> 'Limit latest news',
						'subtitle'		=> 'Limit post number on home peage slider.',
						'default'		=> 8,
						'min'			=> 1,
						'max'			=> 16,
						'step'			=> 1,
						'display_value'	=> 'label'
					),

					array( // Limit posts from the most popular category
						'id'			=> $themePrefix . 'limitPostCategoryList',
						'type'			=> 'slider',
						'title'			=> 'Limit category items',
						'subtitle'		=> 'Limit category number at home page.',
						'default'		=> 5,
						'min'			=> 1,
						'max'			=> 10,
						'step'			=> 1,
						'display_value'	=> 'label'
					),
				)
			);

			// Banners management
			$this->sections[] = array(
				'title'		=> 'Banners',
				'heading'	=> 'Banners',
				'icon'		=> 'el-icon-photo',
				'desc'		=> '<p class="description">Banners management</p>',
				'fields'	=> array(

					// Init section to first banner
					array(
						'id'			=> $themePrefix . 'sectionFirstBanner',
						'type'			=> 'section',
						'title'			=> 'Sidebar Banner',
						'subtitle'		=> 'This banner will be the first on left side of site',
						'indent'		=> true
					),
						array( 				// Title
							'id'			=> $themePrefix . '1BannerTitle',
							'type'			=> 'text',
							'title'			=> 'Title',
							'subtitle'		=> 'Do you have a title to banner?',
							'desc'			=> 'It will be on HTML propertie title'
						),
						array( 				// Upload banner file
							'id'			=> $themePrefix . '1BannerImage',
							'type'			=> 'media',
							'title'			=> 'Banner image upload',
							'subtitle'		=> 'Upload you banner image here.',
							'desc'			=> '250 X 600'
						),
						array( 				// Redirect link
							'id'			=> $themePrefix . '1BannerLink',
							'type'			=> 'text',
							'title'			=> 'Banner Link',
							'subtitle'		=> 'Do you have a redirect link to this banner? If you don\'t, leave this field blank',
						),
						array( 				// Target
							'id'			=> $themePrefix . '1BannerTarget',
							'type'			=> 'switch',
							'title'			=> 'Target. Open in a new tab?',
							'subtitle'		=> 'Set to on if you want this banner open in a new tab',
							'on'			=> 'Yes',
							'off'			=> 'No'
						),

					// End of first banner section
					array(
						'id'			=> $themePrefix . 'sectionFirstBannerEnd',
						'type'			=> 'section',
						'indent'		=> false
					),

					// Init section to second banner
					array(
						'id'			=> $themePrefix . 'sectionSecondBanner',
						'type'			=> 'section',
						'title'			=> 'Banner in content',
						'subtitle'		=> 'This one will be between the post list at home.',
						'indent'		=> true
					),
						array( 				// Title
							'id'			=> $themePrefix . '2BannerTitle',
							'type'			=> 'text',
							'title'			=> 'Title',
							'subtitle'		=> 'Do you have a title to banner?',
							'desc'			=> 'It will be on HTML propertie title'
						),
						array( 				// Upload banner file
							'id'			=> $themePrefix . '2BannerImage',
							'type'			=> 'media',
							'title'			=> 'Banner image upload',
							'subtitle'		=> 'Upload you banner image here.',
							'desc'			=> '1140 X 120'
						),
						array( 				// Redirect link
							'id'			=> $themePrefix . '2BannerLink',
							'type'			=> 'text',
							'title'			=> 'Banner Link',
							'subtitle'		=> 'Do you have a redirect link to this banner? If you don\'t, leave this field blank',
						),
						array( 				// Target
							'id'			=> $themePrefix . '2BannerTarget',
							'type'			=> 'switch',
							'title'			=> 'Target. Open in a new tab?',
							'subtitle'		=> 'Set to on if you want this banner open in a new tab',
							'on'			=> 'Yes',
							'off'			=> 'No'
						),

					// End of second banner section
					array(
						'id'			=> $themePrefix . 'sectionSecondBannerEnd',
						'type'			=> 'section',
						'indent'		=> false
					),

					// Init section to third banner
					array(
						'id'			=> $themePrefix . 'sectionThirdBanner',
						'type'			=> 'section',
						'title'			=> 'Secondary banner',
						'subtitle'		=> 'Will be at sidebar on single and archive pages.',
						'indent'		=> true
					),
						array( 				// Title
							'id'			=> $themePrefix . '3BannerTitle',
							'type'			=> 'text',
							'title'			=> 'Title',
							'subtitle'		=> 'Do you have a title to banner?',
							'desc'			=> 'It will be on HTML propertie title'
						),
						array( 				// Upload banner file
							'id'			=> $themePrefix . '3BannerImage',
							'type'			=> 'media',
							'title'			=> 'Banner image upload',
							'subtitle'		=> 'Upload you banner image here.',
							'desc'			=> '250 X 600'
						),
						array( 				// Redirect link
							'id'			=> $themePrefix . '3BannerLink',
							'type'			=> 'text',
							'title'			=> 'Banner Link',
							'subtitle'		=> 'Do you have a redirect link to this banner? If you don\'t, leave this field blank',
						),
						array( 				// Target
							'id'			=> $themePrefix . '3BannerTarget',
							'type'			=> 'switch',
							'title'			=> 'Target. Open in a new tab?',
							'subtitle'		=> 'Set to on if you want this banner open in a new tab',
							'on'			=> 'Yes',
							'off'			=> 'No'
						),

					// End of third banner section
					array(
						'id'			=> $themePrefix . 'sectionthirdBannerEnd',
						'type'			=> 'section',
						'indent'		=> false
					),
				),
			);
			
			// Sidebar
			$this->sections[] = array(
				'title'		=> 'Sidebar',
				'heading'	=> 'Sidebar',
				'icon'		=> 'el-icon-hand-right',
				'desc'		=> '<p class="description">Sidebar setings.</p>',
				'fields'	=> array(

					array( // Lasteste news
						'id'		=> $themePrefix . 'sbLimitNews',
						'type'		=> 'slider',
						'title'		=> 'Limit news',
						'desc'		=> 'Set limit os lastest news on sidebar.',
						'default'		=> 10,
						'min'			=> 1,
						'max'			=> 20,
						'step'			=> 1,
						'display_value'	=> 'label'

					),

				)
			);

			// Social networks
			$this->sections[] = array(
				'title'		=> 'Social networks',
				'heading' 	=> 'Social networks',
				'icon'    	=> 'el-icon-share',
				'desc'		=> '<p class="description">'.'Settings of social networks.</p>',
				'fields'	=> array(

					array( // Facebook
						'id'		=> $themePrefix.'socialFacebook',
						'type'		=> 'text',
						'title'		=> 'Facebook',
						'subtitle'	=> 'Facebook profile / page.'
					),

					array( // Twitter
						'id'		=> $themePrefix.'socialTwitter',
						'type'		=> 'text',
						'title'		=> 'Twitter',
						'subtitle'	=> 'Twitter profile.'
					),

					array( // Google Plus
						'id'		=> $themePrefix.'socialGoogle',
						'type'		=> 'text',
						'title'		=> 'Google Plus',
						'subtitle'	=> 'G+ profile.'
					),

					array( // Linkedin
						'id'		=> $themePrefix.'socialLinkedin',
						'type'		=> 'text',
						'title'		=> 'Linkedin',
						'subtitle'	=> 'Linkedin profile.'
					),

					array( // Youtube
						'id'		=> $themePrefix.'socialYoutube',
						'type'		=> 'text',
						'title'		=> 'YouTube',
						'subtitle'	=> 'YouTube channel.'
					)
				)
			);

			// Contact
			$this->sections[] = array(
				'title'		=> 'Contact',
				'heading' 	=> 'Type here all the information about contact. ',
				'icon'    	=> 'el-icon-bell',
				'desc'		=> '<p class="description">Contact settings</p>',
				'fields'	=> array(

			       	array( // Adress
						'id'		=> $themePrefix.'contacts',
						'type'		=> 'slides',
						'title'		=> 'Contacts'
					),
			    ),
			);

			// About
			$this->sections[] = array(
				'title'		=> 'About',
				'heading' 	=> 'About',
				'icon'    	=> 'el-icon-file',
				'desc'		=> '<p class="description">Tell something about what is this site.</p>',
				'fields'	=> array(

			      	array( // Title
						'id'		=> $themePrefix . 'aboutTitle',
						'type'		=> 'text',
						'title'		=> 'Title',
						'desc'		=> 'This text will be on the top of the next text.'
					),

			      	array( // Text
			      		'id'		=> $themePrefix . 'aboutText',
			      		'type'		=> 'textarea',
			      		'title'		=> 'Text',
			      		'subtitle'	=> 'This text will be at footer, so don\'t write to much',
			      		'desc'		=> 'You should write a small text. If you want a big one, better create a new Page and write more there.'
			      	),
			    ),
			);

			// Newsletter
			$this->sections[] = array(
				'title'		=> 'Newsletter',
				'heading'	=> 'Newsletter',
				'icon'		=> 'el-icon-folder',
				'desc'		=> '<p class="description">Newsletter text settings.</p>',
				'fields'	=> array(

					array( // Title
						'id'		=> $themePrefix . 'newsletterTitle',
						'type'		=> 'text',
						'title'		=> 'Title',
						'desc'		=> 'This text will be on footer.'
					),

					array(
						'id'		=> $themePrefix . 'newsletterText',
						'type'		=> 'textarea',
						'title'		=> 'Text',
						'desc'		=> 'Use this area to describe, in few words, how the user\'s can subscribe on your newsletter.'
					),

					array(
						'id'		=> $themePrefix . 'newsletterButton',
						'type'		=> 'text',
						'title'		=> 'Button text',
						'desc'		=> 'Button label text.'
					),
				)
			);

			$this->sections[] = array(
				'title'		=> 'Footer',
				'heading'	=> 'Footer',
				'icon'		=> 'el-icon-hand-down',
				'desc'		=> '<p class="description">Footer settings.</p>',
				'fields'	=> array(

					array( // Limit category
						'id'		=> $themePrefix . 'footerLimitCategory',
						'type'			=> 'slider',
						'title'			=> 'Limit categories menu items',
						'subtitle'		=> 'Number of categories items at footer menu.',
						'default'		=> 5,
						'min'			=> 1,
						'max'			=> 10,
						'step'			=> 1,
						'display_value'	=> 'label'
					),

					array( // Limit tag
						'id'		=> $themePrefix . 'footerLimitTag',
						'type'			=> 'slider',
						'title'			=> 'Limit tags menu items',
						'subtitle'		=> 'Number of tags items at footer menu.',
						'default'		=> 10,
						'min'			=> 2,
						'max'			=> 20,
						'step'			=> 2,
						'display_value'	=> 'label'
					),
				)
			);

			/************ END THEME PANELS **************/

			if( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ){
				$tabs['docs'] = array(
					'icon'	  => 'el-icon-book',
					'title'	 => __('Documentation', 'redux-framework-demo'),
					'content'   => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
				);
			}
		}

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'		=> 'redux-help-tab-1',
				'title'	 => __('Theme Information 1', 'redux-framework-demo'),
				'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			$this->args['help_tabs'][] = array(
				'id'		=> 'redux-help-tab-2',
				'title'	 => __('Theme Information 2', 'redux-framework-demo'),
				'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
		}

		/**

		  All the possible arguments for Redux.
		  For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'		  => 'redux_options',			// This is where your data is stored in the database and also becomes your global variable name.
				'display_name'	  => $theme->get('Name'),	 // Name that appears at the top of your panel
				'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
				'menu_type'		 => 'menu',				  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'	=> true,					// Show the sections below the admin menu item or not
				'menu_title'		=> __('Opções do tema', 'redux-framework-demo'),
				'page_title'		=> __('Opções do tema', 'redux-framework-demo'),
				
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key' => '', // Must be defined to add google fonts to the typography module
				
				'async_typography'  => true,					// Use a asynchronous font on the front end or font string
				//'disable_google_fonts_link' => true,					// Disable this in case you want to create your own google fonts loader
				'admin_bar'		 => true,					// Show the panel pages on the admin bar
				'global_variable'   => '',					  // Set a different name for your global variable other than the opt_name
				'dev_mode'		  => false,					// Show the time the page took to load, etc
				'customizer'		=> true,					// Enable basic customizer support
				//'open_expanded'	 => true,					// Allow you to start the panel in an expanded way initially.
				//'disable_save_warn' => true,					// Disable the save warning when a user changes a field

				// OPTIONAL -> Give you extra features
				'page_priority'	 => null,					// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'	   => 'themes.php',			// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'  => 'manage_options',		// Permissions needed to access the options panel.
				'menu_icon'		 => '',					  // Specify a custom URL to an icon
				'last_tab'		  => '',					  // Force your panel to always open to a specific tab (by id)
				'page_icon'		 => 'icon-themes',		   // Icon displayed in the admin panel next to your menu_title
				'page_slug'		 => '_options',			  // Page slug used to denote the panel
				'save_defaults'	 => true,					// On load save the defaults to DB before user clicks save or not
				'default_show'	  => false,				   // If true, shows the default value next to each field that is not the default value.
				'default_mark'	  => '',					  // What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export' => true,				   // Shows the Import/Export panel when not used as a field.
				
				// CAREFUL -> These options are for advanced use only
				'transient_time'	=> 60 * MINUTE_IN_SECONDS,
				'output'			=> true,					// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'		=> true,					// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				// 'footer_credit'	 => '',				   // Disable the footer credit of Redux. Please leave if you can help it.
				
				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'			  => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'system_info'		   => false, // REMOVE

				// HINTS
				'hints' => array(
					'icon'		  => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'	=> 'lightgray',
					'icon_size'	 => 'normal',
					'tip_style'	 => array(
						'color'		 => 'light',
						'shadow'		=> true,
						'rounded'	   => false,
						'style'		 => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'	=> array(
						'show'		  => array(
							'effect'		=> 'slide',
							'duration'	  => '500',
							'event'		 => 'mouseover',
						),
						'hide'	  => array(
							'effect'	=> 'slide',
							'duration'  => '500',
							'event'	 => 'click mouseleave',
						),
					),
				)
			);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
			$this->args['share_icons'][] = array(
				'url'   => 'https://github.com/vhenrique',
				'title' => 'Visit me on GitHub',
				'icon'  => 'el-icon-github'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'http://facebook.com/vhenrique.vhs',
				'title' => 'Find me on Facebook',
				'icon'  => 'el-icon-facebook'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'https://www.instagram.com/vhenriquevhs/',
				'title' => 'Find me us on Instagram',
				'icon'  => 'el-icon-instagram'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'https://www.linkedin.com/in/vhenriquevhs',
				'title' => 'Find me on LinkedIn',
				'icon'  => 'el-icon-linkedin'
			);

			// Panel Intro text -> before the form
			if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
				if (!empty($this->args['global_variable'])) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace('-', '_', $this->args['opt_name']);
				}
				$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
			} else {
				$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
			}

			// Add content after the form.
			$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');
		}

	}
	
	global $reduxConfig;
	$reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
	function redux_my_custom_field($field, $value) {
		print_r($field);
		echo '<br/>';
		print_r($value);
	}
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
	function redux_validate_callback_function($field, $value, $existing_value) {
		$error = false;
		$value = 'just testing';

		/*
		  do your validation

		  if(something) {
			$value = $value;
		  } elseif(something else) {
			$error = true;
			$value = $existing_value;
			$field['msg'] = 'your custom error message';
		  }
		 */

		$return['value'] = $value;
		if ($error == true) {
			$return['error'] = $field;
		}
		return $return;
	}
endif;
