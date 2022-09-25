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
        <el-form ref="formAdvertise" :loading="true" :model="form" :rules="formRules" label-position="top">
          <el-form-item :label="$t('form.field.banner_image')">
            <vue-upload-multiple-image
              id-upload="imgBannerId"
              edit-upload="imgBannerIdEdit"
              :data-images="images.banner"
              :multiple="true"
              @upload-success="uploadImageBanner"
              @before-remove="beforeRemoveBanner"
              @edit-image="editImageBanner"
            />
          </el-form-item>

          <!-- Link1 Input -->
          <el-form-item :label="$t('form.field.link1')" prop="link1" :error="getErrorForField('link1', errorsServer)" required>
            <el-input v-model="form.link1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.link1') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.link2')" prop="link2" :error="getErrorForField('link2', errorsServer)">
            <el-input v-model="form.link2" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.link2') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.link3')" prop="link3" :error="getErrorForField('link3', errorsServer)">
            <el-input v-model="form.link3" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.link3') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.order')" prop="order" :error="getErrorForField('order', errorsServer)">
            <el-input v-model="form.order" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.order') })" />
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formAdvertise')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formAdvertise')"
            >
              {{ $t('button.update') }}
            </el-button>
          </el-form-item>
        </el-form>
      </el-dialog>
    </div>
  </div>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import AdvertiseResource from '@/http/api/v1/advertise';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import { validURL } from '@/utils/validate';
const advertiseResource = new AdvertiseResource();
const defaultForm = {
  link1: '',
  link2: '',
  link3: '',
  order: 100,
};
export default {
  name: 'FormAdvertise',
  components: {
    VueUploadMultipleImage,
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
    dialogSize: '800px',
    dialogVisible: false,
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
    images: {
      banner: [],
    },
    formData: new FormData(),
  }),
  computed: {
    formRules() {
      return {
        link1: [
          {
            validator: (rule, value, callback) => {
              if (value && value.length && !validURL(value)) {
                callback(
                  new Error('⚠ Please enter the correct URL format')
                );
              } else {
                callback();
              }
            },
            trigger: ['change', 'blur'],
          },
        ],
        link2: [
          {
            validator: (rule, value, callback) => {
              if (value && value.length && !validURL(value)) {
                callback(
                  new Error('⚠ Please enter the correct URL format')
                );
              } else {
                callback();
              }
            },
            trigger: ['change', 'blur'],
          },
        ],
        link3: [
          {
            validator: (rule, value, callback) => {
              if (value && value.length && !validURL(value)) {
                callback(
                  new Error('⚠ Please enter the correct URL format')
                );
              } else {
                callback();
              }
            },
            trigger: ['change', 'blur'],
          },
        ],
        order: [
        {
            type: 'number',
            message: this.$t('validate.required', {
              field: this.$t('form.field.order'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
      };
    },
  },
  watch: {
    'isOpened': function (newVal) {
      this.dialogVisible = newVal;
    },
  },
  created() {
    this.dialogVisible = this.isOpened;
    if (this.targetId) {
      this.getItem(+this.targetId);
    }
  },
  methods: {
    getItem(id) {
      advertiseResource.get(id)
        .then(({ data: { data }}) => {
          this.form = data;
          this.$emit('open');
        })
        .catch(_ => {
          this.resetRoute();
          this.$message({
            showClose: true,
            message: this.$t('messages.cancel_action'),
            type: 'error',
          });
          this.$emit('close');
        });
    },
    store(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          this.appendToFormData();
          advertiseResource.store(this.formData)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.advertise')).toLowerCase(),
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
      });
    },
    appendToFormData() {
      this.formData.set('link1', this.form.link1);
      this.formData.set('link2', this.form.link2);
      this.formData.set('link3', this.form.link3);
      this.formData.set('order', this.form.order);
    },
    update(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          this.appendToFormData();
          advertiseResource.update(this.formData, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.advertise')).toLowerCase(),
                }),
                type: 'success',
              });
              this.loading = false;
              this.resetRoute();
              this.$emit('success');
            })
            .catch(({ response }) => {
              if (response && response.data) {
                this.pushErrorFromServer(response.data);
              }
              this.loading = false;
            });
        }
      });
    },
    uploadImageBanner(formData, index, fileList) {
      for (const value of formData.values()) {
        this.formData.set('images[banner]', value);
      }
    },
    beforeRemoveBanner(index, done, fileList) {
      var r = confirm('remove image');
      if (r === true) {
        done();
      }
      this.formData.delete('images[banner]');
    },
    editImageBanner(formData, index, fileList) {
      for (const value of formData.values()) {
        this.formData.set('images[banner]', value);
      }
    },
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
