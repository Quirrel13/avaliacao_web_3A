<script lang="ts">
  import TaskForm from './lib/components/TaskForm.svelte';
  import TaskTable from './lib/components/TaskTable.svelte';
</script>

<main class="min-h-screen bg-stone-50 p-8">
  <div class="max-w-4xl mx-auto">
    <header class="mb-8">
      <h1 class="text-3xl font-bold text-stone-800">Gerenciador de Atividades</h1>
    </header>

    <TaskForm />
    <TaskTable />
  </div>
</main>