import Cookies from 'js-cookie';
import { CONST_APP } from '@/config/constants';

export function getToken() {
  return Cookies.get(CONST_APP.token_key);
}

export function setToken(token, expires = 1) {
  return Cookies.set(CONST_APP.token_key, token, { expires });
}

export function removeToken() {
  return Cookies.remove(CONST_APP.token_key);
}
