@extends('layout.app')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('clients.create') }}">Добавить нового клиента</a>
</div>
<form method="GET" action="{{ route('clients.index') }}" class="mb-4">
    <div class="row">
        <div class="col-md-2" style="width: 200px;">
            <input type="text" name="name" class="form-control" placeholder="Имя" value="{{ request('name') }}" style="width: 200px;">
        </div>
        <div class="col-md-2">
            @foreach($statuses as $statusKey => $statusLabel)
                <div>
                    <label>
                        <input type="checkbox" name="status[]" value="{{ $statusKey }}"
                        {{ is_array(request('status')) && in_array($statusKey, request('status')) ? 'checked' :'' }}>
                        {{ $statusLabel }}
                    </label>
                </div>
            @endforeach
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Фильтровать</button>
        </div>
    </div>
</form>
    <table border="2">
        <thead>
            <tr>
                <th width="30px">№</th>
                <th width="80px">Имя</th>
                <th width="100">Email</th>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->city }}</td>
                    <td>{{ $client->registered_at }}</td>
                    <td>{{ $client->status }}</td>
                    <td>
                    <a href="{{ route('clients.edit', $client) }}">Редактировать</a>
                    <br>
                    <a href="{{ route('clients.show', $client) }}">Профиль</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $clients->links() }}
    </div>
@endsection
