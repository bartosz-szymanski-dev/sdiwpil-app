<template>
  <v-card>
    <v-card-title>Ustawienia ogólne</v-card-title>

    <v-card-text>
      <v-text-field
        v-model="settings.email"
        type="email"
        label="Adres e-mail"
      />

      <v-text-field
        v-model="settings.password"
        type="password"
        label="Nowe hasło"
      />

      <v-text-field
        v-model="settings.passwordRepeat"
        type="password"
        label="Powtórz nowe hasło"
      />
    </v-card-text>
  </v-card>
</template>

<script>

export default {
  name: 'GeneralSettingsPart',
  data: () => ({
    settings: {
      email: '',
      password: '',
      passwordRepeat: '',
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
