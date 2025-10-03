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
    Route::view('/interviews', 'hr1.applicant_management.interviews')->name('interviews');
    Route::view('/offer-acceptance', 'hr1.applicant_management.offer-acceptance')->name('offer-acceptance');

    //New Hire Onboarding
    Route::view('/new-hires', 'hr1.onboarding.new-hires')->name('new-hires');
    Route::view('/document-checklist', 'hr1.onboarding.document-checklist')->name('document-checklist');
    Route::view('/orientation-plan', 'hr1.onboarding.orientation-plan')->name('orientation-plan');

    //Performance Management
    Route::view('/new-hire-reviews', 'hr1.performance_management.new-hire-reviews')->name('new-hire-reviews');
    Route::view('/employee-evaluations', 'hr1.performance_management.employee-evaluations')->name('employee-evaluations');
    Route::view('/evaluation-form', 'hr1.performance_management.evaluation-form')->name('evaluation-form');


    //Social Recognition
    Route::view('/shout-outs', 'hr1.social_recognition.shout-outs')->name('shout-outs');
    Route::view('/shoutout-records', 'hr1.social_recognition.shoutout-records')->name('shoutout-records');

    //Settings 
    Route::view('/user-logs', 'hr1.settings.user-logs')->name('user-logs');
    Route::view('/account', 'hr1.settings.account')->name('account');
});