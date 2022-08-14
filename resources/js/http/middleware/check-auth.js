import store from '@/store';
import { SET_USER } from '@/store/mutation-types';
import AuthResource from '@/http/api/v1/auth';

export default async (to, from, next) => {
  const authResource = new AuthResource();
  const user = store.getters['auth/user'];
  const token = store.getters['auth/token'];

  if (!user && !!token) {
    try {
      // Get user auth
      const userAuth = await authResource.getUserAuth();
      store.dispatch(`auth/${SET_USER}`, userAuth.data.data);
    } catch (e) { /** Code... */ }
  }

  next();
};
