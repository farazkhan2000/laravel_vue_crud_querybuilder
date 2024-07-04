<template>
  <div>
    <table class="table table-dark table-striped table-hover mt-5">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Age</th>
          <th scope="col">Profession</th>
          <th scope="col">Operations</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="student in students" :key="student.id">
          <td>{{ student.id }}</td>
          <td>{{ student.name }}</td>
          <td>{{ student.age }}</td>
          <td>{{ student.profession }}</td>
          <td class="d-flex gap-4">
            <button type="button" @click="showSingleStudent(student)" data-bs-toggle="modal" data-bs-target="#single_student_data_modal" class="btn text-light p-0">
              <i class="bi bi-eye"></i>
            </button>
            <button class="btn text-light p-0">
              <i class="bi bi-pen"></i>
            </button>
            <button @click="deleteStudent(student.id)" class="btn text-light p-0">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="modal" id="single_student_data_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark rounded-0">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="exampleModalLabel">Student Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p><strong>ID:</strong> {{ selectedStudent.id }}</p>
            <p><strong>Name:</strong> {{ selectedStudent.name }}</p>
            <p><strong>Age:</strong> {{ selectedStudent.age }}</p>
            <p><strong>Profession:</strong> {{ selectedStudent.profession }}</p>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-light rounded-0" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'StudentsTable',
  props: {
    students: {
      type: Array,
      required: true,
    }
  },
  data() {
    return {
      selectedStudent: {}
    };
  },
  methods: {
    async showSingleStudent(student) {
      try {
        const response = await axios.get(`/get-single-student/${student.id}`);
        this.selectedStudent = response.data;
      } catch (error) {
        console.error('Error fetching student details:', error);
      }
    },
    async deleteStudent(id) {
      try {
        const response = await axios.delete(`/delete-student/${id}`);
        console.log('Student deleted:', response.data); // Log success message if needed
        // Optionally remove the student from the local array to reflect UI changes
      } catch (error) {
        console.error('Error deleting student:', error);
      }
    }
  }
}
</script>

<style scoped>
/* Add any relevant styles here */
</style>
