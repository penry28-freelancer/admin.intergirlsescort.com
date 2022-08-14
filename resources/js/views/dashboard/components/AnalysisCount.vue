<template>
  <section class="overview__section analysis-count">
    <div
      v-for="(item, index) in items"
      :key="index"
      class="analysis-count-box-info"
      :style="{
        flex: `0 0 ${(100 / items.length) - 0.3}%`,
        maxWidth: `${(100 / items.length) - 0.3}%`
      }"
    >
      <div
        class="analysis-count-box-info__icon"
        :style="{
          backgroundColor: `${item.bgColor}`
        }"
      >
        <svg-icon :icon-class="item.icon" />
      </div>
      <div class="analysis-count-box-info__content">
        <div class="analysis-count-box-info__content-text">{{ item.name }}</div>
        <div class="analysis-count-box-info__content-number">
          <span class="value">{{ item.value }}</span>
          <router-link :to="item.route" class="link">
            <svg-icon icon-class="send" />
          </router-link>
        </div>
        <div class="analysis-count-box-info__content-desc">{{ item.desc }}</div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AnalysisCount',
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
};
</script>
<style lang="scss">
@import "@/styles/comps/analysis-count.scss";
</style>
