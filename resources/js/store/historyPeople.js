
export default {
    namespaced: true,
    state: {
        historyPeople: []
    },
    getters: {
        historyPeopleList: state => {
            return state.historyPeople;
        }
    },
    mutations: {
        SET_HISTORY_PEOPLE(state, historyPeople) {
            state.historyPeople = historyPeople;
        }
    },
    actions: {
        getHistoryPeople({commit}) {
            axios.get("/api/historyPeople").then(response => {
                commit('SET_HISTORY_PEOPLE', response.data);
            }); 
            
        }
    }
};