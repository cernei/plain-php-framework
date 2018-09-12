<?php

namespace App\Models;

use App\System\Model;

class Reply extends Model
{
    protected static $table = 'replies';

    public function candidate()
    {
        return ['users', 'candidate_id', 'id'];
    }

    public function vacancy()
    {
        return ['vacancies', 'vacancy_id', 'id'];
    }
}