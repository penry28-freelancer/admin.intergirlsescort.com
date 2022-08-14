import Vue from 'vue';
import VueRouter from 'vue-router';
import { constantsRoutes } from '@/routes';
import { CONST_AUTH } from '@/config/constants';

Vue.use(VueRouter);

export const createRouter = () => {
  const router = new VueRouter({
    linkActiveClass: 'active',
    mode: 'history',
    routes: constantsRoutes,
    scrollBehavior: to => {
      if (to.hash) {
        return { selector: to.hash };
      } else {
        return { x: 0, y: 0 };
      }
    },
  });

  router.beforeEach(beforeEach);
  router.afterEach(afterEach);

  return router;
};

const router = createRouter();

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
  const newRouter = createRouter();
  router.matcher = newRouter.matcher; // reset router
}

export default router;

// ===== {{ FUNCTIONS HELPERS MIDDLEWARE }} ===== //

/**
 * @param  {Object} requireContext
 * @return {Object}
 */
function resolveMiddleware(requireContext) {
  return requireContext.keys()
    .map(file =>
      [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)]
    )
    .reduce((guards, [name, guard]) => (
      { ...guards, [name]: guard.default }
    ), {});
}

// Load middleware modules dynamically.
const routeMiddleware = resolveMiddleware(
  require.context('@/http/middleware', false, /.*\.js$/)
);

/**
 * Resolve async components.
 *
 * @param  {Array} components
 * @return {Array}
 */
function resolveComponents(components) {
  return Promise.all(components.map(component => {
    return typeof component === 'function' ? component() : component;
  }).filter(component => !!component));
}

/**
 * Merge the the global middleware with the components middleware.
 *
 * @param  {Array} components
 * @return {Array}
 */
function getMiddleware(components) {
  const middleware = [...CONST_AUTH.global_middleware];

  components.filter(c => c.middleware).forEach(component => {
    if (Array.isArray(component.middleware)) {
      middleware.push(...component.middleware);
    } else {
      middleware.push(component.middleware);
    }
  });

  return middleware;
}

/**
 * Call each middleware.
 *
 * @param {Array} middleware
 * @param {Route} to
 * @param {Route} from
 * @param {Function} next
 */
function callMiddleware(middleware, to, from, next) {
  const stack = middleware.reverse();

  const _next = (...args) => {
    // Stop if "_next" was called with an argument or the stack is empty.
    if (args.length > 0 || stack.length === 0) {
      if (args.length > 0) {
        // router.app.$loading.finish()
      }

      return next(...args);
    }

    const { middleware, params } = parseMiddleware(stack.pop());

    if (typeof middleware === 'function') {
      middleware(to, from, _next, params);
    } else if (routeMiddleware[middleware]) {
      routeMiddleware[middleware](to, from, _next, params);
    } else {
      throw Error(`Undefined middleware [${middleware}]`);
    }
  };

  _next();
}

/**
 * @param  {String|Function} middleware
 * @return {Object}
 */
function parseMiddleware(middleware) {
  if (typeof middleware === 'function') {
    return { middleware };
  }

  const [name, params] = middleware.split(':');

  return { middleware: name, params };
}

// ===== ${{ HANDLE MIDDLEWARE }}$ ===== //
async function beforeEach(to, from, next) {
  let components = [];

  try {
    // Get the matched components and resolve them.
    components = await resolveComponents(
      router.getMatchedComponents({ ...to })
    );
  } catch (error) {
    if (/^Loading( CSS)? chunk (\d)+ failed\./.test(error.message)) {
      window.location.reload(true);
      return;
    }
  }

  if (components.length === 0) {
    return next();
  }

  // Get the middleware for all the matched components.
  const middleware = getMiddleware(components);

  // Call each middleware.
  callMiddleware(middleware, to, from, (...args) => {
    // Set the application layout only if "next()" was called with no args.
    if (args.length === 0) {
      router.app.setLayout(components[0].layout || '');
    }

    next(...args);
  });
}

async function afterEach(to, from, next) {

}
