<?php 	
	global $themePrefix;
	$videos = get_posts( array(
			'post_type'		 => 'videos',
			'posts_per_page' => 4
		)
	);

	if( !empty( $videos ) ){
		echo '<section class="section">';
			echo '<h1 class="section-title title">Vídeos</h1>';
			echo '<div class="cat-menu">';
				echo '<a href="' . get_post_type_archive_link( 'videos' ) .'">Ver mais</a>';
			echo '</div>';
			foreach( $videos as $videoIndex => $video ){

				// Identify the first video from the post query
				if( $videoIndex == 0 ){
					echo '<div class="post video-post medium-post">';
						
						// Verify the text lenght from video embed
						if( strlen( get_post_meta( $video->ID, $themePrefix . 'videoEmbed', true ) ) > 0 ){
							echo '<div class="entry-header">';
								echo '<div class="entry-thumbnail embed-responsive embed-responsive-16by9">';
									echo '<iframe class="embed-responsive-item" src="' . get_post_meta( $video->ID, $themePrefix . 'videoEmbed', true ) . '" allowfullscreen></iframe>';
								echo '</div>';
							echo '</div>';
						}
						echo '<div class="post-content">';
							$videoTerm = wp_get_post_terms( $video->ID, 'category' );
							echo '<div class="video-catagory"><a href="' . get_term_link( $videoTerm[0]->term_id ) . '" ' . get_termColor( $videoTerm[0]->term_id, 'color' ) . '>' . $videoTerm[0]->name . '</a></div>';
							echo '<h2 class="entry-title">';
								echo '<a href="' . get_permalink( $video->ID ) . '">' . $video->post_title . '</a>';
							echo '</h2>';
						echo '</div>';
					echo '</div>';
				}

				// Post video list
				else{
					$videoList .= '<li>';
						$videoList .= '<div class="post video-post small-post">';
							if( strlen( get_post_meta( $video->ID, $themePrefix . 'videoEmbed', true ) ) > 1 ){
								$videoList .= '<div class="entry-header">';
									$videoList .= '<div class="entry-thumbnail embed-responsive embed-responsive-16by9">';
										$videoList .= '<iframe class="embed-responsive-item" src="' . get_post_meta( $video->ID, $themePrefix . 'videoEmbed', true ) . '" allowfullscreen></iframe>';
									$videoList .= '</div>';
								$videoList .= '</div>';
							}
							$videoList .= '<div class="post-content">';
							$videoTerm = wp_get_post_terms( $video->ID, 'category' );
								$videoList .= '<div class="video-catagory"><a href="' . get_term_link( $videoTerm[0]->term_id ) . '" ' . get_termColor( $videoTerm[0]->term_id, 'color' ) . '>' . $videoTerm[0]->name .'</a></div>';
								$videoList .= '<h2 class="entry-title">';
									$videoList .= '<a href="' . get_permalink( $video->ID ) . '">' . $video->post_title . '</a>';
								$videoList .= '</h2>';
							$videoList .= '</div>';
						$videoList .= '</div>';
					$videoList .= '</li>';
				}
			}
			echo '<ul class="video-post-list">';
				echo $videoList;
			echo '</ul>';
		echo '</section>';
	}
?>