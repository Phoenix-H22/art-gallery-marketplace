@extends('layouts.app')

@section('title', $profileUser->name . ' - Artist Profile')

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

    .profile-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 30px;
    }

    /* Artist Header */
    .artist-header {
      background: white;
      border-radius: 12px;
      padding: 40px;
      margin-bottom: 30px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      text-align: center;
    }

    .artist-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin: 0 auto 20px;
      overflow: hidden;
      border: 4px solid #f0f0f0;
    }

    .artist-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .artist-name {
      font-size: 32px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .artist-location {
      font-size: 16px;
      color: #666;
      margin-bottom: 20px;
    }

    .artist-bio {
      max-width: 600px;
      margin: 0 auto;
      font-size: 16px;
      line-height: 1.8;
      color: #555;
    }

    .artist-stats {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-top: 30px;
      padding-top: 30px;
      border-top: 1px solid #f0f0f0;
    }

    .stat-item {
      text-align: center;
    }

    .stat-number {
      font-size: 24px;
      font-weight: 700;
      color: #667eea;
      margin-bottom: 5px;
    }

    .stat-label {
      font-size: 14px;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    /* Artworks Section */
    .artworks-section {
      background: white;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      margin-bottom: 30px;
    }

    /* Main Video Section */
    .main-video-section {
      background: white;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      margin-bottom: 30px;
    }

    .main-video-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .main-video-player {
      width: 100%;
      max-width: 800px;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      margin: 0 auto;
    }

    .main-video-info {
      text-align: center;
      max-width: 600px;
      margin: 0 auto;
    }

    .main-video-title {
      font-size: 20px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .main-video-description {
      font-size: 16px;
      color: #666;
      line-height: 1.6;
    }

    .play-overlay button {
      background: rgba(0, 0, 0, 0.8);
      color: white;
      border: none;
      padding: 15px 30px;
      border-radius: 25px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .play-overlay button:hover {
      background: rgba(0, 0, 0, 1);
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

    .view-options {
      display: flex;
      gap: 10px;
    }

    .view-option-btn {
      padding: 8px 16px;
      border: 1px solid #e0e0e0;
      background: white;
      border-radius: 20px;
      cursor: pointer;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .view-option-btn.active {
      background: #667eea;
      color: white;
      border-color: #667eea;
    }

    /* Profile Tabs */
    .profile-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 30px;
      border-bottom: 1px solid #f0f0f0;
      padding-bottom: 10px;
    }

    .tab-button {
      padding: 12px 24px;
      border: none;
      background: none;
      color: #666;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      border-bottom: 3px solid transparent;
    }

    .tab-button:hover {
      color: #333;
    }

    .tab-button.active {
      color: #667eea;
      border-bottom-color: #667eea;
    }

    /* Videos Grid */
    .videos-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
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

    .video-thumbnail {
      position: relative;
      width: 100%;
      height: 200px;
      overflow: hidden;
    }

    .video-thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .play-button {
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
      transition: background 0.3s ease;
    }

    .video-card:hover .play-button {
      background: rgba(0, 0, 0, 0.9);
    }

    .video-info {
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

    .video-duration {
      background: #f0f0f0;
      color: #666;
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: 500;
    }

    .video-date {
      color: #999;
    }

    .artworks-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
    }

    .artworks-list {
      display: none;
      flex-direction: column;
      gap: 20px;
    }

    .artwork-card {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      text-decoration: none;
      color: inherit;
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
      padding: 20px;
    }

    .artwork-price {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
    }

    .artwork-title {
      font-size: 16px;
      color: #666;
      margin-bottom: 6px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .artwork-size {
      font-size: 14px;
      color: #999;
    }

    /* List View Styles */
    .artwork-list-item {
      display: flex;
      background: white;
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      text-decoration: none;
      color: inherit;
    }

    .artwork-list-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .artwork-list-image {
      width: 120px;
      height: 120px;
      object-fit: cover;
      flex-shrink: 0;
    }

    .artwork-list-info {
      padding: 20px;
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .artwork-list-details {
      flex: 1;
    }

    .artwork-list-price {
      font-size: 20px;
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
    }

    .artwork-list-title {
      font-size: 18px;
      color: #333;
      margin-bottom: 6px;
    }

    .artwork-list-size {
      font-size: 14px;
      color: #666;
    }

    /* Load More */
    .load-more-container {
      text-align: center;
      margin-top: 40px;
    }

    .load-more-btn {
      padding: 15px 30px;
      background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
      color: white;
      border: none;
      border-radius: 25px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .load-more-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(255, 87, 34, 0.3);
    }

    /* About Section */
    .about-section {
      background: white;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
      margin-bottom: 30px;
    }

    .about-title {
      font-size: 24px;
      font-weight: 600;
      color: #333;
      margin-bottom: 20px;
    }

    .about-content {
      font-size: 16px;
      line-height: 1.8;
      color: #555;
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

    /* Responsive */
    @media (max-width: 768px) {
      .artist-stats {
        flex-direction: column;
        gap: 20px;
      }

      .artworks-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
      }

      .section-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
      }

      .artwork-list-item {
        flex-direction: column;
      }

      .artwork-list-image {
        width: 100%;
        height: 200px;
      }

      .artwork-list-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
    }
  </style>
@endpush

@section('content')
  <div class="profile-container">

    <!-- Artist Header -->
    <div class="artist-header">
      <div class="artist-avatar">
        <img alt="{{ $profileUser->name }}" src="{{ $profileUser->avatar_url }}">
      </div>
      <h1 class="artist-name">{{ $profileUser->name }}</h1>
      <div class="artist-location">{{ $profileUser->location ?? 'Location not specified' }}</div>
      @if ($profileUser->bio)
        <div class="artist-bio">{{ $profileUser->bio }}</div>
      @endif
      <div class="artist-stats">
        <div class="stat-item">
          <div class="stat-number">{{ $artworks->total() }}</div>
          <div class="stat-label">Artworks</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ ucfirst($profileUser->role) }}</div>
          <div class="stat-label">Role</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $profileUser->created_at->format('Y') }}</div>
          <div class="stat-label">Member Since</div>
        </div>
      </div>
    </div>

    <!-- Artworks Section -->
    <div class="artworks-section">
      <div class="section-header">
        <h2 class="section-title">All Artworks ({{ $artworks->total() }})</h2>
        <div class="view-options">
          <button class="view-option-btn active" onclick="switchView('grid')">Grid</button>
          <button class="view-option-btn" onclick="switchView('list')">List</button>
        </div>
      </div>

      <!-- Profile Tabs -->
      <div class="profile-tabs">
        <button class="tab-button active" onclick="switchTab('artworks')">All Artworks</button>
        <button class="tab-button" onclick="switchTab('videos')">Videos</button>
      </div>

      <div class="artworks-grid" id="artworksGrid">
        @forelse($artworks as $artwork)
          <a class="artwork-card" href="{{ route('artwork.show', $artwork->id) }}">
            <img alt="{{ $artwork->title }}" class="artwork-image" src="{{ $artwork->image_url }}">
            <div class="artwork-info">
              <div class="artwork-price">{{ $artwork->formatted_price }}</div>
              <div class="artwork-title">"{{ $artwork->title }}"</div>
              <div class="artwork-size">{{ $artwork->formatted_dimensions }}</div>
            </div>
          </a>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
            <h3 style="color: #666; margin-bottom: 20px;">No artworks found</h3>
            <p style="color: #999;">This artist hasn't uploaded any artworks yet.</p>
          </div>
        @endforelse
      </div>

      <!-- Videos Tab Content -->
      <div class="videos-grid" id="videosGrid" style="display: none;">
        @if ($videos->count() > 0)
          @foreach ($videos as $video)
            <div class="video-card" onclick="playVideo('{{ $video->video_url }}', '{{ $video->title }}')">
              <div class="video-thumbnail">
                <img alt="{{ $video->title }}" src="{{ $video->display_thumbnail_url }}">
                <div class="play-button">
                  <span>▶</span>
                </div>
              </div>
              <div class="video-info">
                <h3 class="video-title">{{ $video->title }}</h3>
                <p class="video-description">{{ $video->description ?: 'Watch ' . $profileUser->name . ' in action' }}
                </p>
                <div class="video-meta">
                  <span class="video-duration">{{ $video->formatted_duration }}</span>
                  <span class="video-date">{{ $video->created_at->diffForHumans() }}</span>
                </div>
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align: center; padding: 60px 20px; grid-column: 1 / -1;">
            <h3 style="color: #666; margin-bottom: 20px;">No videos found</h3>
            <p style="color: #999;">This artist hasn't uploaded any videos yet.</p>
          </div>
        @endif
      </div>

      <div class="artworks-list" id="artworksList">
        @forelse($artworks as $artwork)
          <a class="artwork-list-item" href="{{ route('artwork.show', $artwork->id) }}">
            <img alt="{{ $artwork->title }}" class="artwork-list-image" src="{{ $artwork->image_url }}">
            <div class="artwork-list-info">
              <div class="artwork-list-details">
                <div class="artwork-list-price">{{ $artwork->formatted_price }}</div>
                <div class="artwork-list-title">"{{ $artwork->title }}"</div>
                <div class="artwork-list-size">{{ $artwork->formatted_dimensions }}</div>
              </div>
            </div>
          </a>
        @empty
          <div style="text-align: center; padding: 60px 20px;">
            <h3 style="color: #666; margin-bottom: 20px;">No artworks found</h3>
            <p style="color: #999;">This artist hasn't uploaded any artworks yet.</p>
          </div>
        @endforelse
      </div>

      <!-- Pagination -->
      @if ($artworks->hasPages())
        <div class="pagination">
          @if ($artworks->onFirstPage())
            <button class="page-btn" disabled>‹ Previous</button>
          @else
            <a class="page-btn" href="{{ $artworks->previousPageUrl() }}">‹ Previous</a>
          @endif

          @foreach ($artworks->getUrlRange(1, $artworks->lastPage()) as $page => $url)
            @if ($page == $artworks->currentPage())
              <button class="page-btn active">{{ $page }}</button>
            @else
              <a class="page-btn" href="{{ $url }}">{{ $page }}</a>
            @endif
          @endforeach

          @if ($artworks->hasMorePages())
            <a class="page-btn" href="{{ $artworks->nextPageUrl() }}">Next ›</a>
          @else
            <button class="page-btn" disabled>Next ›</button>
          @endif
        </div>
      @endif
    </div>

    <!-- Main Video Section -->
    @if ($profileUser->mainVideo)
      <div class="main-video-section">
        <h2 class="section-title">Featured Video</h2>
        <div class="main-video-container">
          <video autoplay class="main-video-player" controls loop muted playsinline
            poster="{{ $profileUser->mainVideo->display_thumbnail_url }}" preload="auto">
            <source src="{{ $profileUser->mainVideo->video_url }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>

          <div class="main-video-info">
            <h3 class="main-video-title">{{ $profileUser->mainVideo->title }}</h3>
            @if ($profileUser->mainVideo->description)
              <p class="main-video-description">{{ $profileUser->mainVideo->description }}</p>
            @endif
          </div>
        </div>
      </div>
    @endif

    <!-- About Section -->
    @if ($profileUser->bio)
      <div class="about-section">
        <h2 class="about-title">About {{ $profileUser->name }}</h2>
        <div class="about-content">
          {{ $profileUser->bio }}
        </div>
      </div>
    @endif
  </div>
@endsection

@push('scripts')
  <script>
    function switchView(viewType) {
      const gridView = document.getElementById('artworksGrid');
      const listView = document.getElementById('artworksList');
      const gridBtn = document.querySelector('.view-option-btn[onclick*="grid"]');
      const listBtn = document.querySelector('.view-option-btn[onclick*="list"]');

      if (viewType === 'grid') {
        gridView.style.display = 'grid';
        listView.style.display = 'none';
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
      } else {
        gridView.style.display = 'none';
        listView.style.display = 'flex';
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
      }
    }

    function switchTab(tabName) {
      const artworksGrid = document.getElementById('artworksGrid');
      const artworksList = document.getElementById('artworksList');
      const videosGrid = document.getElementById('videosGrid');
      const artworksTab = document.querySelector('.tab-button[onclick*="artworks"]');
      const videosTab = document.querySelector('.tab-button[onclick*="videos"]');

      if (tabName === 'artworks') {
        // Show artworks (both grid and list views)
        artworksGrid.style.display = 'grid';
        artworksList.style.display = 'none';
        videosGrid.style.display = 'none';

        // Update tab buttons
        artworksTab.classList.add('active');
        videosTab.classList.remove('active');
      } else if (tabName === 'videos') {
        // Show videos
        artworksGrid.style.display = 'none';
        artworksList.style.display = 'none';
        videosGrid.style.display = 'grid';

        // Update tab buttons
        videosTab.classList.add('active');
        artworksTab.classList.remove('active');
      }
    }

    // Main video autoplay functionality
    document.addEventListener('DOMContentLoaded', function() {
      const mainVideo = document.querySelector('.main-video-player');
      if (mainVideo && !mainVideo.classList.contains('youtube-embed')) {
        // Only handle HTML5 video elements, not YouTube iframes
        // Try to autoplay the video
        mainVideo.play().catch(function(error) {
          console.log('Autoplay prevented:', error);
          // Show a play button overlay if autoplay fails
          const playOverlay = document.createElement('div');
          playOverlay.className = 'play-overlay';
          playOverlay.innerHTML =
            '<button onclick="this.parentElement.remove(); this.parentElement.parentElement.play();">▶ Play Video</button>';
          playOverlay.style.cssText =
            'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10;';
          mainVideo.parentElement.style.position = 'relative';
          mainVideo.parentElement.appendChild(playOverlay);
        });
      }
    });

    // Video functionality
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
