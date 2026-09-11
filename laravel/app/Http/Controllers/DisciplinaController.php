<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Http\Requests\DisciplinaRequest;
use App\Services\CursoService;
use App\Services\DisciplinaService;
use Illuminate\Support\Facades\Gate;

class DisciplinaController extends Controller {

    public function __construct(
        protected DisciplinaService $service,
        protected CursoService $cursoService
    ) {}

    public function index() {

        Gate::authorize('viewAny', Disciplina::class);
        $data = $this->service->all(['curso'], [], 'nome');
        if (request()->is('api/*')) return response()->json($data);

        return view('disciplina.index', compact(['data']));
    }

    public function create() {
        Gate::authorize('create', Disciplina::class);
        $cursos = $this->cursoService->all([], [], 'nome');
        if (request()->is('api/*')) return response()->json($cursos);

        return view('disciplina.create', compact(['cursos']));
    }

    public function store(DisciplinaRequest $request) {

        Gate::authorize('create', Disciplina::class);
        $disciplina = $this->service->store($request->validated());
        if ($request->is('api/*'))  return response()->json($disciplina, 201);

        return redirect()->route('disciplina.index');
    }

    public function show(string $id) {

        $disciplina = $this->service->find($id, ['curso']);
        Gate::authorize('view', $disciplina);

        if(isset($disciplina)) {
            if(request()->is('api/*')) return response()->json($disciplina);

            return view('disciplina.show', compact(['disciplina']));
        }

        return "<h1>Disciplina não encontrada!</h1>";
    }

    public function edit(string $id) {
        $disciplina = $this->service->find($id, ['curso']);
        Gate::authorize('update', $disciplina);
        $cursos = $this->cursoService->all([], [], 'nome');

        if(isset($disciplina)) {
             if(request()->is('api/*')) return response()->json($disciplina);

            return view('disciplina.edit', compact(['disciplina', 'cursos']));
        }

        return "<h1>Disciplina não encontrada!</h1>";
    }

    public function update(DisciplinaRequest $request, string $id) {

        $disciplina = $this->service->find($id);
        Gate::authorize('update', $disciplina);

        if(isset($disciplina)) {
            $updated = $this->service->update($request->validated(), $id);
            if(request()->is('api/*')) return response()->json($updated);

            return redirect()->route('disciplina.index');
        }

        return "<h1>Disciplina não encontrada!</h1>";
    }

    public function destroy(string $id) {

        $disciplina = $this->service->find($id);
        Gate::authorize('delete', $disciplina);

        if(isset($disciplina)) {
            $this->service->remove($id);
            if(request()->is('api/*')) return response()->json(['message' => 'Disciplina removida com sucesso.']);

            return redirect()->route('disciplina.index');
        }

        return "<h1>Disciplina não encontrada!</h1>";
    }
}
