<?php
/**
 * Single stay.
 *
 * @package Ladera_Stay
 */
get_header();
while ( have_posts() ) : the_post();
?>
<article class="single-stay">
	<header class="single-stay-hero" style="background-image:url('<?php echo esc_url( ladera_stay_image_url( get_post_field( 'post_name', get_the_ID() ) ) ); ?>')">
		<div class="hero-shade"></div>
		<div class="shell">
			<p class="eyebrow light"><?php echo esc_html( get_post_meta( get_the_ID(), '_ladera_location', true ) ); ?></p>
			<h1><?php the_title(); ?></h1>
		</div>
	</header>
	<div class="shell single-stay-content section">
		<div>
			<p class="eyebrow" data-i18n="theStay">LA ESTADÍA</p>
			<h2 data-copy-es="<?php echo esc_attr( get_the_excerpt() ); ?>" data-copy-en="<?php echo esc_attr( get_post_meta( get_the_ID(), '_ladera_excerpt_en', true ) ?: get_the_excerpt() ); ?>"><?php echo esc_html( get_the_excerpt() ); ?></h2>
		</div>
		<div class="single-stay-body">
			<p data-copy-es="<?php echo esc_attr( wp_strip_all_tags( get_the_content() ) ); ?>" data-copy-en="<?php echo esc_attr( get_post_meta( get_the_ID(), '_ladera_content_en', true ) ?: wp_strip_all_tags( get_the_content() ) ); ?>"><?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?></p>
			<p><strong data-copy-es="<?php echo esc_attr( get_post_meta( get_the_ID(), '_ladera_capacity', true ) ); ?>" data-copy-en="<?php echo esc_attr( str_replace( 'huéspedes', 'guests', get_post_meta( get_the_ID(), '_ladera_capacity', true ) ) ); ?>"><?php echo esc_html( get_post_meta( get_the_ID(), '_ladera_capacity', true ) ); ?></strong></p>
			<a class="button button-dark" href="mailto:hola@laderastay.test?subject=Consulta%20por%20<?php echo rawurlencode( get_the_title() ); ?>" data-i18n="availability">Consultar disponibilidad</a>
		</div>
	</div>
</article>
<?php endwhile; get_footer(); ?>
