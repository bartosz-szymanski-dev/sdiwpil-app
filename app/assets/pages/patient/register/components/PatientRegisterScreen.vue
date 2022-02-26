<template>
  <v-row
    row
  >
    <v-col md="4">
      <h1 class="text-h4 register-white mb-2">
        Stwórz konto pacjenta
      </h1>

      <p class="register-white mb-0">
        Wypełnij poniższy formularz i skorzystaj z możliwości jakie oferuje system SDIWPIL.
      </p>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'PatientRegisterScreen',
};
</script>

<style scoped lang="scss">
.register {
  &-white {
    color: #fff;
  }
}
</style>
