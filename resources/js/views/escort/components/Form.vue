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
        <form-about v-if="formStep === 0" :data="formData.about" @changeStep="changeStep" @passData="passData" />
        <form-gallery v-if="formStep === 1" @changeStep="changeStep" @passData="passData" />
        <form-rates v-if="formStep === 2" :data="formData.rates" @changeStep="changeStep" @passData="passData" />
        <form-services v-if="formStep === 3" :data="formData.services" :currencyname="formData.rates?.currencyName" @changeStep="changeStep" @passData="passData" />
        <form-working-time v-if="formStep === 4" :data="formData.workingTime" @changeStep="changeStep" @passData="passData" />
      </el-dialog>
    </div>
  </div>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
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
    // add
    formStep(val) {
      if (val === 5) {
        this.loading = true;
        this.errorsServer = [];
        escortResource.store(this.formData)
          .then(_ => {
            this.$message({
              showClose: true,
              message: this.$t('messages.created', {
                model: (this.$t('model.escort')).toLowerCase(),
              }),
              type: 'success',
            });
            this.loading = false;
            this.$emit('success');
          })
          .catch(({ response }) => {
            if (response && response.data) {
              this.pushErrorFromServer(response.data);
            }
            this.loading = false;
          });
      }
    },
  },
  created() {
    this.dialogVisible = this.isOpened;
    if (!isNaN(this.targetId)) {
      escortResource.get(this.targetId)
      .then(res => {
        const { escort_day, escort_language, escort_service, ...escort_about } = res.data.data;
        this.formData.about = { ...escort_about, escort_language };
        this.formData.rates = {
          currency: escort_about.counter_currency_id,
          currencyName: 'USD', // fix here
          rates: {
            rate_30: escort_about.rate_incall_30,
            rate_1: escort_about.rate_incall_1,
            rate_2: escort_about.rate_incall_2,
            rate_3: escort_about.rate_incall_3,
            rate_6: escort_about.rate_incall_6,
            rate_12: escort_about.rate_incall_12,
            rate_24: escort_about.rate_incall_24,
            rate_48: escort_about.rate_incall_48,
            rate_a24: escort_about.rate_incall_24_second,
          },
        };
        this.formData.services = escort_service;
        this.formData.workingTime = escort_day;
      })
      .catch(({ response }) => {
        if (response && response.data) {
          this.pushErrorFromServer(response.data);
        }
        this.loading = false;
      });
    }
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
        case 'gallery':
          this.formData.gallery = payload.data;
          break;
        case 'rates':
          this.formData.rates = payload.data;
          break;
        case 'services':
          this.formData.services = payload.data;
          break;
        case 'workingTime':
          this.formData.workingTime = payload.data;
          break;
      }
    },
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
