jQuery(document).ready(function() {
    // Récupère la balise <ul> de ma liste de vidéo
    var $videosCollectionHolder = $('ul.videos');

    // Compte le nombre de formulaire actuel pour insérer une nouvelle.
    $videosCollectionHolder.data('index', $videosCollectionHolder.find('input').length);

    $('body').on('click', '.add_item_link_video', function(e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        // // Appel de la fonction pour ajouter un nouveau formulaire
        addFormToCollection($collectionHolderClass);
    })
});