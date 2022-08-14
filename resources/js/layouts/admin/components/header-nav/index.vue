<template>
  <header class="dashboard-header">
    <section class="dashboard-header__logo" :class="{ 'is-opened': sidebar.isOpen }">
      <router-link to="/" class="dashboard-header__logo-link" exact>
        <span>ADMIN</span>
      </router-link>
    </section>
    <nav class="dashboard-header__nav" :class="{ 'is-opened': sidebar.isOpen }">
      <div class="dashboard-header__nav-left">
        <div class="sidebar-toggle header-nav-item" @click="toggleSidebar()">
          <svg-icon icon-class="bars" />
        </div>
        <ul class="header-nav">
          <li>
            <router-link class="header-nav-item" to="/" exact>
              <span v-if="user">{{ user.name || 'Admin' }}</span>
            </router-link>
          </li>
        </ul>
      </div>
      <div class="dashboard-header__nav-right">
        <ul class="header-nav">
          <li>
            <router-link class="header-nav-item d-flex align-center" :to="{ name: 'auth.profile' }" exact>
              <el-avatar class="m-r--5" size="small" icon="el-icon-user-solid"></el-avatar>
              <span>{{ $t('view.layout.profile') }}</span>
            </router-link>
          </li>
          <li>
            <a
             href="javascript:;"
             class="header-nav-item d-flex align-center"
             @click="logout"
            >
              <svg-icon class="m-r--5" icon-class="logout" />
              <span>{{ $t('view.auth.logout') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<script>
import { mapGetters } from 'vuex';
import { RESET_AUTH } from '@/store/mutation-types';
import AuthResource from '@/http/api/v1/auth';

const authResource = new AuthResource();

export default {
  name: 'HeaderNav',
  computed: {
    ...mapGetters({
      sidebar: 'app/sidebar',
      user: 'auth/user',
    }),
  },
  methods: {
    toggleSidebar() {
      this.$store.dispatch('app/toggleSidebar');
    },
    logout() {
      authResource.logout()
        .then(() => {
          this.$store.dispatch(`auth/${RESET_AUTH}`);
          this.$message({
            message: 'Logout Successfully!',
            type: 'success',
          });
          this.$router.push({ name: 'auth.login' });
        })
        .catch(() => {
          this.$message({
            message: 'Logout Failed!, Please re again',
            type: 'error',
          });
        });
    },
  },
};
</script>
