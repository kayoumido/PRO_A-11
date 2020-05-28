export default ({
  namespaced: true,
  state: {
    token: null,
    user: null,
  },
  getters: {
    authenticated(state) {
      return state.token && state.user;
    },
    user(state) {
      return state.user;
    },
  },
  mutations: {
    SET_TOKEN(state, token) {
      // eslint-disable-next-line no-param-reassign
      state.token = token;
      if (token) {
        window.axios.defaults.headers.common.Authorization = `Bearer ${token}`;
        localStorage.setItem('token', token);
      } else {
        window.axios.defaults.headers.common.Authorization = null;
        localStorage.removeItem('token');
      }
    },
    SET_USER(state, user) {
      // eslint-disable-next-line no-param-reassign
      state.user = user;
    },
  },
  actions: {
    async signIn({ dispatch }, credentials) {
      const response = await window.axios.post('/login', credentials);
      return dispatch('attempt', response.data.access_token);
    },
    async register({ dispatch }, userData) {
      const response = await window.axios.post('/register', userData);
      return dispatch('attempt', response.data.access_token);
    },
    async attempt({ commit, state }, token) {
      if (token) {
        commit('SET_TOKEN', token);
      }
      if (!state.token) {
        return;
      }

      try {
        const response = await window.axios.get('/me');
        commit('SET_USER', response.data);
      } catch (e) {
        commit('SET_TOKEN', null);
        commit('SET_USER', null);
      }
    },
    signOut({ commit }) {
      return window.axios.post('/logout')
        .then(() => {
          commit('SET_TOKEN', null);
          commit('SET_USER', null);
        });
    },
    updateUser({ commit, state }, userInfo) {
      return window.axios.put(`/users/${state.user.id}`, userInfo)
        .then((response) => {
          commit('SET_USER', response.data);
        });
    },
  },
});
