@extends('layouts.app')

@section('title', 'Search Results - "' . $query . '"')

@section('breadcrumb')
  <div class="page-container">
    <div class="breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span>›</span>
      <span>Search Results</span>
    </div>
  </div>
@endsection

@push('styles')
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Goorm Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      color: #333;
      background: #f8f8f8;
    }

    .page-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 20px 30px;
    }

    /* Breadcrumb */
    .breadcrumb {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin-bottom: 30px;
      font-size: 14px;
      color: #666;
      padding: 20px 0;
      max-width: 1400px;
      margin-left: auto;
      margin-right: auto;
    }

    .breadcrumb a {
      color: #667eea;
      text-decoration: none;
    }

    .breadcrumb a:hover {
      text-decoration: underline;
    }

    /* Search Header */
    .search-header {
      background: white;
      border-radius: 12px;
      padding: 30px;
      margin-bottom: 30px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .search-title {
      font-size: 28px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .search-subtitle {
      font-size: 16px;
      color: #666;
    }

    .search-query {
      color: #667eea;
      font-weight: 600;
    }

    /* Products Grid */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    .product-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      text-decoration: none;
      color: inherit;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .product-image-container {
      position: relative;
      padding-bottom: 100%;
      overflow: hidden;
      background: #f5f5f5;
    }

    .product-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
      transform: scale(1.05);
    }

    .product-actions {
      position: absolute;
      top: 15px;
      right: 15px;
      display: flex;
      gap: 10px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .product-card:hover .product-actions {
      opacity: 1;
    }

    .action-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: white;
      border: none;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 16px;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .action-btn:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .action-btn.liked {
      background: #ff4757;
      color: white;
    }

    .product-info {
      padding: 20px;
    }

    .product-price {
      font-size: 18px;
      font-weight: 700;
      color: #333;
      margin-bottom: 8px;
    }

    .product-title {
      font-size: 16px;
      font-weight: 600;
      color: #333;
      margin-bottom: 6px;
    }

    .product-artist {
      font-size: 14px;
      color: #666;
      margin-bottom: 8px;
    }

    .product-details {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: #999;
      margin-bottom: 8px;
    }

    .product-size {
      font-weight: 500;
    }

    /* Pagination */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      margin-top: 40px;
    }

    .page-btn {
      padding: 10px 15px;
      border: 1px solid #e0e0e0;
      background: white;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 14px;
    }

    .page-btn:hover:not(:disabled) {
      border-color: #667eea;
      color: #667eea;
    }

    .page-btn.active {
      background: #667eea;
      color: white;
      border-color: #667eea;
    }

    .page-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    /* No Results */
    .no-results {
      text-align: center;
      padding: 60px 20px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .no-results-icon {
      font-size: 64px;
      margin-bottom: 20px;
      opacity: 0.5;
    }

    .no-results-title {
      font-size: 24px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .no-results-text {
      font-size: 16px;
      color: #666;
      margin-bottom: 30px;
    }

    .suggestions {
      text-align: left;
      max-width: 400px;
      margin: 0 auto;
    }

    .suggestions-title {
      font-size: 14px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .suggestions-list {
      list-style: none;
      padding: 0;
    }

    .suggestions-list li {
      padding: 5px 0;
      color: #666;
      font-size: 14px;
    }

    .suggestions-list li:before {
      content: "•";
      color: #667eea;
      font-weight: bold;
      margin-right: 8px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
      }

      .search-header {
        padding: 20px;
      }

      .search-title {
        font-size: 24px;
      }
    }
  </style>
@endpush

@section('content')
  <div class="page-container">
    <!-- Search Header -->
    <div class="search-header">
      <h1 class="search-title">Search Results</h1>
      <p class="search-subtitle">
        Found <strong>{{ $totalResults }}</strong> result{{ $totalResults != 1 ? 's' : '' }} for
        <span class="search-query">"{{ $query }}"</span>
      </p>
    </div>

    @if ($artworks->count() > 0)
      <!-- Products Grid -->
      <div class="products-grid">
        @foreach ($artworks as $artwork)
          <a class="product-card" href="{{ route('artwork.show', $artwork->id) }}">
            <div class="product-image-container">
              <img alt="{{ $artwork->title }}" class="product-image" src="{{ $artwork->image_url }}">
              <div class="product-actions">
                <button class="action-btn" onclick="toggleFavorite(event, {{ $artwork->id }})" title="Add to Favorites"
                  type="button">❤</button>
                <button class="action-btn" onclick="addToCart(event, {{ $artwork->id }})" title="Add to Cart"
                  type="button">🛒</button>
                <button class="action-btn" onclick="quickView(event, {{ $artwork->id }})" title="Quick View"
                  type="button">👁</button>
              </div>
            </div>
            <div class="product-info">
              <div class="product-price">{{ $artwork->formatted_price }}</div>
              <div class="product-title">"{{ $artwork->title }}"</div>
              <div class="product-artist">{{ $artwork->artist_name }}, {{ $artwork->location }}</div>
              <div class="product-details">
                <span>{{ $artwork->medium }}</span>
                <span>•</span>
                <span class="product-size">{{ $artwork->formatted_dimensions }}</span>
              </div>
              @if ($artwork->is_ready_to_hang)
                <div style="margin-top: 8px; font-size: 12px; color: #4caf50;">Ready to hang</div>
              @endif
            </div>
          </a>
        @endforeach
      </div>

      <!-- Pagination -->
      @if ($artworks->hasPages())
        <div class="pagination">
          @if ($artworks->onFirstPage())
            <button class="page-btn" disabled>←</button>
          @else
            <a class="page-btn" href="{{ $artworks->previousPageUrl() }}">←</a>
          @endif

          @foreach ($artworks->getUrlRange(1, $artworks->lastPage()) as $page => $url)
            @if ($page == $artworks->currentPage())
              <button class="page-btn active">{{ $page }}</button>
            @else
              <a class="page-btn" href="{{ $url }}">{{ $page }}</a>
            @endif
          @endforeach

          @if ($artworks->hasMorePages())
            <a class="page-btn" href="{{ $artworks->nextPageUrl() }}">→</a>
          @else
            <button class="page-btn" disabled>→</button>
          @endif
        </div>
      @endif
    @else
      <!-- No Results -->
      <div class="no-results">
        <div class="no-results-icon">🔍</div>
        <h2 class="no-results-title">No results found</h2>
        <p class="no-results-text">We couldn't find any artworks matching "{{ $query }}"</p>

        <div class="suggestions">
          <h3 class="suggestions-title">Try these suggestions:</h3>
          <ul class="suggestions-list">
            <li>Check your spelling</li>
            <li>Try more general keywords</li>
            <li>Try different keywords</li>
            <li>Try fewer keywords</li>
          </ul>
        </div>
      </div>
    @endif
  </div>
@endsection

@push('scripts')
  <script>
    // Product interactions
    function toggleFavorite(event, artworkId) {
      event.preventDefault();
      event.stopPropagation();

      const btn = event.target;
      btn.classList.toggle('liked');

      // Here you would make an AJAX request to toggle favorite
      console.log('Toggle favorite for artwork:', artworkId);

      showNotification(btn.classList.contains('liked') ? 'Added to favorites!' : 'Removed from favorites!');
    }

    function addToCart(event, artworkId) {
      event.preventDefault();
      event.stopPropagation();

      // Here you would make an AJAX request to add to cart
      console.log('Add to cart:', artworkId);

      showNotification('Added to cart!');
    }

    function quickView(event, artworkId) {
      event.preventDefault();
      event.stopPropagation();

      // Here you would show a quick view modal
      console.log('Quick view:', artworkId);

      // For now, redirect to the detail page
      window.location.href = `/artwork/${artworkId}`;
    }

    // Show notification
    function showNotification(message) {
      const notification = document.createElement('div');
      notification.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #667eea;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        animation: slideIn 0.3s ease;
      `;
      notification.textContent = message;
      document.body.appendChild(notification);

      setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
      }, 3000);
    }

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
      @keyframes slideIn {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }

      @keyframes slideOut {
        from {
          transform: translateX(0);
          opacity: 1;
        }
        to {
          transform: translateX(100%);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);
  </script>
@endpush
