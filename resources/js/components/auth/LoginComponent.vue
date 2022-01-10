<template>
<div class="container">
    <div class="col-md-12 justify-content-center">
      <div class="row">
        <div class="col-md-8">
          <div class="blockk"></div>
              <h3 class="text-light text-center font-weight-bold">“Learn continually. There's always “One More Thing” to learn.”<br>— Steve Jobs</h3>
            <div class="spaceafter"></div>
          </div>
          <div class="col-md-4 simple-card">
            <h1 class="text-light font-weight-bold">Login</h1>
          <label class="form-label bg-success text-light font-weight-bold" v-if="show.clicked">Login Form Filled Succesfully</label>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label text-light font-weight-bold">Email address</label>
            <input type="email" autocomplete="off" class="form-control" v-model="user.email" id="exampleInputEmail1" aria-describedby="emailHelp">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label text-light font-weight-bold">Password</label>
            <input type="password" autocomplete="off" class="form-control" v-model="user.password" id="exampleInputPassword1">
          </div>
          <button type="submit" @click="login" class="btn btn-md btn-outline-light text-light font-weight-bold">Login</button>
          <button type="button" @click="tryDemo" class="btn btn-md btn-outline-light text-light font-weight-bold">Try Demo</button>
        </div>
      </div>
  </div>
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
    body, html{
        height: 100%;
    }
    .styled{
        background-color: #1c2bff;
        background-image: radial-gradient(circle at 80% 10%, #74abea 5%, transparent 80%),
        radial-gradient(circle at 10% 90%, #000000 25%, transparent);
    }
    .styledbody{
        background-color: #1c2bff;
        background-image: radial-gradient(circle at 80% 10%, #74abea 5%, transparent 80%),
        radial-gradient(circle at 0% 50%, #000000 25%, transparent);
        min-height: 100%;
    }
    .simple-card{
      border: 1px solid white;
      border-radius: 12px;
      padding:20px;
    }
    .blockk{
      padding: 50px;
      /* background-color: #000000; */
    }
    .spaceafter{
      padding: 50px;
    }
    @media screen and (max-width : 906px){
      .blockk{
        visibility:hidden;
        display: none;
      }
    }
</style>