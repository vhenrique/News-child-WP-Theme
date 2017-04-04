<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Theme prefix
	global $themePrefix;

	// News
	$meta_boxes['news_meta'] = array(
		'id'         => $themePrefix.'news_meta',
		'title'      => 'Informações adicionais',
		'pages'      => array( 'noticias' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(

			// Primary highlight, the post will appear at main site homepage
			array(
				'id'   => $themePrefix . 'primaryHighlight',
				'name' => 'Destaque no site principal',
				'desc' => 'Marque esta caixa para tornar esta publicação um destaque na Home page do site principal.',
				'type' => 'checkbox'
			),

			// Secondary highlight, post will appear at subsite home
			array(
				'id'   => $themePrefix . 'secondaryHighlight',
				'name' => 'Destaque neste site',
				'desc' => 'Marque esta caixa para tornar esta publicação um destaque na Home page deste site.',
				'type' => 'checkbox'
			),
		)
	);
	
	$meta_boxes['events_meta'] = array(
		'id'         => $themePrefix.'events_meta',
		'title'      => 'Informações adicionais',
		'pages'      => array( 'eventos' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(

			// Label to star the date time information
			array(
				'id'	 			=> $themePrefix . 'eventDateTimeTitle',
				'name'	 			=> '<h1>Data e hora</h1>',
				'desc'	 			=> 'Configure a data e hora do evento',
				'type'	 			=> 'title'
			),

			// Event start date
			array(
				'id'	 			=> $themePrefix . 'eventStartDate',
				'name'	 			=> 'Inicia em',
				'desc'	 			=> 'Data de início',
				'type'	 			=> 'text_date_timestamp',
				'date_format'		=> 'd/M/Y'
			),

			// Event date to finish
			array(
				'id'	 			=> $themePrefix . 'eventEndDate',
				'name'	 			=> 'Termina em',
				'desc'	 			=> 'Data final',
				'type'	 			=> 'text_date_timestamp',
				'date_format'		=> 'd/M/Y'
			),
		)
	);

	$meta_boxes['videos_meta'] = array(
		'id'         => $themePrefix . 'videos_meta',
		'title'      => 'Informações adicionais',
		'pages'      => array( 'videos' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(

			// Post visitor count
			array(
				'id'   => $themePrefix . 'videoEmbed',
				'name' => 'URL',
				'desc' => 'Embed de compartilhamento do vídeo',
				'type' => 'oembed'
			),
		)
	);

	$meta_boxes['general_meta'] = array(
		'id'         => $themePrefix . 'general_meta',
		'title'      => 'Contador de visitas',
		'pages'      => array( 'noticias', 'eventos', 'videos', 'estabelecimentos' ),
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true,
		'fields'     => array(

			// Post visitor count
			array(
				'id'   => $themePrefix . 'visitorCount',
				'name' => '<h4>Esta publicação foi visitada por ' . get_post_meta( $_GET['post'], $themePrefix . 'visitorCount', true) .' pessoa(s)</h4>',
				'desc' => 'Este número representa a quantidade de visitas desta página',
				'type' => 'title'
			),
		)
	);

	$meta_boxes['establishment_meta'] = array(
		'id'         => $themePrefix . 'establishment_meta',
		'title'      => 'Informações adicionais',
		'pages'      => array( 'estabelecimentos' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(

			// Establishment Url
			array(
				'id'   => $themePrefix . 'establishmentUrl',
				'name' => 'Link',
				'desc' => 'Informe o site do estabelecimento',
				'type' => 'text_url'
			),

			// discount percent
			array(
				'id'   => $themePrefix . 'discountPercent',
				'name' => 'Porcentagem de desconto',
				'desc' => 'Ex: 5%',
				'type' => 'text_small'
			),
		)
	);


	return $meta_boxes;
}

// Initialize the metabox class.
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'custom-metaboxes/init.php';
}