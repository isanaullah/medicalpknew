@extends('layouts.student')

@section('title', 'Notifications — Verdant Academy')
@section('page-title', 'Notifications')

@section('content')
<div class="page-head">
    <div><h1>Notifications</h1><p>2 unread</p></div>
    <button class="btn btn-outline" data-action="toast-demo" data-msg="All notifications marked as read"><i data-lucide="check-check"></i> Mark all as read</button>
  </div>
  <div class="card" style="padding:4px 24px">
    
      <div class="activity" style="padding:18px 0;">
        <div class="a-ic" style=""><i data-lucide="award"></i></div>
        <div style="flex:1">
          <div class="a-t"><b>You earned a certificate in Data Analytics with Python &amp; SQL</b> <span class="badge badge-gold" style="margin-left:7px">New</span></div>
          <p class="small muted" style="margin-top:5px;line-height:1.62;max-width:640px">Congratulations! Your certificate is now available to download and share.</p>
          <div class="a-time">2 days ago</div>
        </div>
        <button class="mini-btn" data-action="toast-demo" data-msg="Notification dismissed" aria-label="Dismiss"><i data-lucide="x"></i></button>
      </div>
      <div class="activity" style="padding:18px 0;">
        <div class="a-ic" style=""><i data-lucide="message-square"></i></div>
        <div style="flex:1">
          <div class="a-t"><b>Marcus Feld replied to your question</b> <span class="badge badge-gold" style="margin-left:7px">New</span></div>
          <p class="small muted" style="margin-top:5px;line-height:1.62;max-width:640px">&quot;Great question — the reason we use sessions here is to avoid storing tokens in localStorage…&quot;</p>
          <div class="a-time">4 days ago</div>
        </div>
        <button class="mini-btn" data-action="toast-demo" data-msg="Notification dismissed" aria-label="Dismiss"><i data-lucide="x"></i></button>
      </div>
      <div class="activity" style="padding:18px 0;opacity:.72">
        <div class="a-ic" style="background:var(--cream-200);color:var(--ink-400);border-color:var(--cream-300)"><i data-lucide="sparkles"></i></div>
        <div style="flex:1">
          <div class="a-t"><b>New course in a category you follow</b> </div>
          <p class="small muted" style="margin-top:5px;line-height:1.62;max-width:640px">Product Design Foundations has been updated with four new lessons on design systems.</p>
          <div class="a-time">1 week ago</div>
        </div>
        <button class="mini-btn" data-action="toast-demo" data-msg="Notification dismissed" aria-label="Dismiss"><i data-lucide="x"></i></button>
      </div>
      <div class="activity" style="padding:18px 0;opacity:.72">
        <div class="a-ic" style="background:var(--cream-200);color:var(--ink-400);border-color:var(--cream-300)"><i data-lucide="megaphone"></i></div>
        <div style="flex:1">
          <div class="a-t"><b>Scheduled maintenance this Sunday</b> </div>
          <p class="small muted" style="margin-top:5px;line-height:1.62;max-width:640px">The platform will be unavailable between 02:00 and 04:00 UTC for scheduled maintenance.</p>
          <div class="a-time">2 weeks ago</div>
        </div>
        <button class="mini-btn" data-action="toast-demo" data-msg="Notification dismissed" aria-label="Dismiss"><i data-lucide="x"></i></button>
      </div>
      <div class="activity" style="padding:18px 0;opacity:.72">
        <div class="a-ic" style="background:var(--cream-200);color:var(--ink-400);border-color:var(--cream-300)"><i data-lucide="tag"></i></div>
        <div style="flex:1">
          <div class="a-t"><b>A course on your wishlist is on sale</b> </div>
          <p class="small muted" style="margin-top:5px;line-height:1.62;max-width:640px">Advanced React &amp; TypeScript is currently 45% off. The offer ends in 3 days.</p>
          <div class="a-time">3 weeks ago</div>
        </div>
        <button class="mini-btn" data-action="toast-demo" data-msg="Notification dismissed" aria-label="Dismiss"><i data-lucide="x"></i></button>
      </div>
  </div>
@endsection
