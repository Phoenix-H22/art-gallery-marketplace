<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVideo extends CreateRecord
{
    protected static string $resource = VideoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If a file was uploaded, use that instead of the URL
        if (isset($data['thumbnail_file']) && $data['thumbnail_file']) {
            $data['thumbnail_url'] = null; // Clear the URL since we have a file
        } elseif (isset($data['thumbnail_url']) && $data['thumbnail_url']) {
            $data['thumbnail_file'] = null; // Clear the file since we have a URL
        } else {
            // Neither URL nor file provided
            throw new \Exception('Please provide either a thumbnail URL or upload a thumbnail file.');
        }

        return $data;
    }
}
