<?php get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<div class="content row">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<article>
	<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>			
	<?php endif; ?>
	<?php comments_template( '', true ); ?>

</article>
<?php endwhile; ?>
</div>
<?php get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>