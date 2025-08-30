@extends('layouts.app')

@section('title', 'Art Gallery - Paintings')

@push('styles')
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Typewriter Regular', monospace;
      color: #333;
      background: #f8f8f8;
    }

    /* Layout */
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

    /* Main Layout */
    .main-layout {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 30px;
    }

    /* Filters Sidebar */
    .filters-sidebar {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      height: fit-content;
      position: sticky;
      top: 20px;
    }

    .filter-section {
      margin-bottom: 25px;
      border-bottom: 1px solid #f0f0f0;
      padding-bottom: 20px;
    }

    .filter-section:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .filter-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      padding: 10px 0;
      user-select: none;
    }

    .filter-title {
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #333;
    }

    .filter-toggle {
      font-size: 18px;
      color: #999;
      transition: transform 0.3s ease;
    }

    .filter-header.collapsed .filter-toggle {
      transform: rotate(-90deg);
    }

    .filter-content {
      margin-top: 15px;
      max-height: 300px;
      overflow-y: auto;
      transition: all 0.3s ease;
    }

    .filter-content.collapsed {
      max-height: 0;
      overflow: hidden;
      margin-top: 0;
    }

    /* Filter Options */
    .filter-option {
      display: flex;
      align-items: center;
      padding: 8px 0;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-option:hover {
      padding-left: 5px;
    }

    .filter-checkbox {
      width: 20px;
      height: 20px;
      border: 2px solid #ddd;
      border-radius: 4px;
      margin-right: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .filter-option input[type="radio"],
    .filter-option input[type="checkbox"] {
      display: none;
    }

    .filter-option input:checked~.filter-checkbox {
      background: #667eea;
      border-color: #667eea;
    }

    .filter-option input:checked~.filter-checkbox::after {
      content: '✓';
      color: white;
      font-size: 14px;
    }

    .filter-label {
      font-size: 14px;
      color: #666;
      flex: 1;
    }

    /* Sort Section */
    .sort-section {
      background: white;
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .sort-dropdown {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      background: white;
      font-size: 14px;
      color: #333;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .sort-dropdown:focus {
      outline: none;
      border-color: #667eea;
    }

    /* Products Grid */
    .products-section {
      display: flex;
      flex-direction: column;
    }

    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    /* Product Card */
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

    /* Mobile Responsive */
    @media (max-width: 768px) {
      .main-layout {
        grid-template-columns: 1fr;
      }

      .filters-sidebar {
        position: static;
        margin-bottom: 20px;
      }

      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
      }
    }
  </style>
@endpush

@section('breadcrumb')
  <div class="breadcrumb">
    <a href="{{ route('home') }}">Home</a>
    <span>›</span>
    <span>Paintings</span>
  </div>
@endsection

@section('content')
  <div class="page-container">
    <div class="main-layout">
      <!-- Filters Sidebar -->
      <aside class="filters-sidebar">
        <form action="{{ route('paintings.index') }}" id="filterForm" method="GET">
          <!-- Categories Filter -->
          <div class="filter-section">
            <div class="filter-header">
              <span class="filter-title">Categories</span>
              <span class="filter-toggle">›</span>
            </div>
            <div class="filter-content">
              @foreach ($categories as $category)
                <label class="filter-option">
                  <input {{ in_array($category->slug, (array) request('category', [])) ? 'checked' : '' }}
                    name="category[]" type="checkbox" value="{{ $category->slug }}">
                  <span class="filter-checkbox"></span>
                  <span class="filter-label">{{ $category->name }} ({{ $category->artworks_count }})</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- Medium Filter -->
          <div class="filter-section">
            <div class="filter-header">
              <span class="filter-title">Medium</span>
              <span class="filter-toggle">›</span>
            </div>
            <div class="filter-content">
              @foreach ($mediums as $medium)
                <label class="filter-option">
                  <input {{ in_array($medium, (array) request('medium', [])) ? 'checked' : '' }} name="medium[]"
                    type="checkbox" value="{{ $medium }}">
                  <span class="filter-checkbox"></span>
                  <span class="filter-label">{{ $medium }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- Style Filter -->
          <div class="filter-section">
            <div class="filter-header">
              <span class="filter-title">Style</span>
              <span class="filter-toggle">›</span>
            </div>
            <div class="filter-content">
              @foreach ($styles as $style)
                <label class="filter-option">
                  <input {{ in_array($style, (array) request('style', [])) ? 'checked' : '' }} name="style[]"
                    type="checkbox" value="{{ $style }}">
                  <span class="filter-checkbox"></span>
                  <span class="filter-label">{{ $style }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- Price Range Filter -->
          <div class="filter-section">
            <div class="filter-header">
              <span class="filter-title">Price Range</span>
              <span class="filter-toggle">›</span>
            </div>
            <div class="filter-content">
              <div style="padding: 10px 0;">
                <input name="price_min" placeholder="Min Price"
                  style="width: 100%; margin-bottom: 10px; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"
                  type="number" value="{{ request('price_min') }}">
                <input name="price_max" placeholder="Max Price"
                  style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" type="number"
                  value="{{ request('price_max') }}">
              </div>
            </div>
          </div>
        </form>
      </aside>

      <!-- Main Content -->
      <main class="products-section">
        <!-- Sort Section -->
        <div class="sort-section">
          <select class="sort-dropdown" onchange="updateSort(this.value)">
            <option {{ request('sort') == 'newest' ? 'selected' : '' }} value="newest">Newest First</option>
            <option {{ request('sort') == 'oldest' ? 'selected' : '' }} value="oldest">Oldest First</option>
            <option {{ request('sort') == 'price_low' ? 'selected' : '' }} value="price_low">Price: Low to High</option>
            <option {{ request('sort') == 'price_high' ? 'selected' : '' }} value="price_high">Price: High to Low
            </option>
          </select>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
          @forelse($artworks as $artwork)
            <a class="product-card" href="{{ route('artwork.show', $artwork->id) }}">
              <div class="product-image-container">
                <img alt="{{ $artwork->title }}" class="product-image" src="{{ $artwork->image_url }}">
                <div class="product-actions">
                  <button class="action-btn" onclick="toggleFavorite(event, {{ $artwork->id }})"
                    title="Add to Favorites" type="button">❤</button>
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
          @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
              <h3 style="color: #666; margin-bottom: 20px;">No artworks found</h3>
              <p style="color: #999;">Try adjusting your filters or browse all categories.</p>
            </div>
          @endforelse
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
      </main>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    // Filter Toggle Functionality
    document.querySelectorAll('.filter-header').forEach(header => {
      header.addEventListener('click', function() {
        this.classList.toggle('collapsed');
        const content = this.nextElementSibling;
        content.classList.toggle('collapsed');
      });
    });

    // Auto-submit form when filters change
    document.querySelectorAll('#filterForm input').forEach(input => {
      input.addEventListener('change', function() {
        document.getElementById('filterForm').submit();
      });
    });

    // Update sort and redirect
    function updateSort(value) {
      const url = new URL(window.location);
      url.searchParams.set('sort', value);
      window.location.href = url.toString();
    }

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
