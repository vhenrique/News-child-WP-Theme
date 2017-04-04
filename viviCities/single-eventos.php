<?php get_header();
	if( have_posts() ): 
		while( have_posts() ): the_post(); ?>
		<div class="container">
			<?php 
				echo '<div class="page-breadcrumbs">';
					echo '<h1 class="section-title">' . get_the_title() . '</h1>';
					get_breadcrumbs();
				echo '</div>';
			?>
			<section class="section">
				<div class="row">
					<div class="col-sm-9">
						<div id="site-content" class="site-content">
							<div class="row">
								<div class="col-sm-12">
									<div class="left-content">
										<div class="details-news">											
											<div class="post">
												<?php 
												if( ! empty( get_the_post_thumbnail() ) ){
													echo '<div class="entry-header">';
														echo '<div class="entry-thumbnail">';
															echo get_the_post_thumbnail( get_the_id(), $themePrefix . 'singleThumbnail', array(
																	'title'		=> get_the_title(),
																	'alt'		=> get_the_excerpt(),
																	'class'		=> 'img-responsive'
																) 
															);
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
													<h2 class="entry-title"><?php the_title(); ?></h2>
													<?php 
													echo '<h3>';

														// Event start date
														if( ! empty( get_post_meta( get_the_id(), $themePrefix . 'eventStartDate', true ) ) ){
															echo '<i class="fa fa-calendar" aria-hidden="true"></i>';
															echo date('d/m/Y', get_post_meta( get_the_id(), $themePrefix . 'eventStartDate', true ) );
														}

														// Event end date
														if( ! empty( get_post_meta( get_the_id(), $themePrefix . 'eventEndDate', true ) ) ){
															echo ' - ' . date('d/m/Y', get_post_meta( get_the_id(), $themePrefix . 'eventEndDate', true ) );
														}

														
													echo '</h3>';
													?>
													<div class="entry-content">
														<?php the_content(); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
						<hr />
							<div class="col-sm-12">

								<?php 
								// Comment list and form
								comments_template();

								// Main category term
								$category = get_the_category();
								$category = $category[0];								

								// Related posts
								$relatedPosts = get_posts( array(
										'post_type'			=> $wp_query->query_vars['post_type'],			// Current post type
										'posts_per_page'	=> 6,											// Keep alignment with multiple from 6
										'post__not_in'		=> array( get_the_id() ),						// Remove current post from query
										'tax_query'			=> array(
											array(															// Get posts by current main category from the current post
												'taxonomy'	=> 'category',
												'field'		=> 'slug',
												'terms'		=> $category->slug
											),
										),
									) 
								);

								if( ! empty( $relatedPosts ) ){
									echo '<section class="section">';
										echo '<h1 class="section-title">Veja também</h1>';
										echo '<div class="row">';
										foreach( $relatedPosts as $related ){
											echo '<div class="col-sm-4">';
												echo '<div class="post medium-post">';
													echo '<div class="entry-header">';
														echo '<div class="entry-thumbnail">';
															echo get_the_post_thumbnail( $related->ID, $themePrefix . 'postList', array(
																	'title'		=> $related->post_title,
																	'alt'		=> $related->post_excerpt,
																	'class'		=> 'img-responsive'
																) 
															);
														echo '</div>';
													echo '</div>';
													echo '<div class="post-content">';
														echo '<div class="entry-meta">';
															echo '<ul class="list-inline">';
																echo '<li class="publish-date"><i class="fa fa-clock-o"></i>' . get_the_date( 'd M, Y', $related->ID ) . '</li>';
																
																echo getVisitorCount( $related->ID );
																echo getCommentsCount( $related->ID );
															echo '</ul>';
														echo '</div>';
														echo '<h2 class="entry-title">';
															echo '<a href="' . get_permalink( $related->ID ) . '">' . $related->post_title . '</a>';
														echo '</h2>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
										}
										echo '</div>';
									echo '</section>';
								}
								?>
							</div>
						</div>
					</div>
					
					<?php get_sidebar( ); ?>
				
				</div>				
			</section>
		</div>
		<?php endwhile; endif; ?>
	</div>
<?php get_footer(); ?>