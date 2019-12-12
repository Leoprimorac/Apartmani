import VueI18n from 'vue-i18n'
import Vue from 'vue'
import { DEFAULT_LANGUAGE, FALLBACK_LANGUAGE } from './trans'
import cro from './../lang/translations/cro.json'

Vue.use(VueI18n)
export const i18n = new VueI18n({
  locale: DEFAULT_LANGUAGE, // set locale
  fallbackLocale: FALLBACK_LANGUAGE,
  messages: { cro }// set locale messages
})
