@extends('layout.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed"
             style="top: 20px; right: 20px; z-index: 1050;"
             role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed"
             style="top: 20px; right: 20px; z-index: 1050;"
             role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="mb-3">
    <a href="{{ route('clients.create') }}" class="btn btn-success">Добавить нового клиента</a>
</div>

<form method="GET" action="{{ route('clients.index') }}" class="mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-md-2">
            <input type="text" name="name" class="form-control" placeholder="Имя" value="{{ request('name') }}">
        </div>
        <div class="col-md-2">
            <div class="form-check">
                @foreach($statuses as $statusKey => $statusLabel)
                    <div class="form-check">
                        <input type="checkbox" name="status[]" value="{{ $statusKey }}"
                               class="form-check-input"
                               id="status_{{ $statusKey }}"
                            {{ is_array(request('status')) && in_array($statusKey, request('status')) ? 'checked' : '' }}>
                        <label for="status_{{ $statusKey }}" class="form-check-label">
                            {{ $statusLabel }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Фильтровать</button>
        </div>
    </div>
</form>

<table class="table table-striped table-bordered table-hover">
    <thead class="thead-light">
    <tr class="text-center">
        <th width="30px">№</th>
        <th width="80px">Имя</th>
        <th width="100px">Email</th>
        <th width="110px">Телефон</th>
        <th width="110px">Город</th>
        <th width="170px">Дата регистрации</th>
        <th width="100px">Статус</th>
        <th width="120px">Действие</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->city }}</td>
            <td>{{ $client->registered_at }}</td>
            <td class="text-center">{{ $statuses[$client->status] }}</td>
            <td>
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">Редактировать</a>
                <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-info">Профиль</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

    <div class="mt-3">
        {{ $clients->links() }}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                }, 5000);
            });
        });
    </script>
@endsection
