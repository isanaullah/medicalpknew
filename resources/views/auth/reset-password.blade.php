@extends('layouts.auth')

@section('title', 'Set new password — Verdant Academy')

@section('content')
<div class="auth-wrap" style="grid-template-columns:1fr">
    <main class="auth-main">
      <div class="auth-card">
        <a href="{{ route('home') }}" class="logo" style="margin-bottom:28px">
          <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
          <span class="logo-text">Verdant<small>Academy</small></span>
        </a>
        <div class="stat-icon gold" style="width:48px;height:48px;margin-bottom:20px"><i data-lucide="shield-check"></i></div>
        <h1 class="display" style="font-size:1.75rem">Set new password</h1>
        <p class="small muted" style="margin-top:10px;margin-bottom:26px;line-height:1.7">
          Please enter your email and your new password below.
        </p>

        @if ($errors->any())
          <div style="background:#fef2f2;color:#991b1b;border:1px solid #fecaca;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;">
            <ul style="margin:0;padding-left:18px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}" novalidate>
          @csrf
          <input type="hidden" name="token" value="{{ $request->route('token') }}">

          <div class="field @error('email') has-error @enderror">
            <label class="label" for="r-email">Email address</label>
            <div class="input-icon">
              <i data-lucide="mail"></i>
              <input id="r-email" name="email" class="input" type="email" required placeholder="you@example.com" value="{{ old('email', $request->email) }}">
            </div>
            @error('email')
              <span class="field-error" style="display:inline-flex"><i data-lucide="alert-circle"></i>{{ $message }}</span>
            @enderror
          </div>

          <div class="field @error('password') has-error @enderror">
            <label class="label" for="r-pass">New Password</label>
            <div class="input-icon">
              <i data-lucide="lock"></i>
              <input id="r-pass" name="password" class="input" type="password" required placeholder="At least 8 characters">
              <button type="button" class="pwd-toggle" data-toggle-password="r-pass" aria-label="Toggle password visibility"><i data-lucide="eye"></i></button>
            </div>
            @error('password')
              <span class="field-error" style="display:inline-flex"><i data-lucide="alert-circle"></i>{{ $message }}</span>
            @enderror
          </div>

          <div class="field @error('password_confirmation') has-error @enderror">
            <label class="label" for="r-pass-confirm">Confirm New Password</label>
            <div class="input-icon">
              <i data-lucide="lock"></i>
              <input id="r-pass-confirm" name="password_confirmation" class="input" type="password" required placeholder="Confirm your password">
            </div>
            @error('password_confirmation')
              <span class="field-error" style="display:inline-flex"><i data-lucide="alert-circle"></i>{{ $message }}</span>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary btn-lg btn-block">Reset password</button>
        </form>

        <p style="text-align:center;margin-top:24px;font-size:13.6px">
          <a href="{{ route('login') }}" style="color:var(--wine-700);font-weight:600">← Back to login</a>
        </p>
      </div>
    </main>
</div>
@endsection
