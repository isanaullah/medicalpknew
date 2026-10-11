{{-- 1.html Standard Modal & Toast JavaScript Controller --}}
<script>
  window.esc = function(s) {
    return String(s == null ? '' : s).replace(/[&<>"']/g, function(c) {
      return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'}[c];
    });
  };

  window.toast = function(title, sub, type) {
    var root = document.getElementById('toastRoot');
    if (!root) return;
    var el = document.createElement('div');
    el.className = 'toast ' + (type || '');
    var ic = (type === 'err' || type === 'danger') ? 'alert-circle' : (type === 'gold' || type === 'warning') ? 'sparkles' : 'check-circle-2';
    el.innerHTML = '<i data-lucide="' + ic + '"></i><div><div class="t-title">' + window.esc(title) + '</div>' + (sub ? '<div class="t-sub">' + window.esc(sub) + '</div>' : '') + '</div>';
    root.appendChild(el);
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons({ root: el });
    }
    setTimeout(function() {
      el.style.transition = 'opacity .3s, transform .3s';
      el.style.opacity = '0';
      el.style.transform = 'translateX(24px)';
      setTimeout(function() { el.remove(); }, 300);
    }, 3600);
  };

  window.openModal = function(title, body, foot, maxWidth) {
    var root = document.getElementById('modalRoot');
    if (!root) return;
    var maxW = maxWidth ? ' style="max-width:' + maxWidth + '"' : '';
    root.innerHTML = '<div class="modal"' + maxW + ' role="dialog" aria-modal="true" aria-label="' + window.esc(title) + '">' +
      '<div class="modal-head">' +
        '<h3>' + window.esc(title) + '</h3>' +
        '<button type="button" class="close" data-action="close-modal" aria-label="Close"><i data-lucide="x"></i></button>' +
      '</div>' +
      '<div class="modal-body">' + body + '</div>' +
      (foot ? '<div class="modal-foot">' + foot + '</div>' : '') +
    '</div>';
    root.classList.add('show');
    document.body.style.overflow = 'hidden';
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons({ root: root });
    }
  };

  window.closeModal = function() {
    var root = document.getElementById('modalRoot');
    if (!root) return;
    root.classList.remove('show');
    root.innerHTML = '';
    document.body.style.overflow = '';
  };

  // Delegated handlers for modal triggers & delete confirmation
  document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    document.addEventListener('click', function(e) {
      // Delete row button
      var delBtn = e.target.closest('[data-action="delete-row"]');
      if (delBtn) {
        e.preventDefault();
        var name = delBtn.dataset.name || 'this record';
        var url = delBtn.dataset.url || '';
        
        window.openModal('Confirm deletion', 
          '<div style="display:flex;gap:15px;align-items:flex-start">' +
            '<div class="stat-icon" style="width:46px;height:46px;background:var(--danger-bg);color:var(--danger);border-color:#F0CFD1;flex:none;display:grid;place-items:center;border-radius:12px;border:1px solid #F0CFD1"><i data-lucide="alert-triangle"></i></div>' +
            '<div>' +
              '<p style="font-size:15px;color:var(--ink-900);font-weight:600">Delete ' + window.esc(name) + '?</p>' +
              '<p style="font-size:14px;color:var(--ink-500);margin-top:8px;line-height:1.65">' +
                'This action cannot be undone. Any associated data will be permanently removed from the platform.' +
              '</p>' +
            '</div>' +
          '</div>',
          '<button type="button" class="btn btn-ghost" data-action="close-modal">Cancel</button>' +
          '<form method="POST" action="' + url + '" style="display:inline;margin:0" id="globalConfirmDeleteForm">' +
            '<input type="hidden" name="_token" value="' + csrfToken + '">' +
            '<input type="hidden" name="_method" value="DELETE">' +
            '<button type="submit" class="btn btn-danger"><i data-lucide="trash-2"></i> Delete permanently</button>' +
          '</form>',
          '520px'
        );
        return;
      }

      // Close modal button
      var closeBtn = e.target.closest('[data-action="close-modal"]');
      if (closeBtn) {
        e.preventDefault();
        window.closeModal();
        return;
      }
    });

    // Close on clicking backdrop
    var modalRoot = document.getElementById('modalRoot');
    if (modalRoot) {
      modalRoot.addEventListener('click', function(e) {
        if (e.target === modalRoot) {
          window.closeModal();
        }
      });
    }

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        window.closeModal();
      }
    });

    // Handle Laravel Session Flashes
    @if(session('success'))
      window.toast('Success', "{{ addslashes(session('success')) }}", '');
    @endif
    @if(session('error'))
      window.toast('Error', "{{ addslashes(session('error')) }}", 'err');
    @endif
    @if(session('warning'))
      window.toast('Notice', "{{ addslashes(session('warning')) }}", 'gold');
    @endif
    @if(session('info'))
      window.toast('Information', "{{ addslashes(session('info')) }}", '');
    @endif
  });
</script>
