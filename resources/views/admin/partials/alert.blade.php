@if (session('success'))
	<div class="alert alert-success fade show mb-4" role="alert">
	  {{ session('success') }}
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger fade show mb-4" role="alert">
	  {{ session('error') }}
	</div>
@endif

@if (session('info'))
	<div class="alert alert-info fade show mb-4" role="alert">
	  {{ session('info') }}
	</div>
@endif

@if (session('warning'))
	<div class="alert alert-warning fade show mb-4" role="alert">
	  {{ session('warning') }}
	</div>
@endif