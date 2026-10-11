@extends('layouts.admin')

@section('title', 'Website Pages — Verdant Academy')
@section('page-title', 'Website Pages')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Pages</span>
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
      <h1>Website Pages</h1>
      <p>{{ $pages->total() }} institutional and legal website pages</p>
    </div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-primary" onclick="document.getElementById('modalAddPage').style.display='grid'">
        <i data-lucide="plus"></i> Add new page
      </button>
    </div>
  </div>

  <div class="table-wrap">
    <form method="GET" action="{{ route('admin.pages') }}" class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" name="search" type="search" placeholder="Search pages…" value="{{ request('search') }}">
      </div>

      <select name="status" class="select" style="max-width:160px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All statuses">All statuses</option>
        <option value="Published" {{ request('status') === 'Published' ? 'selected' : '' }}>Published</option>
        <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
      </select>

      <button type="submit" class="btn btn-outline btn-sm">Filter</button>
      @if (request()->hasAny(['search', 'status']))
        <a href="{{ route('admin.pages') }}" class="btn btn-outline btn-sm" style="margin-left:auto">
          <i data-lucide="filter-x"></i> Clear
        </a>
      @endif
    </form>

    <div class="table-scroll">
      <table class="tbl">
        <thead>
          <tr>
            <th>Page Title</th>
            <th>URL Route</th>
            <th>SEO Title</th>
            <th>Status</th>
            <th>Updated</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pages as $page)
            <tr>
              <td>
                <div class="cell-main">
                  <div class="stat-icon" style="width:40px;height:40px;border-radius:8px">
                    <i data-lucide="layout"></i>
                  </div>
                  <div>
                    <div class="t">{{ $page->title }}</div>
                    <div class="s">{{ Str::limit($page->content, 60) }}</div>
                  </div>
                </div>
              </td>
              <td><code>/{{ $page->slug }}</code></td>
              <td><span class="small muted">{{ $page->meta_title ?: 'Standard' }}</span></td>
              <td>
                <span class="badge {{ $page->status === 'Published' ? 'badge-success' : 'badge-amber' }}">
                  {{ $page->status }}
                </span>
              </td>
              <td style="white-space:nowrap">{{ $page->updated_at->format('d M Y') }}</td>
              <td>
                <div class="row-actions">
                  <a href="{{ route('admin.pages.visual-edit', $page->slug) }}" class="mini-btn" title="Visual Live Editor" target="_blank" style="color:var(--mustard-600)">
                    <i data-lucide="sparkles"></i>
                  </a>
                  <button type="button" class="mini-btn" title="Edit Page" onclick="openEditPageModal('{{ $page->slug }}', '{{ addslashes($page->title) }}', '{{ addslashes($page->slug) }}', '{{ addslashes($page->content ?? '') }}', '{{ addslashes($page->meta_title ?? '') }}', '{{ addslashes($page->meta_description ?? '') }}', '{{ $page->status }}')">
                    <i data-lucide="pencil"></i>
                  </button>
                  <button type="button" class="mini-btn danger" title="Delete Page" data-action="delete-row" data-name="{{ $page->title }}" data-url="{{ route('admin.pages.destroy', $page->slug) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center;padding:36px;color:var(--ink-400)">
                No pages found matching your search.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($pages->hasPages())
      <div class="table-foot">
        <span>Showing <b style="color:var(--ink-900)">{{ $pages->firstItem() }}–{{ $pages->lastItem() }}</b> of <b style="color:var(--ink-900)">{{ $pages->total() }}</b> records</span>
        <div class="pager">
          @if ($pages->onFirstPage())
            <button disabled><i data-lucide="chevron-left" style="width:14px;height:14px"></i></button>
          @else
            <a href="{{ $pages->previousPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-left" style="width:14px;height:14px"></i></a>
          @endif

          @foreach ($pages->getUrlRange(1, $pages->lastPage()) as $p => $u)
            @if ($p == $pages->currentPage())
              <button class="active">{{ $p }}</button>
            @else
              <a href="{{ $u }}" class="btn btn-sm btn-ghost">{{ $p }}</a>
            @endif
          @endforeach

          @if ($pages->hasMorePages())
            <a href="{{ $pages->nextPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-right" style="width:14px;height:14px"></i></a>
          @else
            <button disabled><i data-lucide="chevron-right" style="width:14px;height:14px"></i></button>
          @endif
        </div>
      </div>
    @endif
  </div>

  <!-- Modal: Add Page (Standard Sizing 950px) -->
  <div class="modal-root" id="modalAddPage" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:950px;width:95%;box-shadow:var(--shadow-lg);max-height:90vh;overflow-y:auto">
      <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Add Website Page</h3>
          <button type="button" class="close" onclick="document.getElementById('modalAddPage').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Page Title <span style="color:var(--danger)">*</span></label>
            <input class="input" name="title" required placeholder="e.g. Terms & Conditions">
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Slug (Optional)</label>
              <input class="input" name="slug" placeholder="e.g. terms (auto-generated if empty)">
            </div>
            <div class="field">
              <label class="label">Status</label>
              <select class="select" name="status">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
              </select>
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Page Content <span style="color:var(--danger)">*</span></label>
            <textarea class="textarea" name="content" rows="8" required placeholder="Full page body text..."></textarea>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="field">
              <label class="label">Meta Title (SEO)</label>
              <input class="input" name="meta_title" placeholder="Browser title tag">
            </div>
            <div class="field">
              <label class="label">Meta Description (SEO)</label>
              <input class="input" name="meta_description" placeholder="Brief search engine snippet">
            </div>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalAddPage').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="plus"></i> Create Page</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Edit Page (Standard Sizing 950px) -->
  <div class="modal-root" id="modalEditPage" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:950px;width:95%;box-shadow:var(--shadow-lg);max-height:90vh;overflow-y:auto">
      <form id="formEditPage" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Edit Website Page</h3>
          <button type="button" class="close" onclick="document.getElementById('modalEditPage').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Page Title <span style="color:var(--danger)">*</span></label>
            <input class="input" id="editPageTitle" name="title" required>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Slug</label>
              <input class="input" id="editPageSlug" name="slug">
            </div>
            <div class="field">
              <label class="label">Status</label>
              <select class="select" id="editPageStatus" name="status">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
              </select>
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Page Content <span style="color:var(--danger)">*</span></label>
            <textarea class="textarea" id="editPageContent" name="content" rows="8" required></textarea>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="field">
              <label class="label">Meta Title (SEO)</label>
              <input class="input" id="editPageMetaTitle" name="meta_title">
            </div>
            <div class="field">
              <label class="label">Meta Description (SEO)</label>
              <input class="input" id="editPageMetaDesc" name="meta_description">
            </div>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalEditPage').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update Page</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function openEditPageModal(slug, title, displaySlug, content, metaTitle, metaDesc, status) {
        const form = document.getElementById('formEditPage');
        form.action = `/admin/pages/${slug}`;
        document.getElementById('editPageTitle').value = title;
        document.getElementById('editPageSlug').value = displaySlug;
        document.getElementById('editPageContent').value = content;
        document.getElementById('editPageMetaTitle').value = metaTitle;
        document.getElementById('editPageMetaDesc').value = metaDesc;
        document.getElementById('editPageStatus').value = status;
        document.getElementById('modalEditPage').style.display = 'grid';
        if (window.lucide) { lucide.createIcons(); }
      }
    </script>
  @endpush
@endsection
