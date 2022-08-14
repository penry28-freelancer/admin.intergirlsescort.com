import axios from 'axios';
import store from '@/store';
import router from '@/http/router';
import { Message } from 'element-ui';
import { fConfig, matchInArray } from '@/utils/helpers';
import { getToken, setToken, removeToken } from '@/utils/auth';
import { CONST_APP, CONST_AXIOS } from '@/config/constants';

// Create axios instance
const service = axios.create({
  baseURL: CONST_APP.base_api,
  timeout: CONST_AXIOS.timeout,
});

service.interceptors.request.use(
  config => {
    const token = getToken() || null;
    if (token) {
      config.headers['Authorization'] = 'Bearer ' + token; // Set JWT token
    }

    const locale = store.getters['lang/locale'];
    if (locale) {
      config.headers['Accept-Language'] = locale;
    }

    // request.headers['X-Socket-Id'] = Echo.socketId()

    store.dispatch('app/setLogErrors');

    return config;
  },
  error => Promise.reject(error)
);

service.interceptors.response.use(
  response => {
    if (response.headers.authorization) {
      setToken(response.headers.authorization);
      response.data.token = response.headers.authorization;
    }
    return response;
  },
  error => {
    const res = error.response;
    if (res) {
      const whiteList = fConfig('app.whiteList');
      const currentUrl = router.history.current.path;
      if (!matchInArray(currentUrl, whiteList) && res.status === 401) {
        removeToken();
        router.push({ name: 'auth.login' });
      }
      if (res.status === 404) {
        router.push({ name: 'error.404' });
      }
      if (process.env.NODE_ENV === 'production' && res.status === 500) {
        router.push({ name: 'error.500' });
      }
      if (res.data.errors) {
        store.dispatch('app/setLogErrors', res.data.errors);
      } else {
        Message({
          message: res.data.message || 'Error',
          type: 'error',
          duration: 5 * 1000,
        });
      }
    }
    return Promise.reject(error);
  }
);

export default service;
