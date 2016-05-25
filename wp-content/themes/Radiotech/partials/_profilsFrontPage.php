<?php
// Template de la liste d'auteurs
$args = array('orderby' => 'post_count', 'order' => 'DESC', 'number' => 6,);
$authors =  get_users( $args );?>

    <div class="bloc auteurs">
        <div class="container">
            <h2><?php _e('Nos profils à la une', 'radiotech'); ?></h2>
            <?php ?>
            <ul>
                <?php foreach ( $authors as $author ) {?>
                    <li>
                        <a href="<?php echo site_url(); ?>">
                            <?php echo esc_html( $author->display_name ); ?>
                            <?php //the_post_thumbnail('full');?>
                            <span><?php //echo $author;?></span>
                            <?php //the_title(); // Affiche le titre de l'emission ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
