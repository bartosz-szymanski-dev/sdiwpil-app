<template>
  <div>
    <functions-carousel
      v-if="breakpoint.mdAndDown"
      :functions="functions"
    />
    <functions-block
      v-else
      :functions="functions"
    />
  </div>
</template>

<script>
import breakpoint from '../../../mixins/breakpoint';

import FunctionsCarousel from './functions/FunctionsCarousel';
import FunctionsBlock from './functions/FunctionsBlock';

export default {
  name: 'MainFunctions',
  components: { FunctionsCarousel, FunctionsBlock },
  mixins: [breakpoint],
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

<style scoped>

</style>
