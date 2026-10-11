@extends('layouts.admin')

@section('title', 'Student Management — Verdant Academy')
@section('page-title', 'Student Management')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Students</span>
  </nav>
  <div class="page-head">
    <div><h1>Student Management</h1><p>8 students · 6 active</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-outline" data-action="toast-demo" data-msg="Student data exported"><i data-lucide="download"></i> Export</button>
      <button class="btn btn-primary" data-action="new-student" data-msg="Add student — demo form"><i data-lucide="plus"></i> Add student</button>
    </div>
  </div>
  <div class="table-wrap">
    <div class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" type="search" placeholder="Search by name or email…" data-action="table-search">
      </div>
      <select class="select" style="max-width:180px;padding:9px 34px 9px 12px" data-action="table-filter">
        <option>All statuses</option><option>Active</option><option>Inactive</option><option>Draft</option><option>Pending</option>
      </select>
      <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Filters cleared" style="margin-left:auto"><i data-lucide="filter-x"></i> Clear</button>
    </div>
    <div class="table-scroll">
      <table class="tbl">
        <thead><tr><th>Student</th><th>Joined</th><th>Enrolled</th><th>Progress</th><th>Spent</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=20" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Elena Petrova</div><div class="s">elena.petrova@example.com</div></div>
        </div>
      </td>
      <td>12 Jan 2025</td>
      <td><b>4</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:72%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">72%</span>
        </div>
      </td>
      <td><b>$348</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s1" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Elena Petrova" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Elena Petrova" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>03 Feb 2025</td>
      <td><b>2</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:45%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">45%</span>
        </div>
      </td>
      <td><b>$168</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s2" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Daniel Okonkwo" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Daniel Okonkwo" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>22 Feb 2025</td>
      <td><b>6</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:91%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">91%</span>
        </div>
      </td>
      <td><b>$512</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s3" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Sofia Lindberg" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Sofia Lindberg" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>08 Mar 2025</td>
      <td><b>1</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:12%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">12%</span>
        </div>
      </td>
      <td><b>$89</b></td>
      <td><span class="badge badge-ivory">Inactive</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s4" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Rahul Mehta" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Rahul Mehta" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>17 Apr 2025</td>
      <td><b>3</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:63%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">63%</span>
        </div>
      </td>
      <td><b>$263</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s5" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Claire Dubois" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Claire Dubois" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>29 May 2025</td>
      <td><b>5</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:80%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">80%</span>
        </div>
      </td>
      <td><b>$441</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s6" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Tomasz Kowalski" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Tomasz Kowalski" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>02 Jul 2025</td>
      <td><b>2</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:28%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">28%</span>
        </div>
      </td>
      <td><b>$158</b></td>
      <td><span class="badge badge-warn">Pending</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s7" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Aisha Rahman" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Aisha Rahman" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>19 Aug 2025</td>
      <td><b>3</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:54%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">54%</span>
        </div>
      </td>
      <td><b>$247</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s8" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Marco Bianchi" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Marco Bianchi" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>12 Jan 2025</td>
      <td><b>4</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:72%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">72%</span>
        </div>
      </td>
      <td><b>$348</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s1" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Elena Petrova" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Elena Petrova" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>03 Feb 2025</td>
      <td><b>2</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:45%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">45%</span>
        </div>
      </td>
      <td><b>$168</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s2" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Daniel Okonkwo" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Daniel Okonkwo" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>22 Feb 2025</td>
      <td><b>6</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:91%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">91%</span>
        </div>
      </td>
      <td><b>$512</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s3" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Sofia Lindberg" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Sofia Lindberg" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>08 Mar 2025</td>
      <td><b>1</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:12%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">12%</span>
        </div>
      </td>
      <td><b>$89</b></td>
      <td><span class="badge badge-ivory">Inactive</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s4" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Rahul Mehta" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Rahul Mehta" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>17 Apr 2025</td>
      <td><b>3</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:63%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">63%</span>
        </div>
      </td>
      <td><b>$263</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s5" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Claire Dubois" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Claire Dubois" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>29 May 2025</td>
      <td><b>5</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:80%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">80%</span>
        </div>
      </td>
      <td><b>$441</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s6" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Tomasz Kowalski" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Tomasz Kowalski" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>02 Jul 2025</td>
      <td><b>2</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:28%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">28%</span>
        </div>
      </td>
      <td><b>$158</b></td>
      <td><span class="badge badge-warn">Pending</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s7" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Aisha Rahman" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Aisha Rahman" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
      <td>19 Aug 2025</td>
      <td><b>3</b> courses</td>
      <td>
        <div style="display:flex;align-items:center;gap:9px;min-width:130px">
          <div class="progress" style="flex:1"><i style="width:54%"></i></div>
          <span class="small" style="font-weight:700;color:var(--wine-800)">54%</span>
        </div>
      </td>
      <td><b>$247</b></td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="view-student" data-id="s8" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Editing Marco Bianchi" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Marco Bianchi" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    </div>
    <div class="table-foot">
      <span>Showing <b style="color:var(--ink-900)">9977</b> records</span>
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
