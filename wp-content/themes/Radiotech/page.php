<?php
/**
 * Template par défaut de Wordpress
 * Sert à afficher tout contenu/URL ne possédant pas de template (plus approprié)
 */
get_header();
?>
    <section>
        <header>
            <h1><?php the_title(); ?></h1>
        </header>
        <div class="conteneur">
            <div class="content">
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
                <form action="#">
                    <input type="file">
                </form>
            </div><!-- Fin div content -->
        </div><!-- Fin div conteneur -->
    </section>
<?php
get_footer();