<?php 
/**
 * Template name: Contato
 */

get_header(); 
global $redux_options, $themePrefix;
?>

	<div class="container">
		<div class="contact-us contact-page-two">
			<div class="contact-info">
				<?php 
				echo '<h1 class="section-title title">' . get_the_title() . '</h1>';

				if( ! empty( $redux_options[$themePrefix . 'contacts'] ) ){
					echo '<ul class="list-inline">';
					foreach( $redux_options[$themePrefix . 'contacts'] as $contacts ){
						echo '<li>';
							echo '<i><img src="' . $contacts['url'] . '"></i>';
							echo '<h2>' . $contacts['title'] . '</h2>';
							echo '<address>';
								echo $contacts['description'];
								echo '<p class="contact-mail">';
									echo '<strong>Email:</strong>';
									echo '<a href="mailto:' . $contacts['url'] . '">' . $contacts['url'] . '</a>';
								echo '</p>';
							echo '</address>';
						echo '</li>';
					}
					echo '</ul>';
				}
				?>
			</div>
			
			<div class="message-box">
				<form id="comment-form" name="comment-form" method="POST" action="<?php echo get_permalink(); ?>">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" required="required">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" class="form-control" required="required">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="message">Mensagem</label>
								<textarea name="message" id="comment" required="required" class="form-control" rows="5"></textarea>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Enviar </button>
							</div>
						</div>
					</div>
				</form>
			</div>

			<?php 
			if( isset( $_POST ) ){
				$message = 'Mensagem enviada ' . $_POST['name'] . ' - ' . $_POST['email'] . " através do formulário de contato \r\n";
				$message .= $_POST['message'];

				wp_mail( get_option( 'admin_email' ), 'Contato - ' . get_option( 'blogname' ), $message );
			}
			?>
		</div>
	</div>

<?php get_footer(); ?>