<?php
/**
 * Template Name: Home Page
 *
 */
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<?php the_title(); ?>

				<?php the_content(); ?>
			</article>
		<?php endwhile; endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();
