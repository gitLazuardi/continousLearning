<template>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header font-weight-bold">Create Movies</div>
        <div class="card-body">
          <form method="post" action="#" @submit.prevent="store">
            <input
              type="hidden"
              v-model="form.id"
              id="title"
              class="form-control"
            />
            <div class="form-group">
              <label for="title">Title</label>
              <input
                type="text"
                v-model="form.title"
                id="title"
                class="form-control"
              />
              <div v-if="errorMassages.title" class="mt-2 text-danger">{{errorMassages.title[0]}}</div>
            </div>
            <div class="form-group">
              <label for="category">Category</label>
              <select
                v-model="form.category_id"
                id="category"
                class="form-control"
              >
                <option
                  v-for="category in categorys"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category.name }}
                </option>
              </select>
              <div v-if="errorMassages.category_id" class="mt-2 text-danger">{{errorMassages.category_id[0]}}</div>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea
                v-model="form.description"
                id="description"
                cols="30"
                rows="10"
                class="form-control"
              ></textarea>
              <div v-if="errorMassages.description" class="mt-2 text-danger">{{errorMassages.description[0]}}</div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary text-light">Save</button>
              <a href="#result" id="gow"></a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8" id="result">
      <div class="card">
        <div class="card-header font-weight-bold">Movie List</div>
        <div class="card-body">
          <table class="table">
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Category</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
            <tr v-for="(movie, index) in movies" :key="movie.id">
              <td>{{ index + 1 }}</td>
              <td>{{ movie.title }}</td>
              <td>{{ movie.category }}</td>
              <td>{{ movie.description }}</td>
              <td>
                <a href="#" class="btn btn-success text-light" @click="getMovie(`${movie.slug}`)">Edit</a>
                <a href="#" class="btn btn-danger text-light" @click="deleteMovie(`${movie.id}`)">Delete</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {title: "",description: "",category_id: "",},
      categorys: {},
      movies: {},
      errorMassages: {},
    };
  },

  mounted() {
    this.getCategory();
    this.getMovies();
  },

  methods: {
    async getCategory() {
      await axios.get("/api/category")
      .then(
        response => {
          this.categorys = response.data;
        }
      );
    },
    async getMovies() {
      await axios.get("/api/movies")
      .then(
        response => {
          this.movies = response.data.data;
        }
      );
    },
    async store() {
      await axios.post("/api/movies/create-movie", this.form)
      .then(
        response => {
          this.$toasted.show('Data saved..', {
            type : 'success',
            duration : 2000
          });
          this.getMovies();
          this.errorMassages = {};
          this.form = {};
          document.getElementById("gow").click();
        }
      ).catch(
        error => {
          this.errorMassages = error.response.data.errors;
          this.$toasted.show('Something went wrong..', {
              type : 'error',
              duration : 2000
            });
        }
      );
    },
    async getMovie(slug) {
      await axios.get(`/api/movies/${slug}`)
      .then(
        response => {
          this.form = response.data;
        }
      );
    },
    async deleteMovie(id) {
      await axios.delete(`/api/movies/delete/${id}`)
      .then(
        response => {
          this.getMovies();
          this.$toasted.show('Data deleted..', {
            type : 'error',
            duration : 2000
          });
        }
      );
    },
  },
};
</script>


