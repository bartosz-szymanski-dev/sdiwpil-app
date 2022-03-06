import Vue from 'vue';
import Vuetify from 'vuetify';
import Snotify, { SnotifyPosition } from 'vue-snotify';
import vuetify from '../../../plugins/vuetify';
import '../../../plugins/router';

import ReceptionistSettings from './components/ReceptionistSettings';

Vue.use(Vuetify);
Vue.use(Snotify, {
  toast: {
    position: SnotifyPosition.rightTop,
  },
});

// eslint-disable-next-line no-new
new Vue({
  el: '#main',
  vuetify,
  render(h) {
    return h(ReceptionistSettings);
  },
});