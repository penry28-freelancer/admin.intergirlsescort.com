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
        <el-form ref="formTour" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Input -->
          <el-form-item :label="$t('form.field.website_url')" prop="website_url" :error="getErrorForField('website_url', errorsServer)" required>
            <el-input v-model="form.website_url" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.website_url') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.banner_image')" prop="banner_image" :error="getErrorForField('banner_image', errorsServer)" required>
            <vue-upload-multiple-image
              id-upload="myIdUpload"
              edit-upload="myIdEdit"
              :data-images="banner_image"
              :multiple="false"
              @upload-success="uploadImageGallery"
              @before-remove="beforeRemoveGallery"
              @edit-image="editImageGallery"
            />
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formTour')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formTour')"
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
import ClubBannerResource from '@/http/api/v1/clubBanner';
import CountryResource from '@/http/api/v1/country';
import CityResource from '@/http/api/v1/city';
import GlobalFormMixin from '@/plugins/mixins/GlobalForm';
import { parseTime } from '../../../utils/helpers';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
const clubBannerResource = new ClubBannerResource();
const defaultForm = {
  banner_image: '',
  website_url: '',
  club_id: '',
};
export default {
  name: 'FormClubBanner',
  mixins: [GlobalFormMixin],
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
    countries: [],
    cities: [],
    disables: {
      citySelect: false,
    },
  }),
  computed: {
    formRules() {
      return {
        website_url: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.title'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.title'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
      };
    },
    VueUploadMultipleImage,
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
      clubBannerResource.get(id)
        .then(({ data: { data }}) => {
          data.start_date = parseTime(data.start_date, '{y}/{m}/{d} {h}:{i}');
          data.end_date = parseTime(data.end_date, '{y}/{m}/{d} {h}:{i}');
          data.banner_image = {
            path: data.banner_image,
            default: 1,
            highlight: 1,
            caption: 'caption to display. receive', // Optional
          };
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
          clubBannerResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.tour')).toLowerCase(),
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
    update(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          clubBannerResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.tour')).toLowerCase(),
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
    uploadImageSuccess(formData, index, fileList) {
    },
    beforeRemove(index, done, fileList) {
    },
    editImage(formData, index, fileList) {
    },
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
