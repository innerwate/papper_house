export default {
    namespaced: true,
    state: () => ({
        currentRating: null,
        avgRating: null
    }),
    getters: {
        currentRating: state => state.currentRating,
        avgRating: state => state.avgRating
    },
    mutations: {
        SET_RATING(state, rating) {
            state.currentRating = rating;
        },
        SET_AVG_RATING(state, avgRating) {
            state.avgRating = avgRating;
        },
        UNSET_AVG_RATING(state) {
            state.avgRating = null;
        },
        UNSET_CURRENT_RATING(state) {
            state.currentRating = null;
        },
        RESET_RATING(state) {
            state.currentRating = null;
        },
    },
    actions: {
        getRating({ commit, state, dispatch }, data) {
            console.log('poem_id', data.poem_id)
            console.log('user_id', data.user_id)
            return new Promise((resolve, reject) => {
                axios({
                    url: `/api/poem/${data.poem_id}/get-rating`,
                    params: data,
                    method: 'GET'
                }).then(resp => {
                    commit('SET_RATING', resp.data);
                    resolve(resp);
                });
            });
        },
        getAvgRating({ commit, state, dispatch }, poem_id) {
            return new Promise((resolve, reject) => {
                //context.commit('UNSET_AVG_RATING');
                console.log(`heh we are here ${poem_id}`)
                axios({
                    url: `/api/poem/${poem_id}/get-avg-rating`,
                    params: {
                        'poem_id': poem_id
                    },
                    method: 'GET'
                }).then(resp => {
                    commit('SET_AVG_RATING', resp.data)
                    resolve(resp);
                });
            })
        },
        resetCurrentRating({ commit, state, dispatch }, rateObj) {
            return new Promise((resolve, reject) => {
                axios({
                    url: `/api/poem/${rateObj.poem_id}/reset-rating`,
                    data: rateObj,
                    method: 'POST'
                }).then(resp => {
                    commit('RESET_RATING');
                    resolve(resp);
                });
            });
        },
        setRating({ commit, state, dispatch }, rateObj) {
            return new Promise((resolve, reject) => {
                axios({
                    url: `/api/poem/${rateObj.poem_id}/set-rating`,
                    data: rateObj,
                    method: 'POST'
                }).then(resp => {
                    //console.log(resp)
                    commit('SET_RATING', resp.data)
                    resolve(resp);
                });
            });

        },
    }
} 
