<template>
  <v-app dark>
    <v-main>
      <img
        src="https://img.freepik.com/premium-photo/friends-happiness-enjoying-dinning-eating-concept_53876-27582.jpg?w=1800"
        alt="" style="position: absolute; z-index: 0; width: 100%;">
      <v-container style="margin-top: 50px;">
        <Nuxt />
      </v-container>
    </v-main>


  </v-app>
</template>

<script>
export default {
  name: 'DefaultLayout',
  data() {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [
        {
          icon: 'mdi-apps',
          title: 'Welcome',
          to: '/'
        },
        {
          icon: 'mdi-chart-bubble',
          title: 'Inspire',
          to: '/inspire'
        }
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: 'Vuetify.js'
    }
  }
}
</script>
