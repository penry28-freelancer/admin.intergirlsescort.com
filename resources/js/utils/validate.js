/**
 * @param {String} path
 * @returns {Boolean}
 */
export function isExternal(path) {
  return /^(https?:|mailto:|tel:)/.test(path);
}

export function validPassword(password) {
 return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(password);
}

export function validURL(str) {
  var res = str.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
  return (res !== null);
}

export function validPhone(phone) {
  phone = phone.toString();
  if (phone.charAt(0) !== '0') {
    return false;
  }
  if (phone.length === 10) {
    return true;
  }
  return false;
}
