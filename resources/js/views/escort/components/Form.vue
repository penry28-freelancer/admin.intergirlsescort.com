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
        <form-about v-if="formStep === 0" :escort-id="escortId" :data="formData.about" @changeStep="changeStep" />
        <form-gallery v-if="formStep === 1" :escort-id="escortId" :data="formData.gallery" @changeStep="changeStep" />
        <form-rates v-if="formStep === 2" :escort-id="escortId" :data="formData.rates" @changeStep="changeStep" />
        <form-services
          v-if="formStep === 3"
          :escort-id="escortId"
          :data="formData.services"
          :currencyname="formData.rates?.currencyName"
          @changeStep="changeStep"
        />
        <form-working-time v-if="formStep === 4" :escort-id="escortId" :data="formData.workingTime" @changeStep="changeStep" />
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
import EscortResource from '@/http/api/v1/escort';
<<<<<<< HEAD
=======

>>>>>>> f51ce1810aaaa9fc0fec7a60ef8a61169c472bd8
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
      gallery: [],
      rates: null,
      services: null,
      workingTime: null,
    },
    escortId: null,
  }),
  computed: {},
  watch: {
    'isOpened': function (newVal) {
      this.dialogVisible = newVal;
    },
    // add
    formStep(val) {
      if (val === 5 && this.targetId === null) {
        this.loading = true;
        this.$message({
          showClose: true,
          message: this.$t('messages.created', {
            model: (this.$t('model.escort')).toLowerCase(),
          }),
          type: 'success',
        });
        this.dialogVisible = false;
        this.loading = false;
      } else if (val === 5 && this.targetId !== null) {
        this.loading = true;
        this.$message({
          showClose: true,
          message: this.$t('messages.updated', {
            model: (this.$t('model.escort')).toLowerCase(),
          }),
          type: 'success',
        });
        this.dialogVisible = false;
        this.loading = false;
      }
    },
  },
  created() {
    this.dialogVisible = this.isOpened;
    if (!isNaN(this.targetId)) {
      this.escortId = this.targetId;
      escortResource.get(this.targetId)
      .then(res => {
        const { escort_day, escort_language, escort_service, ...escort_about } = res.data.data;
        this.formData.about = { ...escort_about, escort_language };
        this.formData.gallery = { images: escort_about.images, video: escort_about.video };
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
        this.formData.workingTime = { escort_day, timeZone: escort_about.timezone_id };
        console.log(this.formData.workingTime);
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
    changeStep(data) {
      this.formStep++;
      if (data.escort_id) {
        this.escortId = data.escort_id;
      }
    },
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
