<template>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card" id="list1">
            <div class="card-body py-4 px-4 px-md-5">
              <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                <i class="fas fa-check-square me-1"></i>
                <u>To Do List</u>
              </p>
              <div class="pb-2">
                <div class="card">
                  <div class="card-body">
                    <form id="create-task-form" @submit.prevent="createTask">
                      <div class="d-flex justify-content-between">
                        <input type="text" v-model="formData.title"
                               class="form-control form-control-lg"
                               id="exampleFormControlInput1"
                               placeholder="Add new...">
                        <div class="d-flex align-self-center ms-2">
                          <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <hr class="my-4">

              <ul>
                <ListItem v-for="(task, index) in tasks" :key="index" :task="task" @tasks-updated="fetchTasks"></ListItem>
              </ul>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios';
import ListItem from "./ListItem.vue";

export default {
  name: 'List',

  data() {
    return {
      tasks: [],
      formData: {
        title: '',
      }
    };
  },

  components: {
    ListItem,
  },

  mounted() {
    this.fetchTasks();
  },

  methods: {
    fetchTasks() {
      axios.get('/api/tasks')
        .then(response => {
          this.tasks = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
    createTask() {
      axios.post(`/api/task/create`, this.formData)
        .then(response => {
          this.fetchTasks();
          this.formData.title = '';
        })
        .catch(error => {
          console.error(error);
        });
    }
  }
};
</script>
