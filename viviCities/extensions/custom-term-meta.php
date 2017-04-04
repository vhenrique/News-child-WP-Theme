<?php
	global $themePrefix;

	// Category
	$categoryMetaConfig = array(
		'id'				=> 'categoryMeta',
		'title'				=> 'color',
		'pages'				=> array( 'category' ),
		'context'			=> 'normal',
		'fields'			=> array(),
		'local_images'		=> false,
		'use_with_theme'	=> true
	);

	// Class instance
	$categoryMeta = new Tax_Meta_Class( $categoryMetaConfig );

	// Color
	$categoryMeta->addColor(
		$themePrefix . 'categoryColor',
		array( 'name'	=> 'Color' )
	);
	

	$categoryMeta->Finish();

?>