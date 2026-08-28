<?php
/**
 * Ladera Stay theme setup and content model.
 *
 * @package Ladera_Stay
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ladera_stay_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 240, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary navigation', 'ladera-stay' ),
		)
	);
}
add_action( 'after_setup_theme', 'ladera_stay_setup' );

function ladera_stay_assets() {
	$theme = wp_get_theme();
	wp_enqueue_style( 'ladera-stay-main', get_template_directory_uri() . '/assets/css/main.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'ladera-stay-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme->get( 'Version' ), true );
}
add_action( 'wp_enqueue_scripts', 'ladera_stay_assets' );

function ladera_stay_register_content() {
	register_post_type(
		'stay',
		array(
			'labels' => array(
				'name'          => __( 'Stays', 'ladera-stay' ),
				'singular_name' => __( 'Stay', 'ladera-stay' ),
				'add_new_item'  => __( 'Add new stay', 'ladera-stay' ),
				'edit_item'     => __( 'Edit stay', 'ladera-stay' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'menu_icon'    => 'dashicons-admin-home',
			'show_in_rest' => true,
			'rewrite'      => array( 'slug' => 'stays' ),
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		)
	);

	register_post_type(
		'inquiry',
		array(
			'labels' => array(
				'name'          => __( 'Inquiries', 'ladera-stay' ),
				'singular_name' => __( 'Inquiry', 'ladera-stay' ),
				'edit_item'     => __( 'View inquiry', 'ladera-stay' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-email-alt',
			'exclude_from_search' => true,
			'supports'            => array( 'title' ),
		)
	);
}
add_action( 'init', 'ladera_stay_register_content' );

function ladera_stay_add_details_box() {
	add_meta_box(
		'ladera-stay-details',
		__( 'Stay details', 'ladera-stay' ),
		'ladera_stay_render_details_box',
		'stay',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes_stay', 'ladera_stay_add_details_box' );

function ladera_stay_render_details_box( $post ) {
	wp_nonce_field( 'ladera_stay_save_details', 'ladera_stay_details_nonce' );
	$location = get_post_meta( $post->ID, '_ladera_location', true );
	$capacity = get_post_meta( $post->ID, '_ladera_capacity', true );
	?>
	<p>
		<label for="ladera-location"><strong><?php esc_html_e( 'Location', 'ladera-stay' ); ?></strong></label><br>
		<input class="widefat" id="ladera-location" name="ladera_location" type="text" value="<?php echo esc_attr( $location ); ?>" placeholder="Bariloche">
	</p>
	<p>
		<label for="ladera-capacity"><strong><?php esc_html_e( 'Capacity', 'ladera-stay' ); ?></strong></label><br>
		<input class="widefat" id="ladera-capacity" name="ladera_capacity" type="text" value="<?php echo esc_attr( $capacity ); ?>" placeholder="2 huéspedes">
	</p>
	<?php
}

function ladera_stay_save_details( $post_id ) {
	if ( ! isset( $_POST['ladera_stay_details_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ladera_stay_details_nonce'] ) ), 'ladera_stay_save_details' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['ladera_location'] ) ) {
		update_post_meta( $post_id, '_ladera_location', sanitize_text_field( wp_unslash( $_POST['ladera_location'] ) ) );
	}
	if ( isset( $_POST['ladera_capacity'] ) ) {
		update_post_meta( $post_id, '_ladera_capacity', sanitize_text_field( wp_unslash( $_POST['ladera_capacity'] ) ) );
	}
}
add_action( 'save_post_stay', 'ladera_stay_save_details' );

function ladera_stay_set_default_details( $post_id ) {
	if ( wp_is_post_revision( $post_id ) || 'stay' !== get_post_type( $post_id ) ) {
		return;
	}
	if ( ! get_post_meta( $post_id, '_ladera_location', true ) ) {
		update_post_meta( $post_id, '_ladera_location', 'Patagonia' );
	}
	if ( ! get_post_meta( $post_id, '_ladera_capacity', true ) ) {
		update_post_meta( $post_id, '_ladera_capacity', '2 huéspedes' );
	}
}
add_action( 'save_post_stay', 'ladera_stay_set_default_details', 20 );

function ladera_stay_inquiry_redirect( $status ) {
	$url = add_query_arg( 'inquiry', sanitize_key( $status ), home_url( '/' ) );
	wp_safe_redirect( $url . '#contact' );
	exit;
}

function ladera_stay_submit_inquiry() {
	if ( ! isset( $_POST['ladera_inquiry_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ladera_inquiry_nonce'] ) ), 'ladera_submit_inquiry' ) ) {
		ladera_stay_inquiry_redirect( 'error' );
	}

	if ( ! empty( $_POST['company_website'] ) ) {
		ladera_stay_inquiry_redirect( 'success' );
	}

	$name     = isset( $_POST['guest_name'] ) ? sanitize_text_field( wp_unslash( $_POST['guest_name'] ) ) : '';
	$email    = isset( $_POST['guest_email'] ) ? sanitize_email( wp_unslash( $_POST['guest_email'] ) ) : '';
	$stay_id  = isset( $_POST['stay_id'] ) ? absint( $_POST['stay_id'] ) : 0;
	$check_in = isset( $_POST['check_in'] ) ? sanitize_text_field( wp_unslash( $_POST['check_in'] ) ) : '';
	$check_out = isset( $_POST['check_out'] ) ? sanitize_text_field( wp_unslash( $_POST['check_out'] ) ) : '';
	$guests   = isset( $_POST['guest_count'] ) ? absint( $_POST['guest_count'] ) : 0;
	$message  = isset( $_POST['guest_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['guest_message'] ) ) : '';

	$check_in_date  = DateTime::createFromFormat( 'Y-m-d', $check_in );
	$check_out_date = DateTime::createFromFormat( 'Y-m-d', $check_out );
	$is_valid_stay  = $stay_id && 'stay' === get_post_type( $stay_id ) && 'publish' === get_post_status( $stay_id );

	if ( ! $name || ! is_email( $email ) || ! $is_valid_stay || ! $check_in_date || ! $check_out_date || $check_out_date <= $check_in_date || $guests < 1 || $guests > 8 ) {
		ladera_stay_inquiry_redirect( 'error' );
	}

	$inquiry_id = wp_insert_post(
		array(
			'post_type'   => 'inquiry',
			'post_status' => 'private',
			'post_title'  => sprintf( '%s — %s', $name, get_the_title( $stay_id ) ),
		),
		true
	);

	if ( is_wp_error( $inquiry_id ) ) {
		ladera_stay_inquiry_redirect( 'error' );
	}

	$details = array(
		'_ladera_guest_name'    => $name,
		'_ladera_guest_email'   => $email,
		'_ladera_stay_id'       => $stay_id,
		'_ladera_check_in'      => $check_in,
		'_ladera_check_out'     => $check_out,
		'_ladera_guest_count'   => $guests,
		'_ladera_guest_message' => $message,
	);

	foreach ( $details as $key => $value ) {
		update_post_meta( $inquiry_id, $key, $value );
	}

	ladera_stay_inquiry_redirect( 'success' );
}
add_action( 'admin_post_ladera_submit_inquiry', 'ladera_stay_submit_inquiry' );
add_action( 'admin_post_nopriv_ladera_submit_inquiry', 'ladera_stay_submit_inquiry' );

function ladera_stay_inquiry_columns( $columns ) {
	return array(
		'cb'      => $columns['cb'],
		'title'   => __( 'Guest and stay', 'ladera-stay' ),
		'email'   => __( 'Email', 'ladera-stay' ),
		'dates'   => __( 'Dates', 'ladera-stay' ),
		'guests'  => __( 'Guests', 'ladera-stay' ),
		'date'    => $columns['date'],
	);
}
add_filter( 'manage_inquiry_posts_columns', 'ladera_stay_inquiry_columns' );

function ladera_stay_inquiry_column_content( $column, $post_id ) {
	if ( 'email' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_ladera_guest_email', true ) );
	}
	if ( 'dates' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_ladera_check_in', true ) . ' → ' . get_post_meta( $post_id, '_ladera_check_out', true ) );
	}
	if ( 'guests' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_ladera_guest_count', true ) );
	}
}
add_action( 'manage_inquiry_posts_custom_column', 'ladera_stay_inquiry_column_content', 10, 2 );

function ladera_stay_image_url( $slug, $size = 'large' ) {
	$images = array(
		'bosque-loft'  => 'https://images.unsplash.com/photo-1449158743715-0a90ebb6d2d8?auto=format&fit=crop&w=1400&q=85',
		'piedra-cabin' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1400&q=85',
		'lago-house'   => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1400&q=85',
		'rio-cabin'    => 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=1400&q=85',
	);

	if ( 'hero' === $size ) {
		return 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&w=2200&q=90';
	}

	return isset( $images[ $slug ] ) ? $images[ $slug ] : $images['bosque-loft'];
}

function ladera_stay_seed_demo_content() {
	ladera_stay_register_content();

	if ( get_posts( array( 'post_type' => 'stay', 'numberposts' => 1, 'post_status' => 'any' ) ) ) {
		flush_rewrite_rules();
		return;
	}

	$stays = array(
		array(
			'title'    => 'Bosque Loft',
			'slug'     => 'bosque-loft',
			'excerpt'  => 'Arquitectura cálida entre lengas, pensada para dos personas y muchos silencios.',
			'content'  => 'Un refugio contemporáneo rodeado de bosque nativo. Incluye cocina equipada, salamandra, deck privado y senderos a pocos pasos.',
			'location' => 'Villa La Angostura',
			'capacity' => '2 huéspedes',
		),
		array(
			'title'    => 'Piedra Cabin',
			'slug'     => 'piedra-cabin',
			'excerpt'  => 'Una cabaña serena con texturas naturales, fuego encendido y vistas abiertas.',
			'content'  => 'Diseñada para bajar el ritmo. Piedra Cabin combina materiales locales, luz natural y espacios flexibles para una escapada de montaña.',
			'location' => 'San Martín de los Andes',
			'capacity' => '4 huéspedes',
		),
		array(
			'title'    => 'Lago House',
			'slug'     => 'lago-house',
			'excerpt'  => 'Una casa luminosa frente al agua para compartir tiempo, mesa y paisaje.',
			'content'  => 'Ambientes amplios, cocina central y acceso directo a la costa. Una base tranquila para explorar el lago y volver sin apuro.',
			'location' => 'Bariloche',
			'capacity' => '6 huéspedes',
		),
		array(
			'title'    => 'Río Cabin',
			'slug'     => 'rio-cabin',
			'excerpt'  => 'Una cabaña tranquila junto al río para descansar entre bosque, agua y montaña.',
			'content'  => 'Un refugio íntimo junto al río, con deck privado, cocina equipada y senderos que comienzan en la puerta.',
			'location' => 'El Bolsón',
			'capacity' => '2 huéspedes',
		),
	);

	foreach ( $stays as $stay ) {
		$post_id = wp_insert_post(
			array(
				'post_type'    => 'stay',
				'post_status'  => 'publish',
				'post_title'   => $stay['title'],
				'post_name'    => $stay['slug'],
				'post_excerpt' => $stay['excerpt'],
				'post_content' => $stay['content'],
			)
		);
		if ( ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_ladera_location', $stay['location'] );
			update_post_meta( $post_id, '_ladera_capacity', $stay['capacity'] );
		}
	}

	update_option( 'blogname', 'Ladera Stay' );
	update_option( 'blogdescription', 'Refugios para volver a lo esencial' );
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ladera_stay_seed_demo_content' );

function ladera_stay_add_english_demo_content() {
	if ( '2' === get_option( 'ladera_english_content_version' ) ) {
		return;
	}

	$translations = array(
		'bosque-loft' => array(
			'excerpt' => 'Warm architecture among native trees, designed for two people and plenty of silence.',
			'content' => 'A contemporary retreat surrounded by native forest. It includes a fully equipped kitchen, wood stove, private deck, and nearby trails.',
		),
		'piedra-cabin' => array(
			'excerpt' => 'A serene cabin with natural textures, a glowing fire, and wide-open views.',
			'content' => 'Designed to slow things down. Piedra Cabin combines local materials, natural light, and flexible spaces for a mountain escape.',
		),
		'lago-house' => array(
			'excerpt' => 'A light-filled lakeside house made for sharing time, meals, and landscape.',
			'content' => 'Open spaces, a central kitchen, and direct shore access. A quiet base for exploring the lake and returning without a rush.',
		),
		'rio-cabin' => array(
			'excerpt' => 'A quiet riverside cabin for resting among forest, water, and mountains.',
			'content' => 'An intimate riverside retreat with a private deck, equipped kitchen, and trails beginning right at the door.',
		),
	);

	foreach ( $translations as $slug => $copy ) {
		$post = get_page_by_path( $slug, OBJECT, 'stay' );
		if ( $post ) {
			update_post_meta( $post->ID, '_ladera_excerpt_en', $copy['excerpt'] );
			update_post_meta( $post->ID, '_ladera_content_en', $copy['content'] );
		}
	}

	update_option( 'ladera_english_content_version', '2' );
}
add_action( 'init', 'ladera_stay_add_english_demo_content', 20 );
