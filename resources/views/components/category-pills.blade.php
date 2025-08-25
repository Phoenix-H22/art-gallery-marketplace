<section class="category-section">
  <div class="category-pills">
    @forelse($categories as $category)
      <a class="category-pill" href="{{ route('paintings.index', ['category' => $category->slug]) }}">
        {{ $category->name }}
        <span class="category-count">({{ $category->artworks_count }})</span>
      </a>
    @empty
      <a class="category-pill" href="{{ route('paintings.index') }}">Paintings</a>
      <a class="category-pill" href="{{ route('paintings.index') }}">Abstract Art</a>
      <a class="category-pill" href="{{ route('paintings.index') }}">Oil Paintings</a>
      <a class="category-pill" href="{{ route('paintings.index') }}">Landscapes</a>
      <a class="category-pill" href="{{ route('paintings.index') }}">Large Works</a>
      <a class="category-pill" href="{{ route('paintings.index') }}">Acrylic Paintings</a>
      <a class="category-pill" href="{{ route('paintings.index') }}">Curated Collections</a>
      <a class="category-pill" href="{{ route('paintings.index') }}">Modern Art</a>
      <a class="category-pill" href="{{ route('paintings.index') }}">Sculpture</a>
    @endforelse
  </div>
</section>
