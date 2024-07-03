<template>
  <form class="mt-5 rounded p-5 w-75" :style="{ backgroundColor: '#040406' }">
    <div class="mb-3">
      <label for="name" class="form-label">Name: </label>
      <input type="text" class="form-control bg-dark text-light border-0 rounded-0" id="name" >
    </div>
    <div class="mb-3">
      <label for="age" class="form-label">Age: </label>
      <input type="number" class="form-control bg-dark text-light border-0 rounded-0" id="age">
    </div>
    <div class="mb-3">
      <label for="profession" class="form-label">Profession: </label>
      <input type="text" class="form-control bg-dark text-light border-0 rounded-0" id="profession">
    </div>
    <button type="submit" class="btn btn-dark rounded-0 px-3 mt-3">Submit</button>
  </form>
</template>