
export default {
    namespaced: true,
    state: {
        users: []
    },
    getters: {
        usersList: state => {
            return state.users;
        }
    },
    mutations: {
        SET_USERS(state, users) {
            state.users = users;
        }
    },
    actions: {
        getUsers({commit}) {
            axios.get("/api/auth/users").then(response => {
                commit('SET_USERS', response.data);
            })  
        }
    }
};