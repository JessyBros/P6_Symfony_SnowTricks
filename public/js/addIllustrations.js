jQuery(document).ready(function() {
    var $illustrationsCollectionHolder = $("ul.illustrations");

    // add a delete link to all of the existing tag form li elements
    $illustrationsCollectionHolder.find("li").each(function() {
        addTagFormDeleteLink($(this));
    });
    
    // Count which form already exist to create the new
    $illustrationsCollectionHolder.data("index", $illustrationsCollectionHolder.find("input").length);

    $("body").on("click", ".add_item_link_illustration", function(e) {
        var $collectionHolderClass = $(e.currentTarget).data("collectionHolderClass");
        addFormToCollection($collectionHolderClass);
    })
});

