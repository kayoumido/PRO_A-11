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
    signIn({ dispatch }, credentials) {
      return window.axios.post('/login', credentials)
        .then((response) => {
          dispatch('attempt', response.data.access_token);
        });
    },
    register({ dispatch }, userData) {
      return window.axios.post('/register', userData)
        .then((response) => {
          dispatch('attempt', response.data.access_token);
        });
    },
    attempt({ commit, state }, token) {
      if (token) {
        commit('SET_TOKEN', token);
      }

      if (!state.token) {
        return;
      }

      window.axios.get('/me')
        .then((response) => {
          commit('SET_USER', response.data);
        })
        .catch(() => {
          commit('SET_TOKEN', null);
          commit('SET_USER', null);
        });
    },
    signOut({ commit }) {
      return window.axios.post('/logout')
        .then(() => {
          commit('SET_TOKEN', null);
          commit('SET_USER', null);
        });
    },
  },
});
