<x-admin.admin-layout>
    <div class="container p-3" style="min-height: 80vh;">
        @if(Session::has('success'))
            <p class="bg-success-subtle text-success p-2 rounded">{{Session::get('success')}} </p>
        @endif
        <h4>Blog categories</h4>
        <hr class="col-2 mb-3">
        <div class="row">
            <div class="d-flex col-12  justify-content-end mb-5">
                <a href="{{route('admin.category.create')}}" class="btn btn-outline-info ">Add Category</a>
            </div>
            <div class="table-responsive">
                @if($categories->count()>0)
                <table class="table table-striped table-hover border-top text-decoration-none">
                    <thead>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                                
                                <th scope="row">
                                    <a href="{{route('admin.category.edit',$category->id)}}" class="text-decoration-none text-dark ">
                                    {{$category->id}} 
                                    </a>
                                </th>
                                <td class="text-nowrap">
                                    <a href="{{route('admin.category.edit',$category->id)}}" class="text-decoration-none text-dark ">
                                    {{$category->name}} 
                                    </a>
                                </td>
                                <td class="text-nowrap">
                                     <a href="{{route('admin.category.edit',$category->id)}}" class="text-decoration-none text-dark ">
                                    {{$category->slug}} 
                                    </a>
                                </td>
                                <td >
                                     <a href="{{route('admin.category.edit',$category->id)}}" class="text-decoration-none text-dark ">
                                        <span class=" d-inline-block ">
                                        {{ \Illuminate\Support\Str::limit($category->description, 50) }}
                                        </span>
                                     </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{route('admin.category.edit',$category->id)}}" class=""><i class="fa-solid fa-pen-to-square text-warning"></i></a>
                                        <form action="#" method="POST">
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
                  <div class="d-flex justify-content-center">
                    <h4>Sorry, No data available</h4>
                  </div>
                  @endif
            </div>
        </div>
    </div>
</x-admin.admin-layout>
