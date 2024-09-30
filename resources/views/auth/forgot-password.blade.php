<x-user-layout>
    <div class="row justify-content-center align-items-center" style="min-height:80vh;">
        <div class="col-11 col-md-4">
            <div class="card mt-5 shadow">
                <div class="card-header text-center bg-info text-white">
                    <h4>Forgot Your Password?</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Enter your email address below, and we'll send you a link to reset your password.</p>
    
                    @if (session('status'))
                        <div class="alert alert-success p-2" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    <!-- Forgot Password Form -->
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
    
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="d-grid">
                            <button type="submit" class="btn btn-secondary">Send Password Reset Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>

