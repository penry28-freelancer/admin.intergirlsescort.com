<template>
  <!-- eslint-disable vue/require-component-is -->
  <component v-bind="linkProps(to)">
    <slot />
  </component>
</template>

<script>
import { isExternal } from '@/utils/validate';

export default {
  name: 'AppLink',
  props: {
    to: {
      type: [String, Object],
      required: true,
    },
  },
  methods: {
    linkProps(url) {
      if (isExternal(url.path)) {
        return {
          is: 'a',
          href: url,
          target: '_blank',
          rel: 'noopener',
        };
      } else {
        return {
          is: 'router-link',
          to: url,
        };
      }
    },
  },
};
</script>
