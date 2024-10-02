<x-admin.admin-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Edit Business Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.business-information.update', $businessInformation->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Business Name -->
                            <div class="mb-3">
                                <label for="business_name" class="form-label">Business Name</label>
                                <input type="text" name="business_name" id="business_name" class="form-control @error('business_name') is-invalid @enderror" value="{{ old('business_name', $businessInformation->business_name) }}" required>
                                @error('business_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $businessInformation->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $businessInformation->phone_number) }}" required>
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address', $businessInformation->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Website -->
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website', $businessInformation->website) }}">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Social Media Links -->
                            <div class="mb-3">
                                <label for="facebook_link" class="form-label">Facebook Link</label>
                                <input type="url" name="facebook_link" id="facebook_link" class="form-control @error('facebook_link') is-invalid @enderror" value="{{ old('facebook_link', $businessInformation->facebook_link) }}">
                                @error('facebook_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="instagram_link" class="form-label">Instagram Link</label>
                                <input type="url" name="instagram_link" id="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" value="{{ old('instagram_link', $businessInformation->instagram_link) }}">
                                @error('instagram_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="twitter_link" class="form-label">Twitter Link</label>
                                <input type="url" name="twitter_link" id="twitter_link" class="form-control @error('twitter_link') is-invalid @enderror" value="{{ old('twitter_link', $businessInformation->twitter_link) }}">
                                @error('twitter_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="youtube_link" class="form-label">YouTube Link</label>
                                <input type="url" name="youtube_link" id="youtube_link" class="form-control @error('youtube_link') is-invalid @enderror" value="{{ old('youtube_link', $businessInformation->youtube_link) }}">
                                @error('youtube_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-info">Update Business Information</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.admin-layout>
