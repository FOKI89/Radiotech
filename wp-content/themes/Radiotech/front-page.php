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
                <span class="categorie_slide"> <div class="logo-rond"></div><span>Lire la radio </span><BR>informatique</span>
            </section>
        </div>
        <div>
        <section>
            <span class="chiffres">Déjà <span>10 456</span> abonnés<BR> et <span>111 530</span> téléchargements de podcasts !</span>
        </section>
          </div>   
    </div>
    <?php get_template_part('partials/_publicite'); ?>
    <?php get_template_part('partials/_news'); ?>
    <?php get_template_part('partials/_profilsFrontPage'); ?>
    <section>
        <div class="container">
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
            </div><!-- Fin div content -->
        </div><!-- Fin div conteneur -->
    </section>
<?php
get_footer();
