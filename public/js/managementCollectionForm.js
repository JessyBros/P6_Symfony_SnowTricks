
function addFormToCollection($collectionHolderClass) {
    // Get the ul that holds the collection of tags "add_item_link"
    var $collectionHolder = $("." + $collectionHolderClass);

    // Get the data-prototype
    var prototype = $collectionHolder.data("prototype");

    // get the new index
    var index = $collectionHolder.data("index");

    var newForm = prototype;

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data("index", index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li class="col-md-6 my-2 d-flex justify-content-center flex-column align-items-center"></li>').append(newForm);
    // Add the new form at the end of the list
    $collectionHolder.append($newFormLi);

    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button  type="button" class="btn btn-outline-danger btn-sm mt-1"><i class="fas fa-times"></i></button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on("click", function (e) {
        $tagFormLi.remove();
    });
}