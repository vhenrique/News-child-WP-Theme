<?php get_header(); ?>
		<div class="container">
			<div class="page-breadcrumbs">
				<?php 
				$ptTitle = get_post_type_object( $wp_query->query_vars['post_type'] );
				echo '<h1 class="section-title">' . $ptTitle->labels->name . '</i></h1>';

				// Get page breadcrumb
				get_breadcrumbs();
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
								get_template_part( 'content', 'loopEvents' );
							}
							echo '</div>';
						}
						?>
					</div>					
					<?php get_sidebar(); ?>
				</div>				
			</section>
		</div>
	</div>
<?php get_footer(); ?>