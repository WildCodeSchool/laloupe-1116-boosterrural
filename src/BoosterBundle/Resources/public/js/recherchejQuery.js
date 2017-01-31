$("#search").keyup(function() // " search" est notre cible, à chaque levée d'une touche du clavier sur l'id search, on fera :

{
// Nouvelle regex qui comprend la valeur de l'input 'gi' et 'gi' = mots saisis dans moteur (global i)

    var myRegExp = new RegExp($(this).val(), 'gi');



    $('.filtre').each(function(){ // $(this) = "celui d'avant". Pour chaque élément dans classe "filtre" :

// si le matching n'est pas nul faire :
        if ($(this).html().match(myRegExp) != null)

        {

            // On affiche le bloc correspondant avec un effet slide

            $(this).show('slide');

        }

        else // Sinon

        {


            // On masque le bloc correspondant avec un effet slideOut

            $(this).hide('slideOut');

        }

    });

});

/* *************************************** search 2 ************************** */
$("#search2").keyup(function() // " search" est notre cible, à chaque levée d'une touche du clavier sur l'id search, on fera :

{
// Nouvelle regex qui comprend la valeur de l'input 'gi' et 'gi' = mots saisis dans moteur   (global i)

    var myRegExp = new RegExp($(this).val(), 'gi');



    $('.filtre2').each(function(){ // $(this) = "celui d'avant". Pour chaque élément dans classe "filtre" :

// si le matching n'est pas nul faire :
        if ($(this).html().match(myRegExp) != null)

        {

            // On affiche le bloc correspondant avec un effet slide

            $(this).show('slide');

        }

        else // Sinon

        {


            // On masque le bloc correspondant avec un effet slideOut

            $(this).hide('slideOut');

        }

    });

});