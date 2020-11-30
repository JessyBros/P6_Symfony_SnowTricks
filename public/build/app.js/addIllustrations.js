jQuery(document).ready(function() {
    // Récupère la balise <ul> de ma liste d'illustration
    var $illustrationsCollectionHolder = $('ul.illustrations');

    $illustrationsCollectionHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });


    // Compte le nombre de formulaire actuel pour insérer une nouvelle.
    $illustrationsCollectionHolder.data('index', $illustrationsCollectionHolder.find('input').length);

    
    $('body').on('click', '.add_item_link_illustration', function(e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        // // Appel de la fonction pour ajouter un nouveau formulaire
        addFormToCollection($collectionHolderClass);
    })
});

