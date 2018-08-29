<?php

namespace App\Http\Controllers;

use App\Vacancy;
use Illuminate\Http\Request;
use App\Http\Requests\AddVacancyRequest;

class MainController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::active()->ordered()->paginate(50);
        return view('home', compact('vacancies'));
    }

    public function addVacancy(AddVacancyRequest $request)
    {
        $authUser = auth()->user();
        $vacancy = $authUser->vacancies()->create($request->all());

        if ($authUser->isNotTrusted()) {
            // Если не доверяем пользователю
            $vacancy->sendToModeration();
            $status = 'warning';
            $message = 'Ваша вакансия отправлена на модерацию';
        } else {
            $vacancy->accept();
            $status = 'success';
            $message = 'Ваша вакансия опубликована';
        }

        return redirect()->route('home')
            ->with($status, $message);
    }
}
