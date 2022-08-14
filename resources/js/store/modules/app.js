
import Cookies from 'js-cookie';

export const state = {
  logErrors: {},
  sidebar: {
    isOpen: Cookies.get('sidebarStatus') ? !!+Cookies.get('sidebarStatus') : true,
  },
};

export const getters = {
  logErrors: state => state.logErrors,
  sidebar: state => state.sidebar,
};

export const mutations = {
  SET_LOG_ERRORS: (state, error) => {
    state.logErrors = error;
  },
  TOGGLE_SIDEBAR: state => {
    state.sidebar.isOpen = !state.sidebar.isOpen;
    if (state.sidebar.isOpen) {
      Cookies.set('sidebarStatus', 1);
    } else {
      Cookies.set('sidebarStatus', 0);
    }
  },
};

export const actions = {
  setLogErrors({ commit }, error) {
    commit('SET_LOG_ERRORS', error);
  },
  toggleSidebar({ commit }) {
    commit('TOGGLE_SIDEBAR');
  },
};
