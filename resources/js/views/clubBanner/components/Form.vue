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
              :multiple="false"
              @upload-success="uploadImageBanner"
              @before-remove="beforeRemoveBanner"
              @edit-image="editImageBanner"
            />
          </el-form-item>

          <el-form-item :label="$t('form.field.club')" prop="club_id" :error="getErrorForField('club_id', errorsServer)">
            <el-select v-model="form.club_id" class="w-100">
              <el-option
                v-for="item in clubs"
                :key="item.id"
                :label="item.name"
                :value="item.id"
              >
              </el-option>
            </el-select>
          </el-form-item>

          <!-- Website URL Input -->
          <el-form-item :label="$t('form.field.website_url')" prop="website_url" :error="getErrorForField('website_url', errorsServer)" required>
            <el-input v-model="form.website_url" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.website_url') })" />
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
import ClubBannerResource from '@/http/api/v1/clubBanner';
import ClubResource from '@/http/api/v1/club';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
const clubBannerResource = new ClubBannerResource();
const clubResource = new ClubResource();
const defaultForm = {
  website_url: '',
  club_id: '',
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
    clubs: [],
    formData: new FormData(),
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
  },
  watch: {
    'isOpened': function (newVal) {
      this.dialogVisible = newVal;
    },
  },
  created() {
    this.dialogVisible = this.isOpened;
    this.getClub();
    if (this.targetId) {
      this.getItem(+this.targetId);
    }
  },
  methods: {
    async getClub() {
      try {
        const { data: { data }} = await clubResource.getAll();
        this.clubs = data;
      } catch (e) {
        // ...
      }
    },
    getItem(id) {
      clubBannerResource.get(id)
        .then(({ data: { data }}) => {
          this.form = data;
          this.images.banner = [
            {
              path: data.banner_image,
              default: 1,
              highlight: 1,
            },
          ];
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
          clubBannerResource.store(this.formData)
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
    update(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          this.appendToFormData();
          clubBannerResource.update(this.formData, this.targetId)
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
    appendToFormData() {
      this.formData.set('link1', this.form.link1);
      this.formData.set('link2', this.form.link2);
      this.formData.set('link3', this.form.link3);
      this.formData.set('order', this.form.order);
    },
    uploadImageBanner(formData, index, fileList) {
      for (const value of formData.values()) {
        this.formData.set('images[banner]', value);
      }
    },
    beforeRemoveBanner(index, done, fileList) {
      if (confirm('Remove image')) {
        done();
      }
      if (this.targetId) {
        this.formData.set('delete_images[banner]', 1);
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
