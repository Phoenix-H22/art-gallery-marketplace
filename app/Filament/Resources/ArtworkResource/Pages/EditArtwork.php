<?php

namespace App\Filament\Resources\ArtworkResource\Pages;

use App\Filament\Resources\ArtworkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArtwork extends EditRecord
{
    protected static string $resource = ArtworkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If a file was uploaded, use that instead of the URL
        if (isset($data['image_file']) && $data['image_file']) {
            $data['image_url'] = null; // Clear the URL since we have a file
        } elseif (isset($data['image_url']) && $data['image_url']) {
            $data['image_file'] = null; // Clear the file since we have a URL
        } else {
            // Check if there's an existing image
            $record = $this->getRecord();
            if (!$record->image_url && !$record->image_file) {
                throw new \Exception('Please provide either an image URL or upload an image file.');
            }
        }

        return $data;
    }
}
