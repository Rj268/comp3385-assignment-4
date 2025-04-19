<template>
  <h1 class="mt-4">Movies</h1>
  <div v-if="movies.length === 0">No movies available.</div>
  <div class="row">
    <div
      v-for="movie in movies"
      :key="movie.id"
      class="col-md-4 mb-4"
    >
      <div class="card h-100">
        <img
          :src="movie.poster"
          class="card-img-top"
          alt="Poster"
        />
        <div class="card-body">
          <h5 class="card-title">{{ movie.title }}</h5>
          <p class="card-text">{{ movie.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const movies = ref([]);

async function fetchMovies() {
  try {
    const res = await fetch('/api/v1/movies');
    const json = await res.json();
    movies.value = json.movies;
  } catch (e) {
    console.error('Failed to fetch movies:', e);
  }
}

onMounted(fetchMovies);
</script>
