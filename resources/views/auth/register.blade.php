@extends('layouts.auth')

@section('title', 'Create your free account — Verdant Academy')

@section('content')
<div class="auth-wrap">
    <aside class="auth-aside">
      <a href="{{ route('home') }}" class="logo" style="position:relative;z-index:1">
        <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
        <span class="logo-text" style="color:#fff">Verdant<small style="color:var(--mustard-400)">Academy</small></span>
      </a>
      <div style="position:relative;z-index:1">
        <h1 class="display" style="color:#fff;font-size:2.2rem;line-height:1.15">Start learning today. It's free to join.</h1>
        <p style="margin-top:18px;color:rgba(184,149,166,.8);font-size:15px;line-height:1.75;max-width:420px">
          Create an account to preview lessons, save courses and track your progress across every programme.
        </p>
        <div style="margin-top:40px;display:flex;flex-direction:column;gap:18px;max-width:400px">
          <div style="display:flex;align-items:center;gap:13px;color:rgba(253,251,246,.95);font-size:14.5px"><i data-lucide="gift" style="width:18px;height:18px;color:var(--mustard-400)"></i>Free preview lessons in every course</div>
          <div style="display:flex;align-items:center;gap:13px;color:rgba(253,251,246,.95);font-size:14.5px"><i data-lucide="heart" style="width:18px;height:18px;color:var(--mustard-400)"></i>Save courses to your wishlist</div>
          <div style="display:flex;align-items:center;gap:13px;color:rgba(253,251,246,.95);font-size:14.5px"><i data-lucide="trending-up" style="width:18px;height:18px;color:var(--mustard-400)"></i>Progress tracking across devices</div>
          <div style="display:flex;align-items:center;gap:13px;color:rgba(253,251,246,.95);font-size:14.5px"><i data-lucide="badge-check" style="width:18px;height:18px;color:var(--mustard-400)"></i>Certificates you can verify</div>
        </div>
      </div>
      <p style="position:relative;z-index:1;font-size:12.6px;color:rgba(184,149,166,.5)">© 2025 Verdant Academy Ltd.</p>
    </aside>
    <main class="auth-main">
      <div class="auth-card">
        <a href="{{ route('home') }}" class="logo" style="margin-bottom:28px">
          <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
          <span class="logo-text">Verdant<small>Academy</small></span>
        </a>
        <h1 class="display" style="font-size:1.8rem">Create your free account</h1>
        <p class="small muted" style="margin-top:8px;margin-bottom:26px">Already registered? <a href="{{ route('login') }}" style="color:var(--wine-700);font-weight:600;text-decoration:underline">Log in</a></p>

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="field {{ $errors->has('name') ? 'invalid' : '' }}">
            <label class="label" for="r-name">Full name <span class="req">*</span></label>
            <div class="input-icon">
              <i data-lucide="user"></i>
              <input id="r-name" name="name" value="{{ old('name') }}" class="input" type="text" required placeholder="Jane Doe" autocomplete="name" autofocus>
            </div>
            @if ($errors->has('name'))
              <span class="field-error" style="display:flex"><i data-lucide="alert-circle"></i>{{ $errors->first('name') }}</span>
            @endif
          </div>

          <div class="field {{ $errors->has('email') ? 'invalid' : '' }}">
            <label class="label" for="r-email">Email address <span class="req">*</span></label>
            <div class="input-icon">
              <i data-lucide="mail"></i>
              <input id="r-email" name="email" value="{{ old('email') }}" class="input" type="email" required placeholder="you@example.com" autocomplete="email">
            </div>
            @if ($errors->has('email'))
              <span class="field-error" style="display:flex"><i data-lucide="alert-circle"></i>{{ $errors->first('email') }}</span>
            @endif
          </div>

          <div class="field {{ $errors->has('password') ? 'invalid' : '' }}">
            <label class="label" for="r-pass">Password <span class="req">*</span></label>
            <div class="input-icon">
              <i data-lucide="lock"></i>
              <input id="r-pass" name="password" class="input" type="password" required placeholder="At least 8 characters" autocomplete="new-password" style="padding-right:42px">
              <button type="button" class="pw-toggle" data-action="toggle-pw" aria-label="Show password"><i data-lucide="eye"></i></button>
            </div>
            @if ($errors->has('password'))
              <span class="field-error" style="display:flex"><i data-lucide="alert-circle"></i>{{ $errors->first('password') }}</span>
            @endif
          </div>

          <div class="field {{ $errors->has('password_confirmation') ? 'invalid' : '' }}">
            <label class="label" for="r-pass2">Confirm password <span class="req">*</span></label>
            <div class="input-icon">
              <i data-lucide="lock"></i>
              <input id="r-pass2" name="password_confirmation" class="input" type="password" required placeholder="Re-enter your password" autocomplete="new-password" style="padding-right:42px">
              <button type="button" class="pw-toggle" data-action="toggle-pw" aria-label="Show password"><i data-lucide="eye"></i></button>
            </div>
            @if ($errors->has('password_confirmation'))
              <span class="field-error" style="display:flex"><i data-lucide="alert-circle"></i>{{ $errors->first('password_confirmation') }}</span>
            @endif
          </div>

          <label class="check" style="margin-bottom:20px">
            <input type="checkbox" name="terms" value="1" {{ old('terms') ? 'checked' : '' }} required>
            <span>I agree to the <a href="{{ route('terms') }}" style="color:var(--wine-700);text-decoration:underline">Terms & Conditions</a> and <a href="{{ route('privacy') }}" style="color:var(--wine-700);text-decoration:underline">Privacy Policy</a>. <span class="req" style="color:var(--wine-600)">*</span></span>
          </label>
          @if ($errors->has('terms'))
            <span class="field-error" style="display:flex;margin-top:-14px;margin-bottom:16px"><i data-lucide="alert-circle"></i>{{ $errors->first('terms') }}</span>
          @endif

          <button type="submit" class="btn btn-primary btn-lg btn-block">Create account</button>
        </form>

        <div class="notice ivory" style="margin-top:22px;font-size:12.8px">
          <i data-lucide="shield-check"></i>
          <span>Accounts registered through this page are assigned the <b>Student</b> role by default.</span>
        </div>
      </div>
    </main>
  </div>
@endsection
