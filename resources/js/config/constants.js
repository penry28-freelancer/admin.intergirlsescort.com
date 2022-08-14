/** @desc App configuration */
export const CONST_APP = {
  base_api: process.env.MIX_BASE_API,
  token_key: 'intergirlsescort-auth-token',
};

/** @desc Cookie constants */
export const CONST_COOKIE = {
};

/** @desc Axios configuration */
export const CONST_AXIOS = {
  timeout: 60000,
};

/** @desc Auth configuration */
export const CONST_AUTH = {
  global_middleware: ['check-auth'],
  default_expire: 1,
};

/** @desc Image Default */
export const CONST_IMG = {
  user_empty: require('@/assets/images/default/user-empty.svg').default,
};

/** @desc Pagination */
export const CONST_PAGINATION = {
  limit: 20,
};
