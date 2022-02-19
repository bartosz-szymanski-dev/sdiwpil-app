import Vue from 'vue'
import Vuetify from 'vuetify'

import vuetify from '../../plugins/vueitfy';
import '../../plugins/router';

import HomePage from './components/HomePage';

Vue.use(Vuetify);

new Vue({
  el: '#main',
  vuetify,
  render(h) {
    return h(HomePage);
  }
});
