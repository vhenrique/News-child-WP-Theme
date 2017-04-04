<?php 
	global $redux_options, $themePrefix;
	// Banner 
	if( ! empty( $redux_options[$themePrefix . '3BannerImage'] ) && strlen( $redux_options[$themePrefix . '3BannerImage']['url'] ) > 0 ){
		echo '<div class="widget">';
			echo '<div class="add">';
				// Verify if there's title
				if( strlen( $redux_options[$themePrefix . '3BannerTitle'] ) > 0 ){
					$bannerTitle = 'title="' . $redux_options[$themePrefix . '3BannerTitle'] . '"';
				}

				// Verify if there's target
				if( ! empty( $redux_options[$themePrefix . '3BannerTarget'] ) && $redux_options[$themePrefix . '3BannerTarget'] == true){
					$linkTarget = 'target="_BLANK"';
				}

				// Get banner link if there's one
				if( ! empty( $redux_options[$themePrefix . '3BannerLink'] ) ){
					$linkBegin = '<a href="' . $redux_options[$themePrefix . '3BannerLink'] . '" ' . $bannerTitle . ' ' . $linkTarget . '>';
					$linkEnd = '</a>';
				} else{
					$linkBegin = '';
					$linkEnd = '';
				}
				
				echo $linkBegin;
				echo wp_get_attachment_image( $redux_options[$themePrefix . '3BannerImage']['id'], $themePrefix . '1BannerSize', array(
							'class'		=> 'img-responsive'
						)
					);
				echo $linkEnd;
			echo '</div>';
		echo '</div>';
	} 
?>