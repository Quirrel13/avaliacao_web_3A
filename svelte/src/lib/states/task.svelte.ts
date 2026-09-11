import type { Task } from '../models/task.model';

// Criamos uma classe para encapsular o estado reativo
class TaskService {
  // A rune $state torna o array reativo
  items = $state<Task[]>([]);

  // Encapsulamos a lógica de persistência aqui
  init() {
    const saved = localStorage.getItem('tasks');
    if (saved) this.items = JSON.parse(saved);

    // $effect roda sempre que 'items' mudar
    $effect(() => {
      localStorage.setItem('tasks', JSON.stringify(this.items));
    });
  }

  add(task: Task) {
    this.items.push(task);
  }

  remove(id: string) {
    this.items = this.items.filter(i => i.id !== id);
  }
}

// Exportamos uma única instância (Singleton)
export const taskService = new TaskService();