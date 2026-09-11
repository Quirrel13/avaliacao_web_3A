@extends('template/main',
    [
        'titulo'=>"Sistema Aula",
        'cabecalho' => 'Detalhes do Curso',
        'rota' => '',
    ]
)
@section('conteudo')

    <div class="row">
        <div class="col" >
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    value="{{ $curso->nome }}"
                    disabled
                />
                <label for="nome">Nome</label>

                @if($errors->has('nome'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('nome') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" >
            <div class="form-floating mb-3">
                <input
                    type="number"
                    class="form-control"
                    value="{{ $curso->duracao }}"
                    disabled
                />
                <label for="duracao">Duração</label>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col">
            <a href="{{route('curso.index')}}" class="btn btn-secondary btn-block align-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
                &nbsp; Voltar
            </a>
        </div>
    </div>
@endsection
