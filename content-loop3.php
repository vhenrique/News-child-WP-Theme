<?php 
/**
 * @description
 * @author   Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 */
/*
	This template part folow the model from layout
	A post block with 4 posts equals
*/

	// Get posts of from the most popular category
	if( ! empty( $recentNews ) ){
		echo '<section class="section lifestyle-section">';
			echo '<h1 class="section-title" ' . get_termColor( $term->term_id, 'color') . '>' . $term->name .'</h1>';
			echo '<div class="cat-menu">';
				echo '<a href="' . get_term_link( $term->term_id ) . '">Ver mais</a>';
			echo '</div>';
			echo '<div class="row">';

			unset( $postBlock );

			foreach( $recentNews as $news => $newsPost ){
				$seenPosts[] = $newsPost->ID;

				$postBlock[] = $newsPost;
			}

			foreach( $postBlock as $key => $value ){
				if( $key == 0 || $key % 2 == 0 ){

					// Left side from post list at third category
					$postsLeft .= '<div class="post medium-post">';
						$postsLeft .= '<div class="entry-header">';
							$postsLeft .= '<div class="entry-thumbnail">';
								$postsLeft .=  get_the_post_thumbnail( $value->ID, $themePrefix . 'postListFirst', array(
										'title'		=> $value->post_title,
										'alt'		=> $value->post_excerpt,
										'class'		=> 'img-responsive'
									) 
								);
							$postsLeft .= '</div>';
						$postsLeft .= '</div>';
						$postsLeft .= '<div class="post-content">';
							$postsLeft .= '<div class="entry-meta">';
								$postsLeft .= '<ul class="list-inline">';
									$postsLeft .= '<li class="publish-date"><i class="fa fa-clock-o"></i>' . get_the_date( 'd M, Y', $value->ID ) .'</li>';

									$postsLeft .= getVisitorCount( $value->ID );
									$postsLeft .= getCommentsCount( $value->ID );
								$postsLeft .= '</ul>';
							$postsLeft .= '</div>';
							$postsLeft .= '<h2 class="entry-title">';
								$postsLeft .= '<a href="' . get_permalink( $value->ID ) . '">' . $value->post_title . '</a>';
							$postsLeft .= '</h2>';
						$postsLeft .= '</div>';
					$postsLeft .= '</div>';
				}
				else{

					// Right site
					$postsRight .= '<div class="post medium-post">';
						$postsRight .= '<div class="entry-header">';
							$postsRight .= '<div class="entry-thumbnail">';
								$postsRight .=  get_the_post_thumbnail( $value->ID, $themePrefix . 'postList', array(
										'title'		=> $value->post_title,
										'alt'		=> $value->post_excerpt,
										'class'		=> 'img-responsive'
									) 
								);
							$postsRight .= '</div>';
						$postsRight .= '</div>';
						$postsRight .= '<div class="post-content">';
							$postsRight .= '<div class="entry-meta">';
								$postsRight .= '<ul class="list-inline">';
									$postsRight .= '<li class="publish-date"><i class="fa fa-clock-o"></i>' . get_the_date( 'd M, Y', $value->ID ) .'</li>';
									
									$postsRight .= getVisitorCount( $value->ID );
									$postsRight .= getCommentsCount( $value->ID );
								$postsRight .= '</ul>';
							$postsRight .= '</div>';
							$postsRight .= '<h2 class="entry-title">';
								$postsRight .= '<a href="' . get_permalink( $value->ID ) . '">' . $value->post_title . '</a>';
							$postsRight .= '</h2>';
						$postsRight .= '</div>';
					$postsRight .= '</div>';;
				}
			}
				echo '<div class="col-md-6">';
					echo $postsLeft;
				echo '</div>';

				echo '<div class="col-md-6">';
					echo $postsRight;
				echo '</div>';
			echo '</div>';
		echo '</section>';
	}
?>