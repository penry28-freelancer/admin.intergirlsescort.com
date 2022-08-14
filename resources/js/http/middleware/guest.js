import store from '@/store';

export default (to, from, next) => {
  const user = store.getters['auth/user'];
  const token = store.getters['auth/token'];

  if (!!user && !!token) {
    next({ name: 'dashboard.index' });
  } else {
    next();
  }
};
