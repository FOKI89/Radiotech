<?php
// Template des publicités
?>
<div class="bloc publicite">
    <div class="container">
        <h2><?php _e('Publicités', 'radiotech'); ?></h2>
        <?php
        // check if the repeater field has rows of data
        if (have_rows('liste-pub', 'option')) { ?>
            <ul>
                <?php // loop through the rows of data
                while (have_rows('liste-pub', 'option')) {
                    the_row();
                    $publicite = get_sub_field('pub');
                    if ($publicite) {
                        // override $post
                        $post = $publicite;
                        setup_postdata($post);
                        // get a field value
                        $sousTitre = get_field('sous-titre-pub', $post->ID);
                        $lien = get_field('lien-pub', $post->ID);
                        ?>
                        <li>
                            <a href="<?php echo $lien; ?>" target="_blank">
                                <?php the_post_thumbnail('full');?>
                                <?php the_title(); // Affiche le titre de la publicité ?>
                                <span><?php echo $sousTitre;?></span>
                            </a>
                        </li>
                        <?php
                        wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
                    }
                } ?>
            </ul>
        <?php } else {
            // no rows found
        }
        ?>
    </div>
</div>
