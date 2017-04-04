<?php
// Videos
	add_action('init', 'videos_register');
	function videos_register(){
		$singular_label = 'vídeo';
		$labels = array(
			'name'					=> 'Vídeos',
			'singular_name'			=> $singular_label,
			'add_new'				=> 'Novo ' . $singular_label,
			'add_new_item'			=> 'Novo  ' . $singular_label,
			'edit_item'				=> 'Editar ' . $singular_label,
			'new_item'				=> 'Novo ' . $singular_label,
			'view_item'				=> 'Ver ' . $singular_label,
			'search_items'			=> 'Buscar ' . $singular_label,
			'not_found'				=> 'Não encontrado',
			'not_found_in_trash'	=> 'Não encontrado na lixeira',
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-video-alt3',
			'hierarchical'			=> true,
			'menu_position'			=> 6,
			'has_archive'			=> true,
			'exclude_from_search'	=> false,
			'supports'				=> array( 'comments', 'editor', 'title' ),
			'taxonomies'			=> array( 'category' )
		);
		register_post_type( 'videos', $args );
	}

// Events
	add_action('init', 'events_register');
	function events_register(){
		$singular_label = 'evento';
		$labels = array(
			'name'					=> 'Eventos',
			'singular_name'			=> $singular_label,
			'add_new'				=> 'Novo ' . $singular_label,
			'add_new_item'			=> 'Novo  ' . $singular_label,
			'edit_item'				=> 'Editar ' . $singular_label,
			'new_item'				=> 'Novo ' . $singular_label,
			'view_item'				=> 'Ver ' . $singular_label,
			'search_items'			=> 'Buscar ' . $singular_label,
			'not_found'				=> 'Não encontrado',
			'not_found_in_trash'	=> 'Não encontrado na lixeira',
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-location-alt',
			'hierarchical'			=> true,
			'menu_position'			=> 4,
			'has_archive'			=> true,
			'exclude_from_search'	=> false,
			'supports'				=> array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' )
		);
		register_post_type( 'eventos', $args );
	}

// News
	add_action('init', 'news_register');
	function news_register(){
		$singular_label = 'notícia';
		$labels = array(
			'name'					=> 'Notícias',
			'singular_name'			=> $singular_label,
			'add_new'				=> 'Nova ' . $singular_label,
			'add_new_item'			=> 'Nova  ' . $singular_label,
			'edit_item'				=> 'Editar ' . $singular_label,
			'new_item'				=> 'Nova ' . $singular_label,
			'view_item'				=> 'Ver ' . $singular_label,
			'search_items'			=> 'Buscar ' . $singular_label,
			'not_found'				=> 'Não encontrado',
			'not_found_in_trash'	=> 'Não encontrado na lixeira',
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-welcome-widgets-menus',
			'hierarchical'			=> true,
			'menu_position'			=> 3,
			'has_archive'			=> true,
			'exclude_from_search'	=> false,
			'supports'				=> array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
			'taxonomies'			=> array( 'category', 'post_tag' )
		);
		register_post_type( 'noticias', $args );
	}

// Estabelecimentos
	add_action('init', 'estabelecimentos_register');
	function estabelecimentos_register(){
		$singular_label = 'estabelecimento';
		$labels = array(
			'name'					=> 'Estabelecimentos',
			'singular_name'			=> $singular_label,
			'add_new'				=> 'Novo ' . $singular_label,
			'add_new_item'			=> 'Novo  ' . $singular_label,
			'edit_item'				=> 'Editar ' . $singular_label,
			'new_item'				=> 'Novo ' . $singular_label,
			'view_item'				=> 'Ver ' . $singular_label,
			'search_items'			=> 'Buscar ' . $singular_label,
			'not_found'				=> 'Não encontrado',
			'not_found_in_trash'	=> 'Não encontrado na lixeira',
		);
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'query_var'				=> true,
			'show_in_nav_menus' 	=> true,
			'capability_type'		=> 'post',
			'menu_icon' 			=> 'dashicons-location-alt',
			'hierarchical'			=> true,
			'menu_position'			=> 6,
			'has_archive'			=> true,
			'exclude_from_search'	=> false,
			'supports'				=> array( 'editor', 'title', 'thumbnail' )
		);
		register_post_type( 'estabelecimentos', $args );
	}
?>