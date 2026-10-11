@extends('layouts.admin')

@section('title', 'Reviews & Ratings — Verdant Academy')
@section('page-title', 'Reviews & Ratings')

@section('content')
<nav class="crumbs" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}">Admin</a><span class="sep">/</span><span>Reviews</span>
  </nav>
  <div class="page-head">
    <div><h1>Reviews &amp; Ratings</h1><p>6 reviews · 1 awaiting moderation</p></div>
    <div style="display:flex;gap:9px;flex-wrap:wrap">
      
      
    </div>
  </div>
  <div class="table-wrap">
    <div class="table-toolbar">
      <div class="search">
        <i data-lucide="search"></i>
        <label class="sr-only" for="tbl-search">Search</label>
        <input id="tbl-search" type="search" placeholder="Search reviews…" data-action="table-search">
      </div>
      <select class="select" style="max-width:180px;padding:9px 34px 9px 12px" data-action="table-filter">
        <option>All statuses</option><option>Active</option><option>Inactive</option><option>Draft</option><option>Pending</option>
      </select>
      <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Filters cleared" style="margin-left:auto"><i data-lucide="filter-x"></i> Clear</button>
    </div>
    <div class="table-scroll">
      <table class="tbl">
        <thead><tr><th>Student</th><th>Course</th><th>Rating</th><th>Review</th><th>Status</th><th style="text-align:right">Actions</th></tr></thead>
        <tbody>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=20" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Elena Petrova</div><div class="s">18 Sep 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">The Complete Web Development Bootcamp</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></td>
      <td style="max-width:340px"><span class="small muted">By far the most structured course I have taken. The mentor feedback on my final project was genuinely useful.</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=32" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Sofia Lindberg</div><div class="s">04 Sep 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">Data Analytics with Python &amp; SQL</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></td>
      <td style="max-width:340px"><span class="small muted">The SQL module alone was worth the price. I use window functions at work every week now.</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=24" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Claire Dubois</div><div class="s">22 Aug 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">Digital Marketing Strategy</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style="opacity:.25"></i></span></td>
      <td style="max-width:340px"><span class="small muted">Excellent strategic content. I would have liked more depth on TikTok advertising, but the fundamentals are sol…</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=15" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Daniel Okonkwo</div><div class="s">11 Aug 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">Product Design Foundations</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></td>
      <td style="max-width:340px"><span class="small muted">I came in with zero design experience and finished with a portfolio piece I am proud of.</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=11" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Marco Bianchi</div><div class="s">02 Aug 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">Advanced React &amp; TypeScript</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style="opacity:.25"></i></span></td>
      <td style="max-width:340px"><span class="small muted">Very advanced and dense. Not for beginners, but exactly what I needed for my team lead role.</span></td>
      <td><span class="badge badge-warn">Pending</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=60" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Tomasz Kowalski</div><div class="s">28 Jul 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">The Complete Web Development Bootcamp</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></td>
      <td style="max-width:340px"><span class="small muted">The deployment section finally made CI/CD click for me after two years of avoiding it.</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
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
          <div><div class="t">Elena Petrova</div><div class="s">18 Sep 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">The Complete Web Development Bootcamp</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></td>
      <td style="max-width:340px"><span class="small muted">By far the most structured course I have taken. The mentor feedback on my final project was genuinely useful.</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=32" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Sofia Lindberg</div><div class="s">04 Sep 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">Data Analytics with Python &amp; SQL</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></td>
      <td style="max-width:340px"><span class="small muted">The SQL module alone was worth the price. I use window functions at work every week now.</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=24" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Claire Dubois</div><div class="s">22 Aug 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">Digital Marketing Strategy</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style="opacity:.25"></i></span></td>
      <td style="max-width:340px"><span class="small muted">Excellent strategic content. I would have liked more depth on TikTok advertising, but the fundamentals are sol…</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=15" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Daniel Okonkwo</div><div class="s">11 Aug 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">Product Design Foundations</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></td>
      <td style="max-width:340px"><span class="small muted">I came in with zero design experience and finished with a portfolio piece I am proud of.</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=11" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Marco Bianchi</div><div class="s">02 Aug 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">Advanced React &amp; TypeScript</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style="opacity:.25"></i></span></td>
      <td style="max-width:340px"><span class="small muted">Very advanced and dense. Not for beginners, but exactly what I needed for my team lead role.</span></td>
      <td><span class="badge badge-warn">Pending</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="cell-main">
          <img src="https://i.pravatar.cc/160?img=60" alt="" style="border-radius:50%" onerror="this.style.display='none'">
          <div><div class="t">Tomasz Kowalski</div><div class="s">28 Jul 2025</div></div>
        </div>
      </td>
      <td><span class="small" style="font-weight:600">The Complete Web Development Bootcamp</span></td>
      <td><span class="stars"><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i><i data-lucide="star" style=""></i></span></td>
      <td style="max-width:340px"><span class="small muted">The deployment section finally made CI/CD click for me after two years of avoiding it.</span></td>
      <td><span class="badge badge-success">Approved</span></td>
      <td>
        <div class="row-actions">
          <button class="mini-btn" data-action="toast-demo" data-msg="Review approved"><i data-lucide="check"></i></button>
          <button class="mini-btn" data-action="toast-demo" data-msg="Review rejected"><i data-lucide="x"></i></button>
          <button class="mini-btn danger" data-action="delete-row" data-name="review" aria-label="Delete"><i data-lucide="trash-2"></i></button>
        </div>
      </td>
    </tr>
    </div>
    <div class="table-foot">
      <span>Showing <b style="color:var(--ink-900)">7899</b> records</span>
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
