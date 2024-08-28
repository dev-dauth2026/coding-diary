<x-admin.admin-layout>
    <div class="container p-3" style="min-height: 80vh;">
        <h4>Edit Category</h4>  
        <hr class="col-2 mb-3">
        <div class="row d-flex justify-content-center py-3">
            <form action="{{route('admin.category.update',$category->id)}}" class="col-10 d-flex flex-column gap-3" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group d-flex flex-column gap-2">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$category->name)}}" placeholder="Enter a category name...">
                    @error('name')
                        <p class="invalid-feedback">{{$message}} </p>
                    @enderror
                </div>
                <div class="form-group d-flex flex-column gap-2">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{old('slug',$category->slug)}}" placeholder="Enter a category slug ...">
                    @error('slug')
                        <p class="invalid-feedback">{{$message}} </p>
                    @enderror
                </div>
                <div class="form-group d-flex flex-column gap-2">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description',$category->description)}}" placeholder="Enter a description name..." rows="4">{{old('description',$category->description)}}</textarea>
                    @error('description')
                        <p class="invalid-feedback">{{$message}} </p>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{route('admin.blog.category')}}" class="btn btn-outline-danger" type="button">Cancle</a>
                    <button class="btn btn-outline-info " type="submit">Update Category</button>
                </div>

            </form>
        </div>
    </div>
</x-admin.admin-layout>
