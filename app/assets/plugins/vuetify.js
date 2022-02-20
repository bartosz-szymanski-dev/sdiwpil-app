import Vue from 'vue';
import Vuetify from 'vuetify';
import colors from 'vuetify/lib/util/colors';

import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);

const opts = {
  theme: {
    themes: {
      light: {
        primary: '#00CEC8',
        secondary: '#cddc39',
        accent: '#ffeb3b',
        error: '#f44336',
        warning: '#ffc107',
        info: '#2196f3',
        success: '#8bc34a',
      },
    },
  },
};

export default new Vuetify(opts);
