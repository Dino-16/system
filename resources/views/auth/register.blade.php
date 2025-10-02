@extends('layouts.guest')

@section('content')
<div @class('login-container')>
    <div @class('row g-0')>
        <!-- Left Side - Welcome -->
        <div @class('col-lg-6 login-left')>
            <div @class('floating-shapes')>
                <div @class('shape')></div>
                <div @class('shape')></div>
                <div @class('shape')></div>
            </div>

            <div @class('logo-container')>
                <div @class('logo-box')>
                    <img src="{{ asset('images/logo.png') }}" alt="Jetlouge Travels">
                </div>
                <h1 @class('brand-text')>Jetlouge Travels</h1>
                <p @class('brand-subtitle')>Employee Portal</p>
            </div>

            <h2 @class('welcome-text')>Welcome Back!</h2>
            <p @class('welcome-subtitle')>
                Access your HR dashboard to manage employee records, 
                streamline recruitment, and support organizational growth.
            </p>

            <ul @class('feature-list')>
                <li>
                    <i @class('bi bi-check')></i>
                    <span>Manage employee profiles & roles</span>
                </li>
                <li>
                    <i @class('bi bi-check')></i>
                    <span>Track job applications & interview schedules</span>
                </li>
                <li>
                    <i @class('bi bi-check')></i>
                    <span>Monitor performance reviews & feedback</span>
                </li>
                <li>
                    <i @class('bi bi-check')></i>
                    <span>Secure access to HR tools & workflows</span>
                </li>
            </ul>
        </div>

        <!-- Right Side - Login Form -->
        <div @class('col-lg-6 login-right')>
            <h3 @class('text-center mb-4') style="color: var(--jetlouge-primary); font-weight: 700;">
                Sign In to Your Account
            </h3>

            @livewire('auth.register')
        </div>
    </div>
</div>
@endsection