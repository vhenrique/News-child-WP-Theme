<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,300,700" rel="stylesheet" type="text/css">

	<?php
	wp_head(); 

	// Visitors counter on single pages
	newVisit();
	global $redux_options, $themePrefix;
	if( ! empty( $redux_options[$themePrefix.'favicon_url'] ) ){
		echo '<link href="'.$redux_options[$themePrefix.'favicon_url']['url'].'" rel="shortcut icon" type="image/x-icon" />';
	} ?>
</head>
<body <?php body_class(); ?>>
	<div id="main-wrapper" class="homepage">
		<header id="navigation">
			<div class="navbar" role="banner">
				<?php 
				// Image brand
				if( ! empty( $redux_options[$themePrefix.'logo_url'] ) && strlen( $redux_options[$themePrefix . 'logo_url']['url'] ) !=  0 ){
					echo '<a class="secondary-logo" href="'.get_home_url().'">';
						echo '<img class="img-responsive" src="'.$redux_options[$themePrefix.'logo_url']['url'].'" title="'.get_bloginfo( 'name' ).'" alt="'.get_bloginfo( 'description' ).'" />';
					echo '</a>';
				} 
				else{
					echo '<a class="secondary-logo" href="'.get_home_url().'">';
						echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
					echo '</a>';
				}  ?>
				<div class="topbar">
					<div class="container">
						<div id="topbar" class="navbar-header">
							<?php 

							// Image logo / brand at absolute header
							if(  ! empty( $redux_options[$themePrefix . 'logo_url'] )  && strlen( $redux_options[$themePrefix . 'logo_url']['url'] ) !=  0 ){
								echo '<a class="navbar-brand" href="' . get_home_url() . '">';
									echo '<img class="main-logo img-responsive" src="' . $redux_options[$themePrefix . 'logo_url']['url'] . '" title="' . get_bloginfo( 'name' ) . '" alt="' . get_bloginfo( 'description' ) . '" />';
								echo '</a>';
							} else{
								echo '<h1 class="col-md-3"><a href="' . get_home_url() . '">' . get_bloginfo( 'name' ) . '</a></h1>';
							} ?>							
							<div id="topbar-right">
								<?php 

								// If the switch on theme options will true, show the date
								if( $redux_options[$themePrefix . 'showDate'] ){
									echo '<div id="date-time">';
									echo date('d') . ' de ' . date('F') . ', ' . date('Y');
									echo '</div>';
								}

								if( $redux_options[$themePrefix . 'showWeather'] ){
									echo '<div id="weather"></div>';
								}
								?>
							</div>
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div> 
					</div> 
				</div> 
				<div id="menubar">
					<div class="container">
					<?php wp_nav_menu( array( 
							'menu'				=> 'main',
							'container'		 	=> 'nav',
							'container_class'	=> 'navbar-left collapse navbar-collapse',
							'container_id'		=> 'mainmenu',
							'menu_class'		=> 'nav navbar-nav',
							'theme_location' 	=> 'Main',

							) 
						); ?>
						<div class="searchNlogin">
							<ul>
								<li class="search-icon"><i class="fa fa-search"></i></li>
							</ul>
							<div class="search">
								<form action="<?php echo get_home_url(); ?>" method="GET">
									<?php echo '<input type="text" class="search-form" name="s" placeholder="Buscar em '.get_bloginfo( 'name' ).'" required />'; ?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>