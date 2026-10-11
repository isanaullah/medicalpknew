@extends('layouts.auth')

@section('title', 'Log in to your account — Verdant Academy')

@section('content')
<div class="auth-wrap">
    <aside class="auth-aside">
      <a href="{{ route('home') }}" class="logo" style="position:relative;z-index:1">
        <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
        <span class="logo-text" style="color:#fff">Verdant<small style="color:var(--mustard-400)">Academy</small></span>
      </a>
      <div style="position:relative;z-index:1">
        <h1 class="display" style="color:#fff;font-size:2.2rem;line-height:1.15">Welcome back to your learning.</h1>
        <p style="margin-top:18px;color:rgba(184,149,166,.8);font-size:15px;line-height:1.75;max-width:420px">
          Pick up where you left off. Your progress, notes and certificates are exactly where you saved them.
        </p>
        <div style="margin-top:40px;display:flex;flex-direction:column;gap:18px;max-width:400px">
          <div style="display:flex;align-items:center;gap:13px;color:rgba(253,251,246,.95);font-size:14.5px"><i data-lucide="book-open" style="width:18px;height:18px;color:var(--mustard-400)"></i>Continue 216 expert-led courses</div>
          <div style="display:flex;align-items:center;gap:13px;color:rgba(253,251,246,.95);font-size:14.5px"><i data-lucide="award" style="width:18px;height:18px;color:var(--mustard-400)"></i>Verifiable certificates on completion</div>
          <div style="display:flex;align-items:center;gap:13px;color:rgba(253,251,246,.95);font-size:14.5px"><i data-lucide="users" style="width:18px;height:18px;color:var(--mustard-400)"></i>Weekly live mentor sessions</div>
        </div>
      </div>
      <p style="position:relative;z-index:1;font-size:12.6px;color:rgba(184,149,166,.5)">© 2025 Verdant Academy Ltd.</p>
    </aside>
    <main class="auth-main">
      <div class="auth-card">
        <a href="{{ route('home') }}" class="logo" style="margin-bottom:32px">
          <span class="logo-mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></span>
          <span class="logo-text">Verdant<small>Academy</small></span>
        </a>
        <h1 class="display" style="font-size:1.8rem">Log in to your account</h1>
        <p class="small muted" style="margin-top:8px;margin-bottom:28px">New here? <a href="{{ route('register') }}" style="color:var(--wine-700);font-weight:600;text-decoration:underline">Create a free account</a></p>

        @if (session('status'))
          <div class="form-msg show ok" style="margin-bottom:20px">
            <i data-lucide="check-circle-2"></i><span>{{ session('status') }}</span>
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="field {{ $errors->has('email') ? 'invalid' : '' }}">
            <label class="label" for="l-email">Email address</label>
            <div class="input-icon">
              <i data-lucide="mail"></i>
              <input id="l-email" name="email" value="{{ old('email') }}" class="input" type="email" required placeholder="you@example.com" autocomplete="email" autofocus>
            </div>
            @if ($errors->has('email'))
              <span class="field-error" style="display:flex"><i data-lucide="alert-circle"></i>{{ $errors->first('email') }}</span>
            @endif
          </div>

          <div class="field {{ $errors->has('password') ? 'invalid' : '' }}">
            <label class="label" for="l-pass">Password</label>
            <div class="input-icon">
              <i data-lucide="lock"></i>
              <input id="l-pass" name="password" class="input" type="password" required placeholder="Your password" autocomplete="current-password" style="padding-right:42px">
              <button type="button" class="pw-toggle" data-action="toggle-pw" aria-label="Show password"><i data-lucide="eye"></i></button>
            </div>
            @if ($errors->has('password'))
              <span class="field-error" style="display:flex"><i data-lucide="alert-circle"></i>{{ $errors->first('password') }}</span>
            @endif
          </div>

          <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:22px;flex-wrap:wrap">
            <label class="check">
              <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
              <span>Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" style="font-size:13.6px;color:var(--wine-700);font-weight:600">Forgot password?</a>
          </div>

          <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
        </form>

        <div style="display:flex;align-items:center;gap:14px;margin:26px 0">
          <hr style="flex:1"><span class="small muted">or</span><hr style="flex:1">
        </div>
        <div style="display:flex;gap:11px">
          <button class="btn btn-outline btn-block" data-action="demo-social"><i data-lucide="chrome"></i> Google</button>
          <button class="btn btn-outline btn-block" data-action="demo-social"><i data-lucide="github"></i> GitHub</button>
        </div>

        <div class="notice ivory" style="margin-top:26px;font-size:12.8px">
          <i data-lucide="info"></i>
          <span>Use <b>admin@verdantacademy.com</b> (Super Admin) or <b>student@verdantacademy.com</b> (Student) with password <b>password123</b>.</span>
        </div>

        <p style="text-align:center;margin-top:24px;font-size:13.6px">
          <a href="{{ route('home') }}" style="color:var(--wine-700);font-weight:600">← Back to homepage</a>
        </p>
      </div>
    </main>
  </div>
@endsection
