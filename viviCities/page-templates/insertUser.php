<?php 
/**
* Template name: Insert User
*/
global $redux_options, $themePrefix;

/** Email params **/
	// Email subject
	$subject = get_option( 'blogname' ) . ' - Bem-vindo(a)';
	
	// Email content
	$message = 'Bem-vindo a loja ' . get_option( 'blogname' );

	if( isset( $_POST ) && $_POST['action'] == 'insertUser' ){

		$user = email_exists( $_POST['emailNewsletter'] );
		if( $user ) {
		    update_user_meta( $user, $themePrefix . 'newsletter', 'on' ); 
		    // Send welcome email
			wp_mail( $_POST['emailNewsletter'], $subject, $message );

		    echo json_encode( array(
					'message'	=> 'success',
					'userId' 	=> $user
				)
			);
		}
		else{
			$userdata = array(
			    'user_login'  	=> $_POST['emailNewsletter'],
			    'first_name'	=> $_POST['nameNewsletter'],
			    'user_email'	=> $_POST['emailNewsletter'],
			    'role'   		=> 'subscriber',
			    'user_pass'		=> wp_generate_password( 6, false )
			);
		
			$newUser_id = wp_insert_user( $userdata );

			if ( ! is_wp_error( $newUser_id ) ) {
				update_user_meta( $newUser_id, $themePrefix . 'newsletter', 'on' );

				// Send welcome email
				wp_mail( $_POST['emailNewsletter'], $subject, $message );

				echo json_encode( array(
					'message'	=> 'success',
					'userId' 	=> $newUser_id
					)
				);
			
			}
			else{
				echo json_encode( array(
						'message'	=> 'Você já está inscrito.',
						'userId' 	=> null
					)
				);
			}
		}
	}
?>