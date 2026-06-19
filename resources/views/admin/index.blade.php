@extends('layouts.layout')

@section('title', 'Админ-панель — ServiceName')

@push('styles')
<style>
  .admin-section { min-height: calc(100vh - 180px); background: var(--light); padding: 40px 0; }
  .admin-card { background: var(--white); border-radius: 6px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden; }
  .admin-nav { background: var(--navy2); padding: 0; }
  .admin-nav .nav-link {
    color: rgba(255,255,255,0.7) !important; padding: 1rem 1.5rem !important;
    font-weight: 600; font-size: 0.85rem; letter-spacing: 0.05em; text-transform: uppercase;
    border: none; border-bottom: 2px solid transparent; transition: all 0.2s;
  }
  .admin-nav .nav-link.active { color: var(--accent) !important; background: transparent; border-bottom-color: var(--accent); }
  .admin-nav .nav-link:hover { color: white !important; }
  
  .filter-bar { display: flex; flex-wrap: wrap; gap: 8px; padding: 16px; background: #f8fafc; border-bottom: 1px solid rgba(0,0,0,0.06); }
  .filter-btn {
    padding: 8px 16px; border: 2px solid rgba(0,0,0,0.1); border-radius: 6px;
    font-size: 0.82rem; font-weight: 600; cursor: pointer; transition: all 0.2s;
    background: white; color: var(--navy); text-decoration: none;
  }
  .filter-btn:hover { border-color: var(--steel); }
  .filter-btn.active { background: var(--navy); color: white; border-color: var(--navy); }
  .filter-btn .badge { background: rgba(0,0,0,0.06); padding: 2px 8px; border-radius: 10px; margin-left: 4px; font-size: 0.75rem; }
  .filter-btn.active .badge { background: rgba(255,255,255,0.2); }
  
  .table-custom { width: 100%; border-collapse: collapse; }
  .table-custom th { background: var(--navy); color: white; padding: 12px 16px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; text-align: left; white-space: nowrap; }
  .table-custom td { padding: 12px 16px; border-bottom: 1px solid rgba(0,0,0,0.06); font-size: 0.88rem; color: var(--navy); vertical-align: middle; }
  .table-custom tr:hover td { background: rgba(240,244,248,0.5); }
  
  .status-select { padding: 8px 12px; border: 2px solid rgba(0,0,0,0.15); border-radius: 4px; font-size: 0.85rem; font-weight: 600; background: white; cursor: pointer; width: 170px; }
  .status-select:focus { border-color: var(--steel); outline: none; }
  
  .btn-action { padding: 8px 14px; font-size: 0.82rem; font-weight: 600; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
  .btn-view { background: var(--navy); color: white; }
  .btn-view:hover { background: var(--steel); color: white; }
  .btn-delete { background: #dc2626; color: white; }
  .btn-delete:hover { background: #b91c1c; color: white; }
  
  .badge-status { display: inline-block; padding: 4px 10px; border-radius: 4px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; }
  .badge-admin { background: rgba(245,158,11,0.15); color: #f59e0b; }
  .badge-user { background: rgba(59,130,246,0.15); color: #3b82f6; }
  
  .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
  .empty-state i { font-size: 3rem; display: block; margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<section class="admin-section">
  <div class="container">
    <div class="admin-card">
      <div class="admin-nav">
        <ul class="nav nav-tabs border-0">
          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#requestsTab">Заявки</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#usersTab">Пользователи</button>
          </li>
        </ul>
      </div>

      <div class="tab-content">
        {{-- Заявки --}}
        <div class="tab-pane fade show active" id="requestsTab">
          <div class="filter-bar">
            <a href="?status=new" class="filter-btn {{ $status == 'new' ? 'active' : '' }}">Новое <span class="badge">{{ $stats['new'] }}</span></a>
            <a href="?status=in_progress" class="filter-btn {{ $status == 'in_progress' ? 'active' : '' }}">В работе <span class="badge">{{ $stats['in_progress'] }}</span></a>
            <a href="?status=waiting" class="filter-btn {{ $status == 'waiting' ? 'active' : '' }}">В ожидании <span class="badge">{{ $stats['waiting'] }}</span></a>
            <a href="?status=completed" class="filter-btn {{ $status == 'completed' ? 'active' : '' }}">Выполнено <span class="badge">{{ $stats['completed'] }}</span></a>
            <a href="{{ route('admin.index') }}" class="filter-btn {{ !$status ? 'active' : '' }}">Все <span class="badge">{{ $stats['total'] }}</span></a>
          </div>

          <div class="p-3">
            @if($requests->count() > 0)
              <div class="table-responsive">
                <table class="table-custom">
                  <thead>
                    <tr><th>ID</th><th>Имя</th><th>Компания</th><th>Email</th><th>Дата</th><th>Статус</th><th></th></tr>
                  </thead>
                  <tbody>
                    @foreach($requests as $r)
                    <tr>
                      <td><strong>#{{ $r->id }}</strong></td>
                      <td>{{ $r->name }}</td>
                      <td>{{ $r->company ?: '—' }}</td>
                      <td>{{ $r->email ?: '—' }}</td>
                      <td>{{ $r->created_at->format('d.m.Y H:i') }}</td>
                      <td>
                        <select class="status-select" onchange="upd({{ $r->id }}, this.value)">
                          <option value="new" {{ $r->status == 'new' ? 'selected' : '' }}>Новое</option>
                          <option value="in_progress" {{ $r->status == 'in_progress' ? 'selected' : '' }}>В работе</option>
                          <option value="waiting" {{ $r->status == 'waiting' ? 'selected' : '' }}>В ожидании</option>
                          <option value="completed" {{ $r->status == 'completed' ? 'selected' : '' }}>Выполнено</option>
                        </select>
                      </td>
                      <td>
                        <a href="{{ route('admin.request', $r->id) }}" class="btn-action btn-view me-1"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('admin.deleteRequest', $r->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Удалить #{{ $r->id }}?')">
                          @csrf @method('DELETE')
                          <button class="btn-action btn-delete"><i class="bi bi-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <div class="empty-state"><i class="bi bi-inbox"></i><p>Нет заявок</p></div>
            @endif
          </div>
        </div>

        {{-- Пользователи --}}
        <div class="tab-pane fade" id="usersTab">
          <div class="p-3">
            @if($users->count() > 0)
              <div class="table-responsive">
                <table class="table-custom">
                  <thead>
                    <tr><th>ID</th><th>Имя</th><th>Email</th><th>Роль</th><th>Дата</th></tr>
                  </thead>
                  <tbody>
                    @foreach($users as $u)
                    <tr>
                      <td><strong>#{{ $u->id }}</strong></td>
                      <td>{{ $u->name }}</td>
                      <td>{{ $u->email }}</td>
                      <td><span class="badge-status {{ $u->isAdmin() ? 'badge-admin' : 'badge-user' }}">{{ $u->isAdmin() ? 'Админ' : 'Пользователь' }}</span></td>
                      <td>{{ $u->created_at->format('d.m.Y H:i') }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <div class="empty-state"><i class="bi bi-people"></i><p>Нет пользователей</p></div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
function upd(id, status) {
    fetch('/admin/requests/' + id + '/status', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'},
        body: JSON.stringify({status: status})
    }).then(r => r.json()).then(d => { if(!d.success) location.reload(); });
}
</script>
@endpush