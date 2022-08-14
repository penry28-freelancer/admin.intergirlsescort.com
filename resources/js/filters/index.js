export { pluralize, parseTime, formatTime } from '@/utils/helpers';

/**
 * Get variable from server config
 * @param field
 * @returns {*}
 */
 export function bodyConfig(field) {
  const jsonEncoded = document.querySelector('body').getAttribute('data-app');
  if (jsonEncoded) {
    return JSON.parse(jsonEncoded)[field];
  } return;
}

export function fConfig(path) {
  if (!path.length) {
    return undefined;
  }

  const requireContextConfig = require.context('@/config', false, /\.js$/);
  const configs = requireContextConfig.keys()
    .map(file =>
      [file.replace(/(^.\/)|(\.js$)/g, ''), requireContextConfig(file)]
    )
    .reduce((modules, [name, module]) => {
    if (module.namespaced === undefined) {
      module.namespaced = true;
    }
    return { ...modules, [name]: module };
  }, {});

  function getDeepData(array, dataGet) {
    if (array.length === 0) {
      return dataGet;
    } else {
      dataGet = dataGet[array.shift()];
      return getDeepData(array, dataGet);
    }
  }
  const pathSplit = path.split('.');
  return getDeepData(pathSplit, configs[pathSplit.shift()]);
}
