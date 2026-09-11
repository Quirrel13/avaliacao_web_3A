<script lang="ts">
  import { taskService } from '../states/task.svelte';

  let name = $state('');
  let type = $state('');
  let date = $state('');

  function handleSubmit(event: Event) {
    event.preventDefault();
    
    if (name && type && date) {
      taskService.add({
        id: crypto.randomUUID(),
        name,
        type,
        date
      });
      // Resetar campos
      name = ''; type = ''; date = '';
    }
  }
</script>

<form onsubmit={handleSubmit} class="bg-white p-6 rounded-lg shadow-md mb-6 border border-gray-200">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <input bind:value={name} placeholder="Nome da atividade" class="border p-2 rounded w-full" required />
    
    <select bind:value={type} class="border p-2 rounded w-full" required>
      <option value="" disabled selected>Selecione o tipo</option>
      <option value="Trabalho">Trabalho</option>
      <option value="Estudo">Estudo</option>
      <option value="Lazer">Lazer</option>
    </select>

    <input type="date" bind:value={date} class="border p-2 rounded w-full" required />
  </div>
  
  <button type="submit" class="mt-4 bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700">
    Cadastrar Atividade
  </button>
</form>