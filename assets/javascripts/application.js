/**
 * 
 */

// External links handling
$('a[rel*="external"]').click(function () {
    $(this).attr('target', '_blank');
});

// auto tab selection
$('.nav-tabs a:first').tab('show');
$(document).on('loaded.bs.modal', function () {
    $('.nav-tabs a:first').tab('show');
});

// DateTime picker
$('.field-datetime').datetimepicker({
    icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-arrow-up',
        down: 'fa fa-arrow-down',
        previous: 'fa fa-arrow-left',
        next: 'fa fa-arrow-right',
        today: 'glyphicon glyphicon-screenshot',
        clear: 'glyphicon glyphicon-trash'
    },
    'sideBySide': true,
    'showTodayButton': true,
    'useCurrent': true
});

// Date picker
$('.field-date').datetimepicker({
    icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-arrow-up',
        down: 'fa fa-arrow-down',
        previous: 'fa fa-arrow-left',
        next: 'fa fa-arrow-right',
        today: 'glyphicon glyphicon-screenshot',
        clear: 'glyphicon glyphicon-trash'
    },
    pickTime: false
});

// Time picker
$('.field-time').datetimepicker({
    icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-arrow-up',
        down: 'fa fa-arrow-down',
        previous: 'fa fa-arrow-left',
        next: 'fa fa-arrow-right',
        today: 'glyphicon glyphicon-screenshot',
        clear: 'glyphicon glyphicon-trash'
    },
    pickDate: false
});

// Ajax form submit
$(document).on('submit', 'form[data-async]', function (e) {
    var $form   = $(this),
        $target = $($form.attr('data-target'));

    $.ajax({
        type: $form.attr('method'),
        url:  $form.attr('action'),
        data: $form.serialize(),
        success: function (data) {
            $target.html(data);
        }
    });

    e.preventDefault();
});

// Init tinymce
tinymce.init({
    selector: '.form-wysiwyg'
});

// Infinite fields
$(document)
    .on('click', '.field-infinite a[data-event="field-add"]', function () {
        var clone = $(this).closest('[data-multiply]').clone();

        $(clone).find('input').val('');
        $(clone).find('.image-preview').css('background-image', '');
        $(this).closest('[data-multiply]').after(clone);

        redrawInfiniteFieldButtons();
    }).on('click', '.field-infinite a[data-event="field-remove"]', function () {
        $(this).closest('[data-multiply]').remove();

        redrawInfiniteFieldButtons();
    });

function redrawInfiniteFieldButtons () {
    $('.form-group').each(function () {
        var addFields    = $(this).find('[data-event="field-add"]'),
            removeFields = $(this).find('[data-event="field-remove"]');

        for (var i = 0; i < addFields.length -1; i++) {
            addFields.eq(i).hide();
            removeFields.eq(i).show();
        }

        // multiple limit
        var limit = $(this).find('input').last().attr('multiple-limit');
        if (limit != undefined) {
            var fields = $(this).find('input').length;

            if (fields >= limit) {
                addFields.last().hide();
            } else {
                addFields.last().show();
            }
        }
    });
}

// Image upload
$(document).on('change', '.image-file-wrapper input[type=file]', function () {
    var self = $(this);

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(self).next().css('background-image', 'url("' + e.target.result + '")');
        };

        reader.readAsDataURL(this.files[0]);
    }
});

/* Slugger */
var titleField = $('input[name="title"]'),
    slugField = $('input[name="slug"]'),
    slugLabel = $('label[for="slug"]');

if (titleField.length > 0 && slugField.length > 0) {
    titleField.off('change').on('change', function() {
        var labelOriginal = slugLabel.html();

        slugLabel.append('&nbsp;<i class="fa fa-cog fa-spin"></i>');

        $.ajax({
            data: {
                toSlug: titleField.val()
            },
            type: 'post',
            url: '/throne/slugger',
            success: function (returnData) {
                slugField.val(returnData.response);
                slugLabel.html(labelOriginal);
            }
        });
    });
}

/* Max length */
$('input[maxlength]').maxlength({
    alwaysShow: true
});