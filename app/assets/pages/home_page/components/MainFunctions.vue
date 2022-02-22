<template>
  <v-carousel
    hide-delimiters
    light
    height="420"
  >
    <v-carousel-item
      v-for="({ title, description, image }, i) in functions"
      :key="i"
    >
      <v-card
        class="mx-auto functions-card"
        max-width="374"
      >
        <v-img
          height="250"
          :src="image"
        />

        <v-card-title>{{ title }}</v-card-title>

        <v-card-text>
          <v-row
            align="center"
            class="mx-0"
          >
            <div>{{ description }}</div>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-btn
            color="secondary"
            block
          >
            Sprawdź
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-carousel-item>
  </v-carousel>
</template>

<script>
export default {
  name: 'MainFunctions',
  data: () => ({
    functions: [
      {
        title: 'Konto pacjenta',
        description: 'Lorem ipsum',
        image: '/images/functions/patient-account.png',
      },
      {
        title: 'Konto lekarza',
        description: 'Lorem ipsum',
        image: '/images/functions/doctor-account.png',
      },
      {
        title: 'Konto recepcjonisty',
        description: 'Lorem ipsum',
        image: '/images/functions/receptionist-account.png',
      },
      {
        title: 'Konto administracji',
        description: 'Lorem ipsum',
        image: '/images/functions/management-account.png',
      },
    ],
  }),
};
</script>

<style scoped lang="scss">
.functions {
  &-card {
    border-radius: 8px;
  }
}

::v-deep .v-card__actions {
  padding: 16px;
}
</style>
