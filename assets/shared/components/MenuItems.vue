<template>
  <v-row>
    <v-col
      v-for="({ route, name }, key) in items"
      :key="key"
      cols="auto"
    >
      <v-btn
        text
        color="white"
        :href="$fosGenerate(route)"
      >
        {{ name }}
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
import { mapState } from 'vuex';
import { MENU } from '../../store/module-namespaces';

export default {
  name: 'MenuItems',
  computed: {
    ...mapState(MENU, ['items']),
  },
};
</script>

<style scoped>

</style>
