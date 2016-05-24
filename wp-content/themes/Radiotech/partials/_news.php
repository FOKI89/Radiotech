<?php
// Template des Nouveautés
// the query
$args = array('post_type'  => radiotech_Main::CPT_EMISSION , 'orderby' => 'date' ,'post_limits' => 6,);
$newsQuery = new WP_Query( $args ); ?>
<?php if ( $newsQuery->have_posts() ) { ?>
<div class="bloc nouveaute">
    <div class="container">
        <h2><?php _e('Nouveautés', 'radiotech'); ?></h2>
        <?php ?>
        <ul>
            <?php while ( $newsQuery->have_posts() ) {
                $newsQuery->the_post(); ?>
                <li>
                    <a href="<?php echo the_permalink(); ?>">
                        <?php the_post_thumbnail('full');?>
                        <?php the_title(); // Affiche le titre de l'emission ?>
                        <span><?php //echo $sousTitre;?></span>
                    </a>
                </li>
            <?php }
            wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
            ?>
        </ul>
    </div>
</div>
<?php } else {
    // no rows found
} ?>


