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
        <el-form ref="formEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Input -->
          <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)" required>
            <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
          </el-form-item>

          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.country_id')" prop="country_id" :error="getErrorForField('country_id', errorsServer)" required>
                <el-select v-model="form.country_id" class="w-100">
                  <el-option
                    v-for="item in countries"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.city_id')" prop="city_id" :error="getErrorForField('city_id', errorsServer)" required>
                <el-select v-model="form.city_id" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Avatar Image -->
          <el-form-item
            :label="$t('form.field.avatar')"
            prop="avatar_image"
          >
            <pan-thumb
              :image="form.avatar_image"
              :show-icon="true"
              width="212px"
              height="308px"
              @click="images.avatar.cropperShow = true"
              @clear="onClearImage('avatar')"
            />
            <image-cropper
              v-show="images.avatar.cropperShow"
              :key="images.avatar.key"
              :width="212"
              :height="308"
              :source-img-url="form.avatar_image"
              lang-type="en"
              @close="images.avatar.cropperShow = false"
              @crop-upload-success="file => onCropSuccessImage(file, 'avatar')"
            />
          </el-form-item>

          <!-- Perex Input -->
          <el-form-item :label="$t('form.field.perex')" prop="perex" :error="getErrorForField('perex', errorsServer)" required>
            <el-input v-model="form.perex" type="textarea" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.perex') })" />
          </el-form-item>

          <!-- Sex Input -->
          <el-form-item :label="$t('form.field.sex')" prop="sex" :error="getErrorForField('sex', errorsServer)" required>
            <el-radio-group v-model="form.sex">
              <el-radio :label="1">Female</el-radio>
              <el-radio :label="2">Male</el-radio>
              <el-radio :label="3">Trans</el-radio>
              <el-radio :label="4">Duo with girl</el-radio>
              <el-radio :label="5">Couple</el-radio>
            </el-radio-group>
          </el-form-item>

          <!-- Age & Height Input -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.age')" prop="age" :error="getErrorForField('age', errorsServer)" required>
                <el-select v-model="form.age" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.height')" prop="height" :error="getErrorForField('height', errorsServer)" required>
                <el-select v-model="form.height" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Weight & Ethnicity Input -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.weight')" prop="weight" :error="getErrorForField('weight', errorsServer)" required>
                <el-select v-model="form.weight" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.ethnicity')" prop="ethnicity" :error="getErrorForField('ethnicity', errorsServer)" required>
                <el-select v-model="form.ethnicity" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Hair color & Hair length Input -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.hair_color')" prop="hair_color" :error="getErrorForField('hair_color', errorsServer)" required>
                <el-select v-model="form.hair_color" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.hair_lenght')" prop="hair_lenght" :error="getErrorForField('hair_lenght', errorsServer)" required>
                <el-select v-model="form.hair_lenght" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Breast size & Breast type Input -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.bust_size')" prop="bust_size" :error="getErrorForField('bust_size', errorsServer)" required>
                <el-select v-model="form.bust_size" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.bust_type')" prop="bust_type" :error="getErrorForField('bust_type', errorsServer)" required>
                <el-select v-model="form.bust_type" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Available for & Nationality Input -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.available_for')" prop="available_for" :error="getErrorForField('available_for', errorsServer)" required>
                <el-select v-model="form.available_for" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.nationality')" prop="nationality" :error="getErrorForField('nationality', errorsServer)" required>
                <el-select v-model="form.nationality" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Travel for & Languages Input -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.travel')" prop="travel" :error="getErrorForField('travel', errorsServer)" required>
                <el-select v-model="form.travel" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.languages')" prop="languages" :error="getErrorForField('languages', errorsServer)" required>
                <el-select v-model="form.languages" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Tattoo & Piercing -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.tattoo')" prop="tattoo" :error="getErrorForField('tattoo', errorsServer)" required>
                <el-select v-model="form.tattoo" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.piercing')" prop="piercing" :error="getErrorForField('piercing', errorsServer)" required>
                <el-select v-model="form.piercing" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Smoker & Eye color -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.smoker')" prop="smoker" :error="getErrorForField('smoker', errorsServer)" required>
                <el-select v-model="form.smoker" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.eye_color')" prop="eye_color" :error="getErrorForField('eye_color', errorsServer)" required>
                <el-select v-model="form.eye_color" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Orientation & Pubic hair -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.orientation')" prop="orientation" :error="getErrorForField('orientation', errorsServer)" required>
                <el-select v-model="form.orientation" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item :label="$t('form.field.pubic_hair')" prop="pubic_hair" :error="getErrorForField('pubic_hair', errorsServer)" required>
                <el-select v-model="form.pubic_hair" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Are you pornstar? -->
          <el-row>
            <el-col :span="12">
              <el-form-item :label="$t('form.field.are_you_pornstar')" prop="is_pornstar" :error="getErrorForField('is_pornstar', errorsServer)" required>
                <el-select v-model="form.is_pornstar" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="12" />
          </el-row>

          <!-- Verify text Input -->
          <el-form-item :label="$t('form.field.verify_text')" prop="verify_text" :error="getErrorForField('verify_text', errorsServer)" required>
            <el-input v-model="form.verify_text" type="textarea" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.perex') })" />
          </el-form-item>

          <!-- Provides Input -->
          <el-form-item :label="$t('form.field.services')" prop="provides" :error="getErrorForField('provides', errorsServer)" required>
            <el-input v-model="form.provides" type="textarea" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.perex') })" />
          </el-form-item>

          <!-- Provides Input -->
          <el-form-item :label="$t('form.field.web')" prop="website" :error="getErrorForField('website', errorsServer)" required>
            <el-input v-model="form.website" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.website') })" />
          </el-form-item>

          <!-- Cellphones -->
          <label for="" class="form-label">{{ $t('form.field.cell_phone') }}</label>
          <el-row>
            <el-col :span="6">
              <el-form-item prop="phone1_code" :error="getErrorForField('phone1_code', errorsServer)" required>
                <el-select v-model="form.phone1_code" class="w-100">
                  <el-option
                    v-for="item in cities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  />
                </el-select>
              </el-form-item>
            </el-col>

            <el-col :span="18">
              <el-form-item prop="phone1" :error="getErrorForField('phone1', errorsServer)" required>
                <el-input v-model="form.phone1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone1') })" />
              </el-form-item>
            </el-col>
          </el-row>

          <el-row>
            <el-col :span="4">
              <el-form-item prop="phone1_viber" :error="getErrorForField('phone1_viber', errorsServer)" required>
                <el-checkbox v-model="form.phone1_viber">viber</el-checkbox>
              </el-form-item>
            </el-col>

            <el-col :span="4">
              <el-form-item prop="phone1_whatsapp" :error="getErrorForField('phone1_whatsapp', errorsServer)" required>
                <el-checkbox v-model="form.phone1_whatsapp">Whatsapp</el-checkbox>
              </el-form-item>
            </el-col>

            <el-col :span="4">
              <el-form-item prop="phone1_wechat" :error="getErrorForField('phone1_wechat', errorsServer)" required>
                <el-checkbox v-model="form.phone1_wechat">Wechat</el-checkbox>
              </el-form-item>
            </el-col>

            <el-col :span="4">
              <el-form-item prop="phone1_telegram" :error="getErrorForField('phone1_telegram', errorsServer)" required>
                <el-checkbox v-model="form.phone1_telegram">Telegram</el-checkbox>
              </el-form-item>
            </el-col>

            <el-col :span="4">
              <el-form-item prop="phone1_lineapp" :error="getErrorForField('phone1_lineapp', errorsServer)" required>
                <el-checkbox v-model="form.phone1_lineapp">Lineapp</el-checkbox>
              </el-form-item>
            </el-col>

            <el-col :span="4">
              <el-form-item prop="phone1_signal" :error="getErrorForField('phone1_signal', errorsServer)" required>
                <el-checkbox v-model="form.phone1_signal">Signal</el-checkbox>
              </el-form-item>
            </el-col>
          </el-row>

          <!-- Block country -->
          <el-form-item prop="geo_country_id" :error="getErrorForField('geo_country_id', errorsServer)" required>
            <el-select
              v-model="form.geo_country_id"
              multiple
              filterable
              allow-create
              default-first-option
              class="w-100"
              placeholder="Choose countries"
            >
              <el-option :value="1" label="Country 1" />
              <el-option :value="2" label="Country 2" />
              <el-option :value="3" label="Country 3" />
            </el-select>
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formEscort')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formEscort')"
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
import PanThumb from '@/components/PanThumb';
import ImageCropper from '@/components/ImageCropper';
import EscortResource from '@/http/api/v1/escort';
import GlobalForm from '@/plugins/mixins/GlobalForm';
const escortResource = new EscortResource();
const defaultForm = {
  name: '',
  country_id: null,
  city_id: null,
  avatar_image: '',
  perex: '',
  sex: 1,
};
export default {
  name: 'FormEscort',
  components: {
    PanThumb,
    ImageCropper,
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
    formData: new FormData(),
    countries: [],
    cities: [],
    images: {
      avatar: {
        cropperShow: false,
        key: 0,
      },
    },
  }),
  computed: {
    formRules() {
      return {
        name: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.name'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.name'),
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
    if (this.targetId) {
      this.getItem(+this.targetId);
    }
  },
  methods: {
    getItem(id) {
      escortResource.get(id)
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
          escortResource.store(this.form)
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
      });
    },
    update(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          escortResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.escort')).toLowerCase(),
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
    onCropSuccessImage(file, type) {
      this.formData.set(`images[${type}]`, file.file, file.name);
      this.form[`${type}_image`] = URL.createObjectURL(file.file);
      this.images[type].cropperShow = false;
      this.images[type].key += 1;
    },
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
