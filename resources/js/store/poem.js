export default {
    namespaced: true,
    state: () => ({
        poems: [],
        currentPoem: ''
    }),
    getters: {
        poemId: state => state.poemId,
        poemsList: state => {
            return state.poems;
        },
        singlePoem: state => {
            return state.currentPoem;
        }
    },
    mutations: {
        SET_POEMS(state, poems) {
            state.poems = poems;
        },
        SET_POEM(state, currentPoem) {
            state.currentPoem = currentPoem;
        },
        SET_POEM_ID(state, id) {
            console.log('log in mutation id=' + id)
            state.poemId = id;
        },
    },
    actions: {
        getPoems({ commit, state, dispatch }) {
            axios.get("/api/poems").then(response => {
                commit('SET_POEMS', response.data)
            });
        },
        getSinglePoem({ commit, state, dispatch }, id) {
            return new Promise((resolve, reject) => {
                axios.get(`/api/poems/${id}`).then(response => {
                    commit('SET_POEM', response.data)
                    //commit('SET_POEM_ID')
                    console.log('response poem here', response)
                    resolve(response);
                });
            });
        },
        storePoem({ commit, state, dispatch }, request) {
            return new Promise((resolve, reject) => {
                axios.post("/api/poems/", request).then(response => {
                    this.loading = false;
                    resolve(response);
                });
            });
        },
        deletePoem({ commit, state, dispatch }, id) {
            return new Promise((resolve, reject) => {
                axios.delete(`/api/poems/${id}/delete`).then(response => {
                    this.loading = false;
                });
            })
        }

    },
}
