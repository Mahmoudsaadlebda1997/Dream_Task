<?php
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function return_msg(bool $status = false, string $msg = null, $data = null, $errors = [])
{
    return ['status' => $status, 'msg' => $msg, 'data' => $data, 'errors' => $errors];
}

function handleExceptionDD($exception)
{
    throw new Exception($exception->getMessage());
    return null;
}

function getCaseCollection($builder, array $data)
{
    if ($data['paginated'] ?? null) {
        return $builder->paginate($data['limit'] ?? 20);
    }
    return $builder->get();
}

function getFullPath($path, $file_name)
{
    if (!$file_name) {
        $path = "/$path";
    } else {
        $path = "/$path/";
    }
    return env('AWS_BUCKET_URL') . "/" . env('AWS_PROJECT') . "$path" . $file_name;
//    Storage::disk('s3')->put(env('AWS_PROJECT')."/".$path."/".$file_name, $file);
}

function uploadFile($file, $path, $resize = false)
{
    $data['name'] = uniqid() . "-" . $file->getClientOriginalName();
    $data['mime_type'] = $file->getClientMimeType();
    $data['extension'] = $file->getClientOriginalExtension();
    $data['size'] = $file->getSize();
    $data['placeholder'] = $file->getClientOriginalName();

    if ($resize) {
        $new_file = Image::make($file)->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode($file->getClientOriginalExtension(), 50);
        Storage::disk('s3')->put(env('AWS_PROJECT') . "/$path/" . $data['name'], $new_file->getEncoded());
    } else {
        Storage::disk('s3')->put(env('AWS_PROJECT') . "/$path/" . $data['name'], file_get_contents($file));
    }

//    $file->move(storage_path('files/' . $path), $data['name']);
    return $data;
}

function return_response($response)
{
    if ($response['status'] ?? null) {
        return response()->json($response, 200, []);
    }
    return response()->json($response, 400, []);
}
function getAuthUser($guard)
{
    return auth($guard)->user();
}
?>
