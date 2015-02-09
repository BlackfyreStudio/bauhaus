<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compitable" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" user-scalable="no">

	<title>{{ Config::get('bauhaus::admin.title') }}</title>

	<link rel="stylesheet" href="{{ asset('packages/krafthaus/bauhaus/stylesheets/application.css') }}">

	@foreach (Config::get('bauhaus::admin.assets.stylesheets') as $stylesheet)
		<link rel="stylesheet" href="{{ $stylesheet }}">
	@endforeach

</head>
<body>

	<header>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{{ route('admin.dashboard') }}" class="navbar-brand">{{ Config::get('bauhaus::admin.title') }}</a>
				</div>

				<div class="collapse navbar-collapse" id="navbar-collapse">
					{{ $menu }}
				</div>
			</div>
		</nav>
	</header>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				@yield('sidebar')
			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<section class="sub-header">
					<div class="container-fluid">
						@yield('subheader')
					</div>
				</section>

				<div class="container-fluid">
					@yield('content')
				</div>
			</div>
		</div>
	</div>

	<script src="{{ asset('packages/krafthaus/bauhaus/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('packages/krafthaus/bauhaus/javascripts/application.min.js') }}"></script>
	@yield('scripts')

	@foreach (Config::get('bauhaus::admin.assets.javascripts') as $javascript)
		<script src="{{ $javascript }}"></script>
	@endforeach

	<div class="modal fade" id="field-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close">&times;</button>
					<h4 class="modal-title">
						{{ trans('bauhaus::form.modal.loading') }}
					</h4>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
