@extends('layouts.app')

@section('title', $artwork->title . ' - ' . $artwork->artist_name . ' | Art Gallery')

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

    /* Breadcrumb */
    .breadcrumb {
      max-width: 1400px;
      margin: 0 auto;
      padding: 20px 30px;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: #666;
    }

    .breadcrumb a {
      color: #666;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
      color: #667eea;
      text-decoration: underline;
    }

    /* Product Detail Container */
    .product-detail-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 30px 60px;
      display: grid;
      grid-template-columns: 1fr 450px;
      gap: 60px;
    }

    /* Gallery Section */
    .gallery-section {
      position: sticky;
      top: 100px;
      height: fit-content;
    }

    .main-image-container {
      position: relative;
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .main-image {
      width: 100%;
      height: auto;
      display: block;
    }

    .zoom-indicator {
      position: absolute;
      top: 15px;
      right: 15px;
      background: white;
      padding: 8px 12px;
      border-radius: 20px;
      font-size: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      cursor: pointer;
    }

    .thumbnail-container {
      display: flex;
      gap: 10px;
    }

    .thumbnail {
      width: 80px;
      height: 80px;
      border: 2px solid transparent;
      border-radius: 8px;
      overflow: hidden;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .thumbnail.active {
      border-color: #667eea;
    }

    .thumbnail:hover {
      transform: scale(1.05);
    }

    .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Product Info Section */
    .product-info-section {
      padding-top: 0;
    }

    /* Tabs */
    .product-tabs {
      display: flex;
      gap: 0;
      border-bottom: 2px solid #e0e0e0;
      margin-bottom: 30px;
    }

    .tab-button {
      padding: 15px 30px;
      background: none;
      border: none;
      font-size: 14px;
      font-weight: 600;
      color: #666;
      cursor: pointer;
      position: relative;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .tab-button:hover {
      color: #333;
    }

    .tab-button.active {
      color: #333;
    }

    .tab-button.active::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      right: 0;
      height: 2px;
      background: #667eea;
    }

    /* Tab Content */
    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* Product Header */
    .product-header {
      margin-bottom: 30px;
    }

    .product-title {
      font-size: 32px;
      font-weight: 300;
      color: #333;
      margin-bottom: 10px;
    }

    .product-artist {
      font-size: 16px;
      color: #666;
      margin-bottom: 5px;
    }

    .product-artist a {
      color: #667eea;
      text-decoration: none;
    }

    .product-artist a:hover {
      text-decoration: underline;
    }

    .product-location {
      font-size: 14px;
      color: #999;
      margin-bottom: 20px;
    }

    /* Product Details */
    .product-details-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
      padding: 20px;
      background: #f5f5f5;
      border-radius: 8px;
      margin-bottom: 25px;
    }

    .detail-item {
      font-size: 14px;
    }

    .detail-label {
      color: #666;
      margin-bottom: 5px;
    }

    .detail-value {
      color: #333;
      font-weight: 500;
    }

    /* Price Section */
    .price-section {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      margin-bottom: 25px;
    }

    .price-amount {
      font-size: 36px;
      font-weight: 600;
      color: #333;
      margin-bottom: 5px;
    }

    .price-note {
      font-size: 13px;
      color: #666;
      margin-bottom: 20px;
    }

    .action-buttons {
      display: flex;
      gap: 15px;
      margin-bottom: 15px;
    }

    .btn-primary {
      flex: 1;
      padding: 15px 30px;
      background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(255, 87, 34, 0.3);
    }

    .btn-secondary {
      padding: 15px 30px;
      background: white;
      color: #333;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-secondary:hover {
      border-color: #667eea;
      color: #667eea;
    }

    .make-offer-link {
      text-align: center;
      margin-top: 10px;
    }

    .make-offer-link a {
      color: #667eea;
      font-size: 14px;
      text-decoration: none;
      font-weight: 500;
    }

    .make-offer-link a:hover {
      text-decoration: underline;
    }

    /* Shipping Info */
    .shipping-info {
      padding: 20px;
      background: #f8f9fa;
      border-radius: 8px;
      margin-bottom: 25px;
    }

    .shipping-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 0;
      font-size: 14px;
      color: #333;
    }

    .shipping-icon {
      color: #4caf50;
      font-size: 18px;
    }

    /* Purchase Protection */
    .purchase-protection {
      text-align: center;
      padding: 20px;
      background: white;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      margin-bottom: 25px;
    }

    .protection-badge {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .protection-title {
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .protection-desc {
      font-size: 12px;
      color: #666;
    }

    /* Artist Recognition */
    .artist-recognition {
      padding: 20px;
      background: white;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      margin-bottom: 25px;
    }

    .recognition-title {
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .recognition-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 0;
      font-size: 13px;
      color: #666;
    }

    /* Artist Section */
    .artist-section {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      margin-bottom: 40px;
    }

    /* Video Section */
    .video-section {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      margin-bottom: 40px;
    }

    .video-container {
      max-width: 600px;
    }

    .video-placeholder {
      display: flex;
      gap: 20px;
      align-items: center;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .video-placeholder:hover {
      transform: translateY(-2px);
    }

    .video-thumbnail {
      position: relative;
      width: 200px;
      height: 120px;
      border-radius: 8px;
      overflow: hidden;
      flex-shrink: 0;
    }

    .play-button {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 50px;
      height: 50px;
      background: rgba(0, 0, 0, 0.7);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 20px;
      transition: background 0.3s ease;
    }

    .video-placeholder:hover .play-button {
      background: rgba(0, 0, 0, 0.9);
    }

    .video-info {
      flex: 1;
    }

    .video-duration {
      display: inline-block;
      background: #f0f0f0;
      color: #666;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 500;
    }

    /* Videos Grid */
    .videos-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 30px;
    }

    .video-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .video-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .video-card .video-thumbnail {
      position: relative;
      width: 100%;
      height: 200px;
      border-radius: 12px 12px 0 0;
      overflow: hidden;
    }

    .video-card .play-button {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 60px;
      height: 60px;
      background: rgba(0, 0, 0, 0.7);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 24px;
      transition: all 0.3s ease;
      z-index: 2;
    }

    .video-card:hover .play-button {
      background: rgba(255, 87, 34, 0.9);
      transform: translate(-50%, -50%) scale(1.1);
    }

    .video-card .video-info {
      padding: 20px;
    }

    .video-card .video-info h3 {
      margin-bottom: 10px;
      color: #333;
    }

    .video-card .video-info p {
      color: #666;
      line-height: 1.5;
      margin-bottom: 15px;
    }

    .video-card .video-duration {
      background: #ff5722;
      color: white;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }
    }

    .video-card:hover .play-button {
      background: rgba(0, 0, 0, 0.9);
    }

    .video-card .video-info {
      padding: 20px;
    }

    .video-title {
      font-size: 16px;
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
    }

    .video-description {
      font-size: 14px;
      color: #666;
      line-height: 1.6;
      margin-bottom: 12px;
    }

    .video-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
      color: #999;
    }

    .video-date {
      color: #999;
    }

    .artist-header {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .artist-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      overflow: hidden;
    }

    .artist-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .artist-info {
      flex: 1;
    }

    .artist-name {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .artist-location {
      color: #666;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .view-profile-btn {
      padding: 8px 20px;
      background: white;
      border: 1px solid #e0e0e0;
      border-radius: 20px;
      color: #333;
      font-size: 13px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .view-profile-btn:hover {
      border-color: #667eea;
      color: #667eea;
    }

    .artist-bio {
      font-size: 14px;
      line-height: 1.8;
      color: #555;
      margin-bottom: 20px;
    }

    .artist-stats {
      display: flex;
      gap: 30px;
      padding-top: 20px;
      border-top: 1px solid #f0f0f0;
    }

    .stat-item {
      font-size: 13px;
    }

    .stat-icon {
      color: #667eea;
      margin-right: 5px;
    }

    /* Related Artworks Section */
    .related-section {
      margin-top: 60px;
    }

    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .section-title {
      font-size: 24px;
      font-weight: 600;
      color: #333;
    }

    .view-all-link {
      color: #667eea;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
    }

    .view-all-link:hover {
      text-decoration: underline;
    }

    .artworks-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .artwork-card {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .artwork-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .artwork-image {
      width: 100%;
      aspect-ratio: 1;
      object-fit: cover;
    }

    .artwork-info {
      padding: 15px;
    }

    .artwork-price {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 5px;
    }

    .artwork-title {
      font-size: 14px;
      color: #666;
      margin-bottom: 3px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .artwork-size {
      font-size: 12px;
      color: #999;
    }

    .artwork-actions {
      display: flex;
      gap: 8px;
      padding: 0 15px 15px;
    }

    .action-icon {
      width: 30px;
      height: 30px;
      border: 1px solid #e0e0e0;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .action-icon:hover {
      border-color: #667eea;
      background: #f8f9ff;
    }

    /* Footer Section */
    .footer-section {
      margin-top: 80px;
      padding-top: 40px;
      border-top: 1px solid #e0e0e0;
    }

    .why-saatchi {
      max-width: 1400px;
      margin: 0 auto;
      padding: 40px 30px;
      text-align: center;
    }

    .why-saatchi h2 {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 40px;
    }

    .why-features {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 40px;
      margin-bottom: 40px;
    }

    .why-feature {
      text-align: center;
    }

    .feature-icon {
      font-size: 36px;
      margin-bottom: 15px;
    }

    .feature-title {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .feature-desc {
      font-size: 14px;
      color: #666;
      line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .product-detail-container {
        grid-template-columns: 1fr;
        gap: 40px;
      }

      .gallery-section {
        position: relative;
        top: 0;
      }

      .artworks-grid {
        grid-template-columns: repeat(3, 1fr);
      }

      .why-features {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .product-title {
        font-size: 24px;
      }

      .price-amount {
        font-size: 28px;
      }

      .artworks-grid {
        grid-template-columns: repeat(2, 1fr);
      }

      .action-buttons {
        flex-direction: column;
      }

      .product-details-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 480px) {
      .artworks-grid {
        grid-template-columns: 1fr;
      }

      .thumbnail-container {
        justify-content: center;
      }

      .why-features {
        grid-template-columns: 1fr;
      }
    }
  </style>
@endpush

@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb">
    <a href="{{ route('home') }}">All Artworks</a>
    <span>/</span>
    <a href="{{ route('paintings.index') }}">Paintings</a>
    <span>/</span>
    <span>{{ $artwork->artist_name }} {{ ucfirst($artwork->medium) }}</span>
  </div>

  <!-- Product Detail -->
  <div class="product-detail-container">
    <!-- Gallery Section -->
    <div class="gallery-section">
      <div class="main-image-container">
        <img alt="{{ $artwork->title }}" class="main-image" id="mainImage" src="{{ $artwork->image_url }}">
        <div class="zoom-indicator">🔍 Click to zoom</div>
      </div>
      <div class="thumbnail-container">
        <div class="thumbnail active" onclick="changeImage(0)">
          <img alt="Thumbnail 1" src="{{ $artwork->image_url }}">
        </div>
        <!-- Additional thumbnails can be added here -->
      </div>
    </div>

    <!-- Product Info Section -->
    <div class="product-info-section">
      <!-- Product Tabs -->
      <div class="product-tabs">
        <button class="tab-button active" onclick="switchTab('original')">ORIGINAL</button>
        <button class="tab-button" onclick="switchTab('prints')">PRINTS</button>
      </div>

      <!-- Original Tab Content -->
      <div class="tab-content active" id="original-tab">
        <div class="product-header">
          <h1 class="product-title">"{{ $artwork->title }}"</h1>
          <div class="product-artist">
            <a
              href="{{ $artwork->user ? route('artist.profile', $artwork->user->id) : '#' }}">{{ $artwork->artist_name }}</a>
          </div>
          <div class="product-location">{{ $artwork->location }}</div>
        </div>

        <div class="product-details-grid">
          <div class="detail-item">
            <div class="detail-label">Painting</div>
            <div class="detail-value">{{ $artwork->medium }}</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Size</div>
            <div class="detail-value">{{ $artwork->formatted_dimensions }}</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Ships in a Box</div>
            <div class="detail-value">Yes</div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Ready to Hang</div>
            <div class="detail-value">{{ $artwork->is_ready_to_hang ? 'Yes' : 'Not Applicable' }}</div>
          </div>
        </div>

        <div class="price-section">
          <div class="price-amount">{{ $artwork->formatted_price }}</div>
          <div class="price-note">Plus fees, tax, duties, and shipping</div>

          <div class="action-buttons">
            <button class="btn-primary" onclick="addToCart(event, {{ $artwork->id }})">Add to Cart</button>
          </div>

          <div class="make-offer-link">
            <a href="#">💬 Make an Offer</a>
          </div>
        </div>

        <div class="shipping-info">
          <div class="shipping-item">
            <span class="shipping-icon">✓</span>
            <span>Shipping Included</span>
          </div>
          <div class="shipping-item">
            <span class="shipping-icon">✓</span>
            <span>14-Day Money Back Guarantee</span>
          </div>
          <div class="shipping-item">
            <span class="shipping-icon">✓</span>
            <span>Trustpilot Customer Reviews ⭐⭐⭐⭐⭐</span>
          </div>
        </div>

        <div class="artist-recognition">
          <div class="recognition-title">Artist Recognition</div>
          <div class="recognition-item">
            <span>✓</span>
            <span>Featured in Dun in Watch</span>
          </div>
          <div class="recognition-item">
            <span>✓</span>
            <span>Featured in Rising Stars</span>
          </div>
          <div class="recognition-item">
            <span>✓</span>
            <span>Featured in UK Galleries</span>
          </div>
          <div class="recognition-item">
            <span>✓</span>
            <span>Showed at the The Other Art Fair</span>
          </div>
          <div class="recognition-item">
            <span>✓</span>
            <span>Artist featured in a collection</span>
          </div>
        </div>

        <div class="purchase-protection">
          <div class="protection-badge">🛡️</div>
          <div class="protection-title">See More Like This</div>
          <div class="protection-desc">Browse similar artworks in our collection</div>
        </div>
      </div>

      <!-- Prints Tab Content -->
      <div class="tab-content" id="prints-tab">
        <div class="product-header">
          <h1 class="product-title">"{{ $artwork->title }}" Print</h1>
          <div class="product-artist">
            <a href="#">{{ $artwork->artist_name }}</a>
          </div>
          <div class="product-location">Open Edition Prints Available 🖼️</div>
        </div>

        <div class="product-details-grid">
          <div class="detail-item">
            <div class="detail-label">Select a Size</div>
            <div class="detail-value">
              <select style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                <option>8 x 10 in ($45)</option>
                <option>11 x 14 in ($65)</option>
                <option>16 x 20 in ($95)</option>
                <option>20 x 24 in ($125)</option>
                <option>24 x 36 in ($185)</option>
              </select>
            </div>
          </div>
          <div class="detail-item">
            <div class="detail-label">Select a Canvas Wrap</div>
            <div class="detail-value">
              <select style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; width: 100%;">
                <option>Black Frame</option>
                <option>White Frame</option>
                <option>Natural Wood Frame</option>
                <option>No Frame</option>
              </select>
            </div>
          </div>
        </div>

        <div class="price-section">
          <div class="price-amount">$195</div>
          <div class="price-note">Free shipping on orders above $100</div>

          <div class="action-buttons">
            <button class="btn-primary">Add to Cart</button>
          </div>
        </div>

        <div class="shipping-info">
          <div class="shipping-item">
            <span class="shipping-icon">✓</span>
            <span>Printed on Museum-Quality Paper</span>
          </div>
          <div class="shipping-item">
            <span class="shipping-icon">✓</span>
            <span>Satisfaction Guaranteed</span>
          </div>
          <div class="shipping-item">
            <span class="shipping-icon">✓</span>
            <span>Ready to Frame</span>
          </div>
        </div>
      </div>


    </div>
  </div>

  <!-- About the Artwork Section -->
  <div style="max-width: 1400px; margin: 0 auto; padding: 0 30px;">
    <div class="artist-section">
      <div class="section-header">
        <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 20px;">ABOUT THE ARTWORK</h2>
      </div>
      <div style="font-size: 14px; line-height: 1.8; color: #555; margin-bottom: 30px;">
        @if ($artwork->description)
          <p>{{ $artwork->description }}</p>
        @else
          <p>Original {{ strtolower($artwork->medium) }} on canvas. Artwork is signed.</p>
        @endif
        <p style="margin-top: 15px;">
          <strong>Year Created:</strong> {{ $artwork->year_created ?? 'Not specified' }}<br>
          <strong>Subject:</strong> {{ $artwork->style ?? 'Abstract' }}<br>
          <strong>Styles:</strong>
          {{ $artwork->style ?? 'Abstract, Expressionism, Figurative, Impressionism, Modern' }}<br>
          <strong>Mediums:</strong> {{ $artwork->medium }}
        </p>
      </div>
      <div style="text-align: center; padding-top: 20px; border-top: 1px solid #f0f0f0;">
        <p style="font-size: 13px; color: #666; margin-bottom: 10px;">Need more information? <a href="#"
            style="color: #667eea; text-decoration: none;">Contact Us</a></p>
      </div>
    </div>

    <!-- Video Section -->
    <div class="video-section">
      <div class="section-header">
        <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 20px;">VIDEO</h2>
      </div>
      <div class="video-container">
        @if ($videos->count() > 0)
          @if ($videos->count() == 1)
            @foreach ($videos as $video)
              <div class="video-card" onclick="playVideo('{{ $video->video_url }}', '{{ $video->title }}')">
                <div class="video-thumbnail">
                  <img alt="{{ $video->title }}" src="{{ $video->display_thumbnail_url }}"
                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                  <div class="play-button">
                    <span>▶</span>
                  </div>
                </div>
                <div class="video-info">
                  <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">{{ $video->title }}</h3>
                  <p style="font-size: 14px; color: #666; margin-bottom: 12px;">
                    {{ $video->description ?: 'Watch ' . $artwork->artist_name . ' in action' }}</p>
                  <div class="video-duration">{{ $video->formatted_duration }}</div>
                </div>
              </div>
            @endforeach
          @else
            <div class="videos-grid">
              @foreach ($videos as $video)
                <div class="video-card" onclick="playVideo('{{ $video->video_url }}', '{{ $video->title }}')">
                  <div class="video-thumbnail">
                    <img alt="{{ $video->title }}" src="{{ $video->display_thumbnail_url }}"
                      style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                    <div class="play-button">
                      <span>▶</span>
                    </div>
                  </div>
                  <div class="video-info">
                    <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">{{ $video->title }}</h3>
                    <p style="font-size: 14px; color: #666; margin-bottom: 12px;">
                      {{ $video->description ?: 'Watch ' . $artwork->artist_name . ' in action' }}</p>
                    <div class="video-duration">{{ $video->formatted_duration }}</div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        @else
          <div class="video-placeholder">
            <div class="video-thumbnail">
              <img alt="{{ $artwork->title }}" src="{{ $artwork->image_url }}"
                style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
              <div class="play-button">
                <span>▶</span>
              </div>
            </div>
            <div class="video-info">
              <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">Artist Studio Tour</h3>
              <p style="font-size: 14px; color: #666; margin-bottom: 12px;">Take a behind-the-scenes look at
                {{ $artwork->artist_name }}'s creative process and studio space.</p>
              <div class="video-duration">2:45</div>
            </div>
          </div>
        @endif
      </div>
    </div>

    <!-- Artist Profile Section -->
    <div class="artist-section">
      <div class="artist-header">
        <div class="artist-avatar">
          <img alt="{{ $artwork->artist_name }}"
            src="{{ $artwork->user ? $artwork->user->avatar_url : 'https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?w=150&h=150&fit=crop' }}">
        </div>
        <div class="artist-info">
          <h3 class="artist-name">{{ $artwork->artist_name }}</h3>
          <div class="artist-location">{{ $artwork->location }}</div>
          @if ($artwork->user)
            <a class="view-profile-btn" href="{{ route('artist.profile', $artwork->user->id) }}">View Profile</a>
          @else
            <button class="view-profile-btn">View Profile</button>
          @endif
        </div>
      </div>
      <div class="artist-bio">
        {{ $artwork->artist_name }} is a talented artist based in {{ $artwork->location }}. This piece showcases their
        unique style and artistic vision. The combination of figurative and abstract worlds shows delicate and feminine
        form of womanhood.
      </div>
      <div class="artist-stats">
        <div class="stat-item">
          <span class="stat-icon">🎨</span>
          <span>Featured in Art Gallery's curated series, <a href="#" style="color: #667eea;">Rise To
              Watch</a></span>
        </div>
        <div class="stat-item">
          <span class="stat-icon">🏆</span>
          <span>Handpicked for Art Gallery's Chief Curator for our most prestigious feature, <a href="#"
              style="color: #667eea;">Rising Stars</a></span>
        </div>
      </div>
      <div class="artist-stats" style="border-top: 1px solid #f0f0f0; margin-top: 20px;">
        <div class="stat-item">
          <span class="stat-icon">✓</span>
          <span>Featured in Art Gallery's printed catalog, sent to thousands of art collectors</span>
        </div>
        <div class="stat-item">
          <span class="stat-icon">✓</span>
          <span>Handpicked to show at The Other Art Fair presented by Art Gallery</span>
        </div>
        <div class="stat-item">
          <span class="stat-icon">✓</span>
          <span>Artist featured in Art Gallery in a collection</span>
        </div>
      </div>
    </div>

    <!-- More From Artist Section -->
    @if ($relatedArtworks->count() > 0)
      <div class="related-section">
        <div class="section-header">
          <h2 class="section-title">More From {{ $artwork->artist_name }}</h2>
          <a class="view-all-link" href="{{ route('artist.profile', $artwork->user->id) }}">View All →</a>
        </div>
        <div class="artworks-grid">
          @foreach ($relatedArtworks->take(4) as $related)
            <a class="artwork-card" href="{{ route('artwork.show', $related->id) }}">
              <img alt="{{ $related->title }}" class="artwork-image" src="{{ $related->image_url }}">
              <div class="artwork-info">
                <div class="artwork-price">{{ $related->formatted_price }}</div>
                <div class="artwork-title">"{{ $related->title }}"</div>
                <div class="artwork-size">{{ $related->formatted_dimensions }}</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon" onclick="toggleFavorite(event, {{ $related->id }})">❤️</button>
                <button class="action-icon" onclick="quickView(event, {{ $related->id }})">👁️</button>
                <button class="action-icon" onclick="addToCart(event, {{ $related->id }})">🛒</button>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>
  </div>

  <!-- Additional Sections Container -->
  <div style="max-width: 1400px; margin: 0 auto; padding: 0 30px;">
    <!-- Visually Similar Section -->
    @if ($similarArtworks->count() > 0)
      <div class="related-section">
        <div class="section-header">
          <h2 class="section-title">Visually Similar Artworks</h2>
          <a class="view-all-link" href="{{ route('paintings.index', ['medium' => $artwork->medium]) }}">View All →</a>
        </div>
        <div class="artworks-grid">
          @foreach ($similarArtworks as $similar)
            <a class="artwork-card" href="{{ route('artwork.show', $similar->id) }}">
              <img alt="{{ $similar->title }}" class="artwork-image" src="{{ $similar->image_url }}">
              <div class="artwork-info">
                <div class="artwork-price">{{ $similar->formatted_price }}</div>
                <div class="artwork-title">"{{ $similar->title }}"</div>
                <div class="artwork-size">{{ $similar->artist_name }} • {{ $similar->formatted_dimensions }}</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon" onclick="toggleFavorite(event, {{ $similar->id }})">❤️</button>
                <button class="action-icon" onclick="quickView(event, {{ $similar->id }})">👁️</button>
                <button class="action-icon" onclick="addToCart(event, {{ $similar->id }})">🛒</button>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    @endif

    <!-- You May Also Like Section -->
    @if ($recommendedArtworks->count() > 0)
      <div class="related-section">
        <div class="section-header">
          <h2 class="section-title">Paintings You May Also Like</h2>
          <a class="view-all-link" href="{{ route('paintings.index') }}">View All →</a>
        </div>
        <div class="artworks-grid">
          @foreach ($recommendedArtworks as $recommended)
            <a class="artwork-card" href="{{ route('artwork.show', $recommended->id) }}">
              <img alt="{{ $recommended->title }}" class="artwork-image" src="{{ $recommended->image_url }}">
              <div class="artwork-info">
                <div class="artwork-price">{{ $recommended->formatted_price }}</div>
                <div class="artwork-title">"{{ $recommended->title }}"</div>
                <div class="artwork-size">{{ $recommended->artist_name }} • {{ $recommended->formatted_dimensions }}
                </div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon" onclick="toggleFavorite(event, {{ $recommended->id }})">❤️</button>
                <button class="action-icon" onclick="quickView(event, {{ $recommended->id }})">👁️</button>
                <button class="action-icon" onclick="addToCart(event, {{ $recommended->id }})">🛒</button>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>

  <!-- Why Saatchi Art Section -->
  <div class="footer-section">
    <div class="why-saatchi">
      <h2>Why Saatchi Art?</h2>
      <div class="why-features">
        <div class="why-feature">
          <div class="feature-icon">👥</div>
          <div class="feature-title">Thousands of 5-Star Reviews</div>
          <div class="feature-desc">We deliver world-class customer service to all of our art buyers.</div>
        </div>
        <div class="why-feature">
          <div class="feature-icon">🌍</div>
          <div class="feature-title">Global Selection of Original Art</div>
          <div class="feature-desc">Explore an unparalleled artwork selection by artists from around the world.</div>
        </div>
        <div class="why-feature">
          <div class="feature-icon">🛡️</div>
          <div class="feature-title">Satisfaction Guaranteed</div>
          <div class="feature-desc">We've successfully delivered over 1 million orders across 100+ countries.</div>
        </div>
        <div class="why-feature">
          <div class="feature-icon">📱</div>
          <div class="feature-title">Support Emerging Artists</div>
          <div class="feature-desc">We pay out all our artists fairly and on time since 2011 across 100+ countries.</div>
        </div>
      </div>
    </div>

    <!-- Complimentary Art Advisory -->
    <div style="text-align: center; padding: 40px; background: #f8f9fa; margin: 40px 0;">
      <img alt="Art Advisor" src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=100&h=100&fit=crop"
        style="width: 100px; height: 100px; border-radius: 50%; margin-bottom: 20px;">
      <h3 style="font-size: 24px; margin-bottom: 10px;">Complimentary Art Advisory</h3>
      <p style="max-width: 600px; margin: 0 auto 20px; color: #666; line-height: 1.6;">
        Get free art advisory advice when you shop at Saatchi Art. Our knowledgeable curators are will guide you through a
        seamless, stress-free shopping experience.
      </p>
      <button
        style="padding: 12px 30px; background: #667eea; color: white; border: none; border-radius: 25px; cursor: pointer; font-size: 14px;">Contact
        Art Advisory</button>
      <p style="margin-top: 15px; font-size: 13px; color: #999;">All inquiries receive a response.</p>
    </div>
  </div>

  @push('scripts')
    <script>
      // Image Gallery Functions
      const images = [
        '{{ $artwork->image_url }}',
        // Additional images can be added here
      ];

      function changeImage(index) {
        const mainImage = document.getElementById('mainImage');
        mainImage.src = images[index];

        // Update thumbnail active state
        document.querySelectorAll('.thumbnail').forEach(thumb => {
          thumb.classList.remove('active');
        });
        document.querySelectorAll('.thumbnail')[index].classList.add('active');
      }

      // Add to Cart Function
      function addToCart(event, artworkId) {
        if (event) {
          event.preventDefault();
          event.stopPropagation();
        }
        console.log('Add to cart:', artworkId);
        showNotification('Added to cart successfully!');
      }

      // Toggle Favorite Function
      function toggleFavorite(event, artworkId) {
        event.preventDefault();
        event.stopPropagation();

        const btn = event.target;
        btn.textContent = btn.textContent === '❤️' ? '🤍' : '❤️';

        // Here you would make an AJAX request to toggle favorite
        console.log('Toggle favorite for artwork:', artworkId);

        showNotification(btn.textContent === '❤️' ? 'Added to favorites!' : 'Removed from favorites!');
      }

      // Quick View Function
      function quickView(event, artworkId) {
        event.preventDefault();
        event.stopPropagation();

        // Here you would show a quick view modal
        console.log('Quick view:', artworkId);

        // For now, redirect to the detail page
        window.location.href = `/artwork/${artworkId}`;
      }

      // Favorite Button Toggle
      const actionIcons = document.querySelectorAll('.action-icon');
      if (actionIcons.length > 0) {
        actionIcons.forEach(icon => {
          icon.addEventListener('click', function() {
            if (this.textContent.includes('❤')) {
              this.textContent = this.textContent === '❤️' ? '🤍' : '❤️';
            }
          });
        });
      }

      // Zoom Functionality
      const zoomIndicator = document.querySelector('.zoom-indicator');
      if (zoomIndicator) {
        zoomIndicator.addEventListener('click', function() {
          const mainImage = document.querySelector('.main-image');
          // Here you would implement a modal or lightbox for zooming
          console.log('Zoom functionality would open here');
        });
      }

      // Tab Switching Functionality
      function switchTab(tabName) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
          content.classList.remove('active');
        });

        // Remove active class from all tab buttons
        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
          button.classList.remove('active');
        });

        // Show the selected tab content
        const selectedTab = document.getElementById(tabName + '-tab');
        if (selectedTab) {
          selectedTab.classList.add('active');
        }

        // Add active class to the clicked button
        const clickedButton = document.querySelector(`[onclick="switchTab('${tabName}')"]`);
        if (clickedButton) {
          clickedButton.classList.add('active');
        }
      }

      // Video Functionality
      function playVideo(videoUrl, videoTitle) {
        // Create a modal for video playback
        const modal = document.createElement('div');
        modal.style.cssText = `
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.9);
          z-index: 10000;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 20px;
        `;

        // Create video container
        const videoContainer = document.createElement('div');
        videoContainer.style.cssText = `
          position: relative;
          width: 100%;
          max-width: 800px;
          background: #000;
          border-radius: 8px;
          overflow: hidden;
        `;

        // Create close button
        const closeButton = document.createElement('button');
        closeButton.innerHTML = '×';
        closeButton.style.cssText = `
          position: absolute;
          top: 10px;
          right: 10px;
          background: rgba(0, 0, 0, 0.7);
          color: white;
          border: none;
          border-radius: 50%;
          width: 40px;
          height: 40px;
          font-size: 24px;
          cursor: pointer;
          z-index: 10001;
        `;

        // Create video element
        const video = document.createElement('video');
        video.style.cssText = `
          width: 100%;
          height: auto;
          display: block;
        `;
        video.controls = true;
        video.autoplay = true;

        // Handle different video URL formats
        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
          // YouTube video - create iframe
          const videoId = extractYouTubeId(videoUrl);
          const iframe = document.createElement('iframe');
          iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
          iframe.style.cssText = `
            width: 100%;
            height: 450px;
            border: none;
          `;
          iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
          videoContainer.appendChild(iframe);
        } else {
          // Direct video file
          video.src = videoUrl;
          videoContainer.appendChild(video);
        }

        // Add title
        const title = document.createElement('h3');
        title.textContent = videoTitle;
        title.style.cssText = `
          color: white;
          margin: 0;
          padding: 15px;
          font-size: 18px;
          background: rgba(0, 0, 0, 0.8);
        `;
        videoContainer.appendChild(title);

        // Add close functionality
        closeButton.onclick = () => {
          document.body.removeChild(modal);
        };

        modal.onclick = (e) => {
          if (e.target === modal) {
            document.body.removeChild(modal);
          }
        };

        // Add elements to modal
        videoContainer.appendChild(closeButton);
        modal.appendChild(videoContainer);
        document.body.appendChild(modal);

        console.log('Playing video:', videoUrl);
        showNotification(`Playing: ${videoTitle}`);
      }

      // Extract YouTube video ID
      function extractYouTubeId(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
      }

      // Remove any conflicting event listeners from video elements
      // The onclick attributes will handle the video playback

      // Show notification
      function showNotification(message) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #4caf50;
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
@endsection
