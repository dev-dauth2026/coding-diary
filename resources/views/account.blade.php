<x-user-layout>
    <div class="container mt-4 p-5">
        @if(Session::has('status'))
        <p class="text-success bg-success-subtle p-2 rounded">{{Session::get('status')}} </p>
        @endif
        <h1 class="mb-5w text-center mb-5x">My Account</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Personal Information</h5>
                        <form method="POST" action="{{route('username.change')}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label @error('name') is-inavlid @enderror">Name</label>
                                <input type="text"  class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" >
                                @error('name')
                                <p class="invalid-feedback">{{$message}} </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label @error('email') is-invalid @enderror" >Email</label>
                                <input type="text"  class="form-control" id="email" name="email" value="{{ Auth::user()->email }}"  readonly>
                                @error('email')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary-subtle">Update Information</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        
                        <form method="POST" action="{{ route('password.change') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="current_password" class="form-label @error('current_password') is-invalid @enderror">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" >
                                @error('current_password')
                                    <p class="invalid-feedback">{{$message}} </p>
                                @enderror
                               
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label @error('new_password') is-invalid @enderror">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" >
                                @error('new_password')
                                    <p class="invalid-feedback">{{$message}} </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label @error('new_password_confirmation') is-invalid @enderror">Confirm New Password</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" >
                                @error('new_password_confirmation')
                                    <p class="invalid-feedback">{{$message}} </p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary-subtle">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Profile Picture</h5>
                        @if(Auth::user()->profile_picture)
                            <img src="{{asset('storage/' . Auth::user()->profile_picture)}} " alt="profile picture" style="width: 100px; height: 100px; border-radius: 50%">
                        @else
                        <h1><i class="bi bi-person-circle bi-3x"></i></h1>
                        @endif
                        
                        <form method="POST" action="{{route('profile_picture.change')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label @error('profile_picture') is-inavlid @enderror">Upload New Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture" >
                                @error('profile_picture')
                                <p class="invalid-feedback">{{$message}} </p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary-subtle">Upload Picture</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">Account Settings</h5>
                        <form method="POST" action="">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="notification_preferences" class="form-label">Notification Preferences</label>
                                <select class="form-control" id="notification_preferences" name="notification_preferences">
                                    <option value="all" {{ Auth::user()->notification_preferences == 'all' ? 'selected' : '' }}>All Notifications</option>
                                    <option value="email" {{ Auth::user()->notification_preferences == 'email' ? 'selected' : '' }}>Email Only</option>
                                    <option value="none" {{ Auth::user()->notification_preferences == 'none' ? 'selected' : '' }}>No Notifications</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="privacy_settings" class="form-label">Privacy Settings</label>
                                <select class="form-control" id="privacy_settings" name="privacy_settings">
                                    <option value="public" {{ Auth::user()->privacy_settings == 'public' ? 'selected' : '' }}>Public</option>
                                    <option value="private" {{ Auth::user()->privacy_settings == 'private' ? 'selected' : '' }}>Private</option>
                                    <option value="custom" {{ Auth::user()->privacy_settings == 'custom' ? 'selected' : '' }}>Custom</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary-subtle">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>

