<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài báo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/ye8t257tht9gs3ddxpeb8bgtvxfx151d52chif8tim4s3wr3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: '#content',
        plugins: 'image',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
        height: 500,
        images_upload_url: '{{ route("upload-image") }}',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("upload-image") }}');

            xhr.onload = function() {
                var json;

                console.log(xhr.responseText); // Log phản hồi từ máy chủ

                if (xhr.status !== 200) {
                    console.error('HTTP Error: ' + xhr.status);
                    return failure('HTTP Error: ' + xhr.status);
                }

                try {
                    json = JSON.parse(xhr.responseText);
                } catch (e) {
                    console.error('Invalid JSON: ' + xhr.responseText);
                    return failure('Invalid JSON: ' + xhr.responseText);
                }

                if (!json || typeof json.location !== 'string') {
                    console.error('Invalid JSON: ' + xhr.responseText);
                    return failure('Invalid JSON: ' + xhr.responseText);
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            formData.append('_token', '{{ csrf_token() }}'); // Add CSRF token

            xhr.send(formData);
        }
    });
</script>

</head>
<body>
    <div class="container">
        <h1>Chỉnh sửa bài báo</h1>
        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" name="title" value="{{ $article->title }}" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Chuyên mục</label>
                <select class="form-control" name="category_id" required>
                    <option value="1" @if($article->category_id == 1) selected @endif>Thời sự</option>
                    <option value="2" @if($article->category_id == 2) selected @endif>Thể thao</option>
                    <option value="3" @if($article->category_id == 3) selected @endif>Kinh doanh</option>
                    <option value="4" @if($article->category_id == 4) selected @endif>Giáo dục</option>
                    <option value="5" @if($article->category_id == 5) selected @endif>Công nghệ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="shortcut" class="form-label">Tóm tắt</label>
                <textarea class="form-control" name="shortcut">{{ $article->shortcut }}</textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control" id="content" name="content">{{ $article->content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="author_name" class="form-label">Tác giả</label>
                <input type="text" class="form-control" name="author_name" value="{{ $article->author_name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật bài báo</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
