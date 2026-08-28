<?php
/**
 * Site header.
 *
 * @package Ladera_Stay
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
		try {
			const savedTheme = localStorage.getItem('ladera-theme');
			const preferredTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
			document.documentElement.dataset.theme = savedTheme || preferredTheme;
		} catch (error) {
			document.documentElement.dataset.theme = 'light';
		}
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Saltar al contenido', 'ladera-stay' ); ?></a>
<header class="site-header" data-header>
	<div class="shell header-inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Ladera Stay, inicio">
			<span class="brand-mark" aria-hidden="true">L</span>
			<span class="brand-name">Ladera <em>Stay</em></span>
		</a>
		<nav id="site-menu" class="site-nav" aria-label="Navegación principal" data-menu>
			<a href="<?php echo esc_url( home_url( '/#stays' ) ); ?>" data-i18n="navStays">Estadías</a>
			<a href="<?php echo esc_url( home_url( '/#experience' ) ); ?>" data-i18n="navExperiences">Experiencias</a>
			<a href="<?php echo esc_url( home_url( '/#journal' ) ); ?>">Journal</a>
			<a class="nav-cta" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" data-i18n="navContact">Consultar</a>
		</nav>
		<div class="header-actions">
			<button class="utility-toggle language-toggle" type="button" data-language-toggle aria-label="Switch to English">
				<span data-language-label>EN</span>
			</button>
			<button class="utility-toggle theme-toggle" type="button" data-theme-toggle aria-label="Activar tema oscuro">
				<span class="theme-icon theme-icon-light" aria-hidden="true">☼</span>
				<span class="theme-icon theme-icon-dark" aria-hidden="true">☾</span>
			</button>
			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-menu" data-menu-toggle>
				<span></span><span></span><span></span>
				<span class="screen-reader-text" data-i18n="openMenu"><?php esc_html_e( 'Abrir menú', 'ladera-stay' ); ?></span>
			</button>
		</div>
	</div>
</header>
<main id="content">
