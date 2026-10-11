@if(auth()->check() && auth()->user()->hasRole('Super Admin') && isset($page))
  <!-- VISUAL EDITOR FLOATING TOGGLE / BAR -->
  <div id="visualEditorBar" style="position:fixed;bottom:24px;left:24px;z-index:99999;font-family:var(--font-sans, system-ui, sans-serif);display:flex;align-items:center;gap:10px">
    <button id="toggleVisualEditBtn" type="button" class="btn" style="background:#200713;color:#D9A521;border:2px solid #D9A521;box-shadow:0 8px 24px rgba(0,0,0,0.35);padding:10px 18px;border-radius:999px;font-weight:700;font-size:13px;display:flex;align-items:center;gap:8px;cursor:pointer;transition:transform .2s">
      <i data-lucide="sparkles" style="width:16px;height:16px"></i>
      <span id="visualEditStatusText">Live Visual Editor</span>
    </button>

    <a href="{{ route('admin.pages') }}" class="btn" style="background:#fff;color:#200713;border:1px solid #e2d9d2;box-shadow:0 6px 18px rgba(0,0,0,0.15);padding:10px 14px;border-radius:999px;font-weight:600;font-size:12.5px;text-decoration:none;display:inline-flex;align-items:center;gap:6px">
      <i data-lucide="arrow-left" style="width:14px;height:14px"></i>
      Admin
    </a>
  </div>

  <!-- VISUAL EDITOR MODAL -->
  <div id="visualEditModal" style="display:none;position:fixed;inset:0;background:rgba(18,5,11,0.6);backdrop-filter:blur(4px);z-index:100000;align-items:center;justify-content:center;padding:20px;">
    <div style="background:#fff;border-radius:14px;box-shadow:0 24px 60px rgba(0,0,0,0.3);width:100%;max-width:680px;max-height:90vh;display:flex;flex-direction:column;overflow:hidden;border:1px solid #eeddd3">
      
      <!-- Modal Header -->
      <div style="padding:18px 24px;background:#FAF6F0;border-bottom:1px solid #EAE0D5;display:flex;align-items:center;justify-content:space-between">
        <div style="display:flex;align-items:center;gap:10px">
          <div style="width:34px;height:34px;border-radius:8px;background:#3D1225;color:#D9A521;display:grid;place-items:center">
            <i data-lucide="edit-3" style="width:18px;height:18px"></i>
          </div>
          <div>
            <h3 style="font-size:16px;font-weight:700;color:#200713;margin:0" id="veModalTitle">Edit Section Content</h3>
            <span style="font-size:12px;color:#856B75" id="veModalKey">Key: hero</span>
          </div>
        </div>
        <button type="button" onclick="closeVisualEditModal()" style="background:none;border:none;color:#856B75;cursor:pointer;padding:6px;border-radius:6px">
          <i data-lucide="x" style="width:20px;height:20px"></i>
        </button>
      </div>

      <!-- Modal Body (Scrollable Form) -->
      <form id="visualEditForm" style="padding:22px 24px;overflow-y:auto;display:flex;flex-direction:column;gap:16px;margin:0">
        <input type="hidden" id="veSectionId">
        <input type="hidden" id="vePageId" value="{{ $page->id }}">

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
          <div>
            <label style="font-size:12.5px;font-weight:600;color:#200713;display:block;margin-bottom:6px">Subtitle / Eyebrow</label>
            <input type="text" id="veSubtitle" class="input" style="width:100%;box-sizing:border-box" placeholder="e.g. Since 2016 or Browse by field">
          </div>
          <div>
            <label style="font-size:12.5px;font-weight:600;color:#200713;display:block;margin-bottom:6px">Section Title / Heading</label>
            <input type="text" id="veTitle" class="input" style="width:100%;box-sizing:border-box" placeholder="e.g. Master software engineering">
          </div>
        </div>

        <div>
          <label style="font-size:12.5px;font-weight:600;color:#200713;display:block;margin-bottom:6px">Description / Lead Paragraph</label>
          <textarea id="veDescription" class="textarea" rows="3" style="width:100%;box-sizing:border-box" placeholder="Introductory or lead paragraph text"></textarea>
        </div>

        <div id="veBodyWrap">
          <label style="font-size:12.5px;font-weight:600;color:#200713;display:block;margin-bottom:6px">Body / Rich Content (HTML/Text)</label>
          <textarea id="veBody" class="textarea" rows="4" style="width:100%;box-sizing:border-box" placeholder="Rich paragraph content or HTML"></textarea>
        </div>

        <div>
          <label style="font-size:12.5px;font-weight:600;color:#200713;display:block;margin-bottom:6px">Image URL</label>
          <div style="display:flex;gap:10px;align-items:center">
            <input type="text" id="veImage" class="input" style="flex:1" placeholder="https://... or /images/...">
            <img id="veImagePreview" src="" alt="" style="width:40px;height:40px;border-radius:6px;object-fit:cover;border:1px solid #ddd;display:none">
          </div>
        </div>

        <div>
          <label style="font-size:12.5px;font-weight:600;color:#200713;display:flex;align-items:center;justify-content:space-between;margin-bottom:6px">
            <span>JSON Configuration (Buttons, Badges, Lists)</span>
            <span style="font-size:11px;color:#856B75;font-weight:normal">Auto-formatted JSON</span>
          </label>
          <textarea id="veConfig" class="textarea" rows="5" style="width:100%;box-sizing:border-box;font-family:monospace;font-size:12px;background:#fcfbf9" placeholder="{}"></textarea>
          <span id="veConfigError" style="font-size:11.5px;color:#c92a2a;display:none;margin-top:4px">Invalid JSON format</span>
        </div>

        <div style="display:flex;align-items:center;gap:8px;padding-top:4px">
          <input type="checkbox" id="veIsVisible" style="width:16px;height:16px;cursor:pointer">
          <label for="veIsVisible" style="font-size:13.5px;font-weight:600;color:#200713;cursor:pointer">Section is Visible on Website</label>
        </div>
      </form>

      <!-- Modal Footer -->
      <div style="padding:16px 24px;background:#FAF6F0;border-top:1px solid #EAE0D5;display:flex;align-items:center;justify-content:flex-end;gap:10px">
        <button type="button" onclick="closeVisualEditModal()" class="btn btn-outline" style="padding:8px 16px;font-size:13px">Cancel</button>
        <button type="button" id="veSaveBtn" onclick="saveVisualEditSection()" class="btn btn-primary" style="padding:8px 20px;font-size:13px;display:flex;align-items:center;gap:6px">
          <i data-lucide="check" style="width:15px;height:15px"></i>
          <span>Save Changes</span>
        </button>
      </div>

    </div>
  </div>

  <style>
    .ve-active-section {
      position: relative !important;
      outline: 2px dashed rgba(217,165,33,0.7) !important;
      outline-offset: -2px;
      transition: outline .2s ease;
    }
    .ve-active-section:hover {
      outline: 2.5px solid #D9A521 !important;
    }
    .ve-section-badge {
      position: absolute;
      top: 12px;
      right: 16px;
      z-index: 999;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: #200713;
      color: #fff;
      padding: 6px 12px;
      border-radius: 999px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.3);
      border: 1px solid #D9A521;
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: .02em;
    }
    .ve-edit-trigger {
      background: #D9A521;
      color: #200713;
      border: none;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      transition: transform .15s ease;
    }
    .ve-edit-trigger:hover {
      transform: scale(1.05);
    }
  </style>

  <script>
    (function() {
      let isEditorActive = new URLSearchParams(window.location.search).get('visual_edit') === '1';
      const pageId = {{ $page->id }};

      function updateEditorUi() {
        const btn = document.getElementById('toggleVisualEditBtn');
        const text = document.getElementById('visualEditStatusText');

        if (isEditorActive) {
          btn.style.background = '#D9A521';
          btn.style.color = '#200713';
          btn.style.borderColor = '#200713';
          text.innerText = 'Exit Editor Mode';
          attachSectionOverlays();
        } else {
          btn.style.background = '#200713';
          btn.style.color = '#D9A521';
          btn.style.borderColor = '#D9A521';
          text.innerText = 'Visual Editor';
          removeSectionOverlays();
        }
      }

      function attachSectionOverlays() {
        document.querySelectorAll('[data-section-key]').forEach(el => {
          el.classList.add('ve-active-section');
          if (!el.querySelector('.ve-section-badge')) {
            const key = el.getAttribute('data-section-key');
            const sectionId = el.getAttribute('data-section-id');
            const badge = document.createElement('div');
            badge.className = 've-section-badge';
            badge.innerHTML = `
              <span>Section: <b>${key}</b></span>
              <button type="button" class="ve-edit-trigger" onclick="openVisualEditModal('${pageId}', '${sectionId}', '${key}')">
                <i data-lucide="edit-2" style="width:12px;height:12px"></i> Edit
              </button>
            `;
            el.appendChild(badge);
          }
        });
        if (window.lucide) window.lucide.createIcons();
      }

      function removeSectionOverlays() {
        document.querySelectorAll('[data-section-key]').forEach(el => {
          el.classList.remove('ve-active-section');
          const badge = el.querySelector('.ve-section-badge');
          if (badge) badge.remove();
        });
      }

      document.getElementById('toggleVisualEditBtn').addEventListener('click', function() {
        isEditorActive = !isEditorActive;
        const url = new URL(window.location);
        if (isEditorActive) {
          url.searchParams.set('visual_edit', '1');
        } else {
          url.searchParams.delete('visual_edit');
        }
        window.history.pushState({}, '', url);
        updateEditorUi();
      });

      window.openVisualEditModal = function(pId, sId, key) {
        document.getElementById('veModalKey').innerText = 'Key: ' + key;
        document.getElementById('veSectionId').value = sId;

        // Fetch section data
        fetch(`/admin/visual-edit/${pId}/sections/${sId}`, {
          headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success && data.section) {
            const sec = data.section;
            document.getElementById('veTitle').value = sec.title || '';
            document.getElementById('veSubtitle').value = sec.subtitle || '';
            document.getElementById('veDescription').value = sec.description || '';
            document.getElementById('veBody').value = sec.body || '';
            document.getElementById('veImage').value = sec.image || '';
            document.getElementById('veIsVisible').checked = sec.is_visible !== false;
            document.getElementById('veConfig').value = sec.config ? JSON.stringify(sec.config, null, 2) : '{}';

            const preview = document.getElementById('veImagePreview');
            if (sec.image) {
              preview.src = sec.image;
              preview.style.display = 'block';
            } else {
              preview.style.display = 'none';
            }

            document.getElementById('visualEditModal').style.display = 'flex';
            if (window.lucide) window.lucide.createIcons();
          }
        })
        .catch(err => {
          console.error(err);
          alert('Failed to load section data.');
        });
      };

      window.closeVisualEditModal = function() {
        document.getElementById('visualEditModal').style.display = 'none';
        document.getElementById('veConfigError').style.display = 'none';
      };

      window.saveVisualEditSection = function() {
        const sId = document.getElementById('veSectionId').value;
        const configText = document.getElementById('veConfig').value;
        let configObj = null;

        if (configText.trim()) {
          try {
            configObj = JSON.parse(configText);
            document.getElementById('veConfigError').style.display = 'none';
          } catch(e) {
            document.getElementById('veConfigError').style.display = 'block';
            return;
          }
        }

        const payload = {
          title: document.getElementById('veTitle').value,
          subtitle: document.getElementById('veSubtitle').value,
          description: document.getElementById('veDescription').value,
          body: document.getElementById('veBody').value,
          image: document.getElementById('veImage').value,
          is_visible: document.getElementById('veIsVisible').checked,
          config: configObj,
        };

        const saveBtn = document.getElementById('veSaveBtn');
        saveBtn.disabled = true;
        saveBtn.innerText = 'Saving...';

        fetch(`/admin/visual-edit/${pageId}/sections/${sId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(res => {
          saveBtn.disabled = false;
          saveBtn.innerHTML = '<i data-lucide="check" style="width:15px;height:15px"></i> Save Changes';
          if (res.success) {
            closeVisualEditModal();
            // Show toast or reload page to display fresh DB data
            window.location.reload();
          } else {
            alert(res.error || 'Failed to update section.');
          }
        })
        .catch(err => {
          saveBtn.disabled = false;
          saveBtn.innerText = 'Save Changes';
          console.error(err);
          alert('An error occurred while saving.');
        });
      };

      // Initial check
      if (isEditorActive) {
        updateEditorUi();
      }
    })();
  </script>
@endif
