<?php 
	if( ! empty( $secondaryCategories ) ){
		foreach( $secondaryCategories as $term ){
			echo '<section class="section">';

				$recentNews = get_posts( array(
					'post_type'			=> 'noticias',
					'posts_per_page'	=> 2,
					'post__not_in'		=> $seenPosts,
					'tax_query'			=> array(
							'taxonomy'	=> 'category',
							'field'		=> 'slug',
							'terms'		=> $term->slug
						),
					) 
				);

				if( ! empty( $recentNews ) ){
					// Header box
					echo '<h1 class="section-title"' . get_termColor( $term->term_id, 'color') . '>' . $term->name . '</h1>';
					echo '<div class="cat-menu">';
						echo '<a href="' . get_term_link( $term->term_id, 'category' ) . '">Ver mais</a>';
					echo '</div>';

					foreach( $recentNews as $news ){
						echo '<div class="post medium-post">';
							echo '<div class="entry-header">';
								echo '<div class="entry-thumbnail">';
									echo get_the_post_thumbnail( $news->ID, $themePrefix . 'postList', array(
											'title'		=> $news->post_title,
											'alt'		=> $news->post_excerpt,
											'class'		=> 'img-responsive'
										)
									);
								echo '</div>';
							echo '</div>';
							echo '<div class="post-content">';
								echo '<div class="entry-meta">';
									echo '<ul class="list-inline">';
										echo '<li class="publish-date"><i class="fa fa-clock-o"></i>' . get_the_date( 'd M, Y', $news->ID) . '</li>';

										echo getVisitorCount( $news->ID );
										echo getCommentsCount( $news->ID );
									echo '</ul>';
								echo '</div>';
								echo '<h2 class="entry-title">';
									echo '<a href="' . get_permalink( $news->ID ) . '">' . $news->post_title . '</a>';
								echo '</h2>';
							echo '</div>';
						echo '</div>';
					}
				}
			echo '</section>';
		}
	}	

?>