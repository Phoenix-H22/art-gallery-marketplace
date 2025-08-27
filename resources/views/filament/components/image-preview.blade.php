@php
  $imageUrl = $getState();
  if (!$imageUrl) {
      // Try to get the display URL from the record
      $imageUrl = $getRecord()?->display_image_url ?? ($getRecord()?->display_thumbnail_url ?? null);
  }
@endphp

@if ($imageUrl)
  <div class="space-y-2">
    <div class="flex items-center space-x-4">
      <img alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-200 shadow-sm"
        onerror="this.style.display='none'" src="{{ $imageUrl }}">
      <div class="text-sm text-gray-600">
        <p><strong>Current Image:</strong></p>
        <p class="break-all text-xs">{{ Str::limit($imageUrl, 50) }}</p>
      </div>
    </div>
    <div class="text-xs text-gray-500">
      <p>Image will be updated when you save the form.</p>
    </div>
  </div>
@else
  <div class="text-sm text-gray-500 bg-gray-50 p-3 rounded-lg">
    <p>No image currently set. Enter an image URL above to add one.</p>
  </div>
@endif
