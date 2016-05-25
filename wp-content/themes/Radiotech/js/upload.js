$(document).ready(function () {
    var upload_modal = {
        el: $('#upload_modal'),
        uploads: [],

        init: function () {
            upload_modal.el
                .on('click', '.button.close', upload_modal.close)
            ;
        },

        createUploadProgress: function () {
            var uploadProgress = $('#upload_progress_template').html();

            return upload_modal.el.find('#uploads')
                .append(uploadProgress)
                .find('.upload_progress:last');
        },

        runUpload: function (e) {
            e.preventDefault();

            upload_modal.el.show();
            window.onbeforeunload = function () {
                return 'Upload en cours. Voulez-vous quitter ?';
            };

            var form = $(this);
            var formData = new FormData(form[0]);

            form.trigger('reset');
            
            var uploadProgress = upload_modal.createUploadProgress();
            var index = upload_modal.uploads.push(uploadProgress[0]) - 1;

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    uploadProgress
                        .find('.progress').css('width', '100%').end()
                        .find('.text').html('Terminé')
                    ;
                    upload_modal.uploads.splice(index, 1);
                },
                complete: function () {
                    window.onbeforeunload = null;
                },
                xhr: function () {
                    var xhr = $.ajaxSettings.xhr();

                    xhr.upload.addEventListener("progress", function(e){
                        uploadProgress.find('.progress').css('width', e.loaded / e.total * 90 + '%');
                    }, false);

                    xhr.upload.addEventListener("load", function (e) {
                        uploadProgress.find('.text').show();
                    });

                    return xhr;
                }
            });
        },

        close: function () {
            if (upload_modal.uploads.length > 0) {
                if(!window.confirm('Upload en cours. Voulez-vous quitter ?')) {
                    return false;
                }
            }

            upload_modal.reset();
            upload_modal.el.hide();
        },

        reset: function (e) {
            
        }
    };

    upload_modal.init();
    $('#form_upload').on('submit', upload_modal.runUpload);
});
