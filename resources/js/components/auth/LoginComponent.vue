<template>
  <div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" v-model="user.email" id="exampleInputEmail1" aria-describedby="emailHelp">
    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" v-model="user.password" id="exampleInputPassword1">
  </div>
  <button type="submit" @click="login" class="btn btn-md btn-primary text-light">Login</button>
</div>
</template>

<script>
export default {
    data: () => ({
        user: {
            email: "",
            password: ""
        }
    }),
    methods: {
        login(){
            this.$store.dispatch('loginUser', this.user)
        }   
    }
}
</script>

<style>

</style>