@extends('layout.app')

@section("content")

    <form method="post" action="{{ route('clients.update', $client) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Имя:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" style="width: 200px;" value="{{ old('name', $client->name) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" style="width: 200px;" value="{{ old('email', $client->email) }}">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Телефон:</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" style="width: 200px;" value="{{ old('phone', $client->phone) }}">
            @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Город:</label>
            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" style="width: 200px;" value="{{ old('city', $client->city) }}">
            @error('city')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Выберите статус:</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" style="width: 200px;">
                @foreach($statuses as $statusKey => $statusLabel)
                    <option value="{{ $statusKey }}" {{ old('status', $client->status) == $statusKey ? 'selected' : '' }}>
                        {{ $statusLabel }}
                    </option>
                @endforeach
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>

@endsection
