<?php
/**
 * Template des articles/emissions/badges seuls
 */
get_header();
?>
    <section>
        <div class="container">
            <div class="content">
                <?php
                if (have_posts()) {
                        the_post();?>
                        <h2><?php the_title(); ?></h2>
                        <?php the_post_thumbnail('full');?>
                        <?php  $authorID = get_the_author_id();  var_dump($authorID);?>
                        <audio src=""></audio>
                        <h3>Description:</h3>
                        <?php the_content();
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
