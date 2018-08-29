@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>Объявления</h1>

    @forelse($vacancies as $vacancy)
        <div class="card mb-4">
            <div class="card-header">
                <strong>{{ $vacancy->title }}</strong>
            </div>
            <div class="card-body">
                {{ $vacancy->text }}
            </div>
            <div class="card-footer">
                {{ $vacancy->email }}
                <span class="float-right">
                    {{ $vacancy->created_at }}
                </span>
            </div>
        </div>
    @empty
        <h2 class="text-danger">Нет вакансий</h2>
    @endforelse

    {{ $vacancies->links() }}

    <form action="{{ route('addVacancy') }}" method="POST">
        @csrf
        <hr>
        <h3>Добавить вакансию</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                    <textarea class="form-control" name="text" value="{{ old('text') }}" placeholder="Текст вакансии" rows="6"></textarea>
                    <small class="text-danger">{{ $errors->first('text') }}</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->first('title') }}">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Название вакансии" required>
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                </div>
                <div class="form-group{{ $errors->first('email') }}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ваш e-mail" required>
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                <button type="submit" class="btn btn-primary">
                    Отправить
                </button>
            </div>
        </div>
    </form>

</div>
@endsection
