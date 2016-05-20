<?php
/**
 * Template de la Homepage
 * Sert à afficher tout contenu/URL ne possédant de la homepage
 */
get_header();
?>
    <style>
#button{
    -moz-box-shadow: 0px 1px 0px 0px #1c1b18;
    -webkit-box-shadow: 0px 1px 0px 0px #1c1b18;
    box-shadow: 0px 1px 0px 0px #1c1b18;
    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #eae0c2), color-stop(1, #ccc2a6));
    background:-moz-linear-gradient(top, #eae0c2 5%, #ccc2a6 100%);
    background:-webkit-linear-gradient(top, #eae0c2 5%, #ccc2a6 100%);
    background:-o-linear-gradient(top, #eae0c2 5%, #ccc2a6 100%);
    background:-ms-linear-gradient(top, #eae0c2 5%, #ccc2a6 100%);
    background:linear-gradient(to bottom, #eae0c2 5%, #ccc2a6 100%);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#eae0c2', endColorstr='#ccc2a6',GradientType=0);
    background-color:#eae0c2;
    -moz-border-radius:15px;
    -webkit-border-radius:15px;
    border-radius:15px;
    border:2px solid #333029;
    display:inline-block;
    cursor:pointer;
    color:#505739;
    font-family:Arial;
    font-size:14px;
    font-weight:bold;
    padding:12px 16px;
    text-decoration:none;
    text-shadow:0px 1px 0px #ffffff;
}
#button:hover {
    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ccc2a6), color-stop(1, #eae0c2));
    background:-moz-linear-gradient(top, #ccc2a6 5%, #eae0c2 100%);
    background:-webkit-linear-gradient(top, #ccc2a6 5%, #eae0c2 100%);
    background:-o-linear-gradient(top, #ccc2a6 5%, #eae0c2 100%);
    background:-ms-linear-gradient(top, #ccc2a6 5%, #eae0c2 100%);
    background:linear-gradient(to bottom, #ccc2a6 5%, #eae0c2 100%);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ccc2a6', endColorstr='#eae0c2',GradientType=0);
    background-color:#ccc2a6;
}
#button:active {
    position:relative;
    top:1px;
}
    </style>
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
                <button id="button" data-name="test-podcast.mp3" >Podcast</button>
                <audio id="audio_player" controls  src=""></audio>
            </div><!-- Fin div content -->
        </div><!-- Fin div conteneur -->
    </section>
<?php
get_footer();
