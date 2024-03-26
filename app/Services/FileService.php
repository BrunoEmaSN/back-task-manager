<?php

namespace App\Services;

use App\Filters\V1\FilesFilter;
use App\Http\Requests\V1\File\DeleteFileRequest;
use App\Http\Requests\V1\File\DownloadFileRequest;
use App\Http\Requests\V1\File\GetFileRequest;
use App\Http\Requests\V1\File\StoreFileRequest;
use App\Http\Resources\V1\FileResource;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileService
{
  private $disk = 'public';

  public function find_all(GetFileRequest $request)
  {
    $filter = new FilesFilter();
    $filter_items = $filter->transform($request);

    $files = File::where($filter_items);

    $include_user = $request->query('include_user');
    $include_task = $request->query('include_task');

    if ($include_user) {
      $files = $files->with('user');
    }

    if ($include_task) {
      $files = $files->with('task');
    }

    return FileResource::collection($files->paginate()->appends($request->query()));
  }

  public function upload(StoreFileRequest $request)
  {
    try {
      if ($request->hasFile('file')) {
        DB::beginTransaction();
        $file = $request->file('file');
        $file_name = $request->task_id . '-' . $request->user_id . '-' . $file->getClientOriginalName();

        $data = [
          'user_id' => $request->user_id,
          'task_id' => $request->task_id,
          'file' => $file_name,
        ];

        $file->storeAs('', $file_name, $this->disk);
        $_file = File::create($data);

        DB::commit();
        return response()->json(['file' => $_file]);
      }

      return response()->json([
        'status' => false,
        'message' => 'File is required'
      ], 500);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json([
        'status' => false,
        'message' => $th->getMessage()
      ], 500);
    }
  }

  public function download(DownloadFileRequest $request)
  {
    $storage = Storage::disk($this->disk);
    if ($storage->exists($request->name)) {
      $path = $storage->path($request->name);
      $content = file_get_contents($path);

      return response($content)->withHeaders([
        'Content-Type' => mime_content_type($path)
      ]);
    }

    return response()->json([
      'status' => false,
      'message' => 'not found'
    ], 500);
  }

  public function delete(DeleteFileRequest $request)
  {
    $file = File::where(['id' => $request->id])->first();
    Storage::disk($this->disk)->delete($file->file);
    return $file->delete();
  }
}
