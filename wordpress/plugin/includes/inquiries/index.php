<?php
/** Local inquiry capture. No email or external service is used. */
defined( 'ABSPATH' ) || exit;

function celestial_register_inquiries(): void {
	register_post_type( 'celestial-inquiry', array(
		'labels' => array( 'name' => 'Заявки', 'singular_name' => 'Заявка' ),
		'public' => false,
		'show_ui' => true,
		'show_in_rest' => false,
		'supports' => array( 'title', 'editor' ),
		'capabilities' => array_fill_keys( array( 'edit_post', 'read_post', 'delete_post', 'edit_posts', 'edit_others_posts', 'publish_posts', 'read_private_posts', 'delete_posts', 'delete_private_posts', 'delete_published_posts', 'delete_others_posts', 'edit_private_posts', 'edit_published_posts', 'create_posts' ), 'manage_options' ),
		'map_meta_cap' => false,
		'capability_type' => 'page',
	) );
}
add_action( 'init', 'celestial_register_inquiries' );

function celestial_inquiry_form(): string {
	$state = isset( $_GET['inquiry'] ) && is_string( $_GET['inquiry'] ) ? sanitize_key( wp_unslash( $_GET['inquiry'] ) ) : '';
	ob_start();
	?>
	<form class="celestial-inquiry-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
		<?php if ( 'sent' === $state ) : ?>
			<p class="celestial-inquiry-form__notice" role="status">Заявка сохранена. В этой тестовой версии она доступна владельцу сайта в разделе «Заявки».</p>
		<?php elseif ( 'invalid' === $state ) : ?>
			<p class="celestial-inquiry-form__notice" role="alert">Проверьте номер телефона: нужно от 7 до 15 цифр. Имя — до 80 символов, комментарий — до 2000.</p>
		<?php elseif ( 'failed' === $state ) : ?>
			<p class="celestial-inquiry-form__notice" role="alert">Не удалось сохранить заявку. Попробуйте ещё раз.</p>
		<?php endif; ?>
		<input type="hidden" name="action" value="celestial_inquiry">
		<?php wp_nonce_field( 'celestial_inquiry', 'celestial_inquiry_nonce', false ); ?>
		<label>Как к вам обращаться<input name="customer_name" type="text" autocomplete="name" maxlength="80" placeholder="Ваше имя"></label>
		<label>Номер телефона<input name="customer_phone" type="tel" autocomplete="tel" inputmode="tel" required maxlength="30" placeholder="+7 (___) ___-__-__" aria-describedby="celestial-inquiry-note"></label>
		<label>Несколько слов о шкафе <span class="celestial-inquiry-form__optional">— необязательно</span><textarea name="customer_message" rows="3" maxlength="2000" placeholder="Где будет стоять шкаф, примерные размеры, пожелания"></textarea></label>
		<div class="celestial-inquiry-form__trap" aria-hidden="true"><label>Оставьте поле пустым<input name="customer_website" tabindex="-1" autocomplete="off"></label></div>
		<button type="submit">Обсудить мой шкаф</button>
		<p id="celestial-inquiry-note" class="celestial-inquiry-form__note">Тестовая форма: данные сохраняются только в локальной админке. Письма и сообщения не отправляются.</p>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'celestial_inquiry_form', 'celestial_inquiry_form' );

function celestial_handle_inquiry(): void {
	$nonce = isset( $_POST['celestial_inquiry_nonce'] ) && is_string( $_POST['celestial_inquiry_nonce'] ) ? wp_unslash( $_POST['celestial_inquiry_nonce'] ) : '';
	if ( ! wp_verify_nonce( $nonce, 'celestial_inquiry' ) ) {
		wp_die( 'Обновите страницу и отправьте форму ещё раз.', 'Проверка формы', array( 'response' => 403 ) );
	}
	$read = static function ( string $key ): string {
		return isset( $_POST[ $key ] ) && is_string( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
	};
	$name = sanitize_text_field( $read( 'customer_name' ) );
	$phone = sanitize_text_field( $read( 'customer_phone' ) );
	$message = sanitize_textarea_field( $read( 'customer_message' ) );
	$digits = preg_replace( '/\D/', '', $phone );
	$status = 'invalid';
	if ( '' !== $read( 'customer_website' ) ) {
		$status = 'sent';
	} elseif ( strlen( $digits ) >= 7 && strlen( $digits ) <= 15 && preg_match( '/^[+()\s0-9-]{7,30}$/D', $phone ) && mb_strlen( $name ) <= 80 && mb_strlen( $message ) <= 2000 ) {
		$result = wp_insert_post( array(
			'post_type' => 'celestial-inquiry',
			'post_status' => 'private',
			'post_title' => 'Заявка: ' . ( $name ?: 'Без имени' ),
			'post_content' => "Имя: {$name}\nТелефон: {$phone}\n\n{$message}",
		), true );
		$status = is_wp_error( $result ) ? 'failed' : 'sent';
	}
	wp_safe_redirect( add_query_arg( 'inquiry', $status, home_url( '/' ) ) . '#request', 303 );
	exit;
}
add_action( 'admin_post_celestial_inquiry', 'celestial_handle_inquiry' );
add_action( 'admin_post_nopriv_celestial_inquiry', 'celestial_handle_inquiry' );
