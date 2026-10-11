@extends('layouts.admin')

@section('title', 'PDF Study Notes: ' . $lesson->title . ' — Verdant Academy')
@section('page-title', 'Lesson PDF Notes')

@section('content')
  <nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span>
    <a href="{{ route('admin.courses') }}">Courses</a><span class="sep">/</span>
    <a href="{{ route('admin.curriculum', ['course_id' => $lesson->course->slug]) }}">Curriculum</a><span class="sep">/</span>
    <span>{{ $lesson->title }} Notes</span>
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
      <h1>PDF Study Notes: {{ $lesson->title }}</h1>
      <p>Course: <b style="color:var(--wine-800)">{{ $lesson->course->title }}</b> · {{ $notes->count() }} uploaded notes</p>
    </div>
    <div style="display:flex;gap:10px">
      <a href="{{ route('admin.curriculum', ['course_id' => $lesson->course->slug]) }}" class="btn btn-outline">
        <i data-lucide="arrow-left"></i> Back to Curriculum
      </a>
      <button class="btn btn-primary" onclick="document.getElementById('modalAddNote').style.display='grid'">
        <i data-lucide="upload"></i> Upload PDF Note
      </button>
    </div>
  </div>

  <div class="table-wrap">
    <div class="table-scroll">
      <table class="tbl">
        <thead>
          <tr>
            <th>Document</th>
            <th>Description</th>
            <th>Size</th>
            <th>Status</th>
            <th>Uploaded</th>
            <th style="text-align:right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($notes as $note)
            <tr>
              <td>
                <div class="cell-main">
                  <div class="stat-icon" style="width:38px;height:38px;border-radius:8px;background:var(--wine-50);color:var(--wine-700);border:1px solid var(--wine-200)">
                    <i data-lucide="file-text"></i>
                  </div>
                  <div>
                    <div class="t">{{ $note->title }}</div>
                    <div class="s">{{ $note->file_name }}</div>
                  </div>
                </div>
              </td>
              <td style="max-width:320px">
                <span class="small muted">{{ $note->description ?: 'No description provided.' }}</span>
              </td>
              <td><b>{{ $note->formatted_size }}</b></td>
              <td>
                <span class="badge {{ $note->status === 'Active' ? 'badge-success' : 'badge-amber' }}">
                  {{ $note->status }}
                </span>
              </td>
              <td style="white-space:nowrap">{{ $note->created_at->format('d M Y') }}</td>
              <td>
                <div class="row-actions">
                  <a href="{{ route('admin.lessons.notes.download', $note->id) }}" class="mini-btn" title="Download & Preview PDF" target="_blank">
                    <i data-lucide="download"></i>
                  </a>
                  <button type="button" class="mini-btn" title="Edit Note" onclick="openEditNoteModal({{ $note->id }}, '{{ addslashes($note->title) }}', '{{ addslashes($note->description ?? '') }}', '{{ $note->status }}')">
                    <i data-lucide="pencil"></i>
                  </button>
                  <button type="button" class="mini-btn danger" title="Delete Note" data-action="delete-row" data-name="{{ $note->title }}" data-url="{{ route('admin.lessons.notes.destroy', $note->id) }}">
                    <i data-lucide="trash-2"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align:center;padding:36px;color:var(--ink-400)">
                <i data-lucide="file" style="width:36px;height:36px;margin-bottom:8px"></i>
                <p style="margin:0">No PDF notes uploaded for this lesson yet.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal: Upload PDF Note (Standard Sizing 700px) -->
  <div class="modal-root" id="modalAddNote" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:700px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form method="POST" action="{{ route('admin.lessons.notes.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Upload PDF Study Note</h3>
          <button type="button" class="close" onclick="document.getElementById('modalAddNote').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Note Title <span style="color:var(--danger)">*</span></label>
            <input class="input" name="title" required placeholder="e.g. Chapter Summary & Architecture Cheatsheet">
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Select PDF File <span style="color:var(--danger)">*</span></label>
            <input type="file" name="pdf_file" class="input" accept="application/pdf" required>
            <small class="muted">Stored securely in private application storage. Max 20 MB.</small>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Description (Optional)</label>
            <textarea class="textarea" name="description" rows="3" placeholder="Overview of what is contained in this document"></textarea>
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label">Status <span style="color:var(--danger)">*</span></label>
            <select class="select" name="status">
              <option value="Active">Active (Available to enrolled students)</option>
              <option value="Inactive">Inactive (Hidden)</option>
            </select>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalAddNote').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="upload"></i> Upload Note</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Edit PDF Note (Standard Sizing 700px) -->
  <div class="modal-root" id="modalEditNote" style="display:none;position:fixed;inset:0;background:rgba(32,8,15,.55);backdrop-filter:blur(4px);z-index:999;place-items:center">
    <div class="modal" style="background:#fff;border-radius:var(--radius);max-width:700px;width:95%;box-shadow:var(--shadow-lg);overflow:hidden">
      <form id="formEditNote" method="POST" action="" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

        <div class="modal-head" style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid var(--cream-300)">
          <h3 style="margin:0;font-size:19px;color:var(--wine-900)">Edit PDF Note</h3>
          <button type="button" class="close" onclick="document.getElementById('modalEditNote').style.display='none'" style="background:none;border:none;cursor:pointer"><i data-lucide="x"></i></button>
        </div>

        <div class="modal-body" style="padding:24px">
          <div class="field" style="margin-bottom:16px">
            <label class="label">Note Title <span style="color:var(--danger)">*</span></label>
            <input class="input" id="editNoteTitle" name="title" required>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Replace PDF File (Optional)</label>
            <input type="file" name="pdf_file" class="input" accept="application/pdf">
            <small class="muted">Leave blank to keep existing PDF.</small>
          </div>

          <div class="field" style="margin-bottom:16px">
            <label class="label">Description</label>
            <textarea class="textarea" id="editNoteDesc" name="description" rows="3"></textarea>
          </div>

          <div class="field" style="margin-bottom:0">
            <label class="label">Status <span style="color:var(--danger)">*</span></label>
            <select class="select" id="editNoteStatus" name="status">
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-foot" style="display:flex;justify-content:flex-end;gap:10px;padding:18px 24px;background:var(--cream-50);border-top:1px solid var(--cream-300)">
          <button type="button" class="btn btn-ghost" onclick="document.getElementById('modalEditNote').style.display='none'">Cancel</button>
          <button type="submit" class="btn btn-primary"><i data-lucide="check"></i> Update Note</button>
        </div>
      </form>
    </div>
  </div>

  @push('scripts')
    <script>
      function openEditNoteModal(id, title, desc, status) {
        const form = document.getElementById('formEditNote');
        form.action = `/admin/lessons/notes/${id}`;
        document.getElementById('editNoteTitle').value = title;
        document.getElementById('editNoteDesc').value = desc;
        document.getElementById('editNoteStatus').value = status;
        document.getElementById('modalEditNote').style.display = 'grid';
        if (window.lucide) { lucide.createIcons(); }
      }
    </script>
  @endpush
@endsection
