<?php
/**
 * Stay archive.
 *
 * @package Ladera_Stay
 */
get_header();
?>
<section class="archive-hero shell section">
	<p class="eyebrow">CURATED STAYS</p>
	<h1 data-i18n-html="archiveTitle">Refugios para<br><em>quedarse un poco más.</em></h1>
	<p data-i18n="archiveCopy">Una colección pequeña de lugares con diseño, calma y naturaleza cerca.</p>
</section>
<section class="shell stay-grid archive-grid">
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="stay-card">
			<a class="stay-image" href="<?php the_permalink(); ?>" style="background-image:url('<?php echo esc_url( ladera_stay_image_url( get_post_field( 'post_name', get_the_ID() ) ) ); ?>')">
				<span class="stay-tag"><?php echo esc_html( get_post_meta( get_the_ID(), '_ladera_location', true ) ); ?></span>
			</a>
			<div class="stay-meta">
				<div>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p data-copy-es="<?php echo esc_attr( get_the_excerpt() ); ?>" data-copy-en="<?php echo esc_attr( get_post_meta( get_the_ID(), '_ladera_excerpt_en', true ) ?: get_the_excerpt() ); ?>"><?php echo esc_html( get_the_excerpt() ); ?></p>
				</div>
				<a class="circle-link" href="<?php the_permalink(); ?>" aria-label="Ver <?php the_title_attribute(); ?>">↗</a>
			</div>
		</article>
	<?php endwhile; ?>
</section>
<?php get_footer(); ?>
