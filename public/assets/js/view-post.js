'use_strict';

jQuery(document).ready(function($){
    // Edit post in popup
    let editBtn = $('.view'),
        popup = $('.view-post-popup'),
        closePopup = $('.view-post-popup .btn-close');

    editBtn.on('click', function(event){
        event.preventDefault();

        let target = $(this).data('id'),
            title = $('.card-body[data-post="' + target + '"] .card-title').text(),
            content = $('.card-body[data-post="' + target + '"] .card-text').text();

        if (popup.hasClass('show')) {
            popup.removeClass('show');
        } else {
            popup.addClass('show');
            popup.find('.post-data .title').text(title);
            popup.find('.post-data .content').text(content);
        }

    });

    // Close popup
    closePopup.on('click', function(event){
        event.preventDefault();

        popup.removeClass('show');
        $('#postEditForm').attr('action', '');
        popup.find('.post-data .title').text('');
        popup.find('.post-data .content').text('');
    });
});
