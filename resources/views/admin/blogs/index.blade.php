@extends('layouts.admin')

@section('title', 'Blog Management — Verdant Academy')
@section('page-title', 'Blog & Editorial')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Blog Articles</span>
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
      <h1>Blog & Editorial Articles</h1>
      <p>{{ $articles->total() }} published and draft articles</p>
    </div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-primary" onclick="document.getElementById('modalAddArticle').style.display='grid'">
        <i data-lucide="plus"></i> New article
      </button>
    </div>
  </div>

  <div class="table-wrap">
    <form method="GET" action="{{ route('admin.blog') }}" class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" name="search" type="search" placeholder="Search articles…" value="{{ request('search') }}">
      </div>
      
      <select name="category" class="select" style="max-width:180px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All categories">All categories</option>
        @foreach ($categories as $cat)
          <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
      </select>

      <select name="status" class="select" style="max-width:160px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All statuses">All statuses</option>
        <option value="Published" {{ request('status') === 'Published' ? 'selected' : '' }}>Published</option>
        <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
        <option value="Archived" {{ request('status') === 'Archived' ? 'selected' : '' }}>Archived</option>
      </select>

      <button type="submit" class="btn btn-outline btn-sm">Filter</button>
      @if (request()->hasAny(['search', 'category', 'status']))
        <a href="{{ route('admin.blog') }}" class="btn btn-outline btn-sm" style="margin-left:auto">
          <i data-lucide="filter-x"></i> Clear
        </a>
      @endif
    </form>

    <div class="table-scroll">
      <table class="tbl">
        <thead>
          <tr>
            <th>Article</th>
            <th>Category</th>
            <th>Author</th>
            <th>Status</th>
            <th>Published</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($articles as $art)
            <tr>
              <td>
                <div class="cell-main">
                  @if ($art->featured_image)
                    <img src="{{ asset('storage/' . $art->featured_image) }}" alt="" style="width:48px;height:34px;object-fit:cover;border-radius:6px;flex:none" onerror="this.style.display='none'">
                  @else
                    <div class="stat-icon" style="width:40px;height:40px;border-radius:8px">
                      <i data-lucide="file-text"></i>
                    </div>
                  @endif
                  <div>
                    <div class="t">{{ $art->title }}</div>
                    <div class="s">/{{ $art->slug }}</div>
                  </div>
                </div>
              </td>
              <td>
                @if ($art->category)
                  <span class="badge badge-amber">{{ $art->category->name }}</span>
                @else
                  <span class="small muted">General</span>
                @endif
              </td>
              <td>{{ $art->author ? $art->author->name : 'Staff' }}</td>
              <td>
                <span class="badge {{ $art->status === 'Published' ? 'badge-success' : ($art->status === 'Draft' ? 'badge-amber' : 'badge-danger') }}">
                  {{ $art->status }}
                </span>
              </td>
              <td style="white-space:nowrap">{{ $art->published_at ? $art->published_at->format('d M Y') : 'Draft' }}</td>
              <td>
                <div class="row-actions">
                  <button type="button" class="mini-btn" title="Edit Article" onclick="openEditArticleModal('{{ $art->slug }}', '{{ addslashes($art->title) }}', '{{ addslashes($art->slug) }}', '{{ $art->blog_category_id }}', '{{ addslashes($art->excerpt ?? '') }}', '{{ addslashes($art->content ?? '') }}', '{{ $art->status }}', '{{ addslashes($art->seo_title ?? '') }}', '{{ addslashes($art->seo_description ?? '') }}')">
                    <i data-lucide="pencil"></i>
                  </button>
                  <button type="button" class="mini-btn danger" title="Delete Article" data-action="delete-row" data-name="{{ $art->title }}" data-url="{{ route('admin.blog.destroy', $art->slug) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center;padding:36px;color:var(--ink-400)">
                No blog articles found matching your criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($articles->hasPages())
      <div class="table-foot">
        <span>Showing <b style="color:var(--ink-900)">{{ $articles->firstItem() }}–{{ $articles->lastItem() }}</b> of <b style="color:var(--ink-900)">{{ $articles->total() }}</b> records</span>
        <div class="pager">
          @if ($articles->onFirstPage())
            <button disabled><i data-lucide="chevron-left" style="width:14px;height:14px"></i></button>
          @else
            <a href="{{ $articles->previousPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-left" style="width:14px;height:14px"></i></a>
          @endif

          @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $p => $u)
            @if ($p == $articles->currentPage())
              <button class="active">{{ $p }}</button>
            @else
              <a href="{{ $u }}" class="btn btn-sm btn-ghost">{{ $p }}</a>
            @endif
          @endforeach

          @if ($articles->hasMorePages())
            <a href="{{ $articles->nextPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-right" style="width:14px;height:14px"></i></a>
          @else
            <button disabled><i data-lucide="chevron-right" style="width:14px;height:14px"></i></button>
          @endif
        </div>
      </div>
    @endif
  </div>

  <!-- Modal: Add Article (Standard Sizing 950px) -->
  <div class="modal-root" id="modalAddArticle" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:950px;width:95%;box-shadow:var(--shadow-lg);max-height:90vh;overflow-y:auto">
      <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">New Blog Article</h3>
          <button type="button" class="close" onclick="document.getElementById('modalAddArticle').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Article Title <span style="color:var(--danger)">*</span></label>
            <input class="input" name="title" required placeholder="e.g. How to Choose Your First Programming Language">
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Category</label>
              <select class="select" name="blog_category_id">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <label class="label">Status <span style="color:var(--danger)">*</span></label>
              <select class="select" name="status">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
                <option value="Archived">Archived</option>
              </select>
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Featured Image</label>
            <input type="file" name="image_file" class="input" accept="image/*">
            <small class="muted">JPG, PNG, or WEBP up to 5 MB.</small>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Excerpt</label>
            <textarea class="textarea" name="excerpt" rows="2" placeholder="Short summary displayed on cards"></textarea>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Article Content <span style="color:var(--danger)">*</span></label>
            <textarea class="textarea" name="content" rows="6" required placeholder="Write the complete article content here..."></textarea>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="field">
              <label class="label">SEO Title</label>
              <input class="input" name="seo_title" placeholder="Optional meta title">
            </div>
            <div class="field">
              <label class="label">SEO Description</label>
              <input class="input" name="seo_description" placeholder="Optional meta description">
            </div>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalAddArticle').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Save Article</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Edit Article (Standard Sizing 950px) -->
  <div class="modal-root" id="modalEditArticle" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:950px;width:95%;box-shadow:var(--shadow-lg);max-height:90vh;overflow-y:auto">
      <form id="formEditArticle" method="POST" action="" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Edit Blog Article</h3>
          <button type="button" class="close" onclick="document.getElementById('modalEditArticle').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Article Title <span style="color:var(--danger)">*</span></label>
            <input class="input" id="editArtTitle" name="title" required>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Slug</label>
            <input class="input" id="editArtSlug" name="slug">
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Category</label>
              <select class="select" id="editArtCat" name="blog_category_id">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <label class="label">Status <span style="color:var(--danger)">*</span></label>
              <select class="select" id="editArtStatus" name="status">
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
                <option value="Archived">Archived</option>
              </select>
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Replace Featured Image</label>
            <input type="file" name="image_file" class="input" accept="image/*">
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Excerpt</label>
            <textarea class="textarea" id="editArtExcerpt" name="excerpt" rows="2"></textarea>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Article Content <span style="color:var(--danger)">*</span></label>
            <textarea class="textarea" id="editArtContent" name="content" rows="6" required></textarea>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="field">
              <label class="label">SEO Title</label>
              <input class="input" id="editArtSeoTitle" name="seo_title">
            </div>
            <div class="field">
              <label class="label">SEO Description</label>
              <input class="input" id="editArtSeoDesc" name="seo_description">
            </div>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalEditArticle').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update Article</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function openEditArticleModal(slug, title, displaySlug, catId, excerpt, content, status, seoTitle, seoDesc) {
        const form = document.getElementById('formEditArticle');
        form.action = `/admin/blog/${slug}`;
        document.getElementById('editArtTitle').value = title;
        document.getElementById('editArtSlug').value = displaySlug;
        document.getElementById('editArtCat').value = catId;
        document.getElementById('editArtExcerpt').value = excerpt;
        document.getElementById('editArtContent').value = content;
        document.getElementById('editArtStatus').value = status;
        document.getElementById('editArtSeoTitle').value = seoTitle;
        document.getElementById('editArtSeoDesc').value = seoDesc;
        document.getElementById('modalEditArticle').style.display = 'grid';
        if (window.lucide) { lucide.createIcons(); }
      }
    </script>
  @endpush
@endsection
