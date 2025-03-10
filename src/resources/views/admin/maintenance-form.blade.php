@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header">
                <h4>Maintenance Mode Settings</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.maintenance.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-check mb-3">
                        <input class="form-check-input" id="maintenance_mode" name="maintenance_mode" type="checkbox"
                            value="1" {{ $settings->maintenance_mode ? 'checked' : '' }}>
                        <label class="form-check-label" for="maintenance_mode">Enable Maintenance Mode</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="maintenance_title">Maintenance Title</label>
                        <input class="form-control @error('maintenance_title') is-invalid @enderror" id="maintenance_title"
                            name="maintenance_title" type="text"
                            value="{{ old('maintenance_title', $settings->maintenance_title) }}">
                        @error('maintenance_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="maintenance_description">Maintenance Description</label>
                        <textarea class="form-control @error('maintenance_description') is-invalid @enderror" id="maintenance_description"
                            name="maintenance_description" rows="4">{{ old('maintenance_description', $settings->maintenance_description) }}</textarea>
                        @error('maintenance_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="maintenance_image">Maintenance Image</label>
                        <input class="form-control @error('maintenance_image') is-invalid @enderror" id="maintenance_image"
                            name="maintenance_image" type="file" accept="image/*" onchange="previewImage(this)">
                        @error('maintenance_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @if ($settings->maintenance_image)
                            <p>Current Image:</p>
                            <img id="currentImage" src="{{ asset($settings->maintenance_image) }}"
                                alt="Current Maintenance Image" style="max-width: 300px; max-height: 200px;">
                        @endif

                        <div id="imagePreviewContainer" style="display: none; margin-top: 10px;">
                            <p>New Image Preview:</p>
                            <img id="imagePreview" src="#" alt="Image Preview"
                                style="max-width: 300px; max-height: 200px;">
                        </div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var previewContainer = document.getElementById('imagePreviewContainer');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.style.display = 'none';
            }
        }
    </script>
@endsection
