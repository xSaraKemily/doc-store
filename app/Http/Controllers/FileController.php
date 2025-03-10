<?php

namespace App\Http\Controllers;

use App\Actions\CreateFilesAction;
use App\Actions\DeleteFileAction;
use App\Actions\DeleteFilesAction;
use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class FileController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view(
            'pages.file-list',
            ['files' => File::orderBy('created_at', 'desc')->get()]
        );
    }

    public function store(StoreFileRequest $request): ?JsonResponse
    {
        if ($request->has('files')) {
            CreateFilesAction::execute($request->file('files'));

            return response()->json(['message' => 'Files uploaded successfully!']);
        }

        return response()->json(['message' => 'No files uploaded.'], 400);
    }

    public function destroy(string $id): void
    {
        DeleteFilesAction::execute(Collection::make([$id]));
    }
}
