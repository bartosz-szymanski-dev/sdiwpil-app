import Vue from 'vue';
import Vuetify from 'vuetify';
import Snotify, { SnotifyPosition } from 'vue-snotify';
import vuetify from '../../../plugins/vuetify';
import '../../../plugins/router';

import DoctorSettings from './components/DoctorSettings';

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
    return h(DoctorSettings);
  },
});