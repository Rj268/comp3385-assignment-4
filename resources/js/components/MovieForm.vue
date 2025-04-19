<template>
  <form id="movieForm" @submit.prevent="saveMovie">
    <div class="form-group mb-3">
      <label for="title" class="form-label">Title</label>
      <input
        v-model="form.title"
        id="title"
        name="title"
        type="text"
        class="form-control"
        required
      />
    </div>

    <div class="form-group mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea
        v-model="form.description"
        id="description"
        name="description"
        class="form-control"
        required
      ></textarea>
    </div>

    <div class="form-group mb-3">
      <label for="poster" class="form-label">Poster</label>
      <input
        id="poster"
        name="poster"
        type="file"
        class="form-control"
        required
      />
    </div>

    <button type="submit" class="btn btn-primary">Save</button>

    <!-- Success/Error Feedback -->
    <div v-if="successMessage" class="alert alert-success mt-3">
      {{ successMessage }}
    </div>
    <div v-if="errorMessage" class="alert alert-danger mt-3">
      {{ errorMessage }}
    </div>
  </form>
</template>

<script setup>
import { ref } from 'vue';

// form state
const form = ref({ title: '', description: '' });

// feedback messages
const successMessage = ref('');
const errorMessage = ref('');

async function saveMovie() {
  successMessage.value = '';
  errorMessage.value = '';

  // build FormData
  const movieForm = document.getElementById('movieForm');
  const formData = new FormData(movieForm);

  try {
    const res = await fetch('/api/v1/movies', {
      method: 'POST',
      body: formData,
      headers: { Accept: 'application/json' }
    });

    const data = await res.json();
    if (!res.ok) {
      // flatten and show validation errors
      errorMessage.value = Object.values(data.errors || {})
        .flat()
        .join(' ');
      return;
    }

    successMessage.value = 'Movie added successfully!';
    // reset
    form.value.title = '';
    form.value.description = '';
    document.getElementById('poster').value = null;
  } catch (e) {
    console.error(e);
    errorMessage.value = 'An unexpected error occurred.';
  }
}
</script>
