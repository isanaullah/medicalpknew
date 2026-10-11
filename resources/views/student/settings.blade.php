@extends('layouts.student')

@section('title', 'Profile Settings — Verdant Academy')
@section('page-title', 'Profile Settings')

@section('content')
<div class="page-head">
    <div><h1>Profile Settings</h1><p>Manage your personal information and learning preferences</p></div>
  </div>
  <div class="settings-grid">
    <nav class="settings-nav">
      <a href="{{ route('student.settings') }}" class="active"><i data-lucide="user"></i> Profile</a>
      <a href="{{ route('student.settings') }}"><i data-lucide="bell"></i> Notifications</a>
      <a href="{{ route('student.settings') }}"><i data-lucide="palette"></i> Preferences</a>
      <a href="{{ route('student.password') }}"><i data-lucide="key-round"></i> Password</a>
      <a href="{{ route('student.settings') }}"><i data-lucide="credit-card"></i> Billing</a>
    </nav>
    <div>
      <form data-action="profile" class="card card-pad" style="margin-bottom:20px" novalidate>
        <h2 style="font-size:16.4px;margin-bottom:6px">Personal information</h2>
        <p class="small muted" style="margin-bottom:22px">This information appears on your certificates and public profile.</p>

        <div style="display:flex;gap:22px;align-items:center;margin-bottom:26px;flex-wrap:wrap">
          <img id="avatarPreview" src="https://i.pravatar.cc/160?img=20" alt="Profile photo" style="width:88px;height:88px;border-radius:50%;object-fit:cover;border:3px solid var(--cream-200);box-shadow:0 4px 12px rgba(32,8,15,.1)" onerror="this.style.display='none'">
          <div>
            <div style="display:flex;gap:9px;flex-wrap:wrap">
              <label class="btn btn-outline btn-sm" style="cursor:pointer">
                <i data-lucide="upload"></i> Upload photo
                <input type="file" accept="image/*" data-action="avatar-input" hidden>
              </label>
              <button type="button" class="btn btn-ghost btn-sm" data-action="toast-demo" data-msg="Photo removed">Remove</button>
            </div>
            <p class="small muted" style="margin-top:8px">JPG or PNG, maximum 2 MB. Recommended 400×400 px.</p>
          </div>
        </div>

        <div class="grid g2 gap-sm" style="gap:0 18px">
          <div class="field">
            <label class="label" for="p-first">First name</label>
            <input id="p-first" class="input" type="text" value="Elena">
          </div>
          <div class="field">
            <label class="label" for="p-last">Last name</label>
            <input id="p-last" class="input" type="text" value="Petrova">
          </div>
        </div>
        <div class="field">
          <label class="label" for="p-email">Email address</label>
          <input id="p-email" class="input" type="email" value="elena.petrova@example.com">
        </div>
        <div class="field">
          <label class="label" for="p-bio">Short bio</label>
          <textarea id="p-bio" class="textarea" style="min-height:100px" placeholder="Tell instructors and classmates a little about yourself…">Data analyst transitioning into machine learning. Currently working through the Python and SQL programme.</textarea>
        </div>
        <div class="grid g2 gap-sm" style="gap:0 18px">
          <div class="field">
            <label class="label" for="p-country">Country</label>
            <select id="p-country" class="select">
              <option>United Kingdom</option><option>Germany</option><option>Poland</option>
              <option>Portugal</option><option>Nigeria</option><option>India</option>
            </select>
          </div>
          <div class="field">
            <label class="label" for="p-tz">Time zone</label>
            <select id="p-tz" class="select">
              <option>GMT (London)</option><option>CET (Berlin)</option><option>EST (New York)</option>
              <option>IST (Mumbai)</option>
            </select>
          </div>
        </div>
        <div style="display:flex;gap:10px;margin-top:6px">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="reset" class="btn btn-ghost">Cancel</button>
        </div>
        <p class="form-msg" aria-live="polite"></p>
      </form>

      <div class="card card-pad">
        <h2 style="font-size:16.4px;margin-bottom:6px">Email preferences</h2>
        <p class="small muted" style="margin-bottom:18px">Choose which emails you'd like to receive.</p>
        
          <div style="display:flex;justify-content:space-between;align-items:center;gap:18px;padding:14px 0;border-bottom:1px solid var(--cream-200)">
            <div>
              <div style="font-size:14.2px;font-weight:600;color:var(--ink-900)">Course announcements</div>
              <div class="small muted" style="margin-top:3px">New lessons and updates in courses you are enrolled in</div>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" checked data-action="pref-toggle">
              <span class="toggle-slider"></span>
            </label>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;gap:18px;padding:14px 0;border-bottom:1px solid var(--cream-200)">
            <div>
              <div style="font-size:14.2px;font-weight:600;color:var(--ink-900)">Weekly learning digest</div>
              <div class="small muted" style="margin-top:3px">A summary of your progress and suggested next steps</div>
            </div>
            <label class="toggle-switch">
              <input type="checkbox" checked data-action="pref-toggle">
              <span class="toggle-slider"></span>
            </label>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;gap:18px;padding:14px 0;border-bottom:1px solid var(--cream-200)">
            <div>
              <div style="font-size:14.2px;font-weight:600;color:var(--ink-900)">New course launches</div>
              <div class="small muted" style="margin-top:3px">Be first to know when we publish new programmes</div>
            </div>
            <label class="toggle-switch">
              <input type="checkbox"  data-action="pref-toggle">
              <span class="toggle-slider"></span>
            </label>
          </div>
          <div style="display:flex;justify-content:space-between;align-items:center;gap:18px;padding:14px 0;border-bottom:1px solid var(--cream-200)">
            <div>
              <div style="font-size:14.2px;font-weight:600;color:var(--ink-900)">Book releases & offers</div>
              <div class="small muted" style="margin-top:3px">New Verdant Press titles and bundle deals</div>
            </div>
            <label class="toggle-switch">
              <input type="checkbox"  data-action="pref-toggle">
              <span class="toggle-slider"></span>
            </label>
          </div>
      </div>
    </div>
  </div>
@endsection
