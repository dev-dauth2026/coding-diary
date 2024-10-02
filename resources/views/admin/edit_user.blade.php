<x-admin.admin-layout>
    <div class="container p-3" style="min-height:80vh; ">
        <h4 class="mb-0">Edit User</h4>
        <hr class="col-2 mb-3 ">
        <div class="row gap-2">
            <div>
                <img src="{{asset('storage/' . $user->profile_picture)}}" alt="profile picture" style="width: 100px; height: 100px; border-radius: 50%">
            </div>
            <form action="{{route('admin.user.update',$user->id)}}" method="POST" class=" d-flex flex-column ">
                @csrf
                @method('PUT')
            <div class="row gy-3">
                <div class="col-12 col-md-6 form-group d-flex flex-column gap-2">
                    <label for="name">Username</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name...." name="name" value="{{old('name',$user->name)}}">
                    @error('name')
                    <p class="invalid-feedback">{{$message}}</p>    
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group d-flex flex-column gap-2">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter  email address...." name="email" value="{{old('email',$user->email)}}">
                    @error('email')
                    <p class="invalid-feedback">{{$message}} </p>
                @enderror
                </div>
                <div class="col-12 col-md-6 form-group d-flex flex-column gap-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Change the password..." name="password" value="">
                    @error('password')
                        <p class="invalid-feedback">{{$message}} </p>
                    @enderror
                </div>
                <div class="col-12 col-md-6 form-group d-flex flex-column gap-2">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm the password..." name="password_confirmation" value="">
                    @error('password_confirmation')
                    <p class="invalid-feedback">{{$message}} </p>
                    @enderror
                </div>
                <div class="col-12  form-group d-flex flex-column gap-2">
                    <label for="role_role">Role </label>
                    <select class="form-control text-capitalize @error('role_id') is-invalid @enderror" name="role_id">
                        @foreach($roles as $role)
                            <option  value="{{$role->id}}" {{$role->id==$user->role_id ? 'selected': ''}}  >{{$role->name}}  </option>
                        @endforeach
                    </select>
                    @error('role_id')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
                <div class="d-flex  justify-content-end ms-auto">
    
                    <a href="{{route('admin.users')}}" class="btn text-danger" >Cancel</a>
                    <button class="btn btn-info" type="submit">Update</button>
                </div>
       
            </div>
                    
                
            </form>
        </div>
       
    </div>
</x-admin.admin-layout>
