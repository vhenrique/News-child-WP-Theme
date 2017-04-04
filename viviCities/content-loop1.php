<?php 
/**
 * @description
 * @author   Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 */
/*
	This template part folow the model from layout
	The first post has a thumbnail image and the others just a list that contains just name
*/

	// Get posts of from the most popular category
	if( ! empty( $recentNews ) ){
		echo '<section class="section">';
			echo '<h1 class="section-title" ' . get_termColor( $term->term_id, 'color') . '>' . $term->name . '</h1>';
			echo '<div class="cat-menu">';
				echo '<a href="' . get_term_link( $term->term_id ) . '">Ver mais</a>';
			echo '</div>';
			echo '<div class="post">';

			foreach( $recentNews as $news => $newsPost){
				$seenPosts[] = $newsPost->ID;

				// Verify if this is the first position of the array, the first post has a different layout than the others
				if( $news == 0 ){
					echo '<div class="entry-header">';
						echo '<div class="entry-thumbnail">';
							echo get_the_post_thumbnail( $newsPost->ID, $themePrefix . 'contentSize', array(
									'title'		=> $newsPost->post_title,
									'alt'		=> $newsPost->post_excerpt,
									'class'		=> 'img-responsive'
								)
							);
						echo '</div>';
					echo '</div>';
					echo '<div class="post-content">';
						echo '<div class="entry-meta">';
							echo '<ul class="list-inline">';
								echo '<li class="publish-date"><i class="fa fa-clock-o"></i>' . get_the_date( 'd M, Y', $newsPost->ID) . '</li>';
								
								echo getVisitorCount( $newsPost->ID );
								echo getCommentsCount( $newsPost->ID );
							echo '</ul>';
						echo '</div>';
						echo '<h2 class="entry-title">';
							echo '<a href="' . get_permalink( $newsPost->ID ) . '">' . $newsPost->post_title . '</a>';
						echo '</h2>';
						echo '<div class="entry-content">';
							echo '<p>' . $newsPost->post_excerpt . '</p>';
						echo '</div>';
					echo '</div>';
				} 
				else{
					
					// Concat post items to list them below
					$postList .='<li><a href="' . get_permalink( $newsPost->ID ) . '">' . $newsPost->post_title . '<i class="fa fa-angle-right"></i></a></li>';
				}
			}

				echo '<div class="list-post">';
					echo '<ul>';
						echo $postList;
					echo '</ul>';
				echo '</div>';
			echo '</div>';
		echo '</section>';
	}
?>