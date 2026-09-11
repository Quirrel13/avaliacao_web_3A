<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Http\Requests\CursoRequest;
use Illuminate\Support\Facades\Gate;
use App\Services\CursoService;

class CursoController extends Controller {

    public function __construct(protected CursoService $service) {}

    public function index() {

        Gate::authorize('viewAny', Curso::class);
        $data = $this->service->all(['disciplina', 'aluno'], [], 'nome');

        if (request()->is('api/*')) return response()->json($data);

        return view('curso.index', compact(['data']));
    }

    public function create() {

        Gate::authorize('create', Curso::class);

        if (request()->is('api/*')) return response()->json(['message' => 'Create!']);

        return view('curso.create');
    }

    public function store(CursoRequest $request) {

        Gate::authorize('create', Curso::class);
        $curso = $this->service->store($request->validated());

        if ($request->is('api/*')) return response()->json($curso, 201);

        return redirect()->route('curso.index');
    }

    public function show(string $id) {
        $curso = $this->service->find($id);
        Gate::authorize('view', $curso);

        if(isset($curso)) {
            if(request()->is('api/*')) return response()->json($curso);

            return view('curso.show', compact(['curso']));
        }

        return "<h1>Curso não encontrado!</h1>";
    }

    public function edit(string $id) {
        $curso = $this->service->find($id);
        Gate::authorize('update', $curso);

        if(isset($curso)) {
            if(request()->is('api/*')) return response()->json($curso);

            return view('curso.edit', compact(['curso']));
        }

        return "<h1>Curso não encontrado!</h1>";
    }

    public function update(CursoRequest $request, string $id) {
        $curso = $this->service->find($id);
        Gate::authorize('update', $curso);

        if(isset($curso)) {
            $updated = $this->service->update($request->validated(), $id);
            if(request()->is('api/*')) return response()->json($updated);

            return redirect()->route('curso.index');
        }

        return "<h1>Curso não encontrado!</h1>";
    }

    public function destroy(string $id) {
        $curso = $this->service->find($id);
        Gate::authorize('delete', $curso);

        if(isset($curso)) {
            $this->service->remove($id);

            if(request()->is('api/*')) return response()->json(['message' => 'Curso removido com sucesso.']);

            return redirect()->route('curso.index');
        }

        return "<h1>Curso não encontrado!</h1>";
    }

    public function audit(string $id) {
        $curso = $this->service->find($id);
        Gate::authorize('delete', $curso);

        if(isset($curso)) {
            $data = $this->service->audit($id);
            return view('curso.audit', compact(['data']));
        }

        return "<h1>Não encontrado!</h1>";
    }
}
