<?php 
	global $redux_options, $themePrefix;
	echo '<div class="widget">';
		$latestNews = get_posts(
			array(
				'post_type'			=> 'noticias',
				'posts_per_page'	=> $redux_options[$themePrefix . 'sbLimitNews']
			)
		);

		if( ! empty( $latestNews ) ){
			echo '<h1 class="section-title title">Últimas notícias</h1>';
			echo '<ul class="post-list">';
			foreach( $latestNews as $news ){
				echo '<li>';
					echo '<div class="post small-post">';
						echo '<div class="entry-header">';
							echo '<div class="entry-thumbnail">';
								echo get_the_post_thumbnail( $news->ID, $themePrefix . 'smallList', array(
										'title'		=> $news->post_title,
										'alt'		=> $news->post_excerpt,
										'class'		=> 'img-responsive'
									) 
								);
							echo '</div>';
						echo '</div>';
						echo '<div class="post-content">';
							$terms = wp_get_post_terms( $news->ID, 'category');
							if( ! empty( $terms ) ){
								echo '<div class="video-catagory">';
									echo '<a href="' . get_term_link( $terms[0]->term_id ) . '" ' . get_termColor( $terms[0]->term_id, 'color' ) . '>' . $terms[0]->name . '</a>';
								echo '</div>';
							}
							echo '<h2 class="entry-title">';
								echo '<a href="' . get_permalink( $news->ID ) . '">' . $news->post_title . '</a>';
							echo '</h2>';
						echo '</div>';
					echo '</div>';
				echo '</li>';

			}
			echo '</ul>';
		}
	echo '</div>';
?>