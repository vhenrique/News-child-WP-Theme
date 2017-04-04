jQuery(function ($) {

    'use strict';
	
	/*==============================================================*/
    // Table of index
    /*==============================================================*/

    /*==============================================================
    # sticky-nav
    # Date Time
    # language Select
	# Search Slide
	# Breaking News
	# Owl Carousel
	# magnificPopup
	# newsletter
	# weather	
	
    ==============================================================*/
	
	
	
	
	/*==============================================================*/
    // # sticky-nav
    /*==============================================================*/
	(function () {
		var windowWidth = $(window).width();
		if(windowWidth > 1000 ){
        $(window).scroll (function () {
            var sT = $(this).scrollTop();
				if (sT >= 120) {
					$('.homepage .navbar, .homepage-two.fixed-nav .navbar').addClass('sticky-nav')
				}else {
					$('.homepage .navbar, .homepage-two.fixed-nav .navbar').removeClass('sticky-nav')
				};
			});
		}else{				
			$('.homepage .navbar, .homepage-two.fixed-nav .navbar').removeClass('sticky-nav')			
		};	
		if(windowWidth > 1000 ){
        $(window).scroll (function () {
            var sT = $(this).scrollTop();
				if (sT >= 120) {
					$('.homepage #menubar, .homepage-two.fixed-nav #navigation').removeClass('container')
					$('.homepage #menubar, .homepage-two.fixed-nav #navigation').addClass('container-fluid')
				}else {
					$('.homepage #menubar, .homepage-two.fixed-nav #navigation').removeClass('container-fluid')
					// $('.homepage #menubar').addClass('container')
				}
			});
		}else{				
			$('.homepage #menubar, .homepage-two.fixed-nav #navigation').removeClass('container-fluid')			
		};	 

    }());
	
	/*==============================================================*/
    // # language Select
    /*==============================================================*/
   (function() {
		$('.language-dropdown').on('click', '.language-change a', function(ev) {
			if ("#" === $(this).attr('href')) {
				ev.preventDefault();
				var parent = $(this).parents('.language-dropdown');
				parent.find('.change-text').html($(this).html());
			}
		});
	}());
	
	/*==============================================================*/
	// Search Slide
	/*==============================================================*/
	
	$('.search-icon').on('click', function() {
		$('.searchNlogin').toggleClass("expanded");
	});
		
	
	/*==============================================================*/
    // Breaking News
    /*==============================================================*/
	 (function() {
		$('.breaking-news-scroll').easyTicker({
			direction: 'up',
			easing: 'swing',
			speed: 'slow',
			interval: 3000,
			height: 'auto',
			visible: 1,
			mousePause: 1,
			controls: {
				up: '',
				down: '',
				toggle: '',
				playText: 'Play',
				stopText: 'Stop'
			}
		});
	
	}());
	
	
	/*==============================================================*/
    // sticky
    /*==============================================================*/
	(function () {
		$("#sticky").stick_in_parent();
	}());
	
	/*==============================================================*/
    // Owl Carousel
    /*==============================================================*/
	$("#home-slider").owlCarousel({ 
		pagination	: true,	
		autoPlay	: true,
		singleItem	: true,
		stopOnHover	: true,
	});
	
	$("#latest-news").owlCarousel({ 
		items : 4,
		pagination	: true,	
		autoPlay	: true,
		stopOnHover	: true,
	});
	
	$(".twitter-feeds").owlCarousel({ 
		items : 1,
		singleItem : true,
		pagination	: false,	
		autoPlay	: true,
		stopOnHover	: true,
	});
	
	$("#main-slider").owlCarousel({ 
		items : 3,
		pagination	: false,
		navigation	: false,
		autoPlay	: true,
		stopOnHover	: true
		
	});	

	(function () {
		$('.image-link').magnificPopup({
			gallery: {
			enabled: true
			},		
			type: 'image' 
		});
		$('.feature-image .image-link').magnificPopup({
			gallery: {
				enabled: false
			},		
			type: 'image' 
		});
		$('.image-popup').magnificPopup({	
			type: 'image' 
		});
		$('.video-link').magnificPopup({type:'iframe'});
	}());

	$.simpleWeather({
		location: 'sao paulo, br',
		woeid: '',
		unit: 'c',
		success: function(weather) {
			var html = '<span>'+weather.city+' </span><img src="'+weather.thumbnail+'"><span> '+weather.temp+'&deg;'+weather.units.temp+'</span>';
			$("#weather").html(html);
		},
		error: function(error) {
		  $("#weather").html('<p>'+error+'</p>');
		}
	});


	$( '#subscribe' ).click( function(e) {
		e.preventDefault();

		if( $( '.newsletterName' ).val().length > 0 && $( '.newsletteremail' ).val().length > 0){
			var formData = {
				'nameNewsletter' 		: $( '.newsletterName' ).val(),
				'emailNewsletter' 		: $( '.newsletteremail' ).val(),
				'action'				: 'insertUser'
			};
			$.ajax({
				type:'POST',
				url: 		$( '.newsLetterUrl' ).val(),
				data: 		formData,
				dataType: 	'json',
				error: function(){
					alert( '=( Tente novamente mais tarde.' );
				},
				success: function(data){
					if( data ){
						alert('Você se inscreveu com sucesso.');
					}
				}
			});
		}
		else{
			alert('Por favor, preencha todos os campos!');
		}
		
	});
});