<?php get_header(); ?>
	<div class="container">
		<section>
			<div class="row">
				<div class="site-content col-md-9">
					<div class="row">
						<div class="col-sm-12">
							<div id="home-slider">
								<?php 
								$primaryNews = get_posts( array(
										'post_type'			=> 'noticias',
										'posts_per_page'	=> intval( $redux_options[$themePrefix . 'limitSlider'] ),
										'meta_query'		=> array(
											array(
												'key'			=> $themePrefix . 'secondaryHighlight',
												'value'			=> 'on'
											),
										),
									) 
								);
								if( ! empty( $primaryNews ) ){
									foreach( $primaryNews as $primaryNew ){

										// Complain all the post ids from the query above to remove them from next queries
										$seenPosts [] = $primaryNew->ID;

										echo '<div class="post feature-post">';
											echo '<div class="entry-header">';
												echo '<div class="entry-thumbnail">';
													echo get_the_post_thumbnail( $primaryNew->ID, $themePrefix.'homeSlider', array( 
															'title' 	=> $primaryNew->post_title,
															'alt'		=> $primaryNew->post_excerpt,
															'class'		=> 'img-responsive'
														)
													);
												echo '</div>';
												
												$terms = wp_get_post_terms( $primaryNew->ID, 'category');
												if( ! empty( $terms ) ){
													echo '<div class="catagory" '. get_termColor( $terms[0]->term_id, 'background' ) .'>';
														echo '<a href="' . get_term_link($terms[0]->term_id) . '" title="' . $terms[0]->name . '">' . $terms[0]->name . '</a>';
													echo '</div>';
												}
											echo '</div>';
											echo '<div class="post-content">';
												echo '<div class="entry-meta">';
													echo '<ul class="list-inline">';
														echo '<li class="publish-date"><i class="fa fa-clock-o"></i>' . get_the_date( 'd M, Y', $primaryNew->ID ) . '</li>';

														echo getVisitorCount( $primaryNew->ID );
														echo getCommentsCount( $primaryNew->ID );
													echo '</ul>';
												echo '</div>';
												echo '<h2 class="entry-title">';
													echo '<a href="'. get_permalink( $primaryNew->ID ) .'">' . $primaryNew->post_title . '</a>';
												echo '</h2>';
											echo '</div>';
										echo '</div>';
									}
								}
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<?php 
						$secondaryNews = get_posts( array(
								'post_type'			=> 'noticias',
								'posts_per_page'	=> 3,
								'post__not_in'		=> $seenPosts
							)
						);
						if( ! empty( $secondaryNews ) ){
							foreach( $secondaryNews as $secondaryNew ){
								$seenPosts[] = $secondaryNew->ID;
								echo '<div class="col-sm-4">';
									echo '<div class="post feature-post">';
										echo '<div class="entry-header">';
											echo '<div class="entry-thumbnail">';
												echo get_the_post_thumbnail( $secondaryNew->ID, $themePrefix . 'postList', array(
														'title'		=> $secondaryNew->post_title,
														'alt'		=> $secondaryNew->post_excerpt,
														'class'		=> 'img-responsive'
													) 
												);
											echo '</div>';

											$terms = wp_get_post_terms( $secondaryNew->ID , 'category' );
											if( ! empty( $terms ) ){
												
												echo '<div class="catagory" '. get_termColor( $terms[0]->term_id, 'background' ) .'>';
													echo '<a href="' . get_term_link( $terms[0]->term_id ). '" title="' . $terms[0]->name . '">' . $terms[0]->name . '</a>';
												echo '</div>';
											}
										echo '</div>';
										echo '<div class="post-content">';
											echo '<div class="entry-meta">';
												echo '<ul class="list-inline">';
													echo '<li class="publish-date"><i class="fa fa-clock-o"></i>' . get_the_date( 'd M, Y', $secondaryNew->ID ) . '</li>';
													
													echo getVisitorCount( $secondaryNew->ID );
													echo getCommentsCount( $secondaryNew->ID );
												echo '</ul>';
											echo '</div>';
											echo '<h2 class="entry-title">';
												echo '<a href="' . get_permalink( $secondaryNew->ID ) . '">' . $secondaryNew->post_title . '</a>';
											echo '</h2>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						}
						?>
					</div>
				</div>
				<?php 
				// 1º Banner
				if( ! empty( $redux_options[$themePrefix . '1BannerImage'] ) && strlen( $redux_options[$themePrefix . '1BannerImage']['url'] ) > 0 ){
					echo '<div class="col-md-3 visible-md visible-lg">';
						echo '<div class="add featured-add">';

						// Verify if there's title
						if( strlen( $redux_options[$themePrefix . '1BannerTitle'] ) > 0 ){
							$bannerTitle = 'title="' . $redux_options[$themePrefix . '1BannerTitle'] . '"';
						}

						// Verify if there's target
						if( ! empty( $redux_options[$themePrefix . '1BannerTarget'] ) && $redux_options[$themePrefix . '1BannerTarget'] == true){
							$linkTarget = 'target="_BLANK"';
						}

						// Get banner link if there's one
						if( ! empty( $redux_options[$themePrefix . '1BannerLink'] ) ){
							$linkBegin = '<a href="' . $redux_options[$themePrefix . '1BannerLink'] . '" ' . $bannerTitle . ' ' . $linkTarget . '>';
							$linkEnd = '</a>';
						} else{
							$linkBegin = '';
							$linkEnd = '';
						}
						echo $linkBegin;
						echo wp_get_attachment_image( $redux_options[$themePrefix . '1BannerImage']['id'], $themePrefix . '1BannerSize', array(
									'title'		=> $bannerTitle,
									'class'		=> 'img-responsive'
								)
							);
						echo $linkEnd;
						echo '</div>';
					echo '</div>';
				} ?>
			</div>
		</section>
		
		<section class="add inner-add text-center">
			<?php 
			// 2º Banner
			if( ! empty( $redux_options[$themePrefix . '2BannerImage'] ) && strlen( $redux_options[$themePrefix . '2BannerImage']['url'] ) > 0 ){
				$bannerTitle;

				// Verify if there's title
				if( strlen( $redux_options[$themePrefix . '2BannerTitle'] ) ){
					$bannerTitle = 'title="' . $redux_options[$themePrefix . '2BannerTitle'] . '"';
				}

				// Verify if there's target
				if( ! empty( $redux_options[$themePrefix . '2BannerTarget'] ) && $redux_options[$themePrefix . '2BannerTarget'] == true){
					$linkTarget = 'target="_BLANK"';
				}

				// Get banner link if there's one
				if( ! empty( $redux_options[$themePrefix . '2BannerLink'] ) ){
					$linkBegin = '<a href="' . $redux_options[$themePrefix . '2BannerLink'] . '" ' . $bannerTitle . ' ' . $linkTarget . '>';
					$linkEnd = '</a>';
				} else{
					$linkBegin = '';
					$linkEnd = '';
				}
				echo $linkBegin;
				echo wp_get_attachment_image( $redux_options[$themePrefix . '2BannerImage']['id'], $themePrefix . 'fullWidth', array(
							'class'		=> 'img-responsive'
						)
					);
				echo $linkEnd;
			} ?>
		</section>		

		<section class="section">
			<div class="latest-news-wrapper">				
				<?php 
				$recentNews = get_posts( array(
					'post_type'			=> 'noticias',
					'posts_per_page'	=> intval( $redux_options[$themePrefix . 'limitLatestNews'] ),
					'post__not_in'		=> $seenPosts
					)
				);

				if( ! empty( $recentNews ) ){
					echo '<h1 class="section-title generic">Últimas notícias</h1>';
					echo '<div id="latest-news">';
					foreach( $recentNews as $recent ){
						$seenPosts[] = $recent->ID;
						echo '<div class="post medium-post">';
							echo '<div class="entry-header">';
								echo '<div class="entry-thumbnail">';
									echo get_the_post_thumbnail( $recent->ID, $themePrefix . 'postList', array(
											'title'		=> $recent->post_title,
											'alt'		=> $recent->post_excerpt,
											'class'		=> 'img-responsive'
										) 
									);
								echo '</div>';

								$terms = wp_get_post_terms( $recent->ID , 'category' );
								if( ! empty( $terms ) ){
									
									echo '<div class="catagory" '. get_termColor( $terms[0]->term_id, 'background') .'>';
										echo '<a href="' . get_term_link( $terms[0]->term_id ). '" title="' . $terms[0]->name . '">' . $terms[0]->name . '</a>';
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="post-content">';
								echo '<div class="entry-meta">';
									echo '<ul class="list-inline">';
										echo '<li class="publish-date"><i class="fa fa-clock-o"></i>' . get_the_date( 'd M, Y', $recent->ID ) . '</li>';
										echo '<li class="views" title="Visualizado '. get_post_meta( $recent->ID, $themePrefix . 'visitorCount', true ).' vezes">';
											echo '<i class="fa fa-eye"></i>' . get_post_meta( $recent->ID, $themePrefix . 'visitorCount', true );
										echo '</li>';
									echo '</ul>';
								echo '</div>';
								echo '<h2 class="entry-title">';
									echo '<a href="' . get_permalink( $recent->ID ) . '">' . $recent->post_title . '</a>';
								echo '</h2>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				}
				?>
			</div>
		</section>
		
		<section>
			<div class="row">
				<div class="col-md-9 col-sm-8">
					<div id="site-content">
						<div class="row">
							<div class="col-md-8 col-sm-6">
								<div class="left-content">
									<?php

										// Select the most popular categories terms
										$popularTerms = get_terms( array(
												'taxonomy'			=> 'category',
												'hide_empty'		=> true,
												'orderby'			=> 'count',
												'order'				=> 'DESC',
												'number'			=> $redux_options[$themePrefix . 'limitPostCategoryList'] // It makes 1 to LIMIT on SQL Query
											)
										);

										if( ! empty( $popularTerms ) ){
											foreach( $popularTerms as $popularTerm => $term ){

												// Switch array index from most popular terms in category taxonomy
												switch( $popularTerm ){

													case 0:
														$recentNews = get_posts( array(
															'post_type'			=> 'noticias',
															'posts_per_page'	=> 4,
															'post__not_in'		=> $seenPosts,
															'tax_query'			=> array(
																	'taxonomy'	=> 'category',
																	'field'		=> 'slug',
																	'terms'		=> $term->slug
																),
															) 
														);
														include( locate_template( 'content-loop1.php', false, false ) );
														break;

													case 1:
														$recentNews = get_posts( array(
															'post_type'			=> 'noticias',
															'posts_per_page'	=> 3,
															'post__not_in'		=> $seenPosts,
															'tax_query'			=> array(
																	'taxonomy'	=> 'category',
																	'field'		=> 'slug',
																	'terms'		=> $term->slug
																),
															) 
														);
														include( locate_template( 'content-loop2.php', false, false ) );
														break;

													case 2:
														$recentNews = get_posts( array(
															'post_type'			=> 'noticias',
															'posts_per_page'	=> 4,
															'post__not_in'		=> $seenPosts,
															'tax_query'			=> array(
																	'taxonomy'	=> 'category',
																	'field'		=> 'slug',
																	'terms'		=> $term->slug
																),
															) 
														);
														include( locate_template( 'content-loop3.php', false, false ) );
														break;

													default:
														$secondaryCategories[] = $term;
														break;
												}
											}
										}
									?>
								</div>
							</div>

							<div class="col-md-4 col-sm-6">
								<div class="middle-content">

									<?php 
									get_template_part( 'content', 'home-videos' );
									

									include( locate_template( 'content-loop4.php', false, false ) ); 
									?>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<div id="sitebar">
						<?php 
							// Social networks list
							get_template_part( 'content', 'sidebar-social' );

							// Events list
							get_template_part( 'content', 'sidebar-events' );

							// Banner 
							if( ! empty( $redux_options[$themePrefix . '3BannerImage'] ) && strlen( $redux_options[$themePrefix . '3BannerImage']['url'] ) > 0 ){
								echo '<div class="widget">';
									echo '<div class="add">';
										// Verify if there's title
										if( strlen( $redux_options[$themePrefix . '3BannerTitle'] ) > 0 ){
											$bannerTitle = 'title="' . $redux_options[$themePrefix . '3BannerTitle'] . '"';
										}

										// Verify if there's target
										if( ! empty( $redux_options[$themePrefix . '3BannerTarget'] ) && $redux_options[$themePrefix . '3BannerTarget'] == true){
											$linkTarget = 'target="_BLANK"';
										}

										// Get banner link if there's one
										if( ! empty( $redux_options[$themePrefix . '3BannerLink'] ) ){
											$linkBegin = '<a href="' . $redux_options[$themePrefix . '3BannerLink'] . '" ' . $bannerTitle . ' ' . $linkTarget . '>';
											$linkEnd = '</a>';
										} else{
											$linkBegin = '';
											$linkEnd = '';
										}
										
										echo $linkBegin;
										echo wp_get_attachment_image( $redux_options[$themePrefix . '3BannerImage']['id'], $themePrefix . '1BannerSize', array(
													'class'		=> 'img-responsive'
												)
											);
										echo $linkEnd;
									echo '</div>';
								echo '</div>';
							}
							
							// Comments list
							get_template_part( 'content', 'sidebar-comments' );
						?>
					</div>
				</div>
			</div>				
		</section>
	</div>
<?php get_footer(); ?>