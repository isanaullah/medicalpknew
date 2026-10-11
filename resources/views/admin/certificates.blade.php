@extends('layouts.admin')

@section('title', 'Certificates Management — Verdant Academy')
@section('page-title', 'Certificates')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Certificates</span>
  </nav>
  <div class="page-head">
    <div><h1>Certificates</h1><p>4 certificates issued · 1,842 lifetime</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-outline" data-action="toast-demo" data-msg="Certificate template editor opened"><i data-lucide="palette"></i> Template</button>
      
    </div>
  </div>
  <div class="table-wrap">
    <div class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" type="search" placeholder="Search by serial or student…" data-action="table-search">
      </div>
      <select class="select" style="max-width:180px;padding:9px 34px 9px 12px" data-action="table-filter">
        <option>All statuses</option><option>Active</option><option>Inactive</option><option>Draft</option><option>Pending</option>
      </select>
      <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Filters cleared" style="margin-left:auto"><i data-lucide="filter-x"></i> Clear</button>
    </div>
    <div class="table-scroll">
      <table class="tbl">
        <thead><tr><th>Serial</th><th>Student</th><th>Course</th><th>Issued</th><th>Grade</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
    <tr>
      <td><span style="font-family:ui-monospace,Menlo,monospace;font-size:13px;font-weight:600;color:var(--wine-700)">VA-2025-002184</span></td>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=32" alt="" style="border-radius:50%;width:34px;height:34px" onerror="this.style.display='none'">
          <div><div class="t">Sofia Lindberg</div></div>
        </div>
      </td>
      <td><span class="small">Data Analytics with Python &amp; SQL</span></td>
      <td>26 Sep 2025</td>
      <td><span class="badge badge-gold">Distinction</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-cert" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Certificate PDF downloaded" aria-label="Download"><i data-lucide="download"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="VA-2025-002184" aria-label="Revoke"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td><span style="font-family:ui-monospace,Menlo,monospace;font-size:13px;font-weight:600;color:var(--wine-700)">VA-2025-002031</span></td>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=20" alt="" style="border-radius:50%;width:34px;height:34px" onerror="this.style.display='none'">
          <div><div class="t">Elena Petrova</div></div>
        </div>
      </td>
      <td><span class="small">Data Analytics with Python &amp; SQL</span></td>
      <td>14 Sep 2025</td>
      <td><span class="badge badge-forest">Merit</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-cert" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Certificate PDF downloaded" aria-label="Download"><i data-lucide="download"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="VA-2025-002031" aria-label="Revoke"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td><span style="font-family:ui-monospace,Menlo,monospace;font-size:13px;font-weight:600;color:var(--wine-700)">VA-2025-001897</span></td>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=60" alt="" style="border-radius:50%;width:34px;height:34px" onerror="this.style.display='none'">
          <div><div class="t">Tomasz Kowalski</div></div>
        </div>
      </td>
      <td><span class="small">Digital Marketing Strategy</span></td>
      <td>02 Sep 2025</td>
      <td><span class="badge badge-gold">Distinction</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-cert" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Certificate PDF downloaded" aria-label="Download"><i data-lucide="download"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="VA-2025-001897" aria-label="Revoke"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td><span style="font-family:ui-monospace,Menlo,monospace;font-size:13px;font-weight:600;color:var(--wine-700)">VA-2025-001744</span></td>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=24" alt="" style="border-radius:50%;width:34px;height:34px" onerror="this.style.display='none'">
          <div><div class="t">Claire Dubois</div></div>
        </div>
      </td>
      <td><span class="small">Product Design Foundations</span></td>
      <td>19 Aug 2025</td>
      <td><span class="badge badge-ivory">Pass</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-cert" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Certificate PDF downloaded" aria-label="Download"><i data-lucide="download"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="VA-2025-001744" aria-label="Revoke"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr></tbody>
      </table>
    </div>
    <div class="mobile-list">
      
    <tr>
      <td><span style="font-family:ui-monospace,Menlo,monospace;font-size:13px;font-weight:600;color:var(--wine-700)">VA-2025-002184</span></td>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=32" alt="" style="border-radius:50%;width:34px;height:34px" onerror="this.style.display='none'">
          <div><div class="t">Sofia Lindberg</div></div>
        </div>
      </td>
      <td><span class="small">Data Analytics with Python &amp; SQL</span></td>
      <td>26 Sep 2025</td>
      <td><span class="badge badge-gold">Distinction</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-cert" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Certificate PDF downloaded" aria-label="Download"><i data-lucide="download"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="VA-2025-002184" aria-label="Revoke"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td><span style="font-family:ui-monospace,Menlo,monospace;font-size:13px;font-weight:600;color:var(--wine-700)">VA-2025-002031</span></td>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=20" alt="" style="border-radius:50%;width:34px;height:34px" onerror="this.style.display='none'">
          <div><div class="t">Elena Petrova</div></div>
        </div>
      </td>
      <td><span class="small">Data Analytics with Python &amp; SQL</span></td>
      <td>14 Sep 2025</td>
      <td><span class="badge badge-forest">Merit</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-cert" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Certificate PDF downloaded" aria-label="Download"><i data-lucide="download"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="VA-2025-002031" aria-label="Revoke"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td><span style="font-family:ui-monospace,Menlo,monospace;font-size:13px;font-weight:600;color:var(--wine-700)">VA-2025-001897</span></td>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=60" alt="" style="border-radius:50%;width:34px;height:34px" onerror="this.style.display='none'">
          <div><div class="t">Tomasz Kowalski</div></div>
        </div>
      </td>
      <td><span class="small">Digital Marketing Strategy</span></td>
      <td>02 Sep 2025</td>
      <td><span class="badge badge-gold">Distinction</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-cert" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Certificate PDF downloaded" aria-label="Download"><i data-lucide="download"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="VA-2025-001897" aria-label="Revoke"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td><span style="font-family:ui-monospace,Menlo,monospace;font-size:13px;font-weight:600;color:var(--wine-700)">VA-2025-001744</span></td>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=24" alt="" style="border-radius:50%;width:34px;height:34px" onerror="this.style.display='none'">
          <div><div class="t">Claire Dubois</div></div>
        </div>
      </td>
      <td><span class="small">Product Design Foundations</span></td>
      <td>19 Aug 2025</td>
      <td><span class="badge badge-ivory">Pass</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-cert" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Certificate PDF downloaded" aria-label="Download"><i data-lucide="download"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="VA-2025-001744" aria-label="Revoke"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    </div>
    <div class="table-foot">
      <span>Showing <b style="color:var(--ink-900)">4393</b> records</span>
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
