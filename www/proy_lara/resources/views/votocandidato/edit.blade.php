@extends('plantilla')
@section('content')
<style>
.uper {margin-top: 40px;
}
</style>
<div class="card uper">
	<div class="card-header">
		Editar Votos de los Candidatos
	</div>
	<div class="card-body">
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div><br />
		@endif
		<form method="post" action="{{ route('votocandidato.update', $votocandidato->id) }} " enctype="multipart/form-data">
			@method('PUT')
			{{ csrf_field() }}

			<div class="form-group">
				@csrf
				<label for="voto">Voto:</label>
				<select name="voto_id">
                    @foreach ($votos as $voto)
                        @php
                            $selected = ($votocandidato->voto_id==$voto->id)?" selected ":"";
                        @endphp
                        <option value="{{ $voto->id }}" {{ $selected }}>{{ $voto->eleccion_id }}</option>
                    @endforeach
                </select>			
            </div>

			<div class="form-group">
				@csrf
				<label for="candidato">Candidato:</label>
				<select name="candidato_id">
                    @foreach ($candidato as $candidato)
                        @php
                            $selected = ($votocandidato->candidato_id==$candidato->id)?" selected ":"";
                        @endphp
                        <option value="{{ $candidato->id }}" {{$selected}}>{{ $candidato->nombrecompleto }}</option>
                    @endforeach
                </select>
			</div>

			<div class="form-group">
				@csrf
				<label for="votos">Votos:</label>
				<input type="int" value="{{$votocandidato->votos}}" 
				class="form-control"
				name="votos"/>
			</div>
			
			<button type="submit" class="btn btn-primary">Guardar</button>
		</form>
	</div>
</div>
@endsection