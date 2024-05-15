<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		@vite(['resources/sass/app.scss', 'resources/js/app.js'])
		@routes
		@inertiaHead
		<script type="application/x-javascript">
			window.config = {
				app: {
					name: "{{ config('app.name') }}"
				}
			};
		</script>
	</head>
	<body>
		@inertia
	</body>
</html>
