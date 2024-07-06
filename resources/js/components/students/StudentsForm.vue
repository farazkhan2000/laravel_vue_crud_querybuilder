  <template>
    <form @submit.prevent="addStudent" class="mt-5 rounded p-5 w-75" :style="{ backgroundColor: '#040406' }">
      <div class="mb-3">
        <label for="name" class="form-label">Name: </label>
        <input type="text" class="form-control bg-dark text-light border-0 rounded-0" id="name" name="name" v-model="formData.name">
      </div>
      <div class="mb-3">
        <label for="age" class="form-label">Age: </label>
        <input type="number" class="form-control bg-dark text-light border-0 rounded-0" id="age" name="age" v-model="formData.age">
      </div>
      <div class="mb-3">
        <label for="profession" class="form-label">Profession: </label>
        <input type="text" class="form-control bg-dark text-light border-0 rounded-0" id="profession" name="profession" v-model="formData.profession">
      </div>
      <button type="submit" class="btn btn-dark rounded-0 px-3 mt-3">Add Student</button>
    </form>
  </template>

  <script>
  import axios from 'axios';

  export default {
    name: 'StudentForm',
    data() {
      return {
        formData: {
          name: '',
          age: '',
          profession: ''
        }
      };
    },
    methods: {
      async addStudent() {
        try {
          const response = await axios.post('/add-student', this.formData);
          console.log('Student added successfully:', response.data);

          this.$emit('studentAdded', response.data)
          
          // Clear the form
          this.formData.name = '';
          this.formData.age = '';
          this.formData.profession = '';
        } catch (error) {
          console.error("Error adding student to db: ", error);
        }
      }
    }
  }
  </script>

  <style scoped>
  /* Add any relevant styles here */
  </style>
