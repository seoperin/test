@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Панель администрирования</h1>

    @forelse($vacancies as $vacancy)
        @include('dashboard._vacancy-card')
    @empty
        <h2 class="text-danger">Нет вакансий</h2>
    @endforelse

    {{ $vacancies->links() }}
    
</div>
@endsection
