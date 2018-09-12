<?php
namespace App\Controllers;

use App\Models\Vacancy;
use App\Models\Reply;
use \Auth;

class RepliesController
{
	
	function index()
	{
	    $id = Auth::getUser()->id;
        $replies = Reply::where(['company_id' => $id]);

        $replies = Reply::oneToOne('candidate', $replies);
        $replies = Reply::oneToOne('vacancy', $replies);

        return render('replies', ['title' => 'Replies', 'items' => $replies]);
	}


    function store($id)
    {
        $item = Vacancy::find($id);
        if ($item) {
            $constraint = [
                'vacancy_id' => $id,
                'candidate_id' => Auth::getUser()->id,
                'company_id' => $item->user_id
            ];
            $apply = Reply::where($constraint);
            if (!$apply) {
                Reply::insert($constraint);
            }

            return redirect('vacancies.show', $item->id);
        }
    }


}