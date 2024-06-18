'use_strict';

jQuery(document).ready(function($){
    // Edit post in popup
    let editBtn = $('.edit'),
        popup = $('.edit-post-popup'),
        closePopup = $('.edit-post-popup .btn-close');

    editBtn.on('click', function(event){
        event.preventDefault();

        let target = $(this).data('id'),
            title = $('.card-body[data-post="' + target + '"] .card-title').text(),
            content = $('.card-body[data-post="' + target + '"] .card-text').text(),
            actionUrl = $(this).data('action');

        if (popup.hasClass('show')) {
            popup.removeClass('show');
        } else {
            popup.addClass('show');
            $('#postEditForm').attr('action', actionUrl);
            popup.find('input[name="title"]').val(title);
            popup.find('textarea[name="content"]').val(content);
        }

    });

    // Close popup
    closePopup.on('click', function(event){
        event.preventDefault();

        popup.removeClass('show');
        $('#postEditForm').attr('action', '');
        popup.find('input[name="title"]').val('');
        popup.find('textarea[name="content"]').val('');
    });
});
