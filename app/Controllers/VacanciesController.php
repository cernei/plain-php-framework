<?php
namespace App\Controllers;

use App\Models\Vacancy;
use App\Models\Reply;
use \Auth;

class VacanciesController
{
	
	function index()
	{
	    $id = Auth::getUser()->id;
	    $items = Vacancy::where(['user_id' => $id]);
        return render('vacancies/index', ['title' => 'My vacancies', 'items' => $items]);
	}

	function create()
	{
        return render('vacancies/create');
	}

    function show($id)
    {
        $vacancy = Vacancy::find($id);

        $renderVars = ['title' => $vacancy->title, 'item' => $vacancy];
        if (Auth::check()) {
            $user = Auth::getUser();
            if ($user->type==1) {
                $apply = Reply::where(['candidate_id' => $user->id, 'vacancy_id' => $vacancy->id ]);
                if ($apply) $renderVars['apply'] = $apply;
            }
        }

        return render('vacancies/show', $renderVars );
    }

    function store()
    {
        $set = [
            'user_id' => Auth::getUser()->id,

            'title' => $_POST['title'],
            'salary' => $_POST['salary'],
            'content' => $_POST['content']
        ];
        Vacancy::insert($set);
        return redirect('vacancies.index');
    }

    function edit($id)
    {
        $item = Vacancy::find($id);
        return render('vacancies/edit', ['title' => 'Edit vacancy: ' . $item->title, 'item' => $item]);
    }

    function update($id)
    {
        $vacancy = Vacancy::find($id);
        $userId = Auth::getUser()->id;
        $set = [
            'title' => $_POST['title'],
            'salary' => $_POST['salary'],
            'content' => $_POST['content']
        ];

        if ($vacancy && $vacancy->user_id == $userId) {
            Vacancy::update($set, ['id' => $id]);
        }
        return redirect('vacancies.index');

    }

    function destroy($id)
    {
        $vacancy = Vacancy::find($id);
        if ($vacancy && $vacancy->user_id == Auth::getUser()->id) {
            Vacancy::delete(['id' => $id]);
            Reply::delete(['vacancy_id' => $id]);
            return redirect('vacancies.index');
        }

    }
}