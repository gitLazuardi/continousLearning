<template>
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header font-weight-bold">Find Movies from OMDB API</div>
        <div class="card-body">
            <div class="form-group">
              <label for="keyword">Search</label>
              <input
                type="text"
                v-model="form.keyword"
                id="keyword"
                class="form-control"
              />
            </div>
            <div class="form-group">
              <button type="submit" @click="searchMovie()" class="btn btn-primary text-light">Search</button>
                <img v-bind:src="'/images/load.gif'" width="70px" class="text-center" id="loader" style="visibility : hidden">
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
        <div class="card-header font-weight-bold">Result</div>
        <div v-if="errorMassages.description" class="col-md-12 text-danger">{{errorMassages.description}}</div>
        <div class="card-body row">
            <div v-for="(movie) in movies" :key="movie.id" class="card col-md-4" style="width: 9rem;">
              <img class="card-img-top" v-bind:src="movie.Poster" alt="Images">
              <div class="card-body">
                <h5 class="card-title font-weight-bold">{{movie.Title}}</h5>
                <p class="card-text">Type : {{movie.Type}}</p>
                <p class="card-text">Year : {{movie.Year}}</p>
                <a type="button" class="btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-lg" @click="detailMovie(movie.imdbID)">Detail</a>
              </div>
            </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-if="movieDetails.Title" class="modal-title font-weight-bold" id="exampleModalLabel">{{movieDetails.Title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="clearDetailMovie()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-md-12 row">
              <div class="col-md-6">
                <img v-if="movieDetails.Title" v-bind:src="movieDetails.Poster" alt="Images">
              </div>
              <div class="col-md-6">
                <p class="card-text">Actors : {{movieDetails.Actors}}</p>
                <p class="card-text">Genre : {{movieDetails.Genre}}</p>
                <p class="card-text">Plot : {{movieDetails.Plot}}</p>
                <p class="card-text">Production : {{movieDetails.Production}}</p>
                <p class="card-text">Release : {{movieDetails.Year}}</p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearDetailMovie()">Close</button>
          </div>
        </div>
      </div>
    </div>
   
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        keyword: "",
      },
      movies: {},
      movieDetails: {},
      errorMassages: {},
    };
  },

  methods: {
    async searchMovie() {
      let loader = document.getElementById("loader");
      loader.style.visibility = "visible"
      let params = {s: `${this.form.keyword}`};
      await axios.get('/api/movies/omdb', {params})
      .then(
        response => {
          loader.style.visibility = "hidden"
          this.movies = response.data.Search;
          this.errorMassages = {}
        }
      )
      .catch(
        error => {
          loader.style.visibility = "hidden",
          this.movies = {},
          this.errorMassages = {description : `Can't find any result, try another search word ...`}
        }
      );
    },
    async detailMovie(id) {
      let params = {i: `${id}`};
      await axios.get('/api/movies/omdbDetail', {params})
      .then(
        response => {
          this.movieDetails = response.data;
        }
      );
    },
    clearDetailMovie() {
      this.movieDetails = {};
    }
    
  },
};
</script>


