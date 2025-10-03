<div @class('card shadow-sm mx-auto') style="max-width: 500px;">
    <div @class('card-header bg-white d-flex align-items-center border-bottom py-3')>
        <i @class('bi bi-shield-lock-fill text-primary me-2 fs-5')></i>
        <h5 @class('mb-0 fw-bold text-dark')>Change Password</h5>
    </div>

    <div @class('card-body')>
        @if (session()->has('success'))
            <div @class('alert alert-success mb-4')>
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="changePassword">
            <div @class('mb-3')>
                <label @class('form-label fw-semibold')>Current Password</label>
                <input type="password" wire:model.defer="current_password" @class('form-control')>
                @error('current_password')
                    <div @class('text-danger small mt-1')>{{ $message }}</div>
                @enderror
            </div>

            <div @class('mb-3')>
                <label @class('form-label fw-semibold')>New Password</label>
                <input type="password" wire:model.defer="new_password" @class('form-control')>
                @error('new_password')
                    <div @class('text-danger small mt-1')>{{ $message }}</div>
                @enderror
            </div>

            <div @class('mb-4')>
                <label @class('form-label fw-semibold')>Confirm New Password</label>
                <input type="password" wire:model.defer="new_password_confirmation" @class('form-control')>
            </div>

            <button type="submit" @class('btn btn-primary w-100')>
                Update Password
            </button>
        </form>
    </div>
</div>