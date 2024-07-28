<x-user-layout>
    
    <div class="col-12 d-flex justify-content-center align-items-center my-5 ">
        <div class="col-12 col-md-9 col-lg-4  card border border-light-subtle rounded-4">
            <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-5">
                            <h4 class="text-center">Login Here</h4>
                            @if (session('error'))
                            <div class="p-2 bg-danger-subtle text-danger rounded">
                                {{ session('error') }}
                            </div>
                            @endif
                            @if (Session::has('message'))
                            <div class="p-2 bg-success-subtle text-success rounded">
                                {{ Session::get('message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <form action="{{route('account.authenticate')}}" method="POST">
                    @csrf
                    <div class="row gy-3 overflow-hidden">
                       
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" value="{{old('email',session('verify_email'))}}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" >
                                <label for="email" class="form-label">Email</label>
                                @error('email')
                                    <p class="invalid-feedback">{{$message}} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Password" >
                                <label for="password" class="form-label">Password</label>
                                @error('password')
                                 <p class="invalid-feedback">{{$message}} </p>
                                 @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Log in now</button>
                            </div>
                        </div>
                    </div>
                </form>
                @if (session('message'))
                <div class="col-md-12 d-flex justify-content-center mt-5">
                    <form id="resend-form" method="POST" action="{{route('login.verification.resend')}}">
                        @csrf
                        <input type="hidden" id="resend-email" name="email" >
                        <button type="button" class="btn btn-outline-warning" onclick="resendVerification()">Resend Verification Email</button>
                    </form>
                </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <hr class="mt-5 mb-4 border-secondary-subtle">
                        <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                            <a href="{{route('account.register')}}" class="link-secondary text-decoration-none">Create new account</a>
                            <a href="{{route('password.request')}}" class="link-secondary text-primary">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>

<script>
    function resendVerification() {
        const email = document.getElementById('email').value;
        if (!email) {
            alert('Please enter your email to resend the verification link.');
            return;
        }
        document.getElementById('resend-email').value = email;
        document.getElementById('resend-form').submit();
    }
</script>
                    
               