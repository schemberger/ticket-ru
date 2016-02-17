@extends(Config::get('sgiauthorizer.view.layout'))
@section(Config::get('sgiauthorizer.view.contentUserInfo'))

	Username: {{$usuario->username}}
	</br>	
	Nome: {{$usuario->nome}}
	</br>
	Cpf: {{$usuario->cpf}}
	</br>
	Rg: {{$usuario->rg}}
	</br>
	Email: {{$usuario->email}}
@endsection