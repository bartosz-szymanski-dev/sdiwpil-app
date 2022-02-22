<template>
  <div>
    <div class="background" />
    <v-row
      row
    >
      <v-col cols="12">
        <h1 class="text-h3 main-white mb-2">
          Witaj
        </h1>
        <p class="main-white mb-0">
          Przed tobą system wspomagający pacjenta i lekarza. Aplikacja ta została stworzona z myślą o darmowym
          rozwiązaniu usprawniającym rejestrację wizyt, korzystanie z dokumentacji pacjenta i szereg innych funkcji.
        </p>
      </v-col>
      <v-col cols="12">
        <v-btn
          class="main-btn"
          color="accent"
        >
          Zacznij korzystać z systemu
        </v-btn>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  name: 'MainScreen',
};
</script>

<style scoped lang="scss">
.background {
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 150%;
  height: 360px;
  border-radius: 0 0 50% 50%;
  background: linear-gradient(180deg, rgba(0, 206, 200, 1) 0%, rgba(53, 166, 230, 1) 100%);
  z-index: -1;
}

.main {
  &-white {
    color: #fff;
  }

  &-btn {
    overflow-wrap: anywhere;
  }
}
</style>
