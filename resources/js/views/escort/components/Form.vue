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
        <form-about v-if="formStep === 0" @changeStep="changeStep" @passData="passData" />
        <form-gallery v-if="formStep === 1" />
        <form-rates v-if="formStep === 2" />
        <form-services v-if="formStep === 3" />
        <form-working-time v-if="formStep === 4" />
      </el-dialog>
    </div>
  </div>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import EscortResource from '@/http/api/v1/escort';
import FormAbout from './FormAbout';
import FormGallery from './FormGallery';
import FormRates from './FormRates';
import FormServices from './FormServices';
import FormWorkingTime from './FormWorkingTime';
const escortResource = new EscortResource();

export default {
  name: 'FormEscort',
  components: {
    FormAbout,
    FormGallery,
    FormRates,
    FormServices,
    FormWorkingTime,
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
    formData: {
      about: null,
      gallery: null,
      rates: null,
      services: null,
      workingTime: null,
    },
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
    changeStep() {
      this.formStep++;
    },
    passData(payload) {
      switch (payload.modal) {
        case 'about':
          this.formData.about = payload.data;
          break;
      }
    },
    // store(form) {
    //   this.$refs[form].validate(valid => {
    //     if (valid) {
    //       this.loading = true;
    //       this.errorsServer = [];
    //       escortResource.store(this.form)
    //         .then(_ => {
    //           this.$message({
    //             showClose: true,
    //             message: this.$t('messages.created', {
    //               model: (this.$t('model.escort')).toLowerCase(),
    //             }),
    //             type: 'success',
    //           });
    //           this.loading = false;
    //           this.$emit('success');
    //         })
    //         .catch(({ response }) => {
    //           if (response && response.data) {
    //             this.pushErrorFromServer(response.data);
    //           }
    //           this.loading = false;
    //         });
    //     }
    //   });
    // },
    // update(form) {
    //   this.$refs[form].validate(valid => {
    //     if (valid) {
    //       this.loading = true;
    //       this.errorsServer = [];
    //       escortResource.update(this.form, this.targetId)
    //         .then(_ => {
    //           this.$message({
    //             showClose: true,
    //             message: this.$t('messages.updated', {
    //               model: (this.$t('model.escort')).toLowerCase(),
    //             }),
    //             type: 'success',
    //           });
    //           this.loading = false;
    //           this.resetRoute();
    //           this.$emit('success');
    //         })
    //         .catch(({ response }) => {
    //           if (response && response.data) {
    //             this.pushErrorFromServer(response.data);
    //           }
    //           this.loading = false;
    //         });
    //     }
    //   });
    // },
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
