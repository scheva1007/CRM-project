@extends('layout.app')

@section("content")

<form method="post" action="{{ route('clients.store') }}">
    @csrf
    <div class="form-group">
        <label>Имя</label>
        <input type="text" name="name" class="form-control" style="width: 200px;">
    </div>
    <div class="form-group">
        <label>email</label>
        <input type="email" name="email" class="form-control" style="width: 200px;">
    </div>
    <div class="form-group">
        <label>Телефон</label>
        <input type="text" name="phone" class="form-control" style="width: 200px;">
    </div>

    <div class="form-group">
        <label for="status">Выберите статус:</label>
        <select name="status" id="status" class="form-control" style="width: 200px;">
            @foreach($statuses as $statusKey => $statusLabel)
                <option value="{{ $statusKey }}" {{ request('status') == $statusKey ? 'selected' : '' }}>
                    {{ $statusLabel }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

@endsection
