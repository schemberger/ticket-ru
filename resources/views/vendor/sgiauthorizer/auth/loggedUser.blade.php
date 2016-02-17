@section(Config::get('sgiauthorizer.view.contentLoggedUser'))
	@if({{unserialize(session()->has('sgiauthorizer.usuario')}})
		<a href=Config::get('sgiauthorizer.app.userInfoRoute')>{{unserialize(session()->get('usuario'))->username}}</a>
	@else
		<button>Login</button>
	@endif
@endsection