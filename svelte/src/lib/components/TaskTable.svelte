<script lang="ts">
  import { taskService } from '../states/task.svelte';
</script>

<div class="overflow-x-auto bg-white rounded-lg shadow-md border border-gray-200">
  <table class="w-full text-left border-collapse">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-4 border-b">Nome</th>
        <th class="p-4 border-b">Tipo</th>
        <th class="p-4 border-b">Data</th>
        <th class="p-4 border-b">Ações</th>
      </tr>
    </thead>
    <tbody>
      {#each taskService.items as item (item.id)}
        <tr class="hover:bg-gray-50">
          <td class="p-4 border-b">{item.name}</td>
          <td class="p-4 border-b">
            <span class="px-2 py-1 rounded text-xs bg-orange-100 text-orange-800">{item.type}</span>
          </td>
          <td class="p-4 border-b">{item.date}</td>
          <td class="p-4 border-b">
            <button onclick={() => taskService.remove(item.id)} class="text-red-500 hover:underline">
              Excluir
            </button>
          </td>
        </tr>
      {:else}
        <tr>
          <td colspan="4" class="p-8 text-center text-gray-500">Nenhuma atividade cadastrada.</td>
        </tr>
      {/each}
    </tbody>
  </table>
</div>