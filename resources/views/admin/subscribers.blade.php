@extends('layouts.admin')

@section('title', 'Newsletter Subscribers — Verdant Academy')
@section('page-title', 'Newsletter Subscribers')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Newsletter Subscribers</span>
  </nav>
  <div class="page-head">
    <div><h1>Newsletter Subscribers</h1><p>5 subscribers · 4 active</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-outline" data-action="toast-demo" data-msg="Subscriber list exported as CSV"><i data-lucide="download"></i> Export CSV</button>
      <button class="btn btn-primary" data-action="new-subscriber" data-msg="Add subscriber — demo form"><i data-lucide="plus"></i> Add subscriber</button>
    </div>
  </div>
  <div class="table-wrap">
    <div class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" type="search" placeholder="Search by email…" data-action="table-search">
      </div>
      <select class="select" style="max-width:180px;padding:9px 34px 9px 12px" data-action="table-filter">
        <option>All statuses</option><option>Active</option><option>Inactive</option><option>Draft</option><option>Pending</option>
      </select>
      <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Filters cleared" style="margin-left:auto"><i data-lucide="filter-x"></i> Clear</button>
    </div>
    <div class="table-scroll">
      <table class="tbl">
        <thead><tr><th>Email</th><th>Subscribed</th><th>Source</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">julia.mendes@example.com</div></div>
        </div>
      </td>
      <td>08 Oct 2025</td>
      <td><span class="badge badge-ivory">Footer form</span></td>
      <td><span class="badge badge-success">Subscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="julia.mendes@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">ryan.oconnell@example.com</div></div>
        </div>
      </td>
      <td>06 Oct 2025</td>
      <td><span class="badge badge-ivory">Course page</span></td>
      <td><span class="badge badge-success">Subscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="ryan.oconnell@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">mei.tanaka@example.com</div></div>
        </div>
      </td>
      <td>04 Oct 2025</td>
      <td><span class="badge badge-ivory">Blog article</span></td>
      <td><span class="badge badge-success">Subscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="mei.tanaka@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">omar.khalil@example.com</div></div>
        </div>
      </td>
      <td>01 Oct 2025</td>
      <td><span class="badge badge-ivory">Footer form</span></td>
      <td><span class="badge badge-ivory">Unsubscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="omar.khalil@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">nadia.petrov@example.com</div></div>
        </div>
      </td>
      <td>28 Sep 2025</td>
      <td><span class="badge badge-ivory">Newsletter popup</span></td>
      <td><span class="badge badge-success">Subscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="nadia.petrov@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr></tbody>
      </table>
    </div>
    <div class="mobile-list">
      
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">julia.mendes@example.com</div></div>
        </div>
      </td>
      <td>08 Oct 2025</td>
      <td><span class="badge badge-ivory">Footer form</span></td>
      <td><span class="badge badge-success">Subscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="julia.mendes@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">ryan.oconnell@example.com</div></div>
        </div>
      </td>
      <td>06 Oct 2025</td>
      <td><span class="badge badge-ivory">Course page</span></td>
      <td><span class="badge badge-success">Subscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="ryan.oconnell@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">mei.tanaka@example.com</div></div>
        </div>
      </td>
      <td>04 Oct 2025</td>
      <td><span class="badge badge-ivory">Blog article</span></td>
      <td><span class="badge badge-success">Subscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="mei.tanaka@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">omar.khalil@example.com</div></div>
        </div>
      </td>
      <td>01 Oct 2025</td>
      <td><span class="badge badge-ivory">Footer form</span></td>
      <td><span class="badge badge-ivory">Unsubscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="omar.khalil@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <div class="stat-icon" style="width:40px;height:40px"><i data-lucide="send"></i></div>
          <div><div class="t">nadia.petrov@example.com</div></div>
        </div>
      </td>
      <td>28 Sep 2025</td>
      <td><span class="badge badge-ivory">Newsletter popup</span></td>
      <td><span class="badge badge-success">Subscribed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Subscriber removed" aria-label="Remove"><i data-lucide="user-minus"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="nadia.petrov@example.com" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    </div>
    <div class="table-foot">
      <span>Showing <b style="color:var(--ink-900)">4002</b> records</span>
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
