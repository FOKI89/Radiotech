<?php
/**
 * Template de la Homepage
 * Sert à afficher tout contenu/URL ne possédant de la homepage
 */
get_header();
$category = $wp_query->get_queried_object();
?>
    <section>
        <div class="container">
            <div class="content">
                <?php $args = array('post_type'  => radiotech_Main::CPT_EMISSION , 'category_name' => $category->name, 'orderby' => 'date', );
                $categoryQuery = new WP_Query( $args );
                if ( $categoryQuery->have_posts() ) { ?>
                    <div class="bloc ">
                        <div class="container">
                            <h2><?php echo $category->name; ?></h2>
                            <?php ?>
                            <ul>
                                <?php while ( $categoryQuery->have_posts() ) {
                                    $categoryQuery->the_post(); ?>
                                    <li>
                                        <a href="<?php echo the_permalink(); ?>">
                                            <?php the_post_thumbnail('full');?>
                                        </a>
                                        <a href="<?php ?>"><?php the_author(); ?></a>
                                        <p><?php the_title(); // Affiche le titre de l'emission ?></p>
                                        <?php the_content(); ?>

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
            </div><!-- Fin div content -->
        </div><!-- Fin div conteneur -->
    </section>
<?php
get_footer();
