<div class="card mb-4">
    <div class="card-header">
        <strong>{{ $vacancy->title }}</strong>
    </div>
    <div class="card-body">
        {{ $vacancy->text }}
        <hr>
        @if ($vacancy->is_active === "1")
            <strong class="text-success">Опубликовано</strong>
        @elseif ($vacancy->is_active === "0")
            <strong class="text-danger">Отклонено</strong>
        @else
            <strong class="text-warning">На модерации</strong>
        @endif
        <form action="{{ route('admin.moderate', $vacancy->id) }}" method="POST">
            @csrf
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="status" type="radio" id="action{{ $vacancy->id }}" value="1" @if($vacancy->is_active === "1") checked @endif>
                <label class="form-check-label" for="action{{ $vacancy->id }}">Принять</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="status" type="radio" id="reject{{ $vacancy->id }}" value="0" @if($vacancy->is_active === "0") checked @endif>
                <label class="form-check-label" for="reject{{ $vacancy->id }}">Отклонить</label>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">
                Отправить
            </button>
        </form>

    </div>
    <div class="card-footer">
        {{ $vacancy->email }}
        <span class="float-right">
            {{ $vacancy->created_at }}
        </span>
    </div>
</div>