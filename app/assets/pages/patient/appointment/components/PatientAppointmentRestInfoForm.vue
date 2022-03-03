<template>
  <v-form>
    <v-select
      v-model="timeSlot"
      :items="timeSlots"
      label="Wybierz godzinę wizyty"
    />
    <v-textarea
      v-model="reason"
      label="Wpisz powód wizyty"
    />
  </v-form>
</template>

<script>
import { get } from 'lodash';

export default {
  name: 'PatientAppointmentRestInfoForm',
  data: () => ({
    timeSlots: [],
    timeSlot: '',
    reason: '',
  }),
  mounted() {
    this.timeSlots = get(window.state, 'time_slots', []);
  },
};
</script>

<style scoped>

</style>
