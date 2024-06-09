<!-- resources/views/upload.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
    <h1>Upload File</h1>

    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div>
            <strong>Success!</strong> {{ session('success') }}<br>
            <strong>File Path:</strong> {{ session('path') }}
        </div>
    @endif

    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="file">Choose file</label>
            <input type="file" id="file" name="file" required>
        </div>
        <button type="submit">Upload</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($files))
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file }}</td>
                    <td>
                        <form action="/files/{{ $file }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>

</body>
</html>
