<x-admin.admin-layout>
    <div class="container p-3" style="min-height: 80vh;">
        <h4>Edit Comment</h4>
        <hr class="col-2 mb-3">
        <div class="row">
            <form class="d-flex flex-column gap-3" action="{{route('admin.comments.update',$comment->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group d-flex flex-column gap-2">
                    <label for="content">Comments</label>
                    <textarea type="text" name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Enter a comment...." value="{{old('content',$comment->content)}}" rows="4">{{old('content',$comment->content)}}</textarea>
                    @error('content')
                        <p class="invalid-feedback">{{$message}} </p>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a  href="{{route('admin.comments')}}" class="btn btn-outline-danger">Cancel</a>
                    <button class="btn btn-outline-info" type="submit">Update Comment</button>
                </div>
            </form>
        </div>

    </div>
</x-admin.admin-layout>
