<template>
  <v-form>
    <v-select
      v-model="timeSlot"
      :items="appointmentDates"
      label="Wybierz godzinę wizyty"
    />
    <v-textarea
      v-model="reason"
      label="Wpisz powód wizyty"
    />
  </v-form>
</template>

<script>

export default {
  name: 'PatientAppointmentRestInfoForm',
  props: {
    appointmentDates: {
      type: Array,
      required: true,
    },
  },
  data: () => ({
    timeSlot: '',
    reason: '',
  }),
};
</script>

<style scoped>

</style>
