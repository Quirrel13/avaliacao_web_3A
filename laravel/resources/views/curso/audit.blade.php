@extends('template/main',
    [
        'titulo'=>"Sistema Aula",
        'cabecalho' => 'Lista de Cursos',
        'rota' => '',
    ]
)
@section('conteudo')

     <table class="table align-middle caption-top table-striped">
        <thead>
            <th class="text-secondary">AÇÃO</th>
            <th class="text-secondary">AUTOR</th>
            <th class="d-none d-md-table-cell text-secondary">DATA HORA</th>
            <th class="d-none d-md-table-cell text-secondary">MUDOU DE</th>
            <th class="text-secondary">PARA</th>
        </thead>
        <tbody>
            @foreach ($data as $audit)
                 <tr>
                    <td>{{ strtoupper($audit->event) }}</td>
                    <td>{{ $audit->user->name ?? 'Sistema/Console' }}</td>
                    <td class="d-none d-md-table-cell">{{ $audit->created_at->format('d/m/Y H:i') }}</td>
                    <td class="d-none d-md-table-cell">
                        @if(count($audit->old_values) == 0)
                            -
                        @else
                            @foreach ($audit->old_values as $key => $value)
                                <p><strong>{{ strtoupper($key) }}:</strong> {{ $value }}</p>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if(count($audit->new_values) == 0)
                            -
                        @else
                            @foreach ($audit->new_values as $key => $value)
                                <p><strong>{{ strtoupper($key) }}:</strong> {{ $value }}</p>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
