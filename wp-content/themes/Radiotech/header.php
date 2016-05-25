<?php wp_head(); ?>
<body <?php body_class();?>
<header>
    <div class="container">
        <nav class="main-nav">
            <!-- Menu dynamique de Wordpress -->
            <?php
            $defaults = array(
                'theme_location'  => 'primary',
                'menu'            => 'main-menu',
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
            <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
                <div><input type="text" size="18" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
                    <input type="submit" id="searchsubmit" value="Search" class="btn" />
                </div>
            </form>
        </nav>
    </div>
</header>
<div class="slider">
    <h2>Informatique</h2>
    <div><section>
            <span class="categorie_slide"> <img src="<?php radiotech_th();?>/logo-rond.PNG" alt="play" ><span>Lire la radio </span><BR>informatique</span>
        </section></div>
    <section>
        <span class="chiffres">Déjà 10 456 abonnés<BR> et 111 530 téléchargements de podcasts !</span>
    </section>
</div>

