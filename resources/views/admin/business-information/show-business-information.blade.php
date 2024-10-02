<x-admin.admin-layout>
    <div class="container mt-5" style="min-height: 80vh;">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-info text-white d-flex justify-content-between">
                        <h4 class="mb-0">Business Information</h4>
                        <a class="btn btn-light text-decoration-none "  href="{{route('admin.business-information.edit',$businessInformation->id)}}">Edit</a>
                    </div>
                    <div class="card-body">
                        @if($businessInformation)
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Business Name:</strong> {{ $businessInformation->business_name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Email:</strong> {{ $businessInformation->email }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Phone Number:</strong> {{ $businessInformation->phone_number }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Address:</strong> {{ $businessInformation->address }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Website:</strong>
                                    @if ($businessInformation->website)
                                        <a href="{{ $businessInformation->website }}" target="_blank">{{ $businessInformation->website }}</a>
                                    @else
                                        Not Available
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <strong>Facebook:</strong>
                                    @if ($businessInformation->facebook_link)
                                        <a href="{{ $businessInformation->facebook_link }}" target="_blank">{{ $businessInformation->facebook_link }}</a>
                                    @else
                                        Not Available
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <strong>Instagram:</strong>
                                    @if ($businessInformation->instagram_link)
                                        <a href="{{ $businessInformation->instagram_link }}" target="_blank">{{ $businessInformation->instagram_link }}</a>
                                    @else
                                        Not Available
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <strong>Twitter:</strong>
                                    @if ($businessInformation->twitter_link)
                                        <a href="{{ $businessInformation->twitter_link }}" target="_blank">{{ $businessInformation->twitter_link }}</a>
                                    @else
                                        Not Available
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    <strong>YouTube:</strong>
                                    @if ($businessInformation->youtube_link)
                                        <a href="{{ $businessInformation->youtube_link }}" target="_blank">{{ $businessInformation->youtube_link }}</a>
                                    @else
                                        Not Available
                                    @endif
                                </li>
                            </ul>
                        @else
                            <p class="text-muted">No business information available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.admin-layout>
