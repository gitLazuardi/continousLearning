<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      class="test2"
    >
    <v-list dense>
        <v-list-item link>
            <v-list-item-action>
                <v-icon class="text-light">mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <router-link class="font-weight-bold text-light" exact to="/home/">Home</router-link>
            </v-list-item-content>
        </v-list-item>
        <v-list-item link>
            <v-list-item-action>
                <v-icon class="text-light">mdi-pencil</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <router-link class="font-weight-bold text-light" to="/home/crud-spa">CRUD</router-link>
            </v-list-item-content>
        </v-list-item>
        <v-list-item link>
            <v-list-item-action>
                <v-icon class="text-light">mdi-television</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <router-link class="font-weight-bold text-light" to="/home/movies">OMDB Movie List</router-link>
            </v-list-item-content>
        </v-list-item>
        <v-list-item link>
            <v-list-item-action>
                <v-icon class="text-light">mdi-map</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <router-link class="font-weight-bold text-light" to="/home/gis">Simple GIS</router-link>
            </v-list-item-content>
        </v-list-item>
        <v-list-item link>
            <v-list-item-action>
                <v-icon class="text-light">mdi-hospital</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <router-link class="font-weight-bold text-light" to="/home/covid">Covid Graphic</router-link>
            </v-list-item-content>
        </v-list-item>
        <v-list-item link @click="logout">
            <v-list-item-action>
                <v-icon class="text-light">mdi-power</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <router-link class="font-weight-bold text-light" to="">Log Out</router-link>
            </v-list-item-content>
        </v-list-item>
    </v-list>
      <!--  -->
    </v-navigation-drawer>

    <v-app-bar app class='test'>
      <v-app-bar-nav-icon @click="drawer = !drawer" class="text-light"></v-app-bar-nav-icon>

      <v-toolbar-title class="text-light font-weight-bold">Learn something ..</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <div class="container" id="down">
          <router-view></router-view>
      </div>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    data: () => ({ drawer: null }),
    computed: {
      
    },
    mounted() {
      this.authCheck();
    },
    methods: {
        logout() {
            this.$store.dispatch('logoutUser');
        },    
        authCheck(){
          let check = localStorage.getItem('blog_token')
          if(!check){
            window.location.replace('/login')
          }
        }
    },
    created() {
      axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
      axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.blog_token;
      this.$store.dispatch('getUser')
    }
  }
</script>

<style scoped>
  .test{
    background-color: #1c2bff;
    background-image: radial-gradient(circle at 50% 10%, #74abea 5%, transparent 80%),
    radial-gradient(circle at 10% 30%, #000000 25%, transparent);
  }
  .test2{
    background-color: #1c2bff;
    background-image: radial-gradient(circle at 20% 90%, #74abea 5%, transparent 70%),
    radial-gradient(circle at 10% 0%, #000000 55%, transparent);
  }
  #down{
    padding-top: 20px;
  }
</style>