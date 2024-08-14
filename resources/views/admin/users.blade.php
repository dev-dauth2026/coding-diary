<x-admin.admin-layout>
    <style>
         .bg-success-gradient {
            background: linear-gradient(45deg, #0ad038, #91dba2);
        }
        /* .bg-danger-gradient {
            background: linear-gradient(45deg, #a90415, #d5838b);
        } */
        .bg-secondary-gradient {
            background: linear-gradient(45deg, #536779, #b9c6d2);
        }
    </style>
    <div class="container  p-3  bg-body-tertiary">
        @if (Session::has('success'))
        <div class="p-2 bg-success-subtle text-success rounded mb-2">
            {{ Session::get('success') }}
        </div>
        @endif
        <h4> <i class="fa-solid fa-users me-2"></i>Users Page</h4>
        <hr class="col-2 mb-5" >
        
        <div class="row" style="min-height: 80vh;">
            <div class="d-flex flex-column justify-contente-center">
                <div class="col-12 d-flex justify-content-between mb-5">
                    <div class="col-5">
                        <div class="card bg-success-gradient h-100">
                            <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                                <i class="fa-solid fa-user fa-3x text-white-50"></i>
                                <div>
                                    <h5 class="card-title text-white">Admin</h5>
                                    <h4 class="card-text display-4 text-white">{{$totalAdminUsers}} </h4>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card bg-secondary-gradient h-100">
                            <div class="card-body d-flex flex-row justify-content-center align-items-center gap-3 text-center">
                                <i class="fa-solid fa-users fa-3x text-white-50"></i>
                                <div>
                                    <h5 class="card-title text-secondary text-white">Customers</h5>
                                    <h4 class="card-text display-4 text-white">{{$totalUsers}} </h4>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class=" col-12 table-responsive p-5 bg-white">

                    {{-- filtered categories display --}}
                    <p>Filtered:</p>

                    <div class="mb-3 d-flex align-items-baseline" > Role: 
                        @if($filteredRole !=='all')
                                @foreach ($roles as $role)
                                <span class='text-capitalize fw-bold'> {{$filteredRole == $role->id ?  $role->name : ''}}</span>
                                @endforeach
                        @else
                             <span class='text-capitalize fw-bold'> {{ $filteredRole=='all'?'All':''}}</span>
                        @endif

                        @if(!empty($searchQuery))
                            <span class="ms-2">, Search Query:</span>
                            <span class="fw-bold">{{$searchQuery}} </span>
                        @endif

                        @if(!empty($verified))
                            <span class="ms-2">, Verified Filter:</span>
                            <span class="fw-bold text-capitalize">{{$verified}} </span>
                        @endif

                        <form action="{{route('admin.users')}}" method="GET">
                            <input type="hidden" value=""  name="search_username" hidden>
                            <input type="hidden" value="all"  name="role_id" hidden>
                            <input type="hidden" value="all"  name="verified" hidden>
                            <button class="btn btn-transparent text-primary" type="submit"> Reset</button>
                        </form>
                        
                    
                    </div>
                    {{-- filtered categories display ends--}}

                    {{--all filters section  --}}
                    <div class="d-flex gap-5 mb-5">

                        {{-- Role filter section  --}}
                        <div class="col-2">
                            <form action="{{route('admin.users')}}" method="GET">
                                <input type="hidden" value="{{$searchQuery}}"  name="search_username" hidden>
                                <input type="hidden" value="{{$verified}}"  name="verified" hidden>
                                <select class="form-select text-capitalize" name="role_id" aria-label="Default select example" onchange="this.form.submit()">
                                    <option value="all">All Users</option>
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{(!empty($filteredRole) && $filteredRole==$role->id)?'selected': ''}} >{{$role->name}} </option>
                                    @endforeach
        
                                  </select>
                            </form>
                        
                        </div>
                        {{-- Role filter section  ends --}}


                        {{-- search section  --}}
                        
                        <div class=" flex-grow-1 position-relative">
                          
                            <form action="{{route('admin.users')}}" method="GET" class="d-flex gap-2 col-12 grow-fill ">
                                <input type="hidden" value="{{$filteredRole}}"  name="role_id" hidden>
                                <input type="hidden" value="{{$verified}}"  name="verified" hidden>
                                <div class="d-flex align-items-center">
                                    <button class="btn bg-transparent" type="submit"><i class="fa-solid fa-magnifying-glass fs-4"></i></button>
                                </div>
                                <div class="d-flex flex-column grow-fill  form-group w-100 ">
                                    <input class="form-control " name="search_username" placeholder="Search username..." value="{{$searchQuery??old('search_username')}}">
                                   
                                </div>
                                
                            </form>
                            
                        </div>
                        {{-- search section  ends--}}

                        {{-- Verified filter section  --}}
                        <div class="col-2 d-flex gap-2 align-items-center justify-content-center">
                            <form action="{{route('admin.users')}}" method="GET" class="d-flex justify-content-center align-items-center gap-2">
                                <span class="">Verified:</span>
                                <input type="hidden" value="{{$searchQuery}}"  name="search_username" hidden>
                                <input type="hidden" value="{{$filteredRole}}"  name="role_id" hidden>
                                <select class="form-select" aria-label="Default select " name="verified" onchange="this.form.submit()">

                                    <option  value="all" {{ request('verified') == 'all' ? 'selected' : '' }}>All</option>
                                    <option  value="verified" {{ request('verified') == 'verified' ? 'selected' : '' }}>Verified</option>
                                    <option value="unverified" {{ request('verified') == 'unverified' ? 'selected' : '' }}>Unverified</option>
        
                                </select>
                            </form>
                        </div>
                          {{-- Verified filter section ends --}}


                        {{-- Row filter section  --}}
                        <div class="col-2 d-flex gap-2 align-items-center justify-content-center">
                            <span>Rows:</span>
                            <select class="form-select" aria-label="Default select example">

                                <option selected value="1">1</option>
                                <option value="2">2</option>
    
                              </select>
                        </div>
                          {{-- Row filter section ends --}}
                         
                          
                    </div>
                    {{--all filters section ends --}}


                    @if(($users)->count()>0)
                    <table class="table table-borderless table-striped table-hover align-middle border-top">
                        <thead >
                            <tr >
                              <th scope="col">SN</th>
                              <th scope="col">Profile Image</th>
                              <th scope="col">Username</th>
                              <th scope="col">Email</th>
                              <th scope="col">Role</th>
                              <th scope="col">Verified</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody class="border-top ">
                            @foreach($users as $index => $user)
                            <tr>
                              <th scope="row">{{ $index + 1 }}</th>
                              <td>
                                <img src="{{asset('storage/' . $user->profile_picture)}} " alt="profile picture" style="width: 100px; height: 100px; border-radius: 50%">

                              </td>
                              <td>{{$user->name}} </td>
                              <td>{{$user->email}} </td>
                              <td>
                                  <form action="{{route('admin.roles.update',$user->id)}}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <select name="role_id" class="form-control" onchange="this.form.submit()">
                                          @foreach($roles as $role)
                                          <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                <span @class(['bg-success text-white rounded p-2'=>$user->role =='admin','bg-secondary text-white p-2 rounded'=>!$user->role =='admin'])>
                                                {{ $role->name }}
                                            </span> 
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                             </td>
                             <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    @if($user->email_verified_at !==null)
                                    <span><i class="fa-solid fa-circle-check text-success"></i></span>
                                    @else
                                    <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    @endif
                                </div>
                               
                             </td>
                              <td>
                                <div class="d-flex gap-2">
                                    <a href="{{route('admin.user.edit',$user->id)}}" class=""><i class="fa-solid fa-pen-to-square text-warning"></i></a>
                                    <form action="{{route('admin.user.delete',$user->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn bg-transparent border-none m-0 p-0" type="submit" onclick="return confirm('Are you really want to remove this user?')"><i class="fa-solid fa-trash text-danger"></i></button>
                                    </form>
                                   
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          
                          </tbody>
                    </table>
                    @else
                    <div class="bg-body-tertiary d-flex justify-content-center align-items-center" style="min-height:40vh;">
                        <h4>Sorry no users</h4>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-admin.admin-layout>
