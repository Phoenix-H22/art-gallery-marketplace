@php
  $banners = \App\Models\Banner::active()->ordered()->get();
@endphp

<section class="hero-section">
  <div class="carousel-container">
    @forelse($banners as $index => $banner)
      <div class="rem fieldge  {{ $index === 0 ? 'active' : '' }}">
        <img alt="{{ $banner->title }}" src="{{ $banner->image_url }}">
        <div class="slide-content">
          <h1>{{ strtoupper($banner->title) }}</h1>
          <p>{{ $banner->subtitle }}</p>
          <a class="cta-button" href="{{ $banner->button_url }}">{{ $banner->button_text }}</a>
        </div>
      </div>
    @empty
      <div class="carousel-slide active">
        <img alt="Art Gallery" src="https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=1400&h=500&fit=crop">
        <div class="slide-content">
          <h1>NEW TO BUYING ART?</h1>
          <p>Your Personal Art Advisor Awaits</p>
          <a class="cta-button" href="{{ route('paintings.index') }}">GET EXPERT HELP</a>
        </div>
      </div>

      <div class="carousel-slide">
        <img alt="Art Collection"
          src="https://images.unsplash.com/photo-1578321272176-b7bbc0679853?w=1400&h=500&fit=crop">
        <div class="slide-content">
          <h1>CURATED COLLECTIONS</h1>
          <p>Discover Exceptional Artworks</p>
          <a class="cta-button" href="{{ route('paintings.index') }}">EXPLORE NOW</a>
        </div>
      </div>

      <div class="carousel-slide">
        <img alt="Modern Art" src="https://images.unsplash.com/photo-1536924940846-227afb31e2a5?w=1400&h=500&fit=crop">
        <div class="slide-content">
          <h1>ANNIVERSARY SALE</h1>
          <p>Limited Time Offers on Premium Art</p>
          <a class="cta-button" href="{{ route('paintings.index') }}">SHOP SALE</a>
        </div>
      </div>
    @endforelse

    <div class="carousel-controls">
      <button class="carousel-btn" onclick="previousSlide()">‹</button>
      <button class="carousel-btn" onclick="nextSlide()">›</button>
    </div>
  </div>
</section>
