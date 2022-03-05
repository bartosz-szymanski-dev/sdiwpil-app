<template>
  <v-card height="100%">
    <v-card-title>Ustawienia zawodowe</v-card-title>

    <v-card-text>
      <v-text-field
        v-model="settings.medicalSpecialty"
        label="Specjalizacja medyczna"
      />

      <v-text-field
        v-model="settings.workingTimeSettings"
        label="Godziny pracy"
      />
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'ProfessionalSettingsPart',
  data: () => ({
    settings: {
      medicalSpecialty: '',
      workingTimeSettings: '',
    },
  }),
  watch: {
    settings: {
      deep: true,
      handler() {
        this.$emit('change', this.settings);
      },
    },
  },
};
</script>

<style scoped>
</style>
