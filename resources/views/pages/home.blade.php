@extends('layouts.app')

@section('title', 'Art Gallery - Home')

@section('content')
  @include('components.hero-carousel', ['featuredArtworks' => $featuredArtworks ?? collect()])

  @include('components.category-pills', ['categories' => $categories ?? collect()])
@endsection

@push('scripts')
  <script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');

    function showSlide(index) {
      // Hide all slides
      slides.forEach(slide => slide.classList.remove('active'));

      // Show the current slide
      if (slides[index]) {
        slides[index].classList.add('active');
      }
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    }

    function previousSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    }

    // Auto-advance slides every 5 seconds
    setInterval(nextSlide, 5000);

    // Initialize first slide when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
      showSlide(0);
    });
  </script>
@endpush
