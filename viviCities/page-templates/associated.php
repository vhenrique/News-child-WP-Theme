<?php 
/**
 * Template name: Cadastro de associados
 */

get_header();
global $redux_options, $themePrefix; ?>
	<div class="container">
		<div class="page-breadcrumbs">
			<?php 
			echo '<h1 class="section-title">' . get_the_title() . '</i></h1>';

			// Get page breadcrumb
			get_breadcrumbs();
			?>
		</div>
		<div class="contact-us contact-page-two">
			<?php 
			if( have_posts() ){
				while( have_posts() ){
					the_post(); ?>

					<div class="post">
						<div class="post-content">
							<h2 class="entry-title"><?php echo get_the_title(); ?></h2>
							<div class="entry-content">
									<?php echo get_the_content(); ?>
								</div>
							</div>
						</div>
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
								<div class="col-sm-4">
									<div class="form-group">
										<label for="celphone">Celular</label>
										<input type="text" name="celphone" class="form-control" required="required">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="cpf">CPF</label>
										<input type="text" name="cpf" class="form-control" required="required">
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="birthday">Data de nascimento</label>
										<input type="text" name="birthday" class="form-control" required="required">
									</div>
								</div>
								<div class="col-sm-12">
									<hr />
									<div class="text-center">
										<button type="submit" class="btn btn-primary">Enviar</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				<?php }
			}

			if( isset( $_POST ) ){
				$message = "Cadastro de novo associado enviado por " . $_POST['name'] . "\r\n";
				$message .= "Informações enviadas: \r\n \r\n";
				$message .= "Nome: " . $_POST['name'] . "\r\n";
				$message .= "Email: " . $_POST['email'] . "\r\n";
				$message .= "Telefone: " . $_POTS['celphone'] . "\r\n";
				$message .= "Cpf: " . $_POST['cpf'] . "\r\n";
				$message .= "Data de nascimento: " . $_POST['birthday'] . "\r\n";

				wp_mail( get_option( 'admin_email' ), 'Associado - ' . get_option( 'blogname' ), $message );
			}
			?>
		</div>
	</div>
<?php get_footer(); ?>