<footer>
    <div class="container">
        <nav class="nav-footer">
            <!-- Menu dynamique de Wordpress -->
            <?php
            $defaults = array(
                'theme_location'  => 'menu-footer',
                'menu'            => 'menu-footer',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => '',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => false,
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => ''
            );
            // Affichage du menu principal
            wp_nav_menu( $defaults );
            ?>
        </nav>
    </div>
</footer>
<?php wp_footer(); ?>