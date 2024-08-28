<x-user-dashboard-layout>
    <main style="min-height:90vh;">
        <div class="container py-3 py-md-3">
            <!-- Page Header -->
            <div class="mb-3">
                <h4>User Settings</h4>
                <hr class="col-2">
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Privacy Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Privacy Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('account.settings.updatePrivacy') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="profile_visibility" class="form-label">Profile Visibility</label>
                            <select name="profile_visibility" class="form-select">
                                @foreach($profileVisibilityOptions as $option)
                                    <option value="{{ $option }}" {{ $user->profile_visibility == $option ? 'selected' : '' }}>
                                        {{ ucfirst($option) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="activity_status" class="form-label">Show Activity Status</label>
                            <select name="activity_status" class="form-select">
                                <option value="1" {{ $user->activity_status ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$user->activity_status ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Privacy Settings</button>
                    </form>
                </div>
            </div>

            <!-- Language Preferences -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Language Preferences</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('account.settings.updateLanguage') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="language" class="form-label">Preferred Language</label>
                            <select name="language" class="form-select">
                                @foreach($languageOptions as $language)
                                    <option value="{{ $language }}" {{ $user->language == $language ? 'selected' : '' }}>
                                        {{ ucfirst($language) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Language</button>
                    </form>
                </div>
            </div>

        
            <!-- Email Preferences -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Email Preferences</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('account.settings.updateEmailPreferences') }}" method="POST">
                        @csrf
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="marketing_emails" name="marketing_emails" value="1" {{ $user->marketing_emails ? 'checked' : '' }}>
                            <label class="form-check-label" for="marketing_emails">
                                Receive marketing emails
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="update_emails" name="update_emails" value="1" {{ $user->update_emails ? 'checked' : '' }}>
                            <label class="form-check-label" for="update_emails">
                                Receive update notifications
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Email Preferences</button>
                    </form>
                </div>
            </div>

            <!-- Account Deactivation -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Account Deactivation</h5>
                </div>
                <div class="card-body">
                    <p class="text-danger">Warning: Deactivating your account will disable your profile and remove your access temporarily. You can reactivate it by logging back in.</p>
                    <form action="{{ route('account.settings.deactivate') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Deactivate Account</button>
                    </form>
                </div>
            </div>

            <!-- Two-Factor Authentication (2FA) -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Two-Factor Authentication (2FA)</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('account.settings.update2FA') }}" method="POST">
                        @csrf
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="enable_2fa" name="enable_2fa" {{ $user->two_factor_enabled ? 'checked' : '' }}>
                            <label class="form-check-label" for="enable_2fa">Enable Two-Factor Authentication</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update 2FA Settings</button>
                    </form>
                </div>
            </div>

            <!-- Download Data -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Download Your Data</h5>
                </div>
                <div class="card-body">
                    <p>You can download all your data stored on our platform in a JSON format.</p>
                    <form action="{{ route('account.settings.downloadData') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Download Data</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-user-dashboard-layout>
