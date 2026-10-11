@extends('layouts.admin')

@section('title', 'Enrollments — Verdant Academy')
@section('page-title', 'Enrollments')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Enrollments</span>
  </nav>
  <div class="page-head">
    <div><h1>Enrollments</h1><p>10 recent enrollment records</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      
      <button class="btn btn-primary" data-action="new-enrollment" data-msg="Manual enrollment — demo form"><i data-lucide="plus"></i> Manual enrollment</button>
    </div>
  </div>
  <div class="table-wrap">
    <div class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" type="search" placeholder="Search enrollments…" data-action="table-search">
      </div>
      <select class="select" style="max-width:180px;padding:9px 34px 9px 12px" data-action="table-filter">
        <option>All statuses</option><option>Active</option><option>Inactive</option><option>Draft</option><option>Pending</option>
      </select>
      <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Filters cleared" style="margin-left:auto"><i data-lucide="filter-x"></i> Clear</button>
    </div>
    <div class="table-scroll">
      <table class="tbl">
        <thead><tr><th>Student</th><th>Course</th><th>Date</th><th>Progress</th><th>Amount</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=20" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Elena Petrova</div><div class="s">elena.petrova@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">The Complete Web Development Bootcamp</span></td>
      <td>14 Jan 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:86%"></i></div>
          <span class="small" style="font-weight:700">86%</span>
        </div>
      </td>
      <td><b>$89</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=32" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Sofia Lindberg</div><div class="s">sofia.lindberg@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Data Analytics with Python &amp; SQL</span></td>
      <td>25 Feb 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:94%"></i></div>
          <span class="small" style="font-weight:700">94%</span>
        </div>
      </td>
      <td><b>$99</b></td>
      <td><span class="badge badge-success">Completed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=15" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Daniel Okonkwo</div><div class="s">daniel.okonkwo@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Product Design Foundations</span></td>
      <td>06 Feb 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:41%"></i></div>
          <span class="small" style="font-weight:700">41%</span>
        </div>
      </td>
      <td><b>$79</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=24" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Claire Dubois</div><div class="s">claire.dubois@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Digital Marketing Strategy</span></td>
      <td>19 Apr 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:67%"></i></div>
          <span class="small" style="font-weight:700">67%</span>
        </div>
      </td>
      <td><b>$85</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=60" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Tomasz Kowalski</div><div class="s">tomasz.kowalski@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">The Complete Web Development Bootcamp</span></td>
      <td>31 May 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:78%"></i></div>
          <span class="small" style="font-weight:700">78%</span>
        </div>
      </td>
      <td><b>$89</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=51" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Rahul Mehta</div><div class="s">rahul.mehta@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">AWS Certified Cloud Practitioner</span></td>
      <td>10 Mar 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:9%"></i></div>
          <span class="small" style="font-weight:700">9%</span>
        </div>
      </td>
      <td><b>$0</b></td>
      <td><span class="badge badge-danger">Refunded</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=44" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Aisha Rahman</div><div class="s">aisha.rahman@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Python for Automation &amp; Scripting</span></td>
      <td>04 Jul 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:22%"></i></div>
          <span class="small" style="font-weight:700">22%</span>
        </div>
      </td>
      <td><b>$59</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=11" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Marco Bianchi</div><div class="s">marco.bianchi@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Advanced React &amp; TypeScript</span></td>
      <td>21 Aug 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:49%"></i></div>
          <span class="small" style="font-weight:700">49%</span>
        </div>
      </td>
      <td><b>$109</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=20" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Elena Petrova</div><div class="s">elena.petrova@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Data Analytics with Python &amp; SQL</span></td>
      <td>16 Jan 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:100%"></i></div>
          <span class="small" style="font-weight:700">100%</span>
        </div>
      </td>
      <td><b>$99</b></td>
      <td><span class="badge badge-success">Completed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=32" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Sofia Lindberg</div><div class="s">sofia.lindberg@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">UX Research Methods</span></td>
      <td>27 Feb 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:88%"></i></div>
          <span class="small" style="font-weight:700">88%</span>
        </div>
      </td>
      <td><b>$89</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr></tbody>
      </table>
    </div>
    <div class="mobile-list">
      
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=20" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Elena Petrova</div><div class="s">elena.petrova@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">The Complete Web Development Bootcamp</span></td>
      <td>14 Jan 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:86%"></i></div>
          <span class="small" style="font-weight:700">86%</span>
        </div>
      </td>
      <td><b>$89</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=32" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Sofia Lindberg</div><div class="s">sofia.lindberg@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Data Analytics with Python &amp; SQL</span></td>
      <td>25 Feb 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:94%"></i></div>
          <span class="small" style="font-weight:700">94%</span>
        </div>
      </td>
      <td><b>$99</b></td>
      <td><span class="badge badge-success">Completed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=15" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Daniel Okonkwo</div><div class="s">daniel.okonkwo@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Product Design Foundations</span></td>
      <td>06 Feb 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:41%"></i></div>
          <span class="small" style="font-weight:700">41%</span>
        </div>
      </td>
      <td><b>$79</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=24" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Claire Dubois</div><div class="s">claire.dubois@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Digital Marketing Strategy</span></td>
      <td>19 Apr 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:67%"></i></div>
          <span class="small" style="font-weight:700">67%</span>
        </div>
      </td>
      <td><b>$85</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=60" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Tomasz Kowalski</div><div class="s">tomasz.kowalski@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">The Complete Web Development Bootcamp</span></td>
      <td>31 May 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:78%"></i></div>
          <span class="small" style="font-weight:700">78%</span>
        </div>
      </td>
      <td><b>$89</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=51" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Rahul Mehta</div><div class="s">rahul.mehta@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">AWS Certified Cloud Practitioner</span></td>
      <td>10 Mar 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:9%"></i></div>
          <span class="small" style="font-weight:700">9%</span>
        </div>
      </td>
      <td><b>$0</b></td>
      <td><span class="badge badge-danger">Refunded</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=44" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Aisha Rahman</div><div class="s">aisha.rahman@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Python for Automation &amp; Scripting</span></td>
      <td>04 Jul 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:22%"></i></div>
          <span class="small" style="font-weight:700">22%</span>
        </div>
      </td>
      <td><b>$59</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=11" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Marco Bianchi</div><div class="s">marco.bianchi@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Advanced React &amp; TypeScript</span></td>
      <td>21 Aug 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:49%"></i></div>
          <span class="small" style="font-weight:700">49%</span>
        </div>
      </td>
      <td><b>$109</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=20" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Elena Petrova</div><div class="s">elena.petrova@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">Data Analytics with Python &amp; SQL</span></td>
      <td>16 Jan 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:100%"></i></div>
          <span class="small" style="font-weight:700">100%</span>
        </div>
      </td>
      <td><b>$99</b></td>
      <td><span class="badge badge-success">Completed</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=32" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Sofia Lindberg</div><div class="s">sofia.lindberg@example.com</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600;color:var(--ink-900)">UX Research Methods</span></td>
      <td>27 Feb 2025</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:120px">
          <div class="progress" style="flex:1"><i style="width:88%"></i></div>
          <span class="small" style="font-weight:700">88%</span>
        </div>
      </td>
      <td><b>$89</b></td>
      <td><span class="badge badge-forest">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Enrollment record opened" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="enrollment" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    </div>
    <div class="table-foot">
      <span>Showing <b style="color:var(--ink-900)">11811</b> records</span>
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
