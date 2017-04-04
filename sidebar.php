	<div class="col-sm-3">
		<div id="sitebar">

			<?php 
			global $redux_options, $themePrefix;

			// Social networks list
			get_template_part( 'content', 'sidebar-social' ); 

			// Banner
			get_template_part( 'content', 'sidebar-banner' );
			
			// Lastest news list
			get_template_part( 'content', 'sidebar-lastestNews' );
			?>
		</div>
	</div>