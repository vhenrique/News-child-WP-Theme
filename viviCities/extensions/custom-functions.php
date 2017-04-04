<?php
	
	/**
	 * Get page template URL to export
	 */
	add_action('admin_footer', 'hiddenFieldsNewsleter');
	function hiddenFieldsNewsleter(){
		echo '<input type="hidden" value="' . get_template_directory_uri() . '/page-templates/exportUsers.php" class="tableExport">';
	}

	/**
	 *  Include newsletter export button at admin menu	 
	 */
	add_action('admin_init', 'export_newsletter');
	function export_newsletter(){
		add_submenu_page( 'users.php', 'Exportação de Assinantes', 'Exportar assinantes', 'administrator', 'export-newsletter');
	}

	/**
	 * Enqueue JS to call Ajax function to export the users from newsletter
	 */
	add_action('admin_enqueue_scripts', 'jsLoad');
	function jsLoad(){
		wp_enqueue_script('adminFunctions', get_template_directory_uri() . '/assets/js/adminFunctions.js', array('jquery'), '', true);
	}
	
	/**
	 * Limit text size by words
	 * @param  [string] $text      [Complete text to limit]
	 * @param  [int] 	$maxLength [Size of text in words to return]
	 * @return [string]			   [Text formated limited by words max lenght]
	 */
	function textLimit( $text, $maxLength ){
		$text = explode( ' ', $text );
		
		for( $i = 0; $i < $maxLength; $i++ ){
			$words[] = $text[$i];
		}

		return implode(' ', $words);
	}

	/**
	 * Make a list with the not empty social networks registered in custom theme options
	 * @return [string] [a list that contains each social network profile]
	 */
	function getSocialNetworks(){
		global $redux_options, $themePrefix;

		// Facebook
		if( strlen( $redux_options[$themePrefix . 'socialFacebook'] ) > 0 ){
			$mediaList .= '<li><a href="' . $redux_options[$themePrefix . 'socialFacebook'] . '" target="_BLANK"><i class="fa fa-facebook"></i></a></li>';
		}

		// Twitter
		if( strlen( $redux_options[$themePrefix . 'socialTwitter'] ) > 0 ){
			$mediaList .=  '<li><a href="' . $redux_options[$themePrefix . 'socialTwitter'] . '" target="_BLANK"><i class="fa fa-twitter"></i></a></li>';
		}

		// Google Plus
		if( strlen( $redux_options[$themePrefix . 'socialGoogle'] ) > 0 ){
			$mediaList .=  '<li><a href="' . $redux_options[$themePrefix.'socialGoogle'] . '" target="_BLANK"><i class="fa fa-google-plus"></i></a></li>';
		}
		
		// Linkedin
		if( strlen( $redux_options[$themePrefix . 'socialLinkedin'] ) > 0 ){
			$mediaList .=  '<li><a href="' . $redux_options[$themePrefix . 'socialLinkedin'] . '" target="_BLANK"><i class="fa fa-linkedin"></i></a></li>';
		}

		// YouTube
		if( strlen( $redux_options[$themePrefix . 'socialYoutube'] ) > 0){
			$mediaList .=  '<li><a href="' . $redux_options[$themePrefix . 'socialYoutube'] . '" target="_BLANK"><i class="fa fa-youtube"></i></a></li>';
		}

		return $mediaList;
	}

	/**
	 * Number of comments by post
	 * @param  [int] 	$post_id [post identifier]
	 * @return [string]          [list item with class icon from comment and comment count result, returns false when it's empty]
	 */
	function getCommentsCount( $post_id ){
		$commentsCont = intval( get_comments_number( $post_id ) );

		if( ! is_null( $commentsCont ) && $commentsCont > 0){
			return '<li class="comments" title="Contador de comentários"><i class="fa fa-comment-o"></i>' . $commentsCont . '</li>';
		}
		else{
			return false;
		}
	}

	/**
	 * Get the custom term color from tax meta class
	 * @param  [int] 	$term_id [Id of term]
	 * @param  [string] $type    [Type to return on front, could be background, color...]
	 * @return [type]			 [String that contains a css hard code to aplly the term custom color]
	 */
	function get_termColor( $term_id, $type ){
		global $themePrefix;

		switch ( $type ) {
			case 'background':
				$termColor = 'style="background-color: ';
				break;
			case 'color':
				$termColor = 'style="color: ';
				break;
			default:
				$termColor = 'style="background-color: ';
				break;
		}

		if( ! empty( get_tax_meta( $term_id, $themePrefix . 'categoryColor' ) ) ){
			$termColor .= get_tax_meta( $term_id, $themePrefix . 'categoryColor' ).'"';
		} 
		else{
			$termColor .= '#000"';
		}
		

		return $termColor;
	}

	/**
	 * Number of visitor in a post single page
	 * @param  [int] 	$post_id [An unique number to indentify the post on database]
	 * @return [string]          [If there is some visitor, the function returns an formated string with number. Return 0 when it's empty]
	 */
	function getVisitorCount( $post_id ){
		global $themePrefix;
		$visits = intval( get_post_meta( $post_id, $themePrefix . 'visitorCount', true ) );

		if( ! is_null( $visits ) && $visits > 0 ){
			return '<li class="views" title="Contador de visitas"><i class="fa fa-eye"></i>' . $visits . '</li>';
		} 
		else{
			return '<li class="views" title="contador de visitas"><i class="fa fa-eye"></i>0</li>';
		}
	}

	/**
	 * Visitor counter on single pages
	 * @return [void]
	 */
	function newVisit(){
		global $themePrefix;
		if( is_singular( array( 'noticias', 'eventos', 'videos' ) ) ){
			update_post_meta( get_the_id(), $themePrefix.'visitorCount', get_post_meta( get_the_id(), $themePrefix.'visitorCount', true ) + 1 );
		}
	}	

	/**
	 * Custom numeric pagination feature without plugin
	 * @return [text] [An HTML that build the archive pagination]
	 */
	function get_numeric_pagination(){
		global $wp_query;
		global $numpages;
		$total_pages	= $wp_query->max_num_pages;
		$big			= 999999999; // need an unlikely integer
		if($total_pages > 1){
			echo '<div class="pagination-wrapper">';
			echo paginate_links(
				array(
					'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'	=> '/page/%#%',
					'current'	=> max(1, get_query_var('paged')),
					'total'		=> $wp_query->max_num_pages,
					'type'		=> 'list',
					'class'		=> 'teste',
					'prev_text'	=> '<i class="fa fa-long-arrow-left"></i>',
					'next_text'	=> '<i class="fa fa-long-arrow-right"></i>'
				)
			);
			echo '</div>';
		}
	}

// Breadcrumbs
	function get_breadcrumbs(){
		global $wp_query, $post;

		$before = '<li>';
		$after = '</li>';

		// Post type object
		$ptTitle = get_post_type_object( $wp_query->query_vars['post_type'] );

		echo '<div class="world-nav cat-menu">';
			echo '<ul class="list-inline">';
			if(!is_home() && !is_front_page() || is_paged()){
				echo $before .'<a href="' . get_bloginfo('url') . '" title="Home">Home</a>' . $after;

				if( is_single() && ! is_attachment() ){
					$cat = get_the_category(); 
					$cat = $cat[0];

					// Post type link
					echo $before . '<a href="'. get_post_type_archive_link( $ptTitle->name ) . '">' . $ptTitle->labels->name . '</a>' . $after;

					// Main Category
					if( ! empty( get_category_parents($cat, TRUE, '') ) ){
						echo $before;
						get_category_parents($cat, TRUE, '');
						$after;
					}
					
					// Current page
					// echo $before . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . $after;
				} 
				else if( is_attachment() ){
					$parent = get_post( $post->post_parent );
					$cat = get_the_category( $parent->ID );

					echo $before . get_category_parents($cat[0], TRUE, '') . $after;
					echo $before.'<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>' . $after;
					echo $before . get_the_title() . $after;
				} 
				else if( is_page() && ! $post->post_parent ){
					echo $before . get_the_title() . $currentAfter;
				} 
				else if( is_page() && $post->post_parent ){
					$parent_id  = $post->post_parent;
					
					while( $parent_id ) {
						$page = get_page( $parent_id );
						$breadcrumbs[] = $before . '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>' . $after;
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse( $breadcrumbs );
					foreach ( $breadcrumbs as $crumb ) {
						echo $crumb;
					}
					echo $before . get_the_title() . $after;
				} 
				else if( is_search() ){
					echo $before . '<a href="javascript:void(0);">Busca</a>' . $after;
				} 
				else if( is_category() ){
					echo $before;
					echo '<a href="javascript: void(0);">';
						single_cat_title();
					echo '</a>';
					echo $after;
				}				
				else if( is_tag() ){
					echo $before;
					single_tag_title();
					echo $after;
				} 
				else if( is_404() ){
					echo $before . 'Página não encontrada =(' . $after;
				} 
				else if( is_archive() ){
					echo $before . '<a href="javascript:void(0);">' . $ptTitle->labels->name . '</a>' . $after;
				}
			}
		echo '</ul></div>';
	}
?>