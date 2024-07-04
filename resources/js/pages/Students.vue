<template>
  <div class="bg-dark text-light pt-5" :style="{ height: '100vh' }">
    <div class="container">
      <h1 class="mt-5 text-center text-info fw-bold">CRUD - QueryBuilder</h1>
      <div class="row">
        <div class="col-lg-6">
          <StudentsForm @studentAdded="handleStudentAdded" />
        </div>
        <div class="col-lg-6">
          <StudentsTable :students="students" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import StudentsForm from '../components/students/StudentsForm.vue';
import StudentsTable from '../components/students/StudentsTable.vue';

export default {
  name: 'Students',
  components: {
    StudentsForm,
    StudentsTable
  },
  data() {
    return {
      students: [],
    };
  },
  methods: {
    async getStudents() {
      try {
        const response = await axios.get('/get-students');
        this.students = response.data;
      } catch (error) {
        console.error('Error fetching students:', error);
      }
    },
    handleStudentAdded(newStudent) {
      this.students.push(newStudent);
    }
  },
  mounted() {
    this.getStudents();
  }
}
</script>

<style scoped>
/* Add any relevant styles here */
</style>
