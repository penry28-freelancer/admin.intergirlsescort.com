export const updateStateURL = (newState = '?') => {
  if (history.pushState) {
    var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + newState;
    window.history.pushState({path:newurl},'',newurl);
  }
}
