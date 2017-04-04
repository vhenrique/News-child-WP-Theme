		jQuery(document).ready(function($){
			$('.preset-list li a').on('click',function(event){
				event.preventDefault();
				var color = $(this).data('color'),
					url = 'css/presets/'+color+'.css';
					logoSrc = 'images/presets/'+color+'/logo.png';
					logoIconSrc = 'images/presets/'+color+'/logo-icon.png';
				
				$('.navbar-brand img').attr('src', logoSrc);
				$('.logo-icon img').attr('src', logoIconSrc);
				$('#preset').attr('href', url);
			});

			$('.style-chooser .toggler').on('click', function(event){
				event.preventDefault();
				$(this).closest('.style-chooser').toggleClass('opened');
			});
		});