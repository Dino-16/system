<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group( function() {
    Route::view('/', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
});

Route::middleware(['auth'])->group( function() {
    Route::view('/dashboard', 'hr1.dashboard')->name('dashboard');

    //Recruitment Management
    Route::view('/requisitions', 'hr1.recruitment_management.requisitions')->name('requisitions');
    Route::view('/job-postings', 'hr1.recruitment_management.job-postings')->name('job-postings');

    //Applicant Management
    Route::view('/applications', 'hr1.applicant_management.applications')->name('applications');
    Route::view('/filtered-resumes', 'hr1.applicant_management.filtered-resumes')->name('filtered-resumes');
    Route::view('/candidates', 'hr1.applicant_management.candidates')->name('candidates');

    //Social Recognition
    Route::view('/shout-outs', 'hr1.social_recognition.shout-outs')->name('shout-outs');
        Route::view('/shoutout-records', 'hr1.social_recognition.shoutout-records')->name('shoutout-records');
});