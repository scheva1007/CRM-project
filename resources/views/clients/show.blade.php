@extends('layout.app')

@section('content')

    <div class="card-header" style="width: 400px;">
        <h3>Профиль: {{ $client->name }}</h3>
    </div>
    <ul class="list-group mb-3" style="width: 400px;">
        <li class="list-group-item"><strong>Имя:</strong> {{ $client->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $client->email }}</li>
        <li class="list-group-item"><strong>Телефон:</strong> {{ $client->phone }}</li>
        <li class="list-group-item"><strong>Город:</strong> {{ $client->city ?? 'Not specified' }}</li>
        <li class="list-group-item"><strong>Дата регистрации:</strong> {{ $client->created_at->format('d M Y') }}</li>
        <li class="list-group-item"><strong>Статус:</strong> {{ ucfirst($client->status) }}</li>
    </ul>
    <h4>Информация о погоде:</h4>
    @if($weather)
        <div class="alert alert-info" style="width: 400px;">
            <h5>Текущая погода в {{ $client->city }}:</h5>
            <ul>
                <li><strong>Температура:</strong> {{ $weather['main']['temp'] }}°C</li>
                <li><strong>По ощущениям:</strong> {{ $weather['main']['feels_like'] }}°C</li>
                <li><strong>Описание:</strong> {{ ucfirst($weather['weather'][0]['description']) }}</li>
                <li><strong>Влажность:</strong> {{ $weather['main']['humidity'] }}%</li>
                <li><strong>Скорость ветра:</strong> {{ $weather['wind']['speed'] }} m/s</li>
            </ul>
        </div>
    @else
        <div class="alert alert-warning">
            Данные о погоде недоступны для {{ $client->city ?? 'this location' }}.
        </div>
    @endif
@endsection
