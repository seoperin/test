<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vacancy;

class AdminController extends Controller
{
    public function dashboard()
    {
        $vacancies = Vacancy::ordered()->with(['user'])->paginate(50);
        return view('dashboard.dashboard', compact('vacancies'));
    }

    public function moderate($id, Request $request)
    {
        $vacancy = Vacancy::findOrFail($id);
        if ($request->get('status') == 1) {
            $vacancy->accept();
        } elseif($request->get('status') == 0) {
            $vacancy->reject();
        }
        return back()->with('success', 'Статус вакансии '.$id.' изменён');;
    }

    public function showVacancy($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        return view('dashboard.showVacancy', compact('vacancy'));
    }
}
