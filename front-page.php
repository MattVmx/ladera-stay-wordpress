<?php
/**
 * Front page.
 *
 * @package Ladera_Stay
 */
get_header();
$featured_stays = new WP_Query(
	array(
		'post_type'      => 'stay',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
	)
);
?>

<section class="hero" style="--hero-image: url('<?php echo esc_url( ladera_stay_image_url( '', 'hero' ) ); ?>')">
	<div class="hero-shade"></div>
	<div class="shell hero-content">
		<p class="eyebrow light">PATAGONIA · ARGENTINA</p>
		<h1>Slow down.<br><em>Stay closer.</em></h1>
		<p class="hero-copy" data-i18n="heroCopy">Refugios elegidos para reconectar con el paisaje, el descanso y lo que importa.</p>
		<a class="button button-light" href="#stays"><span data-i18n="heroAction">Descubrir estadías</span> <span aria-hidden="true">↗</span></a>
	</div>
	<div class="shell search-panel" aria-label="Buscar disponibilidad">
		<label>
			<span data-i18n="destination">Destino</span>
			<select><option>Patagonia</option><option>Bariloche</option><option>Villa La Angostura</option></select>
		</label>
		<label>
			<span data-i18n="checkIn">Llegada</span>
			<input type="date">
		</label>
		<label>
			<span data-i18n="checkOut">Salida</span>
			<input type="date">
		</label>
		<label>
			<span data-i18n="guests">Huéspedes</span>
			<select><option data-i18n="twoGuests">2 huéspedes</option><option data-i18n="fourGuests">4 huéspedes</option><option data-i18n="sixGuests">6 huéspedes</option></select>
		</label>
		<button type="button" aria-label="Buscar disponibilidad" data-i18n="search">Buscar</button>
	</div>
</section>

<section class="intro section shell">
	<div>
		<p class="eyebrow">OUR WAY OF STAYING</p>
		<h2 data-i18n-html="introTitle">Hospedajes con<br><em>intención.</em></h2>
	</div>
	<div class="intro-copy">
		<p data-i18n="introCopy">No coleccionamos lugares. Elegimos espacios que respetan su entorno y transforman una estadía en una pausa verdadera.</p>
		<a class="text-link" href="#experience"><span data-i18n="philosophy">Conocé nuestra filosofía</span> <span aria-hidden="true">→</span></a>
	</div>
</section>

<section class="stays section" id="stays">
	<div class="shell section-heading">
		<div>
			<p class="eyebrow">CURATED STAYS</p>
			<h2 data-i18n="staysTitle">Elegí tu próximo refugio.</h2>
		</div>
		<a class="text-link" href="<?php echo esc_url( get_post_type_archive_link( 'stay' ) ); ?>"><span data-i18n="seeAll">Ver todos</span> <span aria-hidden="true">→</span></a>
	</div>
	<div class="shell stay-grid">
		<?php if ( $featured_stays->have_posts() ) : ?>
			<?php while ( $featured_stays->have_posts() ) : $featured_stays->the_post(); ?>
				<article class="stay-card">
					<a class="stay-image" href="<?php the_permalink(); ?>" style="background-image:url('<?php echo esc_url( ladera_stay_image_url( get_post_field( 'post_name', get_the_ID() ) ) ); ?>')">
						<span class="stay-tag"><?php echo esc_html( get_post_meta( get_the_ID(), '_ladera_location', true ) ); ?></span>
					</a>
					<div class="stay-meta">
						<div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><span data-copy-es="<?php echo esc_attr( get_post_meta( get_the_ID(), '_ladera_capacity', true ) ); ?>" data-copy-en="<?php echo esc_attr( str_replace( 'huéspedes', 'guests', get_post_meta( get_the_ID(), '_ladera_capacity', true ) ) ); ?>"><?php echo esc_html( get_post_meta( get_the_ID(), '_ladera_capacity', true ) ); ?></span> · <span data-i18n="wholeRetreat">Refugio completo</span></p>
						</div>
						<a class="circle-link" href="<?php the_permalink(); ?>" aria-label="Ver <?php the_title_attribute(); ?>">↗</a>
					</div>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</div>
</section>

<section class="experience section" id="experience">
	<div class="experience-image" role="img" aria-label="Paisaje de montaña y lago"></div>
	<div class="experience-copy">
		<p class="eyebrow light">LESS, BUT BETTER</p>
		<h2 data-i18n-html="essentialTitle">Lo esencial<br>se siente.</h2>
		<p data-i18n="essentialCopy">Cada lugar combina arquitectura consciente, hospitalidad cercana y una relación auténtica con el paisaje.</p>
		<ul>
			<li><span>01</span> <span data-i18n="valueOne">Diseño que acompaña el entorno</span></li>
			<li><span>02</span> <span data-i18n="valueTwo">Anfitriones y experiencias locales</span></li>
			<li><span>03</span> <span data-i18n="valueThree">Ritmos más lentos, recuerdos más claros</span></li>
		</ul>
	</div>
</section>

<section class="journal section shell" id="journal">
	<div class="section-heading">
		<div>
			<p class="eyebrow">FIELD NOTES</p>
			<h2 data-i18n="storiesTitle">Historias para viajar distinto.</h2>
		</div>
		<a class="text-link" href="#journal"><span data-i18n="journalLink">Ir al journal</span> <span aria-hidden="true">→</span></a>
	</div>
	<div class="journal-grid">
		<article class="journal-feature">
			<div class="journal-image journal-image-main"></div>
			<p class="eyebrow">GUÍA · 6 MIN</p>
			<h3 data-i18n="storyOne">Un fin de semana lento en la cordillera</h3>
		</article>
		<article>
			<div class="journal-image journal-image-small"></div>
			<p class="eyebrow">ARQUITECTURA · 4 MIN</p>
			<h3 data-i18n="storyTwo">Materiales que envejecen bien</h3>
		</article>
	</div>
</section>

<section class="booking section" id="contact">
	<div class="shell booking-grid">
		<div class="booking-intro">
			<p class="eyebrow">PLAN YOUR STAY</p>
			<h2 data-i18n-html="bookingTitle">Empezá por<br><em>una consulta.</em></h2>
			<p data-i18n="bookingCopy">Contanos qué refugio te interesa y cuándo querés viajar. La consulta quedará guardada en WordPress para que el equipo pueda responderla.</p>
			<div class="booking-note">
				<span aria-hidden="true">01</span>
				<p data-i18n="bookingNote">Sin pago ni confirmación automática. Primero revisamos disponibilidad.</p>
			</div>
		</div>
		<div class="booking-form-wrap">
			<?php if ( isset( $_GET['inquiry'] ) && 'success' === sanitize_key( wp_unslash( $_GET['inquiry'] ) ) ) : ?>
				<p class="form-status form-status-success" role="status" data-i18n="formSuccess">Recibimos tu consulta. Te responderemos pronto.</p>
			<?php elseif ( isset( $_GET['inquiry'] ) && 'error' === sanitize_key( wp_unslash( $_GET['inquiry'] ) ) ) : ?>
				<p class="form-status form-status-error" role="alert" data-i18n="formError">Revisá los datos e intentá nuevamente.</p>
			<?php endif; ?>
			<form class="booking-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="ladera_submit_inquiry">
				<?php wp_nonce_field( 'ladera_submit_inquiry', 'ladera_inquiry_nonce' ); ?>
				<div class="form-trap" aria-hidden="true">
					<label for="company-website">Website</label>
					<input id="company-website" name="company_website" type="text" tabindex="-1" autocomplete="off">
				</div>
				<label class="form-field form-field-wide">
					<span data-i18n="formName">Nombre</span>
					<input type="text" name="guest_name" autocomplete="name" required>
				</label>
				<label class="form-field form-field-wide">
					<span>Email</span>
					<input type="email" name="guest_email" autocomplete="email" required>
				</label>
				<label class="form-field form-field-wide">
					<span data-i18n="formStay">Refugio</span>
					<select name="stay_id" required>
						<option value="" data-i18n="formChooseStay">Elegí una opción</option>
						<?php
						$form_stays = get_posts( array( 'post_type' => 'stay', 'numberposts' => -1, 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC' ) );
						foreach ( $form_stays as $form_stay ) :
							?>
							<option value="<?php echo esc_attr( $form_stay->ID ); ?>"><?php echo esc_html( $form_stay->post_title ); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
				<label class="form-field">
					<span data-i18n="checkIn">Llegada</span>
					<input type="date" name="check_in" required>
				</label>
				<label class="form-field">
					<span data-i18n="checkOut">Salida</span>
					<input type="date" name="check_out" required>
				</label>
				<label class="form-field form-field-wide">
					<span data-i18n="guests">Huéspedes</span>
					<select name="guest_count" required>
						<option value="2" data-i18n="twoGuests">2 huéspedes</option>
						<option value="4" data-i18n="fourGuests">4 huéspedes</option>
						<option value="6" data-i18n="sixGuests">6 huéspedes</option>
					</select>
				</label>
				<label class="form-field form-field-wide">
					<span data-i18n="formMessage">Mensaje opcional</span>
					<textarea name="guest_message" rows="4"></textarea>
				</label>
				<button class="button button-dark form-submit" type="submit"><span data-i18n="formSubmit">Enviar consulta</span> <span aria-hidden="true">→</span></button>
			</form>
		</div>
	</div>
</section>

<section class="final-cta">
	<div class="shell">
		<p class="eyebrow light">YOUR NEXT PAUSE</p>
		<h2 data-i18n-html="finalTitle">Hay lugares que<br>te devuelven a vos.</h2>
		<a class="button button-light" href="#contact"><span data-i18n="finalAction">Consultar una estadía</span> <span aria-hidden="true">→</span></a>
	</div>
</section>

<?php get_footer(); ?>
