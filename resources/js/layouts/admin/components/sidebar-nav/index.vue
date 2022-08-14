<template>
  <aside class="dashboard-sidebar h-100" :class="{ 'is-opened': sidebar.isOpen }">
    <div class="sidebar-nav h-100">
      <el-menu
        :default-active="activeMenu"
        :collapse="isCollapse"
        background-color="#0747a6"
        text-color="#ffffff"
        :unique-opened="true"
        :collapse-transition="true"
        mode="vertical"
        class="h-100"
      >
        <sidebar-item
          v-for="(sidebarItem, index) in asyncSidebarMap"
          :key="index"
          :item="sidebarItem"
          :route-name="sidebarItem.route"
        />
      </el-menu>
    </div>
  </aside>
</template>

<script>
import { mapGetters } from 'vuex';
import SidebarItem from './SidebarItem';
import sidebarMap from '@/config/sidebar-map';
import { fConfig } from '@/utils/helpers';

export default {
  name: 'SidebarNav',
  components: {
    SidebarItem,
  },
  computed: {
    ...mapGetters({
      sidebar: 'app/sidebar',
      role: 'auth/role',
      permissions: 'auth/permissions',
      user: 'auth/user',
    }),
    activeMenu() {
      const { meta, path } = this.$route;
      if (meta.activeMenu) {
        return meta.activeMenu;
      }
      return path;
    },
    isCollapse() {
      return !this.sidebar.isOpen;
    },
    asyncSidebarMap() {
      const _self = this;
      function canAccess(sidebar) {
        if (_self.role.id === fConfig('app.superAdminId')) {
          if (
            ['common', 'admin'].includes(sidebar.access) ||
            !sidebar.access
          ) {
            return true;
          } return false;
        } else {
          if (
            ['common', _self.user.access].includes(sidebar.access) ||
            !sidebar.access
          ) {
            if (sidebar.permissions) {
              if (
                sidebar.permissions.some(permission => {
                  return _self.permissions.includes(permission);
                })
              ) {
                return true;
              } return false;
            }
            return true;
          } return false;
        }
      }
      function filterDeepSidebarMap(sidebarMap) {
        const sidebarAccess = [];
        sidebarMap.forEach(sidebar => {
          const sidebarTemp = { ...sidebar };
          if (canAccess(sidebarTemp)) {
            if (sidebarTemp.children) {
              sidebarTemp.children = filterDeepSidebarMap(sidebarTemp.children);
            }
            sidebarAccess.push(sidebarTemp);
          }
        });
        return sidebarAccess;
      }

      if (this.role && this.user) {
        return filterDeepSidebarMap(sidebarMap);
      } return [];
    },
  },
};
</script>
