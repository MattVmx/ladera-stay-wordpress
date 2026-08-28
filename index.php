<?php
/**
 * Default template.
 *
 * @package Ladera_Stay
 */
get_header();
?>
<section class="page-shell shell section">
	<p class="eyebrow">LADERA STAY</p>
	<h1><?php echo esc_html( get_the_archive_title() ?: get_the_title() ); ?></h1>
	<div class="post-list">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p>No hay contenido todavía.</p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>

