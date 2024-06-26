<x-app-web-layout>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <h2 class="font-weight-semibold text-xl text-dark leading-tight">
                    {{ __('Profile') }}
                </h2>
            </div>
        </div>
        
        <div class="row py-4">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-web-layout>

