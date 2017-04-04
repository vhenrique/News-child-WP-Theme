<?php get_header(); ?>
		<div class="container">
			<div class="page-breadcrumbs">
				<?php 
				echo '<h1 class="section-title">' . single_cat_title( '', false ) . '</i></h1>';

				// Get page breadcrumb
				get_breadcrumbs();

				if ( category_description() ){
					echo '<p>' . category_description() . '</p>';
				} 
				?>
			</div>

			<section class="section">
				<div class="row">
					<div class="col-sm-9">
						<?php  
						if( have_posts() ){
							echo '<div class="section listing-news">';

							while( have_posts() ){
								the_post();
								

								echo '<div class="post">';
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
										
										<?php 
										echo '<h2 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
										echo '<div class="entry-content"><p>' . get_the_excerpt() . '</p></div>';
									echo '</div>';
								echo '</div>';

							}
							echo '</div>';
						}

						get_numeric_pagination();
						?>
					</div>					
					<?php get_sidebar(); ?>
				</div>				
			</section>
		</div>
	</div>
<?php get_footer(); ?>