@extends('layouts.admin')

@section('title', 'Category Management — Verdant Academy')
@section('page-title', 'Category Management')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Categories</span>
  </nav>

  @if (session('success'))
    <div style="padding:14px 18px;background:var(--success-bg);color:var(--success);border-radius:var(--radius);border:1px solid #cce1c4;margin-bottom:18px;display:flex;align-items:center;gap:10px">
      <i data-lucide="check-circle" style="width:18px;height:18px"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if (session('error'))
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:18px;display:flex;align-items:center;gap:10px">
      <i data-lucide="alert-circle" style="width:18px;height:18px"></i>
      <span>{{ session('error') }}</span>
    </div>
  @endif

  @if ($errors->any())
    <div style="padding:14px 18px;background:var(--danger-bg);color:var(--danger);border-radius:var(--radius);border:1px solid #f1c5c7;margin-bottom:18px">
      <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="page-head">
    <div>
      <h1>Category Management</h1>
      <p>{{ $categories->total() }} categories organising courses</p>
    </div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-primary" onclick="document.getElementById('modalAddCategory').style.display='grid'">
        <i data-lucide="plus"></i> Add category
      </button>
    </div>
  </div>

  <div class="table-wrap">
    <form method="GET" action="{{ route('admin.categories') }}" class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" name="search" type="search" placeholder="Search categories…" value="{{ request('search') }}">
      </div>
      <select name="status" class="select" style="max-width:180px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All statuses" {{ request('status') === 'All statuses' ? 'selected' : '' }}>All statuses</option>
        <option value="Active" {{ request('status') === 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ request('status') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
      </select>
      <button type="submit" class="btn btn-outline btn-sm">Filter</button>
      @if (request()->hasAny(['search', 'status']))
        <a href="{{ route('admin.categories') }}" class="btn btn-outline btn-sm" style="margin-left:auto">
          <i data-lucide="filter-x"></i> Clear
        </a>
      @endif
    </form>

    <div class="table-scroll">
      <table class="tbl">
        <thead>
          <tr>
            <th>Category</th>
            <th>Description</th>
            <th>Courses</th>
            <th>Status</th>
            <th>Updated</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categories as $cat)
            <tr>
              <td>
                <div class="cell-main">
                  <div class="stat-icon" style="width:40px;height:40px;border-radius:10px">
                    <i data-lucide="folder"></i>
                  </div>
                  <div>
                    <div class="t">{{ $cat->name }}</div>
                    <div class="s">/{{ $cat->slug }}</div>
                  </div>
                </div>
              </td>
              <td style="max-width:320px">
                <span class="small muted">{{ $cat->description ?: 'No description provided.' }}</span>
              </td>
              <td><b>{{ $cat->courses_count }}</b> courses</td>
              <td>
                <span class="badge {{ $cat->status === 'Active' ? 'badge-success' : 'badge-amber' }}">
                  {{ $cat->status }}
                </span>
              </td>
              <td style="white-space:nowrap">{{ $cat->updated_at->format('d M Y') }}</td>
              <td>
                <div class="row-actions">
                  <button type="button" class="mini-btn" title="Edit" onclick="openEditCategoryModal('{{ $cat->slug }}', '{{ addslashes($cat->name) }}', '{{ addslashes($cat->slug) }}', '{{ addslashes($cat->description ?? '') }}', '{{ $cat->status }}')">
                    <i data-lucide="pencil"></i>
                  </button>
                  <button type="button" class="mini-btn danger" title="Delete" data-action="delete-row" data-name="{{ $cat->name }}" data-url="{{ route('admin.categories.destroy', $cat->slug) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center;padding:32px;color:var(--ink-400)">
                No categories found matching your criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($categories->hasPages())
      <div class="table-foot">
        <span>Showing <b style="color:var(--ink-900)">{{ $categories->firstItem() }}–{{ $categories->lastItem() }}</b> of <b style="color:var(--ink-900)">{{ $categories->total() }}</b> records</span>
        <div class="pager">
          @if ($categories->onFirstPage())
            <button disabled><i data-lucide="chevron-left" style="width:14px;height:14px"></i></button>
          @else
            <a href="{{ $categories->previousPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-left" style="width:14px;height:14px"></i></a>
          @endif

          @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $p => $u)
            @if ($p == $categories->currentPage())
              <button class="active">{{ $p }}</button>
            @else
              <a href="{{ $u }}" class="btn btn-sm btn-ghost">{{ $p }}</a>
            @endif
          @endforeach

          @if ($categories->hasMorePages())
            <a href="{{ $categories->nextPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-right" style="width:14px;height:14px"></i></a>
          @else
            <button disabled><i data-lucide="chevron-right" style="width:14px;height:14px"></i></button>
          @endif
        </div>
      </div>
    @endif
  </div>

  <!-- Modal: Add Category (Standard width 680px) -->
  <div class="modal-root" id="modalAddCategory" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:680px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Add Category</h3>
          <button type="button" class="close" onclick="document.getElementById('modalAddCategory').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>
        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Category Name <span style="color:var(--danger)">*</span></label>
            <input class="input" name="name" required placeholder="e.g. Web Development">
          </div>
          <div class="field" style="margin-bottom:16px">
            <label class="label">Slug (optional)</label>
            <input class="input" name="slug" placeholder="web-development (leave blank to auto-generate)">
          </div>
          <div class="field" style="margin-bottom:16px">
            <label class="label">Description</label>
            <textarea class="textarea" name="description" rows="3" placeholder="Brief overview of courses in this category"></textarea>
          </div>
          <div class="field" style="margin-bottom:0">
            <label class="label">Status <span style="color:var(--danger)">*</span></label>
            <select class="select" name="status" required>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalAddCategory').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="plus"></i> Create category</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Edit Category (Standard width 680px) -->
  <div class="modal-root" id="modalEditCategory" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:680px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form id="formEditCategory" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Edit Category</h3>
          <button type="button" class="close" onclick="document.getElementById('modalEditCategory').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>
        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Category Name <span style="color:var(--danger)">*</span></label>
            <input class="input" id="editCatName" name="name" required>
          </div>
          <div class="field" style="margin-bottom:16px">
            <label class="label">Slug</label>
            <input class="input" id="editCatSlug" name="slug" required>
          </div>
          <div class="field" style="margin-bottom:16px">
            <label class="label">Description</label>
            <textarea class="textarea" id="editCatDesc" name="description" rows="3"></textarea>
          </div>
          <div class="field" style="margin-bottom:0">
            <label class="label">Status <span style="color:var(--danger)">*</span></label>
            <select class="select" id="editCatStatus" name="status" required>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalEditCategory').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update category</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function openEditCategoryModal(slug, name, displaySlug, desc, status) {
        const form = document.getElementById('formEditCategory');
        form.action = `/admin/categories/${slug}`;
        document.getElementById('editCatName').value = name;
        document.getElementById('editCatSlug').value = displaySlug;
        document.getElementById('editCatDesc').value = desc;
        document.getElementById('editCatStatus').value = status;
        document.getElementById('modalEditCategory').style.display = 'grid';
        if (window.lucide) { lucide.createIcons(); }
      }
    </script>
  @endpush
@endsection
