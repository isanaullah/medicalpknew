@extends('layouts.admin')

@section('title', 'FAQ Management — Verdant Academy')
@section('page-title', 'Frequently Asked Questions')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>FAQs</span>
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
      <h1>FAQ Management</h1>
      <p>{{ $faqs->total() }} frequently asked questions organized for students and visitors</p>
    </div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      <button class="btn btn-primary" onclick="document.getElementById('modalAddFaq').style.display='grid'">
        <i data-lucide="plus"></i> Add FAQ
      </button>
    </div>
  </div>

  <div class="table-wrap">
    <form method="GET" action="{{ route('admin.faqs') }}" class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" name="search" type="search" placeholder="Search questions or answers…" value="{{ request('search') }}">
      </div>

      <select name="category" class="select" style="max-width:180px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All categories">All categories</option>
        @foreach ($categories as $cat)
          <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
        @endforeach
      </select>

      <select name="status" class="select" style="max-width:160px;padding:9px 34px 9px 12px" onchange="this.form.submit()">
        <option value="All statuses">All statuses</option>
        <option value="Published" {{ request('status') === 'Published' ? 'selected' : '' }}>Published</option>
        <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
      </select>

      <button type="submit" class="btn btn-outline btn-sm">Filter</button>
      @if (request()->hasAny(['search', 'category', 'status']))
        <a href="{{ route('admin.faqs') }}" class="btn btn-outline btn-sm" style="margin-left:auto">
          <i data-lucide="filter-x"></i> Clear
        </a>
      @endif
    </form>

    <div class="table-scroll">
      <table class="tbl">
        <thead>
          <tr>
            <th style="width:60px">Order</th>
            <th>Question & Answer</th>
            <th>Category</th>
            <th>Status</th>
            <th>Updated</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($faqs as $faq)
            <tr>
              <td><b>#{{ $faq->order }}</b></td>
              <td>
                <div class="cell-main">
                  <div>
                    <div class="t">{{ $faq->question }}</div>
                    <div class="s" style="max-width:480px">{{ Str::limit($faq->answer, 90) }}</div>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge badge-amber">{{ $faq->category ?: 'General' }}</span>
              </td>
              <td>
                <span class="badge {{ $faq->status === 'Published' ? 'badge-success' : 'badge-amber' }}">
                  {{ $faq->status }}
                </span>
              </td>
              <td style="white-space:nowrap">{{ $faq->updated_at->format('d M Y') }}</td>
              <td>
                <div class="row-actions">
                  <button type="button" class="mini-btn" title="Edit FAQ" onclick="openEditFaqModal('{{ $faq->slug }}', '{{ addslashes($faq->question) }}', '{{ addslashes($faq->answer) }}', '{{ $faq->category }}', {{ $faq->order }}, '{{ $faq->status }}')">
                    <i data-lucide="pencil"></i>
                  </button>
                  <button type="button" class="mini-btn danger" title="Delete FAQ" data-action="delete-row" data-name="{{ addslashes(Str::limit($faq->question, 40)) }}" data-url="{{ route('admin.faqs.destroy', $faq->slug) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center;padding:36px;color:var(--ink-400)">
                No FAQs found matching your criteria.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($faqs->hasPages())
      <div class="table-foot">
        <span>Showing <b style="color:var(--ink-900)">{{ $faqs->firstItem() }}–{{ $faqs->lastItem() }}</b> of <b style="color:var(--ink-900)">{{ $faqs->total() }}</b> records</span>
        <div class="pager">
          @if ($faqs->onFirstPage())
            <button disabled><i data-lucide="chevron-left" style="width:14px;height:14px"></i></button>
          @else
            <a href="{{ $faqs->previousPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-left" style="width:14px;height:14px"></i></a>
          @endif

          @foreach ($faqs->getUrlRange(1, $faqs->lastPage()) as $p => $u)
            @if ($p == $faqs->currentPage())
              <button class="active">{{ $p }}</button>
            @else
              <a href="{{ $u }}" class="btn btn-sm btn-ghost">{{ $p }}</a>
            @endif
          @endforeach

          @if ($faqs->hasMorePages())
            <a href="{{ $faqs->nextPageUrl() }}" class="btn btn-sm btn-ghost"><i data-lucide="chevron-right" style="width:14px;height:14px"></i></a>
          @else
            <button disabled><i data-lucide="chevron-right" style="width:14px;height:14px"></i></button>
          @endif
        </div>
      </div>
    @endif
  </div>

  <!-- Modal: Add FAQ (Standard Sizing 720px) -->
  <div class="modal-root" id="modalAddFaq" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:720px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form method="POST" action="{{ route('admin.faqs.store') }}">
        @csrf
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Add FAQ</h3>
          <button type="button" class="close" onclick="document.getElementById('modalAddFaq').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Question <span style="color:var(--danger)">*</span></label>
            <input class="input" name="question" required placeholder="e.g. How do I get a certificate of completion?">
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Category</label>
              <select class="select" name="category">
                <option value="General">General</option>
                <option value="Payments">Payments</option>
                <option value="Certificates">Certificates</option>
                <option value="Access">Access</option>
                <option value="Learning">Learning</option>
                <option value="Technical">Technical</option>
                <option value="Support">Support</option>
              </select>
            </div>
            <div class="field">
              <label class="label">Display Order</label>
              <input class="input" type="number" name="order" value="1" min="0">
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Answer <span style="color:var(--danger)">*</span></label>
            <textarea class="textarea" name="answer" rows="4" required placeholder="Provide a comprehensive answer..."></textarea>
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label">Status</label>
            <select class="select" name="status">
              <option value="Published">Published</option>
              <option value="Draft">Draft</option>
            </select>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalAddFaq').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="plus"></i> Create FAQ</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Edit FAQ (Standard Sizing 720px) -->
  <div class="modal-root" id="modalEditFaq" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:720px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form id="formEditFaq" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Edit FAQ</h3>
          <button type="button" class="close" onclick="document.getElementById('modalEditFaq').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Question <span style="color:var(--danger)">*</span></label>
            <input class="input" id="editFaqQuestion" name="question" required>
          </div>

          <div class="grid g2 gap-sm" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="field">
              <label class="label">Category</label>
              <select class="select" id="editFaqCategory" name="category">
                <option value="General">General</option>
                <option value="Payments">Payments</option>
                <option value="Certificates">Certificates</option>
                <option value="Access">Access</option>
                <option value="Learning">Learning</option>
                <option value="Technical">Technical</option>
                <option value="Support">Support</option>
              </select>
            </div>
            <div class="field">
              <label class="label">Display Order</label>
              <input class="input" type="number" id="editFaqOrder" name="order" min="0">
            </div>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Answer <span style="color:var(--danger)">*</span></label>
            <textarea class="textarea" id="editFaqAnswer" name="answer" rows="4" required></textarea>
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label">Status</label>
            <select class="select" id="editFaqStatus" name="status">
              <option value="Published">Published</option>
              <option value="Draft">Draft</option>
            </select>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalEditFaq').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update FAQ</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function openEditFaqModal(slug, q, a, cat, order, status) {
        const form = document.getElementById('formEditFaq');
        form.action = `/admin/faqs/${slug}`;
        document.getElementById('editFaqQuestion').value = q;
        document.getElementById('editFaqAnswer').value = a;
        document.getElementById('editFaqCategory').value = cat || 'General';
        document.getElementById('editFaqOrder').value = order;
        document.getElementById('editFaqStatus').value = status;
        document.getElementById('modalEditFaq').style.display = 'grid';
        if (window.lucide) { lucide.createIcons(); }
      }
    </script>
  @endpush
@endsection
