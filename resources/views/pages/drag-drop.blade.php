<style>
    .drop-zone {
        border: 2px dashed #ccc;
        border-radius: 10px;
        padding: 100px;
        text-align: center;
        cursor: pointer;
        background-color: #f8f9fa;
    }
    .drop-zone.dragover {
        background-color: #e9ecef;
    }
</style>

<div class="container">
    <h2 class="text-center mb-4">Upload Your Files</h2>

    <form>
        <div class="mb-3 drop-zone position-relative" id="dropZone">
            <span> Drag & Drop files here or click to select </span>

            <button class="position-absolute d-flex gap-2 top-0 end-0 m-3 btn btn-danger align-items-center d-none" id="clearSelectionButton">
                <svg class="bi bi-x-lg text-white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>

                Clear Selection
            </button>
        </div>

        <input type="file" class="form-control d-none" id="fileInput" accept=".pdf, .docx" multiple>

        <button class="btn btn-dark w-100 d-none z-5" id="uploadButton">Upload</button>
    </form>
</div>

@push('scripts')
    <script src="{{ asset('js/pages/drag-drop.js') }}" type="module"></script>
@endpush
