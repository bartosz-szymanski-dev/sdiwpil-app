import Vue from 'vue';
import Vuetify from 'vuetify';

import vuetify from '../../../plugins/vuetify';
import '../../../plugins/router';

import PatientRegister from './components/PatientRegister';

Vue.use(Vuetify);

// eslint-disable-next-line no-new
new Vue({
  el: '#main',
  vuetify,
  render(h) {
    return h(PatientRegister);
  },
});
