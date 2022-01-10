import axios from "axios";

const state = {
    user : {}
};
const getters = {};
const actions = {
    getUser(){
        axios.get('/api/user/current').then(
            response => {
                
            }
        );
    },
    loginUser({}, {user, parrent}){
        axios.post('/api/user/login', {
            email: user.email,
            password: user.password
        })
        .then(
            response => {
                if(response.data.access_token){
                    localStorage.setItem(
                        'blog_token', response.data.access_token
                    )
                    window.location.replace('/home')
                }else{
                    parrent.$toasted.show('Invalid username or password..', {
                        type : 'error',
                        duration : 2000
                      });
                }
            }
        ).catch(
            error => {
              parrent.$toasted.show('Input username and password first..', {
                  type : 'error',
                  duration : 2000
                });
            }
          );
        },
    logoutUser() {
        localStorage.removeItem('blog_token');
        window.location.replace('/login');
    }
};
const mutations = {
   
};

export default {
    namespace : true,
    state,
    getters,
    actions,
    mutations
}