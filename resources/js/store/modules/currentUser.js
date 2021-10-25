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
    loginUser({}, user){
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
                    
                }
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