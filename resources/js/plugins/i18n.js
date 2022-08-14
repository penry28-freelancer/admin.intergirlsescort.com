import Vue from 'vue';
import store from '@/store';
import VueI18n from 'vue-i18n';
import { bodyConfig } from '@/utils/helpers';
import viLocale from 'element-ui/lib/locale/lang/en';
Vue.use(VueI18n);

const i18n = new VueI18n({
  locale: bodyConfig('locale'),
  messages: {},
});

/**
 * @param {String} locale
 */
export async function loadMessages(locale) {
  if (Object.keys(i18n.getLocaleMessage(locale)).length === 0) {
    const messages = await import(/* webpackChunkName: '' */ `@/lang/${locale}`);
    i18n.setLocaleMessage(locale, { ...messages, ...viLocale });
  }

  if (i18n.locale !== locale) {
    i18n.locale = locale;
  }
}

// eslint-disable-next-line no-extra-semi
;(async function () {
  await loadMessages(store.getters['lang/locale']);
})();

export default i18n;
