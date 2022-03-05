<template>
  <v-form>
    <v-row wrap>
      <v-col
        md="6"
        cols="12"
      >
        <general-settings-part @change="handleSettingsChange" />
      </v-col>
      <v-col
        md="6"
        cols="12"
      >
        <professional-settings-part @change="handleSettingsChange" />
      </v-col>
      <v-col
        md="auto"
        cols="12"
      >
        <send-form-part />
      </v-col>
    </v-row>
  </v-form>
</template>

<script>
import { merge } from 'lodash';
import SettingsModel from '../models/SettingsModel';
import GeneralSettingsPart from './FormParts/GeneralSettingsPart';
import ProfessionalSettingsPart from './FormParts/ProfessionalSettingsPart';
import SendFormPart from './FormParts/SendFormPart';

export default {
  name: 'DoctorSettingsForm',
  components: { ProfessionalSettingsPart, GeneralSettingsPart, SendFormPart },
  data: () => ({
    settings: new SettingsModel(),
  }),
  methods: {
    handleSettingsChange(settings) {
      this.settings = merge(this.settings, settings);
    },
  },
};
</script>

<style scoped>

</style>
