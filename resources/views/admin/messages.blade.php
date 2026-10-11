@extends('layouts.admin')

@section('title', 'Contact Messages — Verdant Academy')
@section('page-title', 'Contact Messages')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Contact Messages</span>
  </nav>
  <div class="page-head">
    <div><h1>Contact Messages</h1><p>4 messages · 2 unread</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      
      
    </div>
  </div>
  <div class="table-wrap">
    <div class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" type="search" placeholder="Search messages…" data-action="table-search">
      </div>
      <select class="select" style="max-width:180px;padding:9px 34px 9px 12px" data-action="table-filter">
        <option>All statuses</option><option>Active</option><option>Inactive</option><option>Draft</option><option>Pending</option>
      </select>
      <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Filters cleared" style="margin-left:auto"><i data-lucide="filter-x"></i> Clear</button>
    </div>
    <div class="table-scroll">
      <table class="tbl">
        <thead><tr><th>From</th><th>Subject</th><th>Date</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="mail"></i></div>
          <div><div class="t">Karen Whitfield</div><div class="s">k.whitfield@northgate.co</div></div>
        </div>
      </td>
      <td><span style="font-weight:600;font-size:13.4px;color:var(--ink-900)">Corporate training enquiry</span></td>
      <td>08 Oct 2025</td>
      <td><span class="badge badge-danger">Unread</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-message" data-id="m1" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="reply-message" data-id="m1" aria-label="Reply"><i data-lucide="reply"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="message" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="mail"></i></div>
          <div><div class="t">Ahmed Hassan</div><div class="s">ahmed.h@example.com</div></div>
        </div>
      </td>
      <td><span style="font-weight:600;font-size:13.4px;color:var(--ink-900)">Certificate verification</span></td>
      <td>07 Oct 2025</td>
      <td><span class="badge badge-ivory">Read</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-message" data-id="m2" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="reply-message" data-id="m2" aria-label="Reply"><i data-lucide="reply"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="message" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="mail"></i></div>
          <div><div class="t">Lucia Ferreira</div><div class="s">lucia.f@example.com</div></div>
        </div>
      </td>
      <td><span style="font-weight:600;font-size:13.4px;color:var(--ink-900)">Payment issue</span></td>
      <td>05 Oct 2025</td>
      <td><span class="badge badge-danger">Unread</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-message" data-id="m3" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="reply-message" data-id="m3" aria-label="Reply"><i data-lucide="reply"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="message" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="mail"></i></div>
          <div><div class="t">Peter Nowak</div><div class="s">p.nowak@example.com</div></div>
        </div>
      </td>
      <td><span style="font-weight:600;font-size:13.4px;color:var(--ink-900)">Partnership proposal</span></td>
      <td>01 Oct 2025</td>
      <td><span class="badge badge-success">Replied</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-message" data-id="m4" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="reply-message" data-id="m4" aria-label="Reply"><i data-lucide="reply"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="message" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr></tbody>
      </table>
    </div>
    <div class="mobile-list">
      
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="mail"></i></div>
          <div><div class="t">Karen Whitfield</div><div class="s">k.whitfield@northgate.co</div></div>
        </div>
      </td>
      <td><span style="font-weight:600;font-size:13.4px;color:var(--ink-900)">Corporate training enquiry</span></td>
      <td>08 Oct 2025</td>
      <td><span class="badge badge-danger">Unread</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-message" data-id="m1" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="reply-message" data-id="m1" aria-label="Reply"><i data-lucide="reply"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="message" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="mail"></i></div>
          <div><div class="t">Ahmed Hassan</div><div class="s">ahmed.h@example.com</div></div>
        </div>
      </td>
      <td><span style="font-weight:600;font-size:13.4px;color:var(--ink-900)">Certificate verification</span></td>
      <td>07 Oct 2025</td>
      <td><span class="badge badge-ivory">Read</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-message" data-id="m2" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="reply-message" data-id="m2" aria-label="Reply"><i data-lucide="reply"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="message" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="mail"></i></div>
          <div><div class="t">Lucia Ferreira</div><div class="s">lucia.f@example.com</div></div>
        </div>
      </td>
      <td><span style="font-weight:600;font-size:13.4px;color:var(--ink-900)">Payment issue</span></td>
      <td>05 Oct 2025</td>
      <td><span class="badge badge-danger">Unread</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-message" data-id="m3" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="reply-message" data-id="m3" aria-label="Reply"><i data-lucide="reply"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="message" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="mail"></i></div>
          <div><div class="t">Peter Nowak</div><div class="s">p.nowak@example.com</div></div>
        </div>
      </td>
      <td><span style="font-weight:600;font-size:13.4px;color:var(--ink-900)">Partnership proposal</span></td>
      <td>01 Oct 2025</td>
      <td><span class="badge badge-success">Replied</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-message" data-id="m4" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="reply-message" data-id="m4" aria-label="Reply"><i data-lucide="reply"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="message" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    </div>
    <div class="table-foot">
      <span>Showing <b style="color:var(--ink-900)">3847</b> records</span>
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
