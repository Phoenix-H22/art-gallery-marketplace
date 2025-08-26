<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>"Fruitful Day" Painting - Magdalena Krzak | Art Gallery</title>
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

      /* Include header styles from main layout */
      .promo-banner {
        background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
        color: white;
        text-align: center;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
      }

      header {
        background: white;
        border-bottom: 1px solid #e0e0e0;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      }

      .header-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 24px;
        font-weight: 700;
        color: #333;
        text-decoration: none;
      }

      .search-bar {
        flex: 1;
        max-width: 500px;
        margin: 0 40px;
      }

      .search-bar input {
        width: 100%;
        padding: 12px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        font-size: 14px;
      }

      .main-nav {
        background: white;
        border-bottom: 1px solid #f0f0f0;
      }

      .nav-list {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        list-style: none;
        gap: 40px;
        padding: 0 30px;
      }

      .nav-item {
        padding: 20px 0;
        cursor: pointer;
        font-size: 15px;
        font-weight: 500;
        color: #666;
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

        .why-features {
          grid-template-columns: 1fr;
        }

        .thumbnail-container {
          justify-content: center;
        }
      }
    </style>
  </head>

  <body>
    <!-- @extends('layouts.app') -->
    <!-- @section('content') -->

      <!-- Header (from layout) -->
      <div class="promo-banner">
        <span>Shop Our Anniversary Sale</span>
        <span>|</span>
        <span>15% off Originals USD $750+</span>
        <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 4px;">APPLY CODE: 15YEARS</span>
      </div>

      <header>
        <div class="header-container">
          <a class="logo" href="/">
            <div
              style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
              🎨</div>
            <span>ARTGALLERY</span>
          </a>

          <div class="search-bar">
            <input placeholder="Search for paintings" type="text">
          </div>

          <div style="display: flex; gap: 20px;">
            <button
              style="width: 40px; height: 40px; border-radius: 50%; background: #f5f5f5; border: none; cursor: pointer;">🌍</button>
            <button
              style="width: 40px; height: 40px; border-radius: 50%; background: #f5f5f5; border: none; cursor: pointer;">👤</button>
            <button
              style="width: 40px; height: 40px; border-radius: 50%; background: #f5f5f5; border: none; cursor: pointer;">🛒</button>
          </div>
        </div>
      </header>

      <nav class="main-nav">
        <ul class="nav-list">
          <li class="nav-item">Paintings</li>
          <li class="nav-item">Photography</li>
          <li class="nav-item">Sculpture</li>
          <li class="nav-item">Drawings</li>
          <li class="nav-item">Prints</li>
          <li class="nav-item">Inspiration</li>
          <li class="nav-item">Art Advisory</li>
          <li class="nav-item">Trade</li>
          <li class="nav-item">Curated Deals</li>
          <li class="nav-item">Anniversary Picks</li>
        </ul>
      </nav>

      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <a href="/">All Artworks</a>
        <span>/</span>
        <a href="/paintings">Paintings</a>
        <span>/</span>
        <span>Magdalena Krzak Prints</span>
      </div>

      <!-- Product Detail -->
      <div class="product-detail-container">
        <!-- Gallery Section -->
        <div class="gallery-section">
          <div class="main-image-container">
            <img alt="Fruitful Day Painting" class="main-image" id="mainImage"
              src="https://images.unsplash.com/photo-1549887534-1541e9326642?w=800">
            <div class="zoom-indicator">🔍 Click to zoom</div>
          </div>
          <div class="thumbnail-container">
            <div class="thumbnail active" onclick="changeImage(0)">
              <img alt="Thumbnail 1" src="https://images.unsplash.com/photo-1549887534-1541e9326642?w=150">
            </div>
            <div class="thumbnail" onclick="changeImage(1)">
              <img alt="Thumbnail 2" src="https://images.unsplash.com/photo-1578662996442-48f60103fc9e?w=150">
            </div>
            <div class="thumbnail" onclick="changeImage(2)">
              <img alt="Thumbnail 3" src="https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=150">
            </div>
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
              <h1 class="product-title">"Fruitful Day" Painting</h1>
              <div class="product-artist">
                <a href="/artists/magdalena-krzak">Magdalena Krzak</a>
              </div>
              <div class="product-location">United States</div>
            </div>

            <div class="product-details-grid">
              <div class="detail-item">
                <div class="detail-label">Painting</div>
                <div class="detail-value">Acrylic on Canvas</div>
              </div>
              <div class="detail-item">
                <div class="detail-label">Size</div>
                <div class="detail-value">36 W x 48 H x 1.5 D in</div>
              </div>
              <div class="detail-item">
                <div class="detail-label">Ships in a Box</div>
                <div class="detail-value">Yes</div>
              </div>
              <div class="detail-item">
                <div class="detail-label">Ready to Hang</div>
                <div class="detail-value">Not Applicable</div>
              </div>
            </div>

            <div class="price-section">
              <div class="price-amount">$3,868</div>
              <div class="price-note">Plus fees, tax, duties, and shipping</div>

              <div class="action-buttons">
                <button class="btn-primary">Add to Cart</button>
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
              <h1 class="product-title">"Fruitful Day" Print</h1>
              <div class="product-artist">
                <a href="/artists/magdalena-krzak">Magdalena Krzak</a>
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
            <p>Original acrylic painting on canvas. Artwork is signed.</p>
            <p style="margin-top: 15px;">
              <strong>Year Created:</strong> 2022<br>
              <strong>Subject:</strong> Women<br>
              <strong>Styles:</strong> Abstract, Expressionism, Figurative, Impressionism, Modern<br>
              <strong>Mediums:</strong> Acrylic, Canvas
            </p>
          </div>
          <div style="text-align: center; padding-top: 20px; border-top: 1px solid #f0f0f0;">
            <p style="font-size: 13px; color: #666; margin-bottom: 10px;">Need more information? <a href="#"
                style="color: #667eea; text-decoration: none;">Contact Us</a></p>
          </div>
        </div>

        <!-- Artist Profile Section -->
        <div class="artist-section">
          <div class="artist-header">
            <div class="artist-avatar">
              <img alt="Magdalena Krzak"
                src="https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?w=150&h=150&fit=crop">
            </div>
            <div class="artist-info">
              <h3 class="artist-name">Magdalena Krzak</h3>
              <div class="artist-location">United States</div>
              <button class="view-profile-btn">View Profile</button>
            </div>
          </div>
          <div class="artist-bio">
            MAGDALENA KRZAK was born in Tarnów, Poland. After graduating from Art School in Tarnów she continued her
            education at the University in Rzeszow. Her paintings present a unique combination of an abstract, figurative
            forms and drawing. She focuses mainly on human spirit, emotions, gestures and meanings. Her works are held
            internationally, as she has been exhibiting and present observations. Images of women are subtle and feminine.
            Her subjects are often nude and vulnerable. Created only with an outline... fluid with colors and textures
            they blend with the background, yet they speak to us with incredible power. The combination of figurative and
            abstract worlds, drawing an focus, shows delicate and feminine form of womanhood. We all see through a
            different veil when viewing Magdalena Krzak lives and works in Chicago, Illinois.
          </div>
          <div class="artist-stats">
            <div class="stat-item">
              <span class="stat-icon">🎨</span>
              <span>Featured in Saatchi Art's curated series, <a href="#" style="color: #667eea;">Rise To
                  Watch</a></span>
            </div>
            <div class="stat-item">
              <span class="stat-icon">🏆</span>
              <span>Handpicked for Saatchi Art's Chief Curator for our most prestigious feature, <a href="#"
                  style="color: #667eea;">Rising Stars</a></span>
            </div>
          </div>
          <div class="artist-stats" style="border-top: 1px solid #f0f0f0; margin-top: 20px;">
            <div class="stat-item">
              <span class="stat-icon">✓</span>
              <span>Featured in Saatchi Art's printed catalog, sent to thousands of art collectors</span>
            </div>
            <div class="stat-item">
              <span class="stat-icon">✓</span>
              <span>Handpicked to show at The Other Art Fair presented by Saatchi Art in Chicago, Chicago</span>
            </div>
            <div class="stat-item">
              <span class="stat-icon">✓</span>
              <span>Artist featured in Saatchi Art in a collection</span>
            </div>
          </div>
        </div>

        <!-- More From Artist Section -->
        <div class="related-section">
          <div class="section-header">
            <h2 class="section-title">More From Magdalena Krzak</h2>
            <a class="view-all-link" href="/artists/magdalena-krzak">View All →</a>
          </div>
          <div class="artworks-grid">
            <div class="artwork-card">
              <img alt="Swimmer" class="artwork-image"
                src="https://images.unsplash.com/photo-1549887534-1541e9326642?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$948</div>
                <div class="artwork-title">"Swimmer" Painting</div>
                <div class="artwork-size">24 x 20 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="By The Pool" class="artwork-image"
                src="https://images.unsplash.com/photo-1578662996442-48f60103fc9e?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$1,545</div>
                <div class="artwork-title">"By The Pool" Painting</div>
                <div class="artwork-size">30 x 30 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="Garden Girl" class="artwork-image"
                src="https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$1,984</div>
                <div class="artwork-title">"Garden Girl" Painting</div>
                <div class="artwork-size">30 x 40 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="Queen of the Night" class="artwork-image"
                src="https://images.unsplash.com/photo-1578321272176-b7bbc0679853?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$1,515</div>
                <div class="artwork-title">"Queen of the Night" Painting</div>
                <div class="artwork-size">36 x 36 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Visually Similar Section -->
        <div class="related-section">
          <div class="section-header">
            <h2 class="section-title">Visually Similar Artworks</h2>
            <a class="view-all-link" href="/browse/similar">View All →</a>
          </div>
          <div class="artworks-grid">
            <div class="artwork-card">
              <img alt="The Girls on the Beach" class="artwork-image"
                src="https://images.unsplash.com/photo-1536924940846-227afb31e2a5?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$2,023</div>
                <div class="artwork-title">The Girls On The Beach Painting</div>
                <div class="artwork-size">Jason Iskandar • 40 x 30 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="Form" class="artwork-image"
                src="https://images.unsplash.com/photo-1578321272176-b7bbc0679853?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$1,580</div>
                <div class="artwork-title">Form Painting</div>
                <div class="artwork-size">Lisa Groulx • 30 x 30 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="Depression" class="artwork-image"
                src="https://images.unsplash.com/photo-1549887534-1541e9326642?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$3,996</div>
                <div class="artwork-title">Depression Painting</div>
                <div class="artwork-size">Carlos Martinez • 48 x 48 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="Fallen Angels" class="artwork-image"
                src="https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$4,172</div>
                <div class="artwork-title">Fallen Angels in Flowers Painting</div>
                <div class="artwork-size">Kathy Thompson • 60 x 40 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
          </div>
        </div>

        <!-- You May Also Like Section -->
        <div class="related-section">
          <div class="section-header">
            <h2 class="section-title">Paintings You May Also Like</h2>
            <a class="view-all-link" href="/browse/paintings">View All →</a>
          </div>
          <div class="artworks-grid">
            <div class="artwork-card">
              <img alt="Paper Boats" class="artwork-image"
                src="https://images.unsplash.com/photo-1578662996442-48f60103fc9e?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$2,700</div>
                <div class="artwork-title">Paper Boats Painting</div>
                <div class="artwork-size">Jasmin Hansfield • 32 x 40 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="The Void" class="artwork-image"
                src="https://images.unsplash.com/photo-1536924940846-227afb31e2a5?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$4,305</div>
                <div class="artwork-title">The Void Surrealism (Original) Painting</div>
                <div class="artwork-size">Matthew Harris • 40 x 50 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="Horse Painting" class="artwork-image"
                src="https://images.unsplash.com/photo-1549887534-1541e9326642?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$27,087</div>
                <div class="artwork-title">Horse Painting - Gaia Serene</div>
                <div class="artwork-size">Steven Richards • 72 x 48 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
            <div class="artwork-card">
              <img alt="Abstract Trees" class="artwork-image"
                src="https://images.unsplash.com/photo-1578321272176-b7bbc0679853?w=400&h=400&fit=crop">
              <div class="artwork-info">
                <div class="artwork-price">$3,585</div>
                <div class="artwork-title">Abstract Trees Early Summer</div>
                <div class="artwork-size">Theresa Smith • 48 x 36 in</div>
              </div>
              <div class="artwork-actions">
                <button class="action-icon">❤️</button>
                <button class="action-icon">👁️</button>
                <button class="action-icon">🛒</button>
              </div>
            </div>
          </div>
        </div>
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
              <div class="feature-desc">We pay out all our artists fairly and on time since 2011 across 100+ countries.
              </div>
            </div>
          </div>
        </div>

        <!-- Complimentary Art Advisory -->
        <div style="text-align: center; padding: 40px; background: #f8f9fa; margin: 40px 0;">
          <img alt="Art Advisor" src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=100&h=100&fit=crop"
            style="width: 100px; height: 100px; border-radius: 50%; margin-bottom: 20px;">
          <h3 style="font-size: 24px; margin-bottom: 10px;">Complimentary Art Advisory</h3>
          <p style="max-width: 600px; margin: 0 auto 20px; color: #666; line-height: 1.6;">
            Get free art advisory advice when you shop at Saatchi Art. Our knowledgeable curators are will guide you
            through a seamless, stress-free shopping experience.
          </p>
          <button
            style="padding: 12px 30px; background: #667eea; color: white; border: none; border-radius: 25px; cursor: pointer; font-size: 14px;">Contact
            Art Advisory</button>
          <p style="margin-top: 15px; font-size: 13px; color: #999;">All inquiries receive a response.</p>
        </div>
      </div>

      <script>
        // Image Gallery Functions
        const images = [
          'https://images.unsplash.com/photo-1549887534-1541e9326642?w=800',
          'https://images.unsplash.com/photo-1578662996442-48f60103fc9e?w=800',
          'https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=800'
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

        // Tab Switching
        function switchTab(tabName) {
          // Remove active class from all tabs and contents
          document.querySelectorAll('.tab-button').forEach(tab => {
            tab.classList.remove('active');
          });
          document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
          });

          // Add active class to selected tab and content
          if (tabName === 'original') {
            document.querySelectorAll('.tab-button')[0].classList.add('active');
            document.getElementById('original-tab').classList.add('active');
          } else if (tabName === 'prints') {
            document.querySelectorAll('.tab-button')[1].classList.add('active');
            document.getElementById('prints-tab').classList.add('active');
          }
        }

        // Add to Cart Function
        document.querySelectorAll('.btn-primary').forEach(btn => {
          btn.addEventListener('click', function() {
            showNotification('Added to cart successfully!');
          });
        });

        // Favorite Button Toggle
        document.querySelectorAll('.action-icon').forEach(icon => {
          icon.addEventListener('click', function() {
            if (this.textContent.includes('❤')) {
              this.textContent = this.textContent === '❤️' ? '🤍' : '❤️';
            }
          });
        });

        // Zoom Functionality
        document.querySelector('.zoom-indicator').addEventListener('click', function() {
          const mainImage = document.querySelector('.main-image');
          // Here you would implement a modal or lightbox for zooming
          console.log('Zoom functionality would open here');
        });

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
    </body>

  </html>


  @extends('layouts.app')

@section('title', $product->title . ' - ' . $product->artist->name)

@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb">
    <a href="{{ route('home') }}">All Artworks</a>
    <span>/</span>
    <a href="{{ route('category', $product->category) }}">{{ ucfirst($product->category) }}</a>
    <span>/</span>
    <span>{{ $product->artist->name }} {{ ucfirst($product->type) }}</span>
  </div>

  <!-- Include all the HTML structure with dynamic data -->
  @include('components.product-gallery', ['images' => $product->images])
  @include('components.product-info', ['product' => $product])
  @include('components.artist-info', ['artist' => $product->artist])
  @include('components.related-products', [
      'moreFromArtist' => $moreFromArtist,
      'similarProducts' => $similarProducts,
      'youMayLike' => $youMayLike,
  ])
@endsection
