<template>
  <div class="form-dialog">
    <div class="form-dialog__inner">
      <el-dialog
        :title="$t('form.title.form')"
        :visible.sync="dialogVisible"
        :width="dialogSize"
        :before-close="onBeforeClose"
        @close="$emit('close')"
      >
        <el-steps :active="formStep" finish-status="success">
          <el-step title="About" />
          <el-step title="Gallery" />
          <el-step title="Rates" />
          <el-step title="Services" />
          <el-step title="Working time" />
        </el-steps>

        <!-- Form About -->
        <form-about v-if="formStep === 0" />
      </el-dialog>
    </div>
  </div>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import FormAbout from './FormAbout';

export default {
  name: 'FormEscort',
  components: {
    FormAbout,
  },
  mixins: [GlobalForm],
  props: {
    isOpened: {
      type: Boolean,
      default: false,
    },
    targetId: {
      type: Number,
      default: null,
    },
  },
  data: () => ({
    dialogSize: '1400px',
    dialogVisible: false,
    formStep: 0,
  }),
  computed: {},
  watch: {
    'isOpened': function (newVal) {
      this.dialogVisible = newVal;
    },
  },
  created() {
    this.dialogVisible = this.isOpened;
  },
  methods: {
    // ...
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
