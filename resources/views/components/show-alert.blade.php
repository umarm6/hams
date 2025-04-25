<div>
    @if (session('status_error'))
         @dd(session('status_error'))
     @endif

    @if (session('status_success'))
        <div class="alert alert-success">
            {{ session('status_success') }}
        </div>
    @endif

    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
</div>
