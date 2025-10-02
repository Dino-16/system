<div>
    <form wire:submit.prevent="register" id="registerForm">
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Enter your name" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input wire:model="email" type="email" class="form-control" id="email" placeholder="Enter your email" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input wire:model="password" type="password" class="form-control" id="password" placeholder="Create a password" required>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
            <input wire:model="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm your password" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label fw-semibold">Role</label>
            <select wire:model="role" class="form-select" id="role" required>
                <option>Select a role</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
                <option value="manager">Manager</option>
            </select>
            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        
        <div @class('mb-3 form-check d-flex justify-content-between')>
            <span>
                <input type="checkbox" @class('form-check-input') id="rememberMe">
                <label @class('form-check-label') for="rememberMe">
                    Remember me
                </label>
            </span>
            <a href="{{ route('login') }}">Login</a>
        </div>

        <button type="submit" @class('btn btn-login mb-3')>
            <i @class('bi bi-box-arrow-in-right me-2')></i>
            Sign Up
        </button>
    </form>
</div>