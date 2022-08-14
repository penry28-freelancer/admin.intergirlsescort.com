module.exports = {
  title: 'Cba Laravel Vue',

  /**
   * @type {string} default layout
   * @description Determine which layout to use
   */
  defaultLayout: 'default',

  /**
   * @type {string} url pages
   * @description Redirect before login
   */
  redirect: '/dashboard',

  /**
   * @type {number} offset time zone
   * @description Redirect before login
   */
  timeZone: process.env.MIX_TIME_ZONE || 'Asia/Tokyo', // Tokyo

  /**
   * @type {boolean} true | false
   * @description Show translate
   */
  showTrans: true,

  /**
   * @type {boolean} true | false
   * @description Show translate
   */
  showAPI: true,

  /**
   * @type {boolean} true | false
   * @description Whether need tagsView
   */
  tagsView: true,

  /**
   * @type {boolean} true | false
   * @description Whether fix the header
   */
  fixedHeader: true,

  /**
   * @type {boolean} true | false
   * @description Whether show the logo in sidebar
   */
  sidebarLogo: true,

  /**
   * @type {string}
   * @description Whether show the logo in sidebar
   */
  urlLogo: require('@/assets/images/logo/hcb-logo.png').default,

  /**
   * @type {array}
   * @description No redirect whitelist
   */
  whiteList: [/^\/login$/i, /^\/reset-password$/i, /^\/reset-password\/((?:[^\/]+?))(?:\/(?=$))?$/i],

  /**
   * @type {boolean} true | false
   * @description Multiple transition
   */
  moreTransition: true,

  /**
   * @type {int} id
   * @description role user
   */
  superAdminId: 1,

  /**
   * @type {string | array} 'production' | ['production', 'local']
   * @description Need show err logs component.
   * The default is only used in the production env
   * If you want to also use it in dev, you can pass ['production', 'development']
   */
  errorLog: 'production',
};
