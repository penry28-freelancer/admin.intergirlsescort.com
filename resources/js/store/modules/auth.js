/** Auth Store [namespaced=auth] */
import AuthResource from '@/http/api/v1/auth';
import { CONST_AUTH } from '@/config/constants';
import { secondToDay } from '@/utils/helpers';
import { setToken, getToken, removeToken } from '@/utils/auth';
import { SET_TOKEN, SET_USER, RESET_AUTH } from '../mutation-types';

const authResource = new AuthResource();

export const state = {
  token: getToken() || null,
  role: {
    id: 1,
  },
  permissions: [],
  user: null,
};

export const getters = {
  token: state => state.token,
  role: state => state.role,
  permissions: state => state.permissions,
  user: state => state.user,
};

export const mutations = {
  [SET_TOKEN](state, token) {
    setToken(token, 365);
    state.token = token;
  },
  [SET_USER](state, user) {
    state.user = user;
  },
  [RESET_AUTH](state) {
    state.user = null;
    state.token = null;
    removeToken();
  },
};

export const actions = {
  login({ commit }, payload) {
    return new Promise((resolve, reject) => {
      authResource.login(payload)
        .then(res => {
          const token = Object.freeze(res.data.data);
          setToken(token.access_token, payload.remember_me ? secondToDay(token.expires_in) : CONST_AUTH.default_expire);
          commit(SET_TOKEN, token.access_token);
          resolve(res);
        })
        .catch(e => {
          reject(e);
        });
    });
  },
  [SET_TOKEN]({ commit }, payload) {
    const token = Object.freeze(payload);
    setToken(token.access_token, token.remember_me ? secondToDay(token.expires_in) : CONST_AUTH.default_expire);
    commit(SET_TOKEN, token.access_token);
  },
  [SET_USER]({ commit }, user) {
    commit(SET_USER, user);
  },
  [RESET_AUTH]({ commit }) {
    commit(RESET_AUTH);
  },
};
