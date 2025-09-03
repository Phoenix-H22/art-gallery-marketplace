<header>
  <div class="header-container">
    <a class="logo" href="/">
      <img alt="Logo" class="logo-image" src="{{ asset('images/logo.png') }}">
      <span class="logo-text">Loo Art.</span>
    </a>

    <div class="search-bar">
      <input autocomplete="off" id="searchInput" name="q" placeholder="Search for artwork, artists, or styles..."
        type="text" value="{{ request('q') }}">
      <div class="search-results" id="searchResults"></div>
    </div>

    <div class="header-icons">
      <button class="icon-btn">🌍</button>

      @auth
        <div class="user-menu">
          <button class="icon-btn user-btn" onclick="toggleUserMenu()">
                            @if (auth()->user()->avatar)
                  <img alt="Avatar" class="user-avatar" src="{{ auth()->user()->avatar_url }}">
            @else
              👤
            @endif
          </button>
          <div class="user-dropdown" id="userDropdown">
            <div class="user-info">
              <div class="user-name">{{ auth()->user()->name }}</div>
              <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
            @if (auth()->user()->isArtist())
              <a class="dropdown-item" href="#">My Artworks</a>
            @endif
            <a class="dropdown-item" href="#">Settings</a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
              @csrf
              <button class="dropdown-item logout-btn" type="submit">Sign Out</button>
            </form>
          </div>
        </div>
      @else
        <a class="auth-btn login-btn" href="{{ route('login') }}">Sign In</a>
        <a class="auth-btn register-btn" href="{{ route('register') }}">Sign Up</a>
      @endauth

      <button class="icon-btn">🛒</button>
    </div>
  </div>
</header>

<style>
  .user-menu {
    position: relative;
    display: inline-block;
  }

  .user-btn {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .user-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    object-fit: cover;
  }

  .user-dropdown {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    min-width: 200px;
    z-index: 1000;
    display: none;
    margin-top: 8px;
  }

  .user-dropdown.show {
    display: block;
  }

  .user-info {
    padding: 15px;
    border-bottom: 1px solid #f0f0f0;
  }

  .user-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 4px;
  }

  .user-role {
    font-size: 12px;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .dropdown-divider {
    height: 1px;
    background: #f0f0f0;
    margin: 8px 0;
  }

  .dropdown-item {
    display: block;
    padding: 12px 15px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s ease;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
  }

  .dropdown-item:hover {
    background: #f8f9ff;
    color: #667eea;
  }

  .logout-btn {
    color: #e74c3c;
  }

  .logout-btn:hover {
    background: #fee;
    color: #e74c3c;
  }

  .auth-btn {
    padding: 8px 16px;
    border-radius: 20px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin: 0 5px;
  }

  .login-btn {
    color: #667eea;
    border: 1px solid #667eea;
  }

  .login-btn:hover {
    background: #667eea;
    color: white;
  }

  .register-btn {
    background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
    color: white;
    border: 1px solid transparent;
  }

  .register-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
  }
</style>

<script>
  function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');
  }

  // Close dropdown when clicking outside
  document.addEventListener('click', function(event) {
    const userMenu = document.querySelector('.user-menu');
    const dropdown = document.getElementById('userDropdown');

    if (!userMenu.contains(event.target)) {
      dropdown.classList.remove('show');
    }
  });

  // Live Search Functionality
  let searchTimeout;
  const searchInput = document.getElementById('searchInput');
  const searchResults = document.getElementById('searchResults');

  searchInput.addEventListener('input', function() {
    const query = this.value.trim();

    // Clear previous timeout
    clearTimeout(searchTimeout);

    // Hide results if query is empty or too short
    if (query.length < 2) {
      searchResults.classList.remove('show');
      return;
    }

    // Show loading state
    searchResults.innerHTML = '<div class="search-loading">Searching...</div>';
    searchResults.classList.add('show');

    // Debounce the search request
    searchTimeout = setTimeout(() => {
      performLiveSearch(query);
    }, 300);
  });

  // Handle Enter key to go to full search results
  searchInput.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
      const query = this.value.trim();
      if (query !== '') {
        window.location.href = `{{ route('search') }}?q=${encodeURIComponent(query)}`;
      }
    }
  });

  // Close search results when clicking outside
  document.addEventListener('click', function(event) {
    if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
      searchResults.classList.remove('show');
    }
  });

  // Close search results when pressing Escape
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      searchResults.classList.remove('show');
      searchInput.blur();
    }
  });

  function performLiveSearch(query) {
    fetch(`{{ route('live.search') }}?q=${encodeURIComponent(query)}`)
      .then(response => response.json())
      .then(data => {
        displaySearchResults(data, query);
      })
      .catch(error => {
        console.error('Search error:', error);
        searchResults.innerHTML = '<div class="no-results-message">Error loading results</div>';
      });
  }

  function displaySearchResults(artworks, query) {
    if (artworks.length === 0) {
      searchResults.innerHTML = `
        <div class="no-results-message">
          No results found for "${query}"
        </div>
      `;
      return;
    }

    const resultsHTML = artworks.map(artwork => `
      <a href="{{ route('artwork.show', '') }}/${artwork.id}" class="search-result-item">
        <img src="${artwork.image_url}" alt="${artwork.title}" class="search-result-image" onerror="this.style.display='none'">
        <div class="search-result-info">
          <div class="search-result-title">${artwork.title}</div>
          <div class="search-result-artist">${artwork.artist_name}</div>
          <div class="search-result-price">
            $${artwork.price.toLocaleString()}
            <span class="search-result-medium">${artwork.medium}</span>
          </div>
        </div>
      </a>
    `).join('');

    searchResults.innerHTML = resultsHTML;
  }
</script>
