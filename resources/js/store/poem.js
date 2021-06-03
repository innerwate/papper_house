
export default {
    namespaced: true,
    state: () => ({
        poems: [],
        currentPoem: [],
        errors: [],
        alerts: [],
        participant1Poems : [],
        participant2Poems: [],
        myPoems: []
    }),
    getters: {
        poemId: state => state.poemId,
        poemsList: state => {
            return state.poems;
        },
        singlePoem: state => {
            return state.currentPoem;
        },
        errorList: state => {
            return state.errors;
        },
        alertList: state => {
            return state.alerts;
        },
        participant1Poems: state => {
            return state.participant1Poems
        },
        participant2Poems: state => {
            return state.participant2Poems
        },
        myPoems: state => {
            return state.myPoems;
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
        SET_ERROR(state, errorMassage){
            state.errors = errorMassage
        },
        UNSET_ERROR(state){
            state.errors = [];
        },
        SET_MODAL_ALERT(state, poem){
            state.alerts = (`Ваше стихотворение "${poem.title}" успешно добавлено!`)
        },
        UNSET_ALERTS(state){
            state.alerts = [];
        },
        SET_PARTICIPANT1_POEMS(state, poems){
            state.participant1Poems = poems  
        },
        SET_PARTICIPANT2_POEMS(state, poems){
            state.participant2Poems = poems  
        },
        SET_MY_POEMS(state, poems){
            state.myPoems = poems;
        }
    },
    actions: {
        getPoems({ commit, state, dispatch }, isUsers) {
            axios.get("/api/poems", {params: {'is_users': isUsers}}).then(response => {
                
                commit('SET_POEMS', response.data)
            });
        },
        getMyPoems({commit, state, disaptch}, user_id){
            axios.get(`/api/poems/myPoems/${user_id}`, {params: {'user_id' : user_id}}).then(response => {
                commit('SET_MY_POEMS', response.data);
            });
        },
        getPoemsByCategories({commit, state, dispatch}, data){
            axios.get("/api/poems", {params: {'categories' : data.categoriesArray, 'is_users': data.isUsers, 'user_id': data.user_id}}).then(response => {
                console.log(data)
                if(data.user_id){
                    commit('SET_MY_POEMS', response.data)
                }
                else{
                    commit('SET_POEMS', response.data)
                }
                  
            })
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
       async storePoem({ commit, state, dispatch }, poemItem) {
            try {
                 await axios.post("/api/poems", poemItem).then(response => {
                    commit('SET_MODAL_ALERT', response.data)
                    commit('UNSET_ERROR')
                })
            } catch (error) {
                console.log('errored')
                let errorMassage = error;
                commit('SET_ERROR', errorMassage);
            }
            
        },
        async updatePoem({commit}, poemItem){
            try {
                await axios.put(`/api/poems/${poemItem.id}`, poemItem).then(response => {
                    commit('SET_MODAL_ALERT', response.data)
                    commit('UNSET_ERROR');
                });
            } catch (error) {
                
            }
        },
        deletePoem({ commit, state, dispatch }, id) {
            return new Promise((resolve, reject) => {
                axios.delete(`/api/poems/${id}/delete`).then(response => {
                    this.loading = false;
                });
            })
        },
        getPoemsByUser({commit},data){
            axios.get(`/api/poems/getByUser/${data.user_id}`, {params: {'user_id' : data.user_id}}).then(response => {
                    if(data.pNumber == 0){
                    commit('SET_PARTICIPANT1_POEMS', response.data)
                    }
                    else if(data.pNumber == 1){
                    commit('SET_PARTICIPANT2_POEMS', response.data)
                    }
                
            });
        },
        unsetAlerts({commit}){
            commit('UNSET_ALERTS');
        }

    },
}
