<?php 	
	global $themePrefix;
	echo '<div class="post">';
		if( ! empty( get_post_meta( get_the_id(), $themePrefix . 'videoEmbed', true ) ) ){
			echo '<div class="entry-header">';
				echo '<div class="entry-thumbnail embed-responsive embed-responsive-16by9">';
					echo '<iframe class="embed-responsive-item" src="' . get_post_meta( get_the_id(), $themePrefix . 'videoEmbed', true ) . '"></iframe>';
				echo '</div>';
			echo '</div>';
		}
		?>
		
		<div class="post-content">								
			<div class="entry-meta">
				<ul class="list-inline">
					<?php 
					// Author
					echo '<li class="posted-by">';
						echo '<i class="fa fa-user"></i>';
						echo 'por <a href="' . get_author_posts_url( get_the_author_id() ) . '" title="Veja mais publicações de ' . get_the_author() . '">';
							echo get_the_author();
						echo '</a>';
					echo '</li>';

					// Date
					echo '<li class="publish-date">';
						echo '<i class="fa fa-clock-o"></i>';
						echo get_the_date( 'd M, Y' );
					echo '</li>';

					// Views
					echo getVisitorCount( get_the_id() );

					// Comments
					echo getCommentsCount( get_the_id() );
					?>
				</ul>
			</div>
			
			<?php 
			echo '<h2 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			echo '<h5>';

				// Event start date
				if( ! empty( get_post_meta( get_the_id(), $themePrefix . 'eventStartDate', true ) ) ){
					echo '<i class="fa fa-calendar" aria-hidden="true"></i>';
					echo date('d/m/Y', get_post_meta( get_the_id(), $themePrefix . 'eventStartDate', true ) );
				}

				// Event end date
				if( ! empty( get_post_meta( get_the_id(), $themePrefix . 'eventEndDate', true ) ) ){
					echo ' - ' . date('d/m/Y', get_post_meta( get_the_id(), $themePrefix . 'eventEndDate', true ) );
				}

				
			echo '</h5>';

			echo '<div class="entry-content"><p>' . get_the_excerpt() . '</p></div>';
		echo '</div>';
	echo '</div>';
?>