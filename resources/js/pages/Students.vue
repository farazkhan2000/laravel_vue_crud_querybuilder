<template>
  <div class="bg-dark text-light pt-5" :style="{ height: '100vh' }">
    <div class="container">
      <h1 class="mt-5 text-center text-info fw-bold">CRUD - QueryBuilder</h1>
      <div class="row">
        <div class="col-lg-6">
          <StudentsForm />
        </div>
        <div class="col-lg-6">
          <StudentsTable />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StudentsForm from '../components/students/StudentsForm.vue';
import StudentsTable from '../components/students/StudentsTable.vue';

export default {
  name: 'Students',
  components: {
    StudentsForm,
    StudentsTable
  },
  data() {
    
  },
}
</script>