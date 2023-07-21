<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="uploadMul_img.php" id="uploadForm" enctype="multipart/form-data" >
        <div class="upload__box">
            <div class="upload__btn-box">
                <label class="upload__btn">
                    <p>Upload images</p>
                    <input type="file" multiple="" data-max_length="20" class="upload__inputfile" name="images[]">
                </label>
                <input type="text" id="Name" name="name" style="width:30;" required>
            </div>
            <div class="upload__img-wrap"></div>
        </div>
        <input type="submit" id="submitBtn" value="Upload">
    </form>

    <!-- ... other content ... -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function (f, index) {
                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false;
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                };
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('#submitBtn').on('click', function () {
                var formData = new FormData();
                for (var i = 0; i < imgArray.length; i++) {
                    formData.append('images[]', imgArray[i]);
                }

                $.ajax({
                    url: 'uploadMul_img.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        var result = JSON.parse(response);
                        var totalUploaded = result.total_uploaded;
                        var failedInsertions = result.failed_insertions;

                        // Display the result on the same page
                        alert('Total images uploaded: ' + totalUploaded + '\nFailed to insert images: ' + failedInsertions);

                        // Optionally, you can reset the form after upload
                        $('#uploadForm')[0].reset();
                    },
                    error: function () {
                        alert('Error occurred during the upload.');
                    }
                });
            });
        }
    </script>
</body>
</html>
