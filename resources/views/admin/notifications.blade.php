@extends('layouts.admin')

@section('title', 'Announcements & Notifications — Verdant Academy')
@section('page-title', 'Notifications')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Notifications</span>
  </nav>
  <div class="page-head">
    <div><h1>Notifications</h1><p>Create and manage announcements sent to students and subscribers</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      
      <button class="btn btn-primary" data-action="new-notification" data-msg="New announcement — demo form"><i data-lucide="plus"></i> New announcement</button>
    </div>
  </div>
  <div class="table-wrap">
    <div class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" type="search" placeholder="Search announcements…" data-action="table-search">
      </div>
      <select class="select" style="max-width:180px;padding:9px 34px 9px 12px" data-action="table-filter">
        <option>All statuses</option><option>Active</option><option>Inactive</option><option>Draft</option><option>Pending</option>
      </select>
      <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Filters cleared" style="margin-left:auto"><i data-lucide="filter-x"></i> Clear</button>
    </div>
    <div class="table-scroll">
      <table class="tbl">
        <thead><tr><th>Title</th><th>Audience</th><th>Date</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="megaphone"></i></div>
          <div><div class="t">New course launch: Advanced React &amp; TypeScript</div><div class="s">All students</div></div>
        </div>
      </td>
      <td>All students</td>
      <td>08 Oct 2025</td>
      <td><span class="badge badge-success">Sent</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Notification resent" aria-label="Resend"><i data-lucide="send"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="New course launch: Advanced React &amp; TypeScript" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="megaphone"></i></div>
          <div><div class="t">Scheduled maintenance — Sunday 02:00 UTC</div><div class="s">All users</div></div>
        </div>
      </td>
      <td>All users</td>
      <td>05 Oct 2025</td>
      <td><span class="badge badge-success">Sent</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Notification resent" aria-label="Resend"><i data-lucide="send"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Scheduled maintenance — Sunday 02:00 UTC" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="megaphone"></i></div>
          <div><div class="t">Scholarship applications now open</div><div class="s">Subscribers</div></div>
        </div>
      </td>
      <td>Subscribers</td>
      <td>01 Oct 2025</td>
      <td><span class="badge badge-warn">Draft</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Notification resent" aria-label="Resend"><i data-lucide="send"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Scholarship applications now open" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr></tbody>
      </table>
    </div>
    <div class="mobile-list">
      
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="megaphone"></i></div>
          <div><div class="t">New course launch: Advanced React &amp; TypeScript</div><div class="s">All students</div></div>
        </div>
      </td>
      <td>All students</td>
      <td>08 Oct 2025</td>
      <td><span class="badge badge-success">Sent</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Notification resent" aria-label="Resend"><i data-lucide="send"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="New course launch: Advanced React &amp; TypeScript" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="megaphone"></i></div>
          <div><div class="t">Scheduled maintenance — Sunday 02:00 UTC</div><div class="s">All users</div></div>
        </div>
      </td>
      <td>All users</td>
      <td>05 Oct 2025</td>
      <td><span class="badge badge-success">Sent</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Notification resent" aria-label="Resend"><i data-lucide="send"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Scheduled maintenance — Sunday 02:00 UTC" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="megaphone"></i></div>
          <div><div class="t">Scholarship applications now open</div><div class="s">Subscribers</div></div>
        </div>
      </td>
      <td>Subscribers</td>
      <td>01 Oct 2025</td>
      <td><span class="badge badge-warn">Draft</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Notification resent" aria-label="Resend"><i data-lucide="send"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Scholarship applications now open" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    </div>
    <div class="table-foot">
      <span>Showing <b style="color:var(--ink-900)">2459</b> records</span>
      <div class="pager">
        <button disabled><i data-lucide="chevron-left" style="width:14px;height:14px"></i></button>
        <button class="active">1</button>
        <button>2</button>
        <button>3</button>
        <button><i data-lucide="chevron-right" style="width:14px;height:14px"></i></button>
      </div>
    </div>
  </div>
@endsection
