/**
 * Import view
 * @param {String} path
 * @returns View
 */
export function view(path) {
  return () => import(/* webpackChunkName: '' */ `@/views/${path}`).then(m => m.default || m);
}

/**
 * Get variable from server config
 * @param {string} field
 * @returns {string|object|array|number|...[anything you was set]}
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

/**
 * @param {string} string
 * @param {string} expressions
 * @returns {boolean}
 */
 export function matchInArray(string, expressions) {
  const len = expressions.length;
  let i = 0;

  for (; i < len; i++) {
    if (string.match(expressions[i])) {
      return true;
    }
  }

  return false;
}

/**
 * @param {number} second
 * @returns {number}
 */
export function secondToDay(second) {
  return second / (24 * 60 * 60);
}

/**
 * Convert string to slug
 * @param {string}
 * @returns {string}
 */
export function convertToSlug(str) {
  str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, 'a');
  str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, 'e');
  str = str.replace(/ì|í|ị|ỉ|ĩ/g, 'i');
  str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, 'o');
  str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, 'u');
  str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, 'y');
  str = str.replace(/đ/g, 'd');
  str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, 'A');
  str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, 'E');
  str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, 'I');
  str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, 'O');
  str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, 'U');
  str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, 'Y');
  str = str.replace(/Đ/g, 'D');
  str = str.toLowerCase();
  str = str
    .replace(/[&]/g, '-and-')
    .replace(/[^a-zA-Z0-9._-]/g, '-')
    .replace(/[-]+/g, '-')
    .replace(/-$/, '');
  return str;
}

/**
 * @param time
 * @param label
 * @returns {string|*}
 */
 export function pluralize(time, label) {
  if (time === 1) {
    return time + label;
  }
  return time + label + 's';
}

/**
 * @param {*} time
 * @param {*} cFormat
 * @returns {string|*}
 */
export function parseTime(time, cFormat) {
  if (arguments.length === 0 || !time) {
    return null;
  }

  const format = cFormat || '{y}/{m}/{d} {h}:{i}:{s}';
  let date;
  if (typeof time === 'object') {
    date = time;
  } else {
    if (typeof time === 'string' && /^[0-9]+$/.test(time)) {
      time = parseInt(time) * 1000;
    }
    if (typeof time === 'number' && time.toString().length === 10) {
      time = time * 1000;
    }

    date = new Date(time);
  }
  const formatObj = {
    y: date.getFullYear(),
    m: date.getMonth() + 1,
    d: date.getDate(),
    h: date.getHours(),
    i: date.getMinutes(),
    s: date.getSeconds(),
    a: date.getDay(),
  };
  const timeStr = format.replace(/{(y|m|d|h|i|s|a)+}/g, (result, key) => {
    let value = formatObj[key];
    // Note: getDay() returns 0 on Sunday
    if (key === 'a') {
      return ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][value];
    }
    if (result.length > 0 && value < 10) {
      value = '0' + value;
    }

    return value || 0;
  });

  return timeStr;
}

/**
 * @param {*} time
 * @param {*} option
 * @returns {string|*}
 */
export function formatTime(time, option) {
  time = +time * 1000;
  const d = new Date(time);
  const now = Date.now();

  const diff = (now - d) / 1000;

  if (diff < 30) {
    return 'Just now';
  } else if (diff < 3600) {
    // less 1 hour
    return pluralize(Math.ceil(diff / 60), ' minute') + ' ago';
  } else if (diff < 3600 * 24) {
    return pluralize(Math.ceil(diff / 3600), ' hour') + ' ago';
  } else if (diff < 3600 * 24 * 2) {
    return '1 day ago';
  }
  if (option) {
    return parseTime(time, option);
  } else {
    return (
      pluralize(d.getMonth() + 1, ' month') +
      ' ' +
      pluralize(d.getDate(), ' day') +
      ' ' +
      pluralize(d.getHours(), ' day') +
      ' ' +
      pluralize(d.getMinutes(), ' minute')
    );
  }
}

export function debounce(func, wait, immediate) {
  let timeout, args, context, timestamp, result;
  const later = function () {
    // According to the last trigger interval
    const last = new Date().getTime() - timestamp;

    // The last time the wrapped function was called, the interval is last less than the set time interval wait
    if (last < wait && last > 0) {
      timeout = setTimeout(later, wait - last);
    } else {
      timeout = null;
      // If it is set to immediate===true, since the start boundary has already been called, there is no need to call it here.
      if (!immediate) {
        result = func.apply(context, args);
        if (!timeout) {
          context = args = null;
        }
      }
    }
  };

  return function () {
    args = arguments; // "arguments" of func
    context = this;
    timestamp = new Date().getTime();
    const callNow = immediate && !timeout;
    // If the delay does not exist, reset the delay
    if (!timeout) {
      timeout = setTimeout(later, wait);
    }
    if (callNow) {
      result = func.apply(context, args);
      context = args = null;
    }

    return result;
  };
}
