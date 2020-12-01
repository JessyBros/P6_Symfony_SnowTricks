
function addFormToCollection($collectionHolderClass) {
    // Récupérer <ul> où le boutton avec la class "add_item_link" est situé
    var $collectionHolder = $('.' + $collectionHolderClass);

    // Récupérer l'utilisation du data-prototype expliqué et utilisé ultérieuremet par symfony
    var prototype = $collectionHolder.data('prototype');

    // Obtenir la nouvelle indice.
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // Augmente de un l'indice pour le nouveau formulaire
    $collectionHolder.data('index', index + 1);

    // Fait apparaître le formulaire dans la page dans une balise <li>, avant le boutton qui permet d'ajouter ce formulaire
    var $newFormLi = $('<li></li>').append(newForm);
    // Ajoute le formulaire en fin de liste<.
    $collectionHolder.append($newFormLi);

    //appel la function qui supprime son propre formulaire imbriqué d'illustration.
    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button  type="button"><i class="fas fa-times"></i></button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function (e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}