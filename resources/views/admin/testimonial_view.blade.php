@extends('admin.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">Add Testimonial</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('testimonial.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">Testimonial Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" placeholder="Enter Testimonial Name" required>
                                @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div class="mb-3">
                                <label class="form-label">Testimonial Content</label>
                                <textarea class="form-control @error('content') is-invalid @enderror"
                                          name="body_content" placeholder="Enter Testimonial Content" rows="4" required></textarea>
                                @error('content')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Designation -->
                            <div class="mb-3">
                                <label class="form-label">Testimonial Designation</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       name="title" placeholder="Enter Designation" required>
                                @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-3">
                                <label class="form-label">Testimonial Image</label>
                                <input type="file" name="image" id="imageInput" accept="image/*" class="form-control" required>
                                <div class="mt-2">
                                    <img id="preview" src="" alt="Preview"
                                         class="img-fluid mt-2 d-none border" style="max-height: 200px;">
                                    <button type="button" id="removeImage" class="btn btn-sm btn-outline-danger mt-2 d-none">Remove Image</button>
                                </div>
                                @error('image')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Add Testimonial</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const imageInput = document.getElementById('imageInput');
            const preview = document.getElementById('preview');
            const removeBtn = document.getElementById('removeImage');

            imageInput.addEventListener('change', () => {
                const file = imageInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                        removeBtn.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeBtn.addEventListener('click', () => {
                imageInput.value = '';
                preview.src = '';
                preview.classList.add('d-none');
                removeBtn.classList.add('d-none');
            });
        </script>
    @endpush
@endsection
