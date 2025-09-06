@extends('layouts.app')

@section('title', 'Register - Art Gallery')

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

    .auth-container {
      max-width: 500px;
      margin: 40px auto;
      padding: 40px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .auth-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .auth-title {
      font-size: 28px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .auth-subtitle {
      font-size: 14px;
      color: #666;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #333;
      margin-bottom: 8px;
    }

    .form-input {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-textarea {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.3s ease;
      resize: vertical;
      min-height: 100px;
    }

    .form-textarea:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-select {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.3s ease;
      background: white;
    }

    .form-select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-error {
      color: #e74c3c;
      font-size: 12px;
      margin-top: 5px;
    }

    .role-selection {
      display: flex;
      gap: 15px;
      margin-bottom: 20px;
    }

    .role-option {
      flex: 1;
      padding: 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .role-option:hover {
      border-color: #667eea;
      background: #f8f9ff;
    }

    .role-option.selected {
      border-color: #667eea;
      background: #667eea;
      color: white;
    }

    .role-option input {
      display: none;
    }

    .role-icon {
      font-size: 24px;
      margin-bottom: 8px;
    }

    .role-title {
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 4px;
    }

    .role-desc {
      font-size: 12px;
      opacity: 0.8;
    }

    .btn-primary {
      width: 100%;
      padding: 14px 20px;
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

    .auth-footer {
      text-align: center;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #f0f0f0;
    }

    .auth-link {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
    }

    .auth-link:hover {
      text-decoration: underline;
    }

    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-error {
      background: #fee;
      color: #e74c3c;
      border: 1px solid #fcc;
    }
  </style>
@endpush

@section('content')
  <div class="auth-container">
    <div class="auth-header">
      <h1 class="auth-title">Create Account</h1>
      <p class="auth-subtitle">Join our art community</p>
    </div>

    @if ($errors->any())
      <div class="alert alert-error">
        <ul style="margin: 0; padding-left: 20px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
      @csrf

      <div class="form-group">
        <label class="form-label" for="name">Full Name</label>
        <input class="form-input" id="name" name="name" required type="text" value="{{ old('name') }}">
        @error('name')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <input class="form-input" id="email" name="email" required type="email" value="{{ old('email') }}">
        @error('email')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label">Account Type</label>
        <div class="role-selection">
          <label class="role-option {{ old('role') == 'user' ? 'selected' : '' }}">
            <input {{ old('role') == 'user' ? 'checked' : '' }} name="role" type="radio" value="user">
            <div class="role-icon">👤</div>
            <div class="role-title">Art Collector</div>
            <div class="role-desc">Browse and purchase art</div>
          </label>
          <label class="role-option {{ old('role') == 'artist' ? 'selected' : '' }}">
            <input {{ old('role') == 'artist' ? 'checked' : '' }} name="role" type="radio" value="artist">
            <div class="role-icon">🎨</div>
            <div class="role-title">Artist</div>
            <div class="role-desc">Sell your artwork</div>
          </label>
        </div>
        @error('role')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="location">Location (Optional)</label>
        <input class="form-input" id="location" name="location" placeholder="City, Country" type="text"
          value="{{ old('location') }}">
        @error('location')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="bio">Bio (Optional)</label>
        <textarea class="form-textarea" id="bio" name="bio" placeholder="Tell us about yourself...">{{ old('bio') }}</textarea>
        @error('bio')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input class="form-input" id="password" name="password" required type="password">
        @error('password')
          <div class="form-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label class="form-label" for="password_confirmation">Confirm Password</label>
        <input class="form-input" id="password_confirmation" name="password_confirmation" required type="password">
      </div>

      <button class="btn-primary" type="submit">Create Account</button>
    </form>

    <div class="auth-footer">
      <p>Already have an account? <a class="auth-link" href="{{ route('login') }}">Sign in</a></p>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const roleOptions = document.querySelectorAll('.role-option');

      roleOptions.forEach(option => {
        option.addEventListener('click', function() {
          // Remove selected class from all options
          roleOptions.forEach(opt => opt.classList.remove('selected'));
          // Add selected class to clicked option
          this.classList.add('selected');
          // Check the radio button
          const radio = this.querySelector('input[type="radio"]');
          radio.checked = true;
        });
      });
    });
  </script>
@endsection
