@extends('layouts.admin')

@section('title', 'Instructor Management — Verdant Academy')
@section('page-title', 'Instructor Management')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Instructors</span>
  </nav>
  <div class="page-head">
    <div><h1>Instructor Management</h1><p>6 active instructors across 8 disciplines</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      
      <button class="btn btn-primary" data-action="new-instructor" data-msg="Add instructor — demo form"><i data-lucide="plus"></i> Add instructor</button>
    </div>
  </div>
  <div class="table-wrap">
    <div class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" type="search" placeholder="Search instructors…" data-action="table-search">
      </div>
      <select class="select" style="max-width:180px;padding:9px 34px 9px 12px" data-action="table-filter">
        <option>All statuses</option><option>Active</option><option>Inactive</option><option>Draft</option><option>Pending</option>
      </select>
      <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Filters cleared" style="margin-left:auto"><i data-lucide="filter-x"></i> Clear</button>
    </div>
    <div class="table-scroll">
      <table class="tbl">
        <thead><tr><th>Instructor</th><th>Email</th><th>Expertise</th><th>Courses</th><th>Students</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=45" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Dr. Amara Osei</div><div class="s">Lead Data Scientist</div></div>
        </div>
      </td>
      <td><span class="small">dr.amara.osei@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">Python</span><span class="badge badge-ivory" style="margin-right:4px">Machine Learning</span><span class="badge badge-ivory" style="margin-right:4px">SQL</span></td>
      <td><b>6</b></td>
      <td>18,420</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Dr. Amara Osei" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i1" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Dr. Amara Osei" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=12" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Marcus Feld</div><div class="s">Full-Stack Engineer</div></div>
        </div>
      </td>
      <td><span class="small">marcus.feld@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">JavaScript</span><span class="badge badge-ivory" style="margin-right:4px">Node.js</span><span class="badge badge-ivory" style="margin-right:4px">PostgreSQL</span></td>
      <td><b>8</b></td>
      <td>22,130</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Marcus Feld" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i2" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Marcus Feld" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=47" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Priya Raghunathan</div><div class="s">Product Design Director</div></div>
        </div>
      </td>
      <td><span class="small">priya.raghunathan@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">Figma</span><span class="badge badge-ivory" style="margin-right:4px">UX Research</span><span class="badge badge-ivory" style="margin-right:4px">Design Systems</span></td>
      <td><b>5</b></td>
      <td>14,680</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Priya Raghunathan" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i3" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Priya Raghunathan" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=33" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Jonas Lindqvist</div><div class="s">Cloud Architect</div></div>
        </div>
      </td>
      <td><span class="small">jonas.lindqvist@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">AWS</span><span class="badge badge-ivory" style="margin-right:4px">Kubernetes</span><span class="badge badge-ivory" style="margin-right:4px">Terraform</span></td>
      <td><b>4</b></td>
      <td>9,270</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Jonas Lindqvist" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i4" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Jonas Lindqvist" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=26" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Helena Marchetti</div><div class="s">Growth Marketing Lead</div></div>
        </div>
      </td>
      <td><span class="small">helena.marchetti@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">SEO</span><span class="badge badge-ivory" style="margin-right:4px">Paid Media</span><span class="badge badge-ivory" style="margin-right:4px">Analytics</span></td>
      <td><b>5</b></td>
      <td>11,400</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Helena Marchetti" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i5" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Helena Marchetti" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=59" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Samuel Adeyemi</div><div class="s">Engineering Manager</div></div>
        </div>
      </td>
      <td><span class="small">samuel.adeyemi@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">System Design</span><span class="badge badge-ivory" style="margin-right:4px">Leadership</span><span class="badge badge-ivory" style="margin-right:4px">Go</span></td>
      <td><b>3</b></td>
      <td>7,890</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Samuel Adeyemi" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i6" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Samuel Adeyemi" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr></tbody>
      </table>
    </div>
    <div class="mobile-list">
      
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=45" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Dr. Amara Osei</div><div class="s">Lead Data Scientist</div></div>
        </div>
      </td>
      <td><span class="small">dr.amara.osei@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">Python</span><span class="badge badge-ivory" style="margin-right:4px">Machine Learning</span><span class="badge badge-ivory" style="margin-right:4px">SQL</span></td>
      <td><b>6</b></td>
      <td>18,420</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Dr. Amara Osei" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i1" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Dr. Amara Osei" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=12" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Marcus Feld</div><div class="s">Full-Stack Engineer</div></div>
        </div>
      </td>
      <td><span class="small">marcus.feld@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">JavaScript</span><span class="badge badge-ivory" style="margin-right:4px">Node.js</span><span class="badge badge-ivory" style="margin-right:4px">PostgreSQL</span></td>
      <td><b>8</b></td>
      <td>22,130</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Marcus Feld" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i2" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Marcus Feld" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=47" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Priya Raghunathan</div><div class="s">Product Design Director</div></div>
        </div>
      </td>
      <td><span class="small">priya.raghunathan@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">Figma</span><span class="badge badge-ivory" style="margin-right:4px">UX Research</span><span class="badge badge-ivory" style="margin-right:4px">Design Systems</span></td>
      <td><b>5</b></td>
      <td>14,680</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Priya Raghunathan" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i3" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Priya Raghunathan" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=33" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Jonas Lindqvist</div><div class="s">Cloud Architect</div></div>
        </div>
      </td>
      <td><span class="small">jonas.lindqvist@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">AWS</span><span class="badge badge-ivory" style="margin-right:4px">Kubernetes</span><span class="badge badge-ivory" style="margin-right:4px">Terraform</span></td>
      <td><b>4</b></td>
      <td>9,270</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Jonas Lindqvist" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i4" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Jonas Lindqvist" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=26" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Helena Marchetti</div><div class="s">Growth Marketing Lead</div></div>
        </div>
      </td>
      <td><span class="small">helena.marchetti@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">SEO</span><span class="badge badge-ivory" style="margin-right:4px">Paid Media</span><span class="badge badge-ivory" style="margin-right:4px">Analytics</span></td>
      <td><b>5</b></td>
      <td>11,400</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Helena Marchetti" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i5" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Helena Marchetti" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=59" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Samuel Adeyemi</div><div class="s">Engineering Manager</div></div>
        </div>
      </td>
      <td><span class="small">samuel.adeyemi@verdantacademy.com</span></td>
      <td><span class="badge badge-ivory" style="margin-right:4px">System Design</span><span class="badge badge-ivory" style="margin-right:4px">Leadership</span><span class="badge badge-ivory" style="margin-right:4px">Go</span></td>
      <td><b>3</b></td>
      <td>7,890</td>
      <td><span class="badge badge-success">Active</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Viewing Samuel Adeyemi" aria-label="View"><i data-lucide="eye"></i></button>
          <button class="mini-btn" data-action="edit-instructor" data-id="i6" aria-label="Edit"><i data-lucide="pencil"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="Samuel Adeyemi" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    </div>
    <div class="table-foot">
      <span>Showing <b style="color:var(--ink-900)">7416</b> records</span>
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
