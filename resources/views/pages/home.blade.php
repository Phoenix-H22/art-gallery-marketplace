@extends('layouts.app')

@section('title', 'Art Gallery - Home')

@section('content')
  @include('components.hero-carousel', ['featuredArtworks' => $featuredArtworks ?? collect()])

  @include('components.category-pills', ['categories' => $categories ?? collect()])
@endsection

@push('scripts')
  <script>
    let currentSlide = 0;
    let slides = [];
    let autoSlideInterval;

    function initializeCarousel() {
      slides = document.querySelectorAll('.carousel-slide');
      console.log('Found slides:', slides.length);

      if (slides.length === 0) {
        console.log('No slides found, retrying...');
        setTimeout(initializeCarousel, 100);
        return;
      }

      // Show first slide
      showSlide(0);

      // Start auto-advance
      startAutoSlide();
    }

    function showSlide(index) {
      console.log('Showing slide:', index);

      // Hide all slides
      slides.forEach(slide => slide.classList.remove('active'));

      // Show the current slide
      if (slides[index]) {
        slides[index].classList.add('active');
        currentSlide = index;
      }
    }

    function nextSlide() {
      console.log('Next slide clicked');
      if (slides.length === 0) return;

      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);

      // Reset auto-slide timer
      resetAutoSlide();
    }

    function previousSlide() {
      console.log('Previous slide clicked');
      if (slides.length === 0) return;

      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);

      // Reset auto-slide timer
      resetAutoSlide();
    }

    function startAutoSlide() {
      if (slides.length <= 1) return;

      autoSlideInterval = setInterval(() => {
        nextSlide();
      }, 5000);
    }

    function resetAutoSlide() {
      if (autoSlideInterval) {
        clearInterval(autoSlideInterval);
      }
      startAutoSlide();
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      console.log('DOM loaded, initializing carousel...');
      initializeCarousel();
    });

    // Make functions globally available
    window.nextSlide = nextSlide;
    window.previousSlide = previousSlide;
  </script>
@endpush
