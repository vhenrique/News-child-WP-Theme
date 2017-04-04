<?php 
	// if( strlen(getSocialNetworks() ) > 0 ){
		echo '<div class="widget follow-us">';
			echo '<h1 class="section-title title">Siga-nos</h1>';
			echo '<ul class="list-inline social-icons">';
				echo getSocialNetworks();
			echo '</ul>';
		echo '</div>';
	// }
?>