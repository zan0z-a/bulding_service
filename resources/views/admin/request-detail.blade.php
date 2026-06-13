{{-- resources/views/admin/request-detail.blade.php --}}
@extends('layouts.layout')

@section('title', 'Заявка #' . $contactRequest->id . ' — ServiceName')

@push('styles')
<style>
  .admin-section {
    min-height: calc(100vh - 180px);
    background: var(--light);
    padding: 40px 0;
  }
  .detail-card {
    background: white;
    border-radius: 6px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    padding: 2rem;
  }
  .detail-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--light);
  }
  .detail-row {
    display: flex;
    margin-bottom: 1.2rem;
  }
  .detail-label {
    width: 200px;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #64748b;
    flex-shrink: 0;
  }
  .detail-value {
    font-size: 0.95rem;
    color: var(--navy);
    font-weight: 500;
  }
  .badge-status {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }
  .badge-pending {
    background: rgba(245,158,11,0.15);
    color: #f59e0b;
  }
  .badge-in_progress {
    background: rgba(59,130,246,0.15);
    color: #3b82f6;
  }
  .badge-completed {
    background: rgba(22,163,74,0.15);
    color: #16a34a;
  }
  .btn-back {
    background: var(--navy);
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.2s;
  }
  .btn-back:hover { background: var(--steel); color: white; }
</style>
@endpush

@section('content')
<section class="admin-section">
  <div class="container">
    <div class="detail-card">
      <div class="detail-header">
        <h2 style="font-family:'Bebas Neue',sans-serif; font-size:2rem; color:var(--navy); margin:0;">
          Заявка #{{ $contactRequest->id }}
        </h2>
        <a href="{{ route('admin.index') }}" class="btn-back">
          <i class="bi bi-arrow-left me-2"></i>Назад
        </a>
      </div>

      <div class="detail-row">
        <div class="detail-label">Имя</div>
        <div class="detail-value">{{ $contactRequest->name }}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Компания</div>
        <div class="detail-value">{{ $contactRequest->company ?: 'Не указана' }}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Email</div>
        <div class="detail-value">{{ $contactRequest->email ?: 'Не указан' }}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">IP-адрес</div>
        <div class="detail-value">{{ $contactRequest->ip_address }}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Статус</div>
        <div class="detail-value">
          <span class="badge-status badge-{{ $contactRequest->status }}">
            {{ $contactRequest->getStatusLabel() }}
          </span>
        </div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Дата создания</div>
        <div class="detail-value">{{ $contactRequest->created_at->format('d.m.Y H:i') }}</div>
      </div>
      <div class="detail-row">
        <div class="detail-label">Сообщение</div>
        <div class="detail-value" style="white-space: pre-wrap;">{{ $contactRequest->message ?: 'Не указано' }}</div>
      </div>
    </div>
  </div>
</section>
@endsection