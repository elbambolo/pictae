<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('upload.titolo') ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <h2><?= lang('upload.sottotitolo') ?></h2>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="files[]" id="files" multiple>
        <input type="submit" value="Upload">
    </form>
    <div id="progress"></div>
    <div id="uploadedFiles"></div>

    <script>
        $(document).ready(function() {
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '<?= base_url('upload/upload-image') ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                $('#progress').text(Math.round(percentComplete * 100) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response) {
                        $('#uploadedFiles').html(response);
                    },
                    error: function() {
                        alert('File upload failed.');
                    }
                });
            });
        });
    </script>
</body>
</html>