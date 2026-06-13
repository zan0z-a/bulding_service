{{-- resources/views/admin/index.blade.php --}}
@extends('layouts.layout')

@section('title', 'Админ-панель — ServiceName')

@push('styles')
<style>
  .admin-section {
    min-height: calc(100vh - 180px);
    background: var(--light);
    padding: 40px 0;
  }
  .admin-card {
    background: var(--white);
    border-radius: 6px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    overflow: hidden;
  }
  .admin-nav {
    background: var(--navy2);
    padding: 0;
  }
  .admin-nav .nav-link {
    color: rgba(255,255,255,0.7) !important;
    padding: 1rem 1.5rem !important;
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    border: none;
    border-bottom: 2px solid transparent;
    transition: all 0.2s;
  }
  .admin-nav .nav-link.active {
    color: var(--accent) !important;
    background: transparent;
    border-bottom-color: var(--accent);
  }
  .admin-nav .nav-link:hover {
    color: white !important;
  }
  .table-custom {
    width: 100%;
    border-collapse: collapse;
  }
  .table-custom th {
    background: var(--navy);
    color: white;
    padding: 12px 16px;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    text-align: left;
    white-space: nowrap;
  }
  .table-custom td {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(0,0,0,0.06);
    font-size: 0.88rem;
    color: var(--navy);
    vertical-align: middle;
  }
  .table-custom tr:hover td {
    background: rgba(240,244,248,0.5);
  }
  .badge-status {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    white-space: nowrap;
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
  .btn-action {
    padding: 8px 14px;
    font-size: 0.82rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }
  .btn-view {
    background: var(--navy);
    color: white;
  }
  .btn-view:hover { background: var(--steel); color: white; }
  .btn-delete {
    background: #dc2626;
    color: white;
  }
  .btn-delete:hover { background: #b91c1c; color: white; }
  .status-select {
    padding: 8px 12px;
    border: 2px solid rgba(0,0,0,0.15);
    border-radius: 4px;
    font-size: 0.85rem;
    font-weight: 600;
    background: white;
    cursor: pointer;
    width: 200px;
    transition: all 0.2s;
  }
  .status-select:focus {
    border-color: var(--steel);
    outline: none;
    box-shadow: 0 0 0 3px rgba(37,99,168,0.1);
  }
  .actions-cell {
    white-space: nowrap;
    width: 120px;
  }
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
  }
  .empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    display: block;
  }
</style>
@endpush

@section('content')
<section class="admin-section">
  <div class="container">

    {{-- Табы --}}
    <div class="admin-card">
      <div class="admin-nav">
        <ul class="nav nav-tabs border-0" role="tablist">
          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#requestsTab" type="button">
              Заявки
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#usersTab" type="button">
              Пользователи
            </button>
          </li>
        </ul>
      </div>

      <div class="tab-content p-4">
        
        {{-- Таблица заявок --}}
        <div class="tab-pane fade show active" id="requestsTab">
          @if($requests->count() > 0)
            <div class="table-responsive">
              <table class="table-custom">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Компания</th>
                    <th>Email</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($requests as $req)
                  <tr>
                    <td><strong>#{{ $req->id }}</strong></td>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->company ?: '—' }}</td>
                    <td>{{ $req->email ?: '—' }}</td>
                    <td style="white-space: nowrap;">{{ $req->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                      <select 
                        class="status-select" 
                        onchange="updateStatus({{ $req->id }}, this.value)"
                      >
                        <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>На рассмотрении</option>
                        <option value="in_progress" {{ $req->status == 'in_progress' ? 'selected' : '' }}>В работе</option>
                        <option value="completed" {{ $req->status == 'completed' ? 'selected' : '' }}>Готово</option>
                      </select>
                    </td>
                    <td class="actions-cell">
                      <a href="{{ route('admin.request', $req->id) }}" class="btn-action btn-view me-1" title="Просмотр">
                        <i class="bi bi-eye"></i>
                      </a>
                      <form action="{{ route('admin.deleteRequest', $req->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Удалить заявку #{{ $req->id }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" title="Удалить">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state">
              <i class="bi bi-inbox"></i>
              <p style="font-size: 1.1rem; font-weight: 600;">Нет заявок</p>
              <p style="font-size: 0.9rem;">Когда появятся заявки, они отобразятся здесь</p>
            </div>
          @endif
        </div>

        {{-- Таблица пользователей --}}
        <div class="tab-pane fade" id="usersTab">
          @if($users->count() > 0)
            <div class="table-responsive">
              <table class="table-custom">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Дата регистрации</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td><strong>#{{ $user->id }}</strong></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      @if($user->isAdmin())
                        <span class="badge-status badge-pending">Администратор</span>
                      @else
                        <span class="badge-status badge-in_progress">Пользователь</span>
                      @endif
                    </td>
                    <td style="white-space: nowrap;">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="empty-state">
              <i class="bi bi-people"></i>
              <p style="font-size: 1.1rem; font-weight: 600;">Нет пользователей</p>
              <p style="font-size: 0.9rem;">Зарегистрированные пользователи появятся здесь</p>
            </div>
          @endif
        </div>

      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
function updateStatus(id, status) {
    fetch('/admin/requests/' + id + '/status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            alert('Ошибка обновления статуса');
            location.reload();
        }
    })
    .catch(error => {
        alert('Ошибка соединения');
        location.reload();
    });
}
</script>
@endpush