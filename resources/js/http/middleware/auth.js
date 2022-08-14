import store from '@/store';

export default async (to, from, next) => {
  const user = store.getters['auth/user'];
  const token = store.getters['auth/token'];

  if (!user || !token) {
    next({ name: 'auth.login' });
  } else {
    next();
  }
};
