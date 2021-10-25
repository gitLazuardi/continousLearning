import Vue from "vue"
import Vuex from "vuex"

import User from "./modules/currentUser"


Vue.use(Vuex);

export default new Vuex.Store({
    modules : {
        currentUser : User
    }
})