<div>

    <form wire:submit.prevent="login" id="loginForm" >
        <div @class('mb-3')>
            <label for="email-name" @class('form-label fw-semibold')>Email</label>
            <div @class('input-group')>
                <span @class('input-group-text')>
                    <i @class('bi bi-envelope')></i>
                </span>
                <input wire:model="email" type="email" @class('form-control') id="email-name" placeholder="Enter your email" required>
            </div>
            <x-input-error :field="('email')" />
        </div>

        <div @class('mb-3')>
            <label for="password" @class('form-label fw-semibold')>Password</label>
            <div @class('input-group')>
                <span @class('input-group-text')>
                    <i @class('bi bi-lock')></i>
                </span>
                <input wire:model="password" type="password" @class('form-control') id="password" placeholder="Enter your password" required>
                <button @class('btn btn-outline-secondary') type="button" id="togglePassword">
                    <i @class('bi bi-eye')></i>
                </button>
            </div>
            <x-input-error :field="('password')" />
        </div>

        <div @class('mb-3 form-check d-flex justify-content-between')>
            <span>
                <input type="checkbox" @class('form-check-input') id="rememberMe">
                <label @class('form-check-label') for="rememberMe">
                    Remember me
                </label>
            </span>
            <a href="{{ route('register') }}">Register</a>
        </div>

        <button type="submit" @class('btn btn-login mb-3')>
            <i @class('bi bi-box-arrow-in-right me-2')></i>
            Sign In
        </button>

        <hr @class('my-4')>
    </form>
</div>
