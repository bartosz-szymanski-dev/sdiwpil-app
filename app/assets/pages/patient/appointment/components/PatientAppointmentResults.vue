<template>
  <v-row dense>
    <v-col
      v-for="({id, name, description}, i) in doctors"
      :key="i"
      cols="12"
    >
      <v-card
        :class="[chosenDoctor === id && 'active']"
        color="#00cec80d"
        @click="handleChosenDoctorChange(id)"
      >
        <v-card-title class="text-h5">
          {{ name }}
        </v-card-title>

        <v-card-subtitle>{{ description }}</v-card-subtitle>

        <v-card-actions>
          <v-btn @click="handleChosenDoctorChange(id)">
            Wybierz
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'PatientAppointmentResults',
  data: () => ({
    doctors: [
      {
        id: 1,
        name: 'Jan Kowalski',
        description: 'Lorem ipsum',
      },
      {
        id: 2,
        name: 'Anna Nowak',
        description: 'Lorem ipsum',
      },
    ],
    chosenDoctor: -1,
  }),
  methods: {
    handleChosenDoctorChange(id) {
      this.chosenDoctor = id;
      this.$emit('change');
    },
  },
};
</script>

<style scoped lang="scss">
@import "assets/styles/colors";

.active {
  border: 3px solid #00cec8 !important;
}
</style>
