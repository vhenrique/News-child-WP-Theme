<?php 
	$comments = get_comments( array(
			'status'		=> 'approve',
			'number'		=> 5
		) 
	);

	if( ! empty( $comments ) ){
		echo '<div class="widget meta-widget">';
			echo '<h1 class="section-title title">Últimos comentários</h1>';
			echo '<div class="meta-tab">';
				echo '<div class="tab-content">';
					echo '<div role="tabpanel">';
						echo '<ul class="comment-list">';
						foreach( $comments as $comment ){
							echo '<li>';
							echo '<div class="post small-post">';
								echo '<div class="post-content">';
									echo '<div class="entry-meta">';
										echo '<ul class="list-inline">';
											echo '<li class="post-author">' . $comment->comment_author . '</li>';
											echo '<li class="publish-date">' . get_comment_date( 'd M, Y', $comment->comment_id ) . '</a></li>';
										echo '</ul>';
									echo '</div>';
									echo '<h2 class="entry-title">' . textLimit( $comment->comment_content, 25) . '</h2>';
								echo '</div>';
							echo '</div>';
							echo '</li>';
						}
						echo '</ul>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
?>