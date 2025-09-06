@extends('layouts.app')

@section('title', 'Login - Art Gallery')

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
      max-width: 400px;
      margin: 60px auto;
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

    .form-error {
      color: #e74c3c;
      font-size: 12px;
      margin-top: 5px;
    }

    .form-checkbox {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 20px;
    }

    .form-checkbox input {
      width: 16px;
      height: 16px;
    }

    .form-checkbox label {
      font-size: 14px;
      color: #666;
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

    .alert-success {
      background: #efe;
      color: #27ae60;
      border: 1px solid #cfc;
    }
  </style>
@endpush

@section('content')
  <div class="auth-container">
    <div class="auth-header">
      <h1 class="auth-title">Welcome Back</h1>
      <p class="auth-subtitle">Sign in to your account</p>
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

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
      @csrf

      <div class="form-group">
        <label class="form-label" for="email">Email Address</label>
        <input class="form-input" id="email" name="email" required type="email" value="{{ old('email') }}">
        @error('email')
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

      <div class="form-checkbox">
        <input id="remember" name="remember" type="checkbox">
        <label for="remember">Remember me</label>
      </div>

      <button class="btn-primary" type="submit">Sign In</button>
    </form>

    <div class="auth-footer">
      <p>Don't have an account? <a class="auth-link" href="{{ route('register') }}">Sign up</a></p>
    </div>
  </div>
@endsection
