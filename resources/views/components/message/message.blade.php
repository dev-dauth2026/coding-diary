@if(Session::has('success'))
        <div class="p-2">
            <div class="alert alert-success alert-dismissible p-2 d-flex align-items-center justify-content-between" role="alert">
                <div>
                    <i class="fa-solid fa-circle-check text-success"></i> {{Session::get('success')}} 
                </div>
                <button type="button" class=" bg-transparent p-0 m-0 border-0" data-bs-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
 @endif
 @if($errors->any())    
 @foreach($errors->all() as $error)
     <p class="alert alert-danger p-2">{{ $error }}</p>
 @endforeach
@endif