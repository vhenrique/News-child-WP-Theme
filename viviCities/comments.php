<?php
// Do not delete these lines
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die('Please do not load this page directly. Thanks!');

	if(post_password_required()){ ?>
		<p class="nocomments">Este post é protegido com senha. Entre com a sua senha para ver os comentários.</p>
	<?php
		return;
	}


	// Comment template
	if( have_comments() ){
		echo '<div class="comments-wrapper">';
			echo '<h1 class="section-title title">Comentários</h1>';
			echo  '<h5>';
				comments_number('Sem comentários', '1 comentário', '% comentários');
			echo '</h5>';
			echo '<hr>';
			echo '<ul class="media-list">';

				// Get comment from the current page / post
				$comments = get_comments( array(
						'post_id'		=> get_the_id(),
						'status'		=> 'approve'
					) 
				);

				if( ! empty( $comments ) ){
					foreach( $comments as $comment ){
						echo '<li class="media">';
							echo '<div class="media-body">';
								// Post author name | Make the first letter in cap
								echo '<h2>' . ucfirst( $comment->comment_author ). '</h2>';
								echo '<h3 class="date">' . get_comment_date( 'd M, Y', $comment->comment_ID ) . '</h3>';
								echo '<p>' . $comment->comment_content . '</p>';
							echo '</div>';
						echo '</li>';
					}
				}
			echo '</ul>';
		echo '</div>';
	}
	else{ // this is displayed if there are no comments so far
		if(comments_open()){
			comments_open();
		}
		else{
			echo '<p class="nocomments">Este post está fechado para comentários.</p>';
		}
	}

	echo '<div class="comments-box">';
		echo '<h1 class="section-title title">Deixe um comentário</h1>';
		echo '<div class="cancel-comment-reply"><small>' . cancel_comment_reply_link() . '</small></div>';

		if( get_option( 'comment_registration' ) && !is_user_logged_in() ){
			echo '<p>Você deve estar <a href="' . wp_login_url(get_permalink() ) . '" title="Fazer login">logado</a> para postar um comentário.</p>';
		}
		else{ 
			echo '<form action="' . get_option('siteurl') . '/wp-comments-post.php" method="post" id="comment-form">';
				if( is_user_logged_in() ){
					echo '<label class="lead">Olá ' . $user_identity . '</label>';
					echo '<label class="small"><a href="' . wp_logout_url( get_permalink() ) . '" title="Fazer logout">, sair</a></label>';
				}
				else{ 
					echo '<div class="col-sm-4">';
						echo '<div class="form-group">';
							echo '<input type="text" name="author" value="' . esc_attr( $comment_author ) . '" placeholder="Nome" class="form-control" required="required">';
						echo '</div>';
					echo '</div>';

					echo '<div class="col-sm-4">';
						echo '<div class="form-group">';
							echo '<input type="email" name="email" value="' . esc_attr( $comment_author_email ) . '" placeholder="Email" class="form-control" required="required">';
						echo '</div>';
					echo '</div>';
				}
				echo '<div class="col-sm-12">';
					echo '<div class="form-group">';
						echo '<textarea name="comment" placeholder="Seu comentário" id="comment" required="required" class="form-control" rows="5"></textarea>';
					echo '</div>';
				echo '</div>';

				echo '<div class="text-center">';
						echo '<input name="submit" type="submit" id="submit" class="btn btn-primary" value="Enviar" >';
					echo '</div>';
				comment_id_fields();

				do_action('comment_form', $post->ID);
			echo '</form>';
		}

	echo '</div>';
?>