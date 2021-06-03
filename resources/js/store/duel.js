
export default {
    namespaced: true,
    state: {
        duels: [],
        duel: {},
        alerts: [],
        errors: [],
        userVote: ''
    },
    getters: {
        duelsList: state => {
            return state.duels;
        },
        singleDuel: state =>{
            return state.duel;
        },
        alerts: state => {
            return state.alerts
        },
        errors: state => {
            return state.errors
        },
        userVote: state => {
            return state.userVote
        }
    },
    mutations: {
        SET_DUELS(state, duels) {
            state.duels = duels;
        },
        SET_DUEL(state, duel){
            state.duel = duel;
        },
        SET_ERRORS(state, errors){
            state.errors = errors;
        },
        UNSET_ERRORS(state){
            state.errors = [];
        },
        SET_ALERTS(state, alerts){
            state.alerts = alerts;
        },
        UNSET_ALERTS(state){
            state.alerts = [];
        },
        SET_USER_VOTE(state, participant){
            state.vote = participant
        }
    },
    actions: {
        getDuels({commit, state, dispatch}, user_id){
            axios.get("/api/duels", {params:{'user_id': user_id }}).then(response => {
                commit('SET_DUELS', response.data)
            }); 
        },
        getDuel({commit, state, dispatch}, duel_id){
            axios.get(`/api/duels/${duel_id}`).then(response => {
                commit('SET_DUEL', response.data)
            });
        },
       async storeDuel({commit}, data){
           try {
            await axios.post('/api/duels/', data).then(response => {
                commit('SET_ALERTS', `Дуэль с участниками успешно добавлена`);
            })
               
           } catch (error) {
                commit('SET_ERRORS', 'Что-то пошло не так...');
           }
            
        },
        async updateDuel({commit}, data){
            console.log(data, 'data in action update duel')
            try {
             await axios.put(`/api/duels/${data.duel_id}`, data).then(response => {
                 commit('SET_ALERTS', `Дуэль с участниками успешно обновлена!`);
             })
                
            } catch (error) {
                console.log(error)
                 commit('SET_ERRORS', 'Что-то пошло не так...');
            }
             
         },
        deleteDuel({commit, state, dispatch}, data){
            const params = {'duel_id' : data.duel_id};
            axios.delete(`/api/duels/${data.duel_id}`, {params} ).then(response => {
                commit('SET_ALERTS', 'Дуэль успешно удалена!')
                dispatch('getDuels', data.user_id);

            });
        },
        unsetAlerts({commit, state, dispatch}){
            commit('UNSET_ALERTS');
        },
        getUserVote({commit}, data){
            axios.get(`/api/duels/${data.duel_id}/get-vote`, {params: {'duel_id' : data.duel_id, 'user_id': data.user_id}}).then(response => {
                commit('SET_USER_VOTE', response.data)
            })
        },
        async storeUserVote({commit, dispatch}, data){
            try {
                console.log(data)
                await axios.post(`/api/duels/${data.duel_id}/set-vote`, data).then(response => {
                        commit('SET_ALERTS', 'Ваш голос учтён!');
                        dispatch("getDuels", data.user_id)
                })
            } catch (error) {
                commit('SET_ALERTS', 'Ошибка! Ваш голос не был учтен, попробуйте позже.');
            }
        }
    }
};