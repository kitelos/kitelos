import Vue from 'vue'
import VueI18n from 'vue-i18n'

import en from './i18n/en_US'
import es from './i18n/es_ES'

Vue.use(VueI18n)

export default new VueI18n({
	locale: 'en',
	messages: {
		en: {
			lang: en
		},
		es: {
			lang: es
		}
	}
})