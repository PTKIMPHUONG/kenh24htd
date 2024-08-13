<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soạn thảo bài báo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/ye8t257tht9gs3ddxpeb8bgtvxfx151d52chif8tim4s3wr3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<!--     <script>
        tinymce.init({
            selector: '#content',
            plugins: 'image link media',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
            height: 500
        });
    </script> -->
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'image imagetools',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
            height: 500,
            images_upload_url: '{{ route("upload-image") }}', // Sử dụng helper route của Laravel để lấy URL chính xác
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route("upload-image") }}'); // Sử dụng helper route của Laravel

                xhr.onload = function() {
                    var json;

                    if (xhr.status !== 200) {
                        failure('Lỗi HTTP: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location !== 'string') {
                        failure('JSON không hợp lệ: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            }
        });
    </script>

</head>
<body>
    <div class="container">
        <h1>Soạn thảo bài báo</h1>
        <form action="{{ route('save-article') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" name="title" placeholder="Tiêu đề bài báo" required>
            </div>
            <div class="mb-3">
                <select class="form-control" name="category_id" required>
                    <option value="1">Thời sự</option>
                    <option value="2">Thể thao</option>
                    <option value="3">Kinh doanh</option>
                    <option value="4">Giáo dục</option>
                    <option value="5">Công nghệ</option>
                </select>
            </div>
            <div class="mb-3">
                <textarea id="shortcut" class="form-control" name="shortcut" placeholder="Tóm tắt"></textarea>
            </div>
            <div class="mb-3">
                <textarea id="content" class="form-control" name="content"></textarea>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="author_name" placeholder="Tên tác giả" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu bài báo</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
