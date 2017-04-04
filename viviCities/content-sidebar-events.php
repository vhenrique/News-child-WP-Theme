<?php 
	global $themePrefix;

	$events = get_posts( array( 
			'post_type'		=> 'eventos',
			'posts_per_page'=> 4
		) 
	);

	if( ! empty( $events ) ){
		echo '<section class="widget">';
			echo '<h1 class="section-title title">Eventos</h1>';
			echo '<div class="cat-menu"><a href="' . get_post_type_archive_link( 'eventos' ) . '">Ver mais</a></div>';
			echo '<ul class="post-list">';
			foreach( $events as $event ){
				echo '<li>';
					echo '<div class="post small-post">';
						echo '<div class="entry-header">';
							echo '<div class="entry-thumbnail">';
								echo get_the_post_thumbnail( $event->ID, $themePrefix . 'smallList', array(
										'title'		=> $event->post_title,
										'alt'		=> $event->post_excerpt,
										'class'		=> 'img-responsive'
									) 
								);
							echo '</div>';
						echo '</div>';
						echo '<div class="post-content">';
							echo '<div class="video-catagory">';
								echo '<a href="' . get_permalink( $event->ID ) . '">' . $event->post_title . '</a>';
							echo '</div>';
							echo '<h2 class="entry-title">';
								echo '<a href="' . get_permalink( $event->ID ) . '">' . date('d/m/Y', get_post_meta( $event->ID, $themePrefix . 'eventStartDate', true ) )  . '</a>';
							echo '</h2>';
						echo '</div>';
					echo '</div>';
				echo '</li>';
			}
			echo '</ul>';
		echo '</section>';
	}		
?>