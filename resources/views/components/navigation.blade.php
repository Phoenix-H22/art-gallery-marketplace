<nav class="main-nav">
  <div class="nav-container">
    <ul class="nav-list">
      @php
        $categories = App\Models\Category::withCount('artworks')->get();
      @endphp

      @forelse($categories as $category)
        <li class="nav-item">
          <a class="nav-link" href="{{ route('paintings.index', ['category' => $category->slug]) }}">
            {{ $category->name }}
            @if ($category->artworks_count > 0)
              <span class="nav-count">({{ $category->artworks_count }})</span>
            @endif
          </a>
        </li>
      @empty
        <li class="nav-item">
          <a class="nav-link" href="{{ route('paintings.index') }}">Paintings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('paintings.index') }}">Photography</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('paintings.index') }}">Sculpture</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('paintings.index') }}">Drawings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('paintings.index') }}">Prints</a>
        </li>
      @endforelse
    </ul>
  </div>
</nav>

<style>
  .nav-link {
    text-decoration: none;
    color: inherit;
    display: block;
    padding: 10px 15px;
    transition: all 0.3s ease;
  }

  .nav-link:hover {
    color: #667eea;
    background-color: rgba(102, 126, 234, 0.1);
    border-radius: 4px;
  }

  .nav-count {
    font-size: 0.8em;
    color: #666;
    margin-left: 4px;
  }
</style>
