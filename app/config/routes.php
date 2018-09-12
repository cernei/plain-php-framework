<?php
return [
    'web' => [
        'vacancies.show' => ['/vacancies/{:int}', 'VacanciesController@show'],

        'home.index' => ['/', 'HomeController@index'],
        'home.login' => ['/login', 'HomeController@login'],
        'home.auth' => ['/auth', 'HomeController@auth', ['http' => 'POST']],

    ],

    'auth' => [
        'vacancies.create' => ['/vacancies/create', 'VacanciesController@create'],
        'vacancies.store' => ['/vacancies', 'VacanciesController@store', ['http' => 'POST']],
        'vacancies.update' => ['/vacancies/{:int}', 'VacanciesController@update', ['http' => 'PUT']],
        'vacancies.destroy' => ['/vacancies/{:int}','VacanciesController@destroy', ['http' => 'DELETE']],
        'vacancies.index' => ['/vacancies', 'VacanciesController@index' ],
        'vacancies.edit' => ['/vacancies/edit/{:int}', 'VacanciesController@edit' ],

        'replies.store' => ['/replies/store/{:int}', 'RepliesController@store' ],
        'replies.index' => ['/replies', 'RepliesController@index' ],

        'home.logout' => ['/logout', 'HomeController@logout']
    ]
];