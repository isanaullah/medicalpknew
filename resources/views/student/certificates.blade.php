@extends('layouts.student')

@section('title', 'My Certificates — Verdant Academy')
@section('page-title', 'Certificates')

@section('content')
<div class="page-head">
    <div><h1>Certificates</h1><p>1 certificate earned · 1 in progress</p></div>
    <button class="btn btn-outline" data-action="toast-demo" data-msg="Certificate list exported as PDF"><i data-lucide="download"></i> Export all</button>
  </div>
  <div class="grid g2">
    <div class="cert-card">
      <div class="seal"><i data-lucide="award"></i></div>
      <span class="badge badge-success" style="margin-bottom:12px"><i data-lucide="check"></i> Verified</span>
      <h3 style="font-size:16.4px;line-height:1.4">Data Analytics with Python & SQL</h3>
      <p class="small muted" style="margin-top:8px">Issued 14 September 2025 · Grade: Merit</p>
      <div class="info-row" style="margin-top:14px"><span class="k">Certificate ID</span><span class="v">VA-2025-002031</span></div>
      <div class="info-row"><span class="k">Instructor</span><span class="v">Dr. Amara Osei</span></div>
      <div class="info-row"><span class="k">Duration</span><span class="v">44 hours</span></div>
      <div style="display:flex;gap:9px;margin-top:18px">
        <button class="btn btn-primary btn-sm" data-action="view-cert"><i data-lucide="eye"></i> View</button>
        <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Certificate downloaded"><i data-lucide="download"></i> Download PDF</button>
        <button class="btn btn-outline btn-sm" data-action="toast-demo" data-msg="Verification link copied to clipboard"><i data-lucide="link"></i></button>
      </div>
    </div>

    <div class="card card-pad" style="display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;border-style:dashed;border-color:var(--cream-400)">
      <div class="stat-icon ivory" style="width:54px;height:54px;margin-bottom:16px"><i data-lucide="loader"></i></div>
      <h3 style="font-size:15.6px">In progress</h3>
      <p class="small muted" style="margin-top:8px;max-width:280px;line-height:1.6">
        Complete <b>The Complete Web Development Bootcamp</b> to earn your next certificate.
      </p>
      <div class="progress" style="width:100%;max-width:260px;margin-top:18px"><i style="width:86%"></i></div>
      <p class="small" style="margin-top:9px;font-weight:600;color:var(--wine-800)">86% complete</p>
      <button class="btn btn-primary btn-sm" style="margin-top:16px" data-action="resume"><i data-lucide="play"></i> Continue course</button>
    </div>
  </div>
@endsection
