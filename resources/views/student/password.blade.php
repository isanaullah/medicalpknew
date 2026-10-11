@extends('layouts.student')

@section('title', 'Change Password — Verdant Academy')
@section('page-title', 'Change Password')

@section('content')
<div class="page-head">
    <div><h1>Change Password</h1><p>Keep your account secure with a strong, unique password</p></div>
  </div>
  <div class="settings-grid">
    <nav class="settings-nav">
      <a href="{{ route('student.settings') }}"><i data-lucide="user"></i> Profile</a>
      <a href="{{ route('student.settings') }}"><i data-lucide="bell"></i> Notifications</a>
      <a href="{{ route('student.settings') }}"><i data-lucide="palette"></i> Preferences</a>
      <a href="{{ route('student.password') }}" class="active"><i data-lucide="key-round"></i> Password</a>
      <a href="{{ route('student.settings') }}"><i data-lucide="credit-card"></i> Billing</a>
    </nav>
    <div>
      <form data-action="change-password" class="card card-pad" style="max-width:560px" novalidate>
        <h2 style="font-size:16.4px;margin-bottom:6px">Update your password</h2>
        <p class="small muted" style="margin-bottom:26px">You will be signed out of other devices after changing your password.</p>

        <div class="field">
          <label class="label" for="cp-current">Current password</label>
          <div class="input-icon">
            <i data-lucide="lock"></i>
            <input id="cp-current" name="current" class="input" type="password" required placeholder="Enter current password" style="padding-right:42px">
            <button type="button" class="pw-toggle" data-action="toggle-pw" aria-label="Show password"><i data-lucide="eye"></i></button>
          </div>
          <span class="field-error"><i data-lucide="alert-circle"></i>Please enter your current password.</span>
        </div>
        <div class="field">
          <label class="label" for="cp-new">New password</label>
          <div class="input-icon">
            <i data-lucide="key-round"></i>
            <input id="cp-new" name="newpass" class="input" type="password" required placeholder="At least 8 characters" style="padding-right:42px">
            <button type="button" class="pw-toggle" data-action="toggle-pw" aria-label="Show password"><i data-lucide="eye"></i></button>
          </div>
          <span class="field-error"><i data-lucide="alert-circle"></i>Password must be at least 8 characters.</span>
        </div>
        <div class="field">
          <label class="label" for="cp-confirm">Confirm new password</label>
          <div class="input-icon">
            <i data-lucide="key-round"></i>
            <input id="cp-confirm" name="confirm" class="input" type="password" required placeholder="Re-enter new password" style="padding-right:42px">
            <button type="button" class="pw-toggle" data-action="toggle-pw" aria-label="Show password"><i data-lucide="eye"></i></button>
          </div>
          <span class="field-error"><i data-lucide="alert-circle"></i>Passwords do not match.</span>
        </div>

        <div class="notice ivory" style="margin-bottom:20px;font-size:12.8px">
          <i data-lucide="shield-check"></i>
          <span>Use at least 8 characters with a mix of letters, numbers and symbols. Avoid reusing passwords from other sites.</span>
        </div>

        <button type="submit" class="btn btn-primary">Update password</button>
        <p class="form-msg" aria-live="polite"></p>
      </form>
    </div>
  </div>
@endsection
