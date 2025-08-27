<?php

namespace App\Filament\Resources\VideoResource\Pages;

use App\Filament\Resources\VideoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVideo extends EditRecord
{
    protected static string $resource = VideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // If a file was uploaded, use that instead of the URL
        if (isset($data['thumbnail_file']) && $data['thumbnail_file']) {
            $data['thumbnail_url'] = null; // Clear the URL since we have a file
        } elseif (isset($data['thumbnail_url']) && $data['thumbnail_url']) {
            $data['thumbnail_file'] = null; // Clear the file since we have a URL
        } else {
            // Check if there's an existing thumbnail
            $record = $this->getRecord();
            if (!$record->thumbnail_url && !$record->thumbnail_file) {
                throw new \Exception('Please provide either a thumbnail URL or upload a thumbnail file.');
            }
        }

        return $data;
    }
}
