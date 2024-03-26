<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\File\DeleteFileRequest;
use App\Http\Requests\V1\File\DownloadFileRequest;
use App\Http\Requests\V1\File\StoreFileRequest;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(protected FileService $file_service)
    {
    }

    public function load(Request $request)
    {
        try {
            return $this->file_service->find_all($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 404);
        }
    }

    public function upload(StoreFileRequest $request)
    {
        try {
            return $this->file_service->upload($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function download(DownloadFileRequest $request)
    {
        try {
            return $this->file_service->download($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(DeleteFileRequest $request)
    {
        try {
            return $this->file_service->delete($request);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
