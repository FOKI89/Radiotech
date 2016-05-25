/**
 * Fichier Js principal
 */

// Nav pour mobile
function mobileMenu(){
    $('nav a.bouton-nav').click(function(e) {
        e.preventDefault();
        $('nav.main-nav').toggleClass('open');
        $('nav ul#menu-menu-1').toggle(100);
    });
}
/* Fonction qui détache le conteneur des version mutlingues en mode tablet/mobile pour le remettre dans le menu */
function langueMobile(){
    var langueConteneur;
    if($( window ).width() > 1024){
        langueConteneur = $('nav div.select-langue').detach();
        $('header div.super-header div.wrapper-socials').before($(langueConteneur));
    }else{
        langueConteneur = $('header div.super-header div.select-langue').detach();
        $('nav.main-nav').append(langueConteneur);
    }
}

// resize blocs height on frontpage
function maxHeightBlocs(div){
    var maxHeight = -1;

    $(div).each(function() {
      maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
    });

    $(div).each(function() {
      $(this).height(maxHeight + 20);
    });

}


// Fonction qui affiche la pop-in de demande d'inscriprion
function affichePopIn(e){
    e.preventDefault();
    $('.inscription-pop-in').toggle();
}


jQuery(document).ready(function( $ ) {
    mobileMenu();
    langueMobile();
    //maxHeightBlocs('.first-part .conteneur > div');
    maxHeightBlocs('.bloc-footer');

    $( window ).on('resize', function(){
        langueMobile();
        if(window.innerWidth > 1025){
            $('nav ul#menu-menu-1').show();
        }else{
            $('nav ul#menu-menu-1').hide();
        }
    });
});
