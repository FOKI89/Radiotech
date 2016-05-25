<?php
/**
 * Template de la Homepage
 * Sert à afficher tout contenu/URL ne possédant de la homepage
 */
get_header();
?>
    <div class="slider">
        <h2>Informatique</h2>
        <div>
            <section>
                <span class="categorie_slide"> <img src="<?php radiotech_th(); ?>/logo-rond.PNG" alt="play"><span>Lire la radio </span><BR>informatique</span>
            </section>
        </div>
        <section>
            <span class="chiffres">Déjà 10 456 abonnés<BR> et 111 530 téléchargements de podcasts !</span>
        </section>
    </div>
    <section>
        <div class="container">
            <div class="content">
                <?php get_template_part('partials/_publicite'); ?>
                <?php get_template_part('partials/_news'); ?>
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

                <form action="#" method="post" enctype="multipart/form-data" id="form_upload">
                    <input type="file" name="file" id="file">
                    <input type="submit">
                </form>
            </div><!-- Fin div content -->
        </div><!-- Fin div conteneur -->
    </section>
<?php
get_sidebar('upload');
get_footer();
