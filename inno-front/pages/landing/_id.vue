<template>
  <div>
    <LandingMain :item='startup' :pilot="startup.project_stage_id >= 5" />
    <LandingInfo :item='startup' />
    <div v-if="startup.project_stage_id > 5" >
      <LandingPilot v-for="pilot in startup.pilots" :key='pilot.ok' :item='pilot' />
    </div>
    <LandingPresentation v-if="startup.project_stage_id <= 5" :item="startup" />
    <LandingContacts :item='startup'/>


  </div>
</template>

<script>
import { getStartup } from '~/api/api';
import LandingMain from '~/components/LandingMain/LandingMain.vue';
import LandingInfo from '~/components/LandingInfo.vue';
import LandingPilot from '~/components/LandingPilot/LandingPilot.vue';
import LandingContacts from '~/components/LandingContacts/LandingContacts.vue';
import LandingPresentation from '~/components/LandingPresentation.vue';
export default {
  components:{
    LandingMain,
    LandingInfo,
    LandingPilot,
    LandingContacts,
    LandingPresentation,
  },
  async asyncData({ params }) {
    const id = params.id
    const response = await getStartup(id)
    const startup = response.data
    return { startup }
  }
}
</script>

<style lang="scss" scoped>

</style>
