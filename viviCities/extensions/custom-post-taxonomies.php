<?php 
// Region
	add_action( 'init', 'create_custom_tax_region');
	function create_custom_tax_region() {
		$singular_label = 'região';
		$labels = array(
			'name'					=> 'Regiões',
			'singular_name'			=> ucfirst($singular_label),
			'search_items'			=> 'Buscar',
			'all_items'				=> 'Todos',
			'edit_item'				=> 'Editar',
			'update_item'			=> 'Atualizar',
			'add_new_item'			=> 'Novo ' . strtolower($singular_label),
			'new_item_name'			=> 'Novo ' . strtolower($singular_label),
			'menu_name'				=> 'Regiões'
		);
		$args = array(
			'hierarchical'			=> true,
			'labels'				=> $labels,
			'show_ui'				=> true,
			'show_admin_column'		=> true,
			'capability_type'     	=> 'post',
			'query_var'				=> true,
			'rewrite'				=> array( 'slug' => 'regioes' ),
			'has_archive'			=> false,
			'exclude_from_search'	=> true
		);
		register_taxonomy( 'regioes', array( 'estabelecimentos' ), $args );
	}

// Region
	add_action( 'init', 'create_custom_tax_category');
	function create_custom_tax_category() {
		$singular_label = 'categoria';
		$labels = array(
			'name'					=> 'Categorias',
			'singular_name'			=> ucfirst($singular_label),
			'search_items'			=> 'Buscar',
			'all_items'				=> 'Todas',
			'edit_item'				=> 'Editar',
			'update_item'			=> 'Atualizar',
			'add_new_item'			=> 'Nova ' . strtolower($singular_label),
			'new_item_name'			=> 'Nova ' . strtolower($singular_label),
			'menu_name'				=> 'Categorias'
		);
		$args = array(
			'hierarchical'			=> true,
			'labels'				=> $labels,
			'show_ui'				=> true,
			'show_admin_column'		=> true,
			'capability_type'     	=> 'post',
			'query_var'				=> true,
			'rewrite'				=> array( 'slug' => 'categorias' ),
			'has_archive'			=> false,
			'exclude_from_search'	=> true
		);
		register_taxonomy( 'categorias', array( 'estabelecimentos' ), $args );
	}
?>