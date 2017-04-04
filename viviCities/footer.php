		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="widget">
							<?php 
								global $redux_options, $themePrefix;
								// About us text title length
								if( strlen( $redux_options[$themePrefix . 'aboutTitle'] ) > 0 ){
									echo '<h1 class="section-title title">' . $redux_options[$themePrefix . 'aboutTitle'] . '</h1>';
								}

								// About us text content length
								if( strlen( $redux_options[$themePrefix . 'aboutText'] ) > 0 ){
									echo '<p>' . $redux_options[$themePrefix . 'aboutText'] . '</p>';
								}
							?>							
							<address>
								<?php 
									// Address field
									if( strlen( $redux_options[$themePrefix . 'contactAddress'] ) > 0 ){
										echo '<p>' . $redux_options[$themePrefix . 'contactAddress'] . '</p>';
									}

									// Telephone field
									if( strlen( $redux_options[$themePrefix . 'contactTelephone'] ) > 0 ){
										echo '<p>' . $redux_options[$themePrefix . 'contactTelephone'] . '</p>';
									}

									// City and state field
									if( strlen( $redux_options[$themePrefix . 'contactCityState'] ) > 0){
										echo '<p>' . $redux_options[$themePrefix . 'contactCityState'] . '</p>';
									}

									// Email to field
									if( strlen( $redux_options[$themePrefix . 'contactEmail'] ) ){
										echo '<a href="mailto:' . $redux_options[$themePrefix . 'contactEmail'] . '">Email: ' . $redux_options[$themePrefix . 'contactEmail'] . '</a></p>';
									}
								?>
							</address>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="text-center">
							<?php 
								// Logo thumbnail
								if( ! empty( $redux_options[$themePrefix . 'logo_url'] ) && strlen( $redux_options[$themePrefix . 'logo_url']['url'] ) > 0 ){
									echo '<div class="logo-icon">';
										echo '<img class="img-responsive" src="' . $redux_options[$themePrefix.'logo_url']['url'] . '" title="' . get_bloginfo( 'name' ) . '" alt="' . get_bloginfo( 'description' ).'" />';
									echo '</div>';
								} 

								// When it's empty, show the site site title
								else{
									echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
								}
							?>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="widget news-letter">
							<?php 
								// Newsletter text title length
								if( strlen( $redux_options[$themePrefix . 'newsletterTitle'] ) > 0 ){
									echo '<h1 class="section-title title">' . $redux_options[$themePrefix . 'newsletterTitle'] . '</h1>';
								}

								if( strlen( $redux_options[$themePrefix . 'newsletterText'] ) > 0){
									echo '<p>' . $redux_options[$themePrefix . 'newsletterText'] . '</p>';
								}
							?>
							<form id="subscribe-form">
								<input type="hidden" class="newsLetterUrl" value="<?php echo get_permalink(6); ?>" />
								<input tyep="text" placeholder="Nome" class="newsletterName" name="newsletterName" required>
								<input type="text" placeholder="email" class="newsletteremail" name="newsletteremail" required>
							
								<?php 
									if( strlen( $redux_options[$themePrefix . 'newsletterButton'] ) > 0 ){
										echo '<input type="submit" id="subscribe" value="' . $redux_options[$themePrefix . 'newsletterButton'] . '">';
									} else{
										echo '<input type="submit" id="subscribe" value="Inscrever">';
									}
								?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer id="footer">
		<div class="footer-menu">
			<div class="container">
				<?php 
				wp_nav_menu( array(
						'menu'				=> 'footer',
						'theme_location'	=> 'footer',
						'menu_class'		=> 'nav navbar-nav',
					) 
				);
				?>
			</div>
		</div>
		<div class="bottom-widgets">
			<div class="container">
				<div class="col-sm-4">
					<div class="widget">
						<?php 
						$categories = get_terms( array(
								'taxonomy'		=> 'category',
								'hide_empty'	=> true,
								'number'		=> $redux_options[$themePrefix . 'footerLimitCategory']
							) 
						);

						if( ! empty( $categories ) ){
							echo '<h2>Categorias</h2>';
							echo '<ul>';
							foreach( $categories as $category ){
								echo '<li><a href="' . get_term_link( $category->term_id ) . '">' . $category->name . '</a></li>';
							}
							echo '</ul>';
						}
						?>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="widget">
						<?php 
						$tags = get_terms( array(
								'taxonomy'		=> 'post_tag',
								'hide_empty'	=> true,
								'number'		=> $redux_options[$themePrefix . 'footerLimitTag']
							)
						);

						if( ! empty( $tags ) ){
							echo '<h2>Tags</h2>';
							foreach( $tags as $key => $tag ){
								if( $key == 0 || $key % 2 == 0 ){
									$leftSide .=  '<li><a href="' . get_term_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
								} 
								else{
									$rightSide .= '<li><a href="' . get_term_link( $tag->term_id ) . '">' . $tag->name . '</a></li>';
								}
							}
							echo '<ul>' . $leftSide . '</ul>';
							echo '<ul>' . $rightSide . '</ul>';
						}
						?>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="widget">
						<?php 
						$blog_list = get_blog_list( 0, 'all' );
						if( ! empty( $blog_list ) ){
							echo '<h2>Regiões</h2>';
							echo '<ul>';
							foreach( $blog_list as $blog ){
								$blogDetails = get_blog_details( $blog['blog_id'] );
							    echo '<li><a href="' . $blogDetails->siteurl . '">' . $blogDetails->blogname . '</a></li>';
							}
							echo '</ul>';
						}


						?>						
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container text-center small">
				<?php 
					echo '<p><a href="http://avivatec.com.br/" target="_BLANK" class="avivatec">';
						echo 'Desenvolvido por <label>A</label>VIVA<label>TEC</label> Soluções em TI';
					echo '</a>&copy; '.date('Y').'  </p>';
				?>
			</div>
		</div>		
	</footer>
    <?php 
    echo '<div class="subscribe-me text-center sb">';

		// Newsletter text title length
		if( strlen( $redux_options[$themePrefix . 'newsletterTitle'] ) > 0 ){
			echo '<h1>' . $redux_options[$themePrefix . 'newsletterTitle'] . '</h1>';
		}

		if( strlen( $redux_options[$themePrefix . 'newsletterText'] ) > 0){
			echo '<h2>' . $redux_options[$themePrefix . 'newsletterText'] . '</h2>';
		}
		
		echo '<a href="#close" class="sb-close-btn">';
			echo '<img class="<img-responsive></img-responsive>" src="' . get_template_directory_uri() . '/assets/img/close-button.png" alt="" />';
		echo '</a>';

		echo '<form action="#" method="post" id="popup-subscribe-form" name="subscribe-form">';
			echo '<div class="input-group">';
				echo '<span class="input-group-addon"><img src="' . get_template_directory_uri() . '/assets/img/icon-message.png" alt="" /></span>';
				echo '<input type="text" placeholder="Email" name="email">';
				echo '<button type="submit" name="subscribe">Enviar</button>';
			echo '</div>';
		echo '</form>';
	echo '</div>';
	
    wp_footer(); ?>
</body>
</html>