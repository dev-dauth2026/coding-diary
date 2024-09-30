<x-user-layout>
    <div class="row justify-content-center align-items-center" style="min-height:80vh;">
        <div class="col-11 col-md-4">
            <div class="card mt-5 shadow">
                <div class="card-header text-center bg-info text-white">
                    <h4>Reset Your Password</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Enter your email address, password, and confirm your password to reset.</p>

                    @if (session('status'))
                        <div class="alert alert-success p-2" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Password Reset Form -->
                    <form method="POST" action="{{ route('password-update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-secondary">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
