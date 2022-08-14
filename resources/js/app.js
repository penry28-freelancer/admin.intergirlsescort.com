import Vue from 'vue';
import store from '@/store';
import App from '@/views/App';
import i18n from '@/plugins/i18n';
import ElementUI from 'element-ui';
import router from '@/http/router';

import '@/icons';
import '@/utils/logging';
import '@/components/Global';
import '@/styles/element-variables.scss';

// start third party
Vue.use(ElementUI, {
  size: 'medium',
  i18n: (key, value) => i18n.t(key, value),
});

// Register global utility filters.
import * as filters from '@/filters';
Object.keys(filters).forEach(key => {
  Vue.filter(key, filters[key]);
});

// disable show warning async validator
// eslint-disable-next-line no-console
const warn = console.warn;
// eslint-disable-next-line no-console
console.warn = (...args) => {
  if (typeof args[0] === 'string' && args[0].startsWith('async-validator:')) {
    return;
  }
  warn(...args);
};

Vue.config.performance = process.env.NODE_ENV !== 'production';
Vue.config.productionTip = false;
new Vue({
  i18n,
  store,
  router,
  ...App,
});
