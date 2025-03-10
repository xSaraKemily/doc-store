@php use Illuminate\Support\Str; @endphp
@extends('app')

@section('content')
    <div class="container mt-5 d-flex flex-column justify-content-center align-items-center">
        @if($files->isNotEmpty())
            <h2 class="text-center mb-4">Uploaded Files</h2>

            <table class="table table-striped">
                <thead class="table-dark">
                <tr>
                    <th scope="col">File Name</th>
                    <th scope="col">Upload Time</th>
                    <th class="text-center" scope="col">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td class="col-6" title="{{$file->filename}}">
                            <div class="d-flex flex-row align-items-center gap-1">
                                <img src="{{Str::endsWith($file->filename, '.docx') ? 'docx-icon.svg' : 'pdf-icon.svg'}}"
                                     style="width: 30px;">

                                {{ Str::limit($file->filename, 50, '...') }}
                            </div>
                        </td>

                        <td class="col-4">{{ $file->created_at->format('m/d/Y') }}</td>

                        <td>
                            <div class="d-flex flex-row align-items-center gap-1 justify-content-center">
                                <button class="btn btn-danger open-delete-modal-button" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-file-id="{{ $file->id }}">
                                    <img src="trash.svg" style="width: 23px">
                                </button>

                                <a href="/download/{{ $file->id }}">
                                    <button class="btn btn-info text-white">
                                        <img src="download-icon.svg" style="width: 20px">
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h2>There are no files uploaded yet</h2>
            <img class="w-50" src="undraw_add-notes_9xls.svg">
        @endif
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Are you sure you want to delete this file? This action cannot be undone.
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="idToDeleteInput">

    @push('scripts')
        <script src="{{ asset('js/pages/files-list.js') }}" type="module"></script>
    @endpush
@endsection
