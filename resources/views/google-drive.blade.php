

<h2 class="text-xl font-bold mb-4">Google Drive Shared Drive</h2>

<form method="POST" enctype="multipart/form-data">
    @csrf

    <input type="file" name="file" required>
    <button class="bg-blue-500 text-white px-3 py-1 rounded">
        Upload
    </button>
</form>

<hr class="my-4">

@if(count($files))
    <ul class="list-disc ml-5">
        @foreach($files as $file)
            <li>
                {{ $file->name }}
                —
                <a href="https://drive.google.com/file/d/{{ $file->id }}/view"
                   target="_blank"
                   class="text-blue-600 underline">
                    Open
                </a>
            </li>
        @endforeach
    </ul>
@else
    <p>No files in this folder.</p>
@endif

