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

        open: function (e) {
            e.preventDefault();
            $('#form_upload').find('.file').trigger('click');
        },

        runUpload: function (e) {
            e.preventDefault();

            upload_modal.el.show();
            window.onbeforeunload = function () {
                return 'Upload en cours. Voulez-vous quitter ?';
            };

            var form = $('#form_upload');

            $.each(form.find('.file')[0].files, function (key, file) {
                var formData = new FormData();
                formData.append('file', file);
                formData.append('action', 'upload');

                var uploadProgress = upload_modal.createUploadProgress();
                var index = upload_modal.uploads.push(uploadProgress[0]) - 1;
                //uploadProgress.find('.text').text(file.name);

                $.ajax({
                    type: 'POST',
                    url: form.data('action'),
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

            });

            upload_modal.reset();
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

        reset: function () {
            var file = $('#form_upload').find('.file');
            file.replaceWith(file.val('').clone(true));
        }
    };

    upload_modal.init();
    $('#form_upload')
        .on('click', '.submit_upload', upload_modal.open)
        .on('change', '.file', upload_modal.runUpload)
    ;
});
