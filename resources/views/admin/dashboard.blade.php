<x-admin.admin-layout>

@if (Session::has('postCreated'))
<p class="text-success bg-success-subtle p-2 rounded">{{Session::get('postCreated')}} </p>
@endif

<h2 class="my-4 text-capitalize">{{ Auth::guard('admin')->user()->role }} Dashboard</h2>
<div class="col-12 col-md-6 col-lg-3 ">
    <div class="card h-100">
        <div class="card-body bg-primary-subtle">
            <h5 class="card-title">Total Blogs : {{$totalPosts}} </h5>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="card h-100">
        <div class="card-body bg-success-subtle">
            <h5 class="card-title">Users: {{$totalUsers}} </h5>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="card h-100">
        <div class="card-body bg-danger-subtle">
            <h5 class="card-title">Admin Users: {{$totalAdminUsers}} </h5>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-3 ">
    <div class="card h-100">
        <div class="card-body bg-secondary-subtle">
            <h5 class="card-title">Messages</h5>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 col-lg-3">
    <div class="card h-100">
        <div class="card-body bg-primary-subtle">
            <h5 class="card-title ">Add New Blog</h5>
        </div>
    </div>
</div>
</x-admin.admin-layout>