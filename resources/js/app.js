
require('axios').defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('axios').interceptors.request.use(function (config) {
    config.headers['X-Expect-Language'] = window.app.$i18n.locale;
    window.app.$store.dispatch('state/start');
    return config;
});

require('axios').interceptors.response.use(function (response) {
    window.app.$store.dispatch('state/finish');
    return response;
}, function (error) {
    window.app.$store.dispatch('state/finish');
    return Promise.reject(error);
});

require('dayjs/locale/en');
require('dayjs/locale/fr');
require('dayjs').extend(require('dayjs/plugin/isoWeek'));
require('dayjs').extend(require('dayjs/plugin/localizedFormat'));

const Vue = require('vue');

const VueRouter = require('vue-router').default;
Vue.use(VueRouter);

const Vuex = require('vuex').default;
Vue.use(Vuex);

const VueI18n = require('vue-i18n').default;
Vue.use(VueI18n);

const files = require.context('./components', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.mixin(require('./mixins.js'));

window.app = new Vue({
    el: '#app',
    i18n: new VueI18n({
        locale: navigator.languages[0].split('-')[0],
        fallbackLocale: 'en',
        messages: {
            en: require('./lang/en.js').default,
            fr: require('./lang/fr.js').default,
        },
    }),
    router: new VueRouter({
        linkActiveClass: 'active',
        routes: require('./routes.js').default,
    }),
    store: new Vuex.Store({
        modules: {
            state: {
                namespaced: true,
                ...require('./stores/state.js'),
            },
            task: {
                namespaced: true,
                ...require('./stores/task.js'),
            },
        }
    }),
    created() {
        require('dayjs').locale(this.$i18n.locale);
    }
});
