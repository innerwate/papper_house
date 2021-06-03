
export default {
    namespaced: true,
    state: () => ({
        categories: []
    }),
    getters: {
        categoriesList: state => state.categories,
    },
    mutations: {
        SET_CATEGORIES(state, categories){
           categories = categories.map((item) => {
                return {
                  ...item,
                  isActive: false
                }
              });
            state.categories = categories;
        }
    },
    actions: {
        getCategories({ commit, state, dispatch }, isUsers) {
            axios.get("/api/getCategories", {params: {'is_users' : isUsers}}).then(response => {
                commit('SET_CATEGORIES', response.data)
            });
        },
        getPoemsByCategories({commit, state, dispatch}){
            // axios.get("/api/getPoemsByCategories").then(response => {
            //     return response.data;
            // })
            //console.log('wowoow')
        }
    },
}
