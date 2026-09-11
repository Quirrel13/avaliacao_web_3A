<?php

namespace App\Http\Controllers\Api;

use App\Models\Curso;
use App\Http\Controllers\Controller;
use App\Http\Requests\CursoRequest;
use Illuminate\Support\Facades\Gate;
use App\Services\CursoService;
use Illuminate\Http\JsonResponse;

class CursoController extends Controller {

    public function __construct(protected CursoService $service) {}

    public function index(): JsonResponse {

        Gate::authorize('viewAny', Curso::class);
        $data = $this->service->all(['disciplina', 'aluno'], [], 'nome');
        return response()->json($data);
    }
    public function store(CursoRequest $request): JsonResponse {

        Gate::authorize('create', Curso::class);
        $curso = $this->service->store($request->validated());
        return response()->json($curso, 201); // 201 Created
    }
    public function show(string $id): JsonResponse {

        $curso = $this->service->find($id);
        Gate::authorize('view', $curso);
        if(isset($curso)) {
            return response()->json($curso);
        }

        return response()->json(['message' => 'Curso não encontrado!'], 404);
    }

    public function update(CursoRequest $request, string $id): JsonResponse {

        $curso = $this->service->find($id);
        Gate::authorize('update', $curso);

        if(isset($curso)) {
            $updated = $this->service->update($request->validated(), $id);
            return response()->json($updated);
        }

        return response()->json(['message' => 'Curso não encontrado!'], 404);
    }

    public function destroy(string $id): JsonResponse {

        $curso = $this->service->find($id);
        Gate::authorize('delete', $curso);

        if(isset($curso)) {
            $this->service->remove($id);
            return response()->json(['message' => 'Curso removido com sucesso.']);
        }

        return response()->json(['message' => 'Curso não encontrado!'], 404);
    }
}
