jQuery(document).ready(function() {
    var $videosCollectionHolder = $('ul.videos');

    // add a delete link to all of the existing tag form li elements
    $videosCollectionHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });

    // Count which form already exist to create the new
    $videosCollectionHolder.data('index', $videosCollectionHolder.find('input').length);

    $('body').on('click', '.add_item_link_video', function(e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        addFormToCollection($collectionHolderClass);
    })
});