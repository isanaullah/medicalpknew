@extends('layouts.admin')

@section('title', 'Website Settings — Verdant Academy')
@section('page-title', 'Website Settings')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Website Settings</span>
  </nav>

  @if (session('success'))
    <div style="padding:14px 18px;background:var(--success-bg);color:var(--success);border-radius:var(--radius);border:1px solid #cce1c4;margin-bottom:18px;display:flex;align-items:center;gap:10px">
      <i data-lucide="check-circle" style="width:18px;height:18px"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if (session('error'))
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:18px;display:flex;align-items:center;gap:10px">
      <i data-lucide="alert-circle" style="width:18px;height:18px"></i>
      <span>{{ session('error') }}</span>
    </div>
  @endif

  @if ($errors->any())
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:18px">
      <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="page-head">
      <div>
        <h1>Website Settings</h1>
        <p>Database-backed brand identity, contact information, social links and SEO defaults</p>
      </div>
      <button type="submit" class="btn btn-primary">
        <i data-lucide="save"></i> Save all changes
      </button>
    </div>

    <div class="grid" style="grid-template-columns:1fr 1fr;gap:24px;align-items:start" id="settings-grid">
      <div>
        <!-- Brand Identity -->
        <div class="card" style="padding:24px;margin-bottom:24px">
          <h2 style="font-size:16px;margin-top:0;margin-bottom:6px;color:var(--wine-900)">Brand Identity</h2>
          <p class="small muted" style="margin-bottom:20px">Website name, tagline, logo, and favicon.</p>

          <div style="display:flex;gap:20px;align-items:center;margin-bottom:22px;flex-wrap:wrap">
            <div style="width:64px;height:64px;border-radius:12px;background:var(--cream-100);display:grid;place-items:center;overflow:hidden;border:1px solid var(--cream-300)">
              @if (!empty($settings['logo']))
                <img src="{{ Storage::disk('public')->url($settings['logo']) }}" alt="Logo" style="max-width:100%;max-height:100%;object-fit:contain">
              @else
                <div class="logo-mark" style="width:48px;height:48px"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19 L12 5 L20 19"/><path d="M8.5 14 h7"/></svg></div>
              @endif
            </div>
            <div>
              <label class="btn btn-outline btn-sm" style="cursor:pointer">
                <i data-lucide="upload"></i> Upload new logo
                <input type="file" name="logo_file" accept="image/*" hidden onchange="this.form.submit()">
              </label>
              <p class="small muted" style="margin-top:8px">SVG, PNG, or JPG up to 2 MB.</p>
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label" for="s-name">Website Name <span style="color:var(--danger)">*</span></label>
            <input id="s-name" name="website_name" class="input" type="text" required value="{{ old('website_name', $settings['website_name'] ?? 'Verdant Academy') }}">
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label" for="s-tag">Tagline</label>
            <input id="s-tag" name="tagline" class="input" type="text" value="{{ old('tagline', $settings['tagline'] ?? '') }}" placeholder="e.g. Learn skills that matter.">
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label">Favicon Icon (Optional)</label>
            <input type="file" name="favicon_file" class="input" accept="image/x-icon,image/png,image/svg+xml">
            <small class="muted">ICO, PNG, or SVG icon file.</small>
          </div>
        </div>

        <!-- Contact Information -->
        <div class="card" style="padding:24px">
          <h2 style="font-size:16px;margin-top:0;margin-bottom:6px;color:var(--wine-900)">Contact Information</h2>
          <p class="small muted" style="margin-bottom:20px">Displayed in the website footer and on student support pages.</p>

          <div class="field" style="margin-bottom:16px">
            <label class="label" for="s-email">Contact / Support Email</label>
            <input id="s-email" name="contact_email" class="input" type="email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label" for="s-phone">Contact Phone Number</label>
            <input id="s-phone" name="contact_phone" class="input" type="tel" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label" for="s-addr">Physical Address</label>
            <textarea id="s-addr" name="address" class="textarea" rows="3">{{ old('address', $settings['address'] ?? '') }}</textarea>
          </div>
        </div>
      </div>

      <div>
        <!-- Social Media Profiles -->
        <div class="card" style="padding:24px;margin-bottom:24px">
          <h2 style="font-size:16px;margin-top:0;margin-bottom:6px;color:var(--wine-900)">Social Media Profiles</h2>
          <p class="small muted" style="margin-bottom:20px">External links shown in footer and header.</p>

          <div class="field" style="margin-bottom:14px">
            <label class="label">YouTube Channel</label>
            <input name="social_youtube" class="input" type="url" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}" placeholder="https://youtube.com/@...">
          </div>

          <div class="field" style="margin-bottom:14px">
            <label class="label">LinkedIn Profile / Page</label>
            <input name="social_linkedin" class="input" type="url" value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}" placeholder="https://linkedin.com/company/...">
          </div>

          <div class="field" style="margin-bottom:14px">
            <label class="label">Twitter / X</label>
            <input name="social_twitter" class="input" type="url" value="{{ old('social_twitter', $settings['social_twitter'] ?? '') }}" placeholder="https://twitter.com/...">
          </div>

          <div class="field" style="margin-bottom:14px">
            <label class="label">Facebook Page</label>
            <input name="social_facebook" class="input" type="url" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" placeholder="https://facebook.com/...">
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label">Instagram Profile</label>
            <input name="social_instagram" class="input" type="url" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" placeholder="https://instagram.com/...">
          </div>
        </div>

        <!-- SEO Defaults -->
        <div class="card" style="padding:24px">
          <h2 style="font-size:16px;margin-top:0;margin-bottom:6px;color:var(--wine-900)">Global SEO Defaults</h2>
          <p class="small muted" style="margin-bottom:20px">Default meta tags for search engines and social sharing.</p>

          <div class="field" style="margin-bottom:16px">
            <label class="label" for="s-seotitle">Default SEO Title</label>
            <input id="s-seotitle" name="default_seo_title" class="input" type="text" value="{{ old('default_seo_title', $settings['default_seo_title'] ?? '') }}">
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label" for="s-seodesc">Default SEO Description</label>
            <textarea id="s-seodesc" name="default_seo_description" class="textarea" rows="3">{{ old('default_seo_description', $settings['default_seo_description'] ?? '') }}</textarea>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
