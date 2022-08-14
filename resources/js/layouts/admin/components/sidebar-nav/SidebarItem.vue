<template>
  <div class="sidebar-nav__item">
    <template
      v-if="
        hasOneShowingChild(item.children, item) &&
        (!onlyOneChild.children || onlyOneChild.noShowingChildren)
      "
    >
      <app-link :to="{ name: onlyOneChild.route }">
        <el-menu-item :index="onlyOneChild.name" :class="{ 'submenu-title-noDropdown': !isNest }">
          <item
            :icon="onlyOneChild.icon || item.icon"
            :title="onlyOneChild.name"
          />
        </el-menu-item>
      </app-link>
    </template>

    <el-submenu
      v-else
      ref="subMenu"
      :index="item.name"
      popper-append-to-body
    >
      <template slot="title">
        <item :icon="item.icon" :title="item.name" />
      </template>
      <sidebar-item
        v-for="(child, index) in item.children"
        :key="index"
        :item="child"
        :is-nest="true"
        :route-name="child.route"
        class="nest-menu"
      >
      </sidebar-item>
    </el-submenu>
  </div>
</template>

<script>
import AppLink from '@/components/AppLink';
import Item from './Item';

export default {
  name: 'SidebarItem',
  components: {
    AppLink,
    Item,
  },
  props: {
    item: {
      type: Object,
      required: true,
    },
    routeName: {
      type: String,
      default: '',
    },
    isNest: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    this.onlyOneChild = null;
    return {};
  },
  methods: {
    hasOneShowingChild(children = [], parent) {
      const showingChildren = children.filter(item => {
        if (item.hidden) {
          return false;
        } else {
          this.onlyOneChild = item;
          return true;
        }
      });

      if (showingChildren.length === 0) {
        this.onlyOneChild = { ...parent, path: '', noShowingChildren: true };
        return true;
      }

      return false;
    },
  },
};
</script>
