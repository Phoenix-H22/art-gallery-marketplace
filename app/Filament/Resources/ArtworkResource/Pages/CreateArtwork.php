<?php

namespace App\Filament\Resources\ArtworkResource\Pages;

use App\Filament\Resources\ArtworkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;

class CreateArtwork extends CreateRecord
{
    protected static string $resource = ArtworkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If a file was uploaded, use that instead of the URL
        if (isset($data['image_file']) && $data['image_file']) {
            $data['image_url'] = null; // Clear the URL since we have a file
        } elseif (isset($data['image_url']) && $data['image_url']) {
            $data['image_file'] = null; // Clear the file since we have a URL
        } else {
            // Neither URL nor file provided
            throw new \Exception('Please provide either an image URL or upload an image file.');
        }
        $data['artist_name'] = User::find($data['user_id'])->name;

        return $data;
    }
}
