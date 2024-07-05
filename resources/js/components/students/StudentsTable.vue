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
            <button @click="editStudent(student)" data-bs-toggle="modal" data-bs-target="#edit_student_modal" class="btn text-light p-0">
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

    <!-- Edit Student Modal -->
    <div class="modal" id="edit_student_modal" tabindex="-1" role="dialog" aria-labelledby="editStudentLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark rounded-0">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="editStudentLabel">Edit Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="updateStudent" class="mt-5 rounded p-5 w-75" :style="{ backgroundColor: '#040406' }">
              <div class="mb-3">
                <label for="name" class="form-label">Name: </label>
                <input type="text" class="form-control bg-dark text-light border-0 rounded-0" id="name" name="name" v-model="selectedStudent.name">
              </div>
              <div class="mb-3">
                <label for="age" class="form-label">Age: </label>
                <input type="number" class="form-control bg-dark text-light border-0 rounded-0" id="age" name="age" v-model="selectedStudent.age">
              </div>
              <div class="mb-3">
                <label for="profession" class="form-label">Profession: </label>
                <input type="text" class="form-control bg-dark text-light border-0 rounded-0" id="profession" name="profession" v-model="selectedStudent.profession">
              </div>
              <button type="submit" class="btn btn-dark rounded-0 px-3 mt-3">Update Student</button>
            </form>
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
    editStudent(student) {
      this.selectedStudent = { ...student };
    },
    async updateStudent() {
      try {
        const response = await axios.put(`/update-student/${this.selectedStudent.id}`, this.selectedStudent);
        console.log('Student updated successfully:', response.data);
        
        // Update the student in the local array to reflect the changes
        const index = this.students.findIndex(student => student.id === this.selectedStudent.id);
        if (index !== -1) {
          this.$set(this.students, index, response.data);
        }
        
        // Close the modal
        const modal = new bootstrap.Modal(document.getElementById('edit_student_modal'));
        modal.hide();
      } catch (error) {
        console.error('Error updating student:', error);
      }
    },
    async deleteStudent(id) {
      try {
        const response = await axios.delete(`/delete-student/${id}`);
        console.log('Student deleted:', response.data);
        
        // Optionally remove the student from the local array to reflect UI changes
        const index = this.students.findIndex(student => student.id === id);
        if (index !== -1) {
          this.students.splice(index, 1);
        }
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
