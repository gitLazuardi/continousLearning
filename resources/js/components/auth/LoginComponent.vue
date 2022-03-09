<template>
  <div class="col-md-4 simple-card">
      <h1 class="text-dark font-weight-bold">Login</h1>
    <label class="form-label bg-success text-dark font-weight-bold" v-if="show.clicked">Login Form Filled Succesfully</label>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label text-dark font-weight-bold">Email address</label>
      <input type="email" autocomplete="off" class="form-control" v-model="user.email" id="exampleInputEmail1" aria-describedby="emailHelp">
      <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label text-dark font-weight-bold">Password</label>
      <input type="password" autocomplete="off" class="form-control" v-model="user.password" id="exampleInputPassword1">
    </div>
    <button type="submit" @click="login" class="btn btn-md btn-outline-dark text-dark font-weight-bold">Login</button>
    <button type="button" @click="tryDemo" class="btn btn-md btn-outline-dark text-dark font-weight-bold">Try Demo</button>
  </div>
</template>

<script>
export default {
    data: () => ({
        user: {
            email: "",
            password: ""
        },
        show: {},
    }),
    methods: {
        login(){
            this.$store.dispatch('loginUser', {user : this.user, parrent: this})
        },
        tryDemo(){
            this.user = {
              email: "admin@test.com",
              password: "cobacoba",
            }
            this.show = {
              clicked : true,
            }
        }
    }
}
</script>

<style>
    
</style>