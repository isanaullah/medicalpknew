@extends('layouts.auth')

@section('title', 'Reset your password — Verdant Academy')

@section('content')
<div class="auth-wrap" style="grid-template-columns:1fr">
    <main class="auth-main">
      <div class="auth-card">
        <a href="{{ route('home') }}" class="logo" style="margin-bottom:28px">
          <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
          <span class="logo-text">Verdant<small>Academy</small></span>
        </a>
        <div class="stat-icon gold" style="width:48px;height:48px;margin-bottom:20px"><i data-lucide="key-round"></i></div>
        <h1 class="display" style="font-size:1.75rem">Reset your password</h1>
        <p class="small muted" style="margin-top:10px;margin-bottom:26px;line-height:1.7">
          Enter the email address associated with your account and we will send you a secure link to reset your password.
        </p>
        @if (session('status'))
          <div style="background:#ecfdf5;color:#065f46;border:1px solid #a7f3d0;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;display:flex;align-items:center;gap:8px;">
            <i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>
            <span>{{ session('status') }}</span>
          </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" novalidate>
          @csrf
          <div class="field @error('email') has-error @enderror">
            <label class="label" for="f-email">Email address</label>
            <div class="input-icon">
              <i data-lucide="mail"></i>
              <input id="f-email" name="email" class="input" type="email" required placeholder="you@example.com" value="{{ old('email') }}">
            </div>
            @error('email')
              <span class="field-error" style="display:inline-flex"><i data-lucide="alert-circle"></i>{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary btn-lg btn-block">Send reset link</button>
        </form>
        <p style="text-align:center;margin-top:24px;font-size:13.6px">
          <a href="{{ route('login') }}" style="color:var(--wine-700);font-weight:600">← Back to login</a>
        </p>
      </div>
    </main>
  </div>
@endsection
