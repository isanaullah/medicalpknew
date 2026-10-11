@extends('layouts.admin')

@section('title', 'Media Library — Verdant Academy')
@section('page-title', 'Media Library')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Media Library</span>
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
      <h1>Media Library</h1>
      <p>{{ $mediaItems->total() }} uploaded files, course images, banners, and documents</p>
    </div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-primary" onclick="document.getElementById('modalUploadMedia').style.display='grid'">
        <i data-lucide="upload"></i> Upload Media
      </button>
    </div>
  </div>

  <div class="table-wrap">
    <form method="GET" action="{{ route('admin.media') }}" class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" name="search" type="search" placeholder="Search by file name or title…" value="{{ request('search') }}">
      </div>

      <select name="type" class="select" style="max-width:180px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All types">All types</option>
        <option value="Images" {{ request('type') === 'Images' ? 'selected' : '' }}>Images</option>
        <option value="Documents" {{ request('type') === 'Documents' ? 'selected' : '' }}>Documents / PDFs</option>
        <option value="Videos" {{ request('type') === 'Videos' ? 'selected' : '' }}>Videos</option>
      </select>

      <button type="submit" class="btn btn-outline btn-sm">Filter</button>
      @if (request()->hasAny(['search', 'type']))
        <a href="{{ route('admin.media') }}" class="btn btn-outline btn-sm" style="margin-left:auto">
          <i data-lucide="filter-x"></i> Clear
        </a>
      @endif
    </form>

    <div style="padding:20px">
      @if ($mediaItems->isEmpty())
        <div style="text-align:center;padding:48px;color:var(--ink-400)">
          <i data-lucide="image" style="width:48px;height:48px;margin-bottom:10px"></i>
          <p style="margin:0;font-size:15px">No media files found matching your search.</p>
        </div>
      @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(220px, 1fr));gap:20px">
          @foreach ($mediaItems as $item)
            <div class="card" style="display:flex;flex-direction:column;overflow:hidden;border:1px solid var(--cream-300)">
              <div style="height:140px;background:var(--cream-100);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative">
                @if ($item->isImage())
                  <img src="{{ $item->url }}" alt="{{ $item->alt_text }}" style="width:100%;height:100%;object-fit:cover">
                @else
                  <div style="text-align:center;color:var(--ink-400)">
                    <i data-lucide="{{ $item->icon_name }}" style="width:40px;height:40px"></i>
                    <div style="font-size:11px;font-weight:600;margin-top:4px;text-transform:uppercase">{{ pathinfo($item->name, PATHINFO_EXTENSION) }}</div>
                  </div>
                @endif
              </div>

              <div style="padding:14px;flex:1;display:flex;flex-direction:column;justify-content:space-between">
                <div>
                  <div style="font-weight:600;font-size:13.6px;color:var(--ink-900);overflow:hidden;text-overflow:ellipsis;white-space:nowrap" title="{{ $item->name }}">
                    {{ $item->name }}
                  </div>
                  <div class="small muted" style="margin-top:4px">
                    {{ $item->formatted_size }} · {{ $item->created_at->format('d M Y') }}
                  </div>
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:14px;padding-top:10px;border-top:1px solid var(--cream-200)">
                  <button type="button" class="mini-btn" title="Copy URL" onclick="copyMediaUrl('{{ $item->url }}')">
                    <i data-lucide="copy"></i>
                  </button>
                  <a href="{{ $item->url }}" target="_blank" class="mini-btn" title="View Full File">
                    <i data-lucide="external-link"></i>
                  </a>
                  <button type="button" class="mini-btn danger" title="Delete File" data-action="delete-row" data-name="{{ $item->name }}" data-url="{{ route('admin.media.destroy', $item->id) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>

    @if ($mediaItems->hasPages())
      <div class="table-foot">
        <span>Showing <b style="color:var(--ink-900)">{{ $mediaItems->firstItem() }}–{{ $mediaItems->lastItem() }}</b> of <b style="color:var(--ink-900)">{{ $mediaItems->total() }}</b> records</span>
        <div class="pager">
          @if ($mediaItems->onFirstPage())
            <button disabled><i data-lucide="chevron-left" style="width:14px;height:14px"></i></button>
          @else
            <a href="{{ $mediaItems->previousPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-left" style="width:14px;height:14px"></i></a>
          @endif

          @foreach ($mediaItems->getUrlRange(1, $mediaItems->lastPage()) as $p => $u)
            @if ($p == $mediaItems->currentPage())
              <button class="active">{{ $p }}</button>
            @else
              <a href="{{ $u }}" class="btn btn-sm btn-ghost">{{ $p }}</a>
            @endif
          @endforeach

          @if ($mediaItems->hasMorePages())
            <a href="{{ $mediaItems->nextPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-right" style="width:14px;height:14px"></i></a>
          @else
            <button disabled><i data-lucide="chevron-right" style="width:14px;height:14px"></i></button>
          @endif
        </div>
      </div>
    @endif
  </div>

  <!-- Modal: Upload Media (Standard Sizing 700px) -->
  <div class="modal-root" id="modalUploadMedia" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:700px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Upload File to Media Library</h3>
          <button type="button" class="close" onclick="document.getElementById('modalUploadMedia').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Select File <span style="color:var(--danger)">*</span></label>
            <input type="file" name="file" class="input" required>
            <small class="muted">Images, PDFs, audio, or video up to 50 MB.</small>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Alt Text (For accessibility & SEO)</label>
            <input class="input" name="alt_text" placeholder="Descriptive alternative text for screen readers">
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Title (Optional)</label>
            <input class="input" name="title" placeholder="Descriptive title">
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label">Description (Optional)</label>
            <textarea class="textarea" name="description" rows="2" placeholder="Asset usage notes"></textarea>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalUploadMedia').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="upload"></i> Upload</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function copyMediaUrl(url) {
        if (navigator.clipboard) {
          navigator.clipboard.writeText(url).then(function() {
            if (typeof window.toast === 'function') {
              window.toast('URL Copied', 'Media asset link copied to clipboard.', '');
            }
          });
        }
      }
    </script>
  @endpush
@endsection
