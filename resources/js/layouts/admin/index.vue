<template>
  <section class="dashboard-container">
    <section class="dashboard-container__inner">
      <header-nav />
      <sidebar-nav />
      <section class="content-wrapper" :class="{ 'is-opened': sidebar.isOpen }">
        <div class="content-wrapper__inner">
          <TargetLayout />
        </div>
      </section>
    </section>
  </section>
</template>

<script>
import { HeaderNav, SidebarNav } from './components';
import { mapGetters } from 'vuex';

export default {
  name: 'LayoutDashboardAdmin',
  components: {
    HeaderNav,
    SidebarNav,
  },
  computed: {
    ...mapGetters({
      sidebar: 'app/sidebar',
    }),
  },
};
</script>
<style lang="scss">
@import "@/styles/comps/dashboard-layout.scss";
</style>
