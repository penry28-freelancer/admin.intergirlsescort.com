<template>
  <section class="table-panel">
    <section class="table-panel__header">
      <section class="table-panel__header-title">
        <slot name="title" />
      </section>
      <section class="table-panel__header-tools">
        <slot name="tools" />
      </section>
    </section>
    <section class="table-panel__body">
      <section class="table-panel__body-data">
        <section class="table-panel__body-btns">
          <slot name="buttons" />
        </section>
        <section class="table-panel__body-filter">
          <slot name="filters" />
        </section>
      </section>
      <section class="table-panel__body-target">
        <slot name="table" />
      </section>
    </section>
    <section class="table-panel__footer">
      <slot name="pagination" />
    </section>
  </section>
</template>

<script>
export default {
  name: 'TablePanel',
};
</script>
<style lang="scss">
@import "@/styles/comps/table-panel.scss";
</style>
