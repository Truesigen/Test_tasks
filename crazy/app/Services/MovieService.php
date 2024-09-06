<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    private string $previewImage = 'default_poster.jpg';

    public function handleImage(?UploadedFile $image): string
    {
        if (! $image instanceof UploadedFile || $image->getClientOriginalName() == $this->previewImage) {
            return $this->previewImage;
        }

        $filename = uniqid().'.'.$image->extension();

        Storage::put("public/movies/preview/$filename", file_get_contents($image));

        return $filename;
    }

    public function handleUpdateMovie(int $id, array $data): bool
    {
        $movie = Movie::find($id);

        if (isset($data['preview_image'])) {
            $data['preview_image'] = $this->handleImage($data['preview_image']);

            if ($movie->getRawOriginal('preview_image') != $this->previewImage) {
                Storage::disk('public')->delete('movies/preview/'.$movie->getRawOriginal('preview_image'));
            }
        }

        $movie->update($data);

        if (isset($data['category_id'])) {
            $movie->categories()->sync($data['category_id']);
        }

        return true;
    }
}
