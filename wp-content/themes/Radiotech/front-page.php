<?php
/**
 * Template de la Homepage
 * Sert à afficher tout contenu/URL ne possédant de la homepage
 */
get_header();
?>
    </style>
    <section>
        <div class="container">
            <div class="content">

                <?php get_template_part('partials/_publicite'); ?>
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        the_content();
                    } // end while
                } else {
                    // Aucun contenu trouvé
                    _e("Sorry, no content matches your request", "radiotech");
                }
                ?>
            </div><!-- Fin div content -->
        </div><!-- Fin div conteneur -->
    </section>
<?php
get_footer();
