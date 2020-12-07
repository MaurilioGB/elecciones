@extends('plantilla')
@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="uper">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
    <table class="table table-striped">
    <thead>
        <tr>
        	
        	<th>Voto</th>
			<th>Candidato</th>
			<th>Votos</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($votocandidatos as $votocandidato)
		
			<tr>
				<td>{{$votocandidato->voto}}</td>
				<td>{{$votocandidato->candidato}}</td>
				<td>{{$votocandidato->votos}}</td>

				<td><a href="{{ route('votocandidato.edit', $votocandidato->id)}}"
					class="btn btn-primary">Edit</a></td>
				<td>

					<form action="{{ route('votocandidato.destroy', $votocandidato->id)}}"
					method="post">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger" type="submit"
						onclick="return confirm('Esta seguro de borrar el voto {{$votocandidato->voto}} con el candidato {{$votocandidato->candidato}}')" >Del</button>
					</form>
				</td>
			</tr>
		@endforeach

	</tbody>
	</table>
<div>
@endsection