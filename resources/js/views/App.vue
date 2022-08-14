<template>
  <div id="app">
    <transition name="page" mode="out-in">
      <component :is="layout" v-if="layout" />
    </transition>
  </div>
</template>

<script>
import { defaultLayout } from '@/config/app';

const requireContextLayouts = require.context('@/layouts', true, /\index.vue$/);
const layouts = requireContextLayouts.keys()
  .map(file =>
    [file.replace(/(^.\/)|(\.vue$)/g, '').replace('/index', ''), requireContextLayouts(file)]
  )
  .reduce((components, [name, component]) => {
    components[name] = component.default;
    return components;
  }, {});

export default {
  el: '#app',
  data: () => ({
    layout: null,
  }),
  methods: {
    /**
     * Set the application layout
     * @param {String} layout
     */
    setLayout(layout) {
      if (!layout || !layouts[layout]) {
        layout = defaultLayout;
      }
      this.layout = layouts[layout];
    },
  },
};
</script>
