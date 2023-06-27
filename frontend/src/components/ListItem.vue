<template>
  <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
    <li class="list-group-item d-flex align-items-center ps-0 py-1 rounded-0 border-0 bg-transparent">
      <div class="form-check">
        <input @click="updateTaskStatus()" class="form-check-input me-0" type="checkbox" value=""
               aria-label="..." :checked="task.status === 1"/>
      </div>
    </li>
    <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent justify-content-between"
        :class="task.status === 1 ? 'text-decoration-line-through' : ''">
      <p v-if="!editMode" class="lead fw-normal mb-0 max-width-400 text-wrap me-5">{{ task.title }}</p>
      <input v-else @keyup.enter="updateTaskText()" type="text" class="form-control" v-model="task.title">

      <div class="ps-5 d-flex justify-content-between">
        <svg v-if="editMode" @click="updateTaskText()" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer"
             height="1em" viewBox="0 0 448 512">
          <path
            d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
        </svg>
        <svg @click="editMode = !editMode" class="ms-2" xmlns="http://www.w3.org/2000/svg" style="cursor: pointer"
             height="1em" viewBox="0 0 512 512">
          <path
            d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
        </svg>
        <svg @click="deleteTask()" class="ms-2" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg"
             height="1em" viewBox="0 0 448 512">
          <path
            d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
        </svg>
      </div>
    </li>
  </ul>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ListItem',
  props: {
    task: Object,
  },
  emits: ['tasks-updated'],
  data() {
    return {
      editMode: false,
    };
  },
  methods: {
    async deleteTask() {
      try {
        await axios.delete(`/api/task/${this.task.id}/delete`);
        this.$emit('tasks-updated');
      } catch (error) {
        console.error(error);
      }
    },

    async updateTaskStatus() {
      const newStatus = this.task.status === 1 ? 0 : 1;

      try {
        await axios.put(`/api/task/${this.task.id}`, { status: newStatus });
        this.$emit('tasks-updated');
      } catch (error) {
        console.error(error);
      }
    },

    async updateTaskText() {
      try {
        await axios.put(`/api/task/${this.task.id}`, { title: this.task.title });
        this.editMode = false;
        this.$emit('tasks-updated');
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
