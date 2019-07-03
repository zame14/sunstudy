<?php
$class = '';
if(!has_post_thumbnail( $post->ID ) ) {
    $class = 'hide';
}
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="blog-image-wrapper <?=$class?>">
        <?php echo get_the_post_thumbnail( $post->ID, 'blog' ); ?>
    </div><div class="blog-content-wrapper <?=$class?>">
        <header class="entry-header">

            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                '</a></h2>' ); ?>

            <?php if ( 'post' == get_post_type() ) : ?>

                <div class="entry-meta">
                    <?php understrap_posted_on(); ?>
                </div><!-- .entry-meta -->

            <?php endif; ?>

        </header><!-- .entry-header -->
        <div class="entry-content">

            <?php
            the_excerpt();
            ?>

            <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
                'after'  => '</div>',
            ) );
            ?>

        </div><!-- .entry-content -->
    </div>
</article><!-- #post-## -->