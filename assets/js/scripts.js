
window.onhashchange = function () {
    ShowCustomFeed(window.location.hash); // do something on click
}


$(document).ready(function () {

//    if ($("#hfLoadMore").val() == '') {
//        $('#load_more_insta').fadeOut();
//    }
    
    $('#menu_assign li a').click(function(){
        $('#menu_assign li a').removeClass('active');
        $(this).addClass('active');
    });
    $(document).on('click', '.addToGallery', function () {
        var url, priority, $content, li_id, insta_user_id, insta_link, insta_text, tag;
        $content = $(this).closest('.modal-content');
        url = $content.find('.standard_resolution').val();
        priority = $content.find('.priority').val();
        li_id = $content.find('.insta_img_id').val();
        insta_user_id = $content.find('.insta_user_id').val();
        insta_link = $content.find('.insta_link').val();
        insta_text = $content.find('.insta_text').val();
        tag = $("#tag_name").val();

        $.post('ajax.php', {'url': url, 'insta_user_id': insta_user_id, 'tag': tag, 'insta_id': li_id, 'priority': priority, 'insta_link': insta_link, 'insta_text': insta_text, 'addToGallery': true}, function (data) {
            if (data == 'success') {
                $('.msg_success').html('Image added to gallery.');
                $('.msg_success').append('<p><button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">Close</button><p>');
                var list_id = $('#galleryModal').find('.insta_img_id').val();
                var added_img = _.findWhere(insta_images, {id: list_id});
                assigned_images[assigned_images.length] = added_img;
                unassigned_images = _.without(unassigned_images, added_img);
                $('li#' + list_id).fadeOut(function () {
                    $(this).remove();
                });
            }
            else {
                $('.msg_error').html(data);
            }
        });
    });

    $('.feed_item').on('click', '.remove_inst_img', function () {
        var discarded_image = _.findWhere(insta_images, {id: $(this).parent('li').prop('id')});
        if (!_.findWhere(discarded_images, {id: discarded_image.id})) {
            discarded_images[discarded_images.length] = discarded_image;
        }
        unassigned_images = _.difference(insta_images, discarded_images);
        $(this).parent('li').fadeOut(function () {
            $(this).remove();
        });
    });

    $('.feed_item').on('click', '.open_modal', function () {
        var li = $(this).parent('li');
        var modal = $('#galleryModal');
        var current_order = modal.find('.priority').val();
        var next_order = parseInt(current_order) + 1;
        modal.find('.insta_img_id').val(li.prop('id'));
        modal.find('.low_resolution').val(li.find('.low_resolution').val());
        modal.find('.standard_resolution').val(li.find('.standard_resolution').val());
        modal.find('.insta_link').val(li.find('.insta_link').val());
        modal.find('.insta_text').val(li.find('.insta_text').val());
        modal.find('.fa-heart').text(li.find('.fa-heart').text());
        modal.find('.fa-comment').text(li.find('.fa-comment').text());
        modal.find('.img_inst').attr('src', li.find('.img_inst').attr('src'));
        modal.find('.msg_success').html('');
        modal.find('.priority').val(next_order);
        $('#galleryModal').modal(next_order);
    });
//    $('#galleryModal').on('show.bs.modal', function (event) {
//        var button = $(event.relatedTarget) // Button that triggered the modal
//        var recipient = button.data('whatever') // Extract info from data-* attributes
//        var modal = $(this);
//        modal.find('.modal-title').text('New message to ' + recipient);
//        modal.find('.modal-body input').val(recipient);
//    });

    $(document).on('click', '#load_more_insta', function () {
        var next_url = $("#hfLoadMore").val();
        LoadInstagramFeed(next_url);
    });
});

function LoadInstagramFeed(next_url, remove_all) {
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        dataType: "json",
        beforeSend: function () {
            $("#loading").show();
        },
        data: {'next_url': next_url, 'load_more': true}
    })
            .done(function (data) {
                if (data) {
                    if (!data.pagination.next_url) {
                        $('#load_more_insta').fadeOut();
                    }
                    insta_images = _.union(insta_images, data.data);
                    $("#hfLoadMore").val(data.pagination.next_url);
                    if(remove_all){
                        $('ul.feed_item').html('');
                    }
                    AddImagestoFeed(data.data, 'ajax');
                }
            })
            .fail(function (data) {
            })
            .always(function (data) {
                $("#loading").hide();
            });
}

function ShowCustomFeed(hash) {
    switch (hash) {
        case '#assigned':            
            $('#load_more_insta, #quick_discard').fadeOut();
            $('ul.feed_item').html('');
            AddImagestoFeed(assigned_images);
            break;
        case '#unassigned':
            $('#load_more_insta, #quick_discard').fadeIn();
            $('ul.feed_item').html('');
            AddImagestoFeed(unassigned_images, 'unassigned');
            break;
        case '#discarded':
            $('#load_more_insta, #quick_discard').fadeOut();
            $('ul.feed_item').html('');
            AddImagestoFeed(discarded_images, 'discarded');
            break;
    }
}

function AddImagestoFeed(images, source) {
    var open_modal, li, caption_text, cross_icon;
    $.each(images, function (index, image) {
        open_modal = '';
        cross_icon = ' hidden ';

        if (source && source == 'ajax') {
            if (user_insta_images.indexOf(image.id) >= 0) {
                assigned_images[assigned_images.length] = this;
                return 1;
            }
            else {
                unassigned_images[unassigned_images.length] = this;
            }
            open_modal = 'class=" open_modal"';
            cross_icon = '';
        }
        else if (source && source == 'unassigned') {
            open_modal = 'class=" open_modal"';
            cross_icon = '';
        }
        else if (source && source == 'discarded') {
        open_modal = 'class=" open_modal"';
        }

        caption_text = '';
        if (image.caption) {
            caption_text = image.caption.text;
        }
        li = '<li id="' + image.id + '"><a class="close_icon' + cross_icon + ' text-right remove_inst_img"><i class="fa fa-times fa-2x "></i></a><a href="javascript:void(0);"' + open_modal + '><img class="img_inst" src="' + image.images.thumbnail.url + '" alt="" /></a><div class="like_comment"><i class="fa fa-heart"> ' + image.likes.count + '</i> <i class="fa fa-comment"> ' + image.comments.count + '</i></div><input  type="hidden" class="low_resolution"  value="' + image.images.low_resolution.url + '"/><input  type="hidden" class="standard_resolution" value="' + image.images.standard_resolution.url + '"/><input  type="hidden" class="insta_link" value="' + image.link + '"/><input  type="hidden" class="insta_text" value="' + caption_text + '"/></li>';
        $('ul.feed_item').append(li);
    });
}