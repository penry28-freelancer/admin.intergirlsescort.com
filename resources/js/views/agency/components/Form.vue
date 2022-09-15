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
        <el-form ref="formAccountAgency" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Input -->
          <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)" required>
            <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.email')" prop="email" :error="getErrorForField('email', errorsServer)" required>
            <el-input v-model="form.email" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.email') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.country_id')" prop="country_id" :error="getErrorForField('country_id', errorsServer)">
            <el-select v-model="form.country_id" class="w-100">
              <el-option
                v-for="item in countries"
                :key="item.id"
                :label="item.name"
                :value="item.id"
              >
              </el-option>
            </el-select>
          </el-form-item>

          <el-form-item :label="$t('form.field.city_id')" prop="city_id" :error="getErrorForField('city_id', errorsServer)">
            <el-select v-model="form.city_id" class="w-100" :disabled="disables.citySelect">
              <el-option
                v-for="item in cities"
                :key="item.id"
                :label="item.name"
                :value="item.id"
              >
              </el-option>
            </el-select>
          </el-form-item>

          <el-form-item v-if="!isHidden" :label="$t('form.field.password')" prop="password" :error="getErrorForField('password', errorsServer)" required>
            <el-input v-model="form.password" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.password') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.description')" prop="description" :error="getErrorForField('description', errorsServer)">
            <el-input v-model="form.description" type="textarea" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.description') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.website')" prop="website" :error="getErrorForField('website', errorsServer)" required>
            <el-input v-model="form.website" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.website') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.banner_url')" prop="banner_url" :error="getErrorForField('banner_url', errorsServer)" required>
            <el-input v-model="form.banner_url" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.banner_url') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.calling_country_id_1')" prop="calling_country_id_1" :error="getErrorForField('calling_country_id_1', errorsServer)" required>
            <el-select v-model="form.calling_country_id_1" class="w-100">
              <el-option
                v-for="item in countries"
                :key="item.id"
                :label="item.calling_code"
                :value="item.id"
              >
              </el-option>
            </el-select>
          </el-form-item>

          <el-form-item :label="$t('form.field.phone_1')" prop="phone_1" :error="getErrorForField('phone_1', errorsServer)" required>
            <el-input v-model="form.phone_1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone_1') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.is_viber_1')" prop="is_viber_1" :error="getErrorForField('is_viber_1', errorsServer)">
            <el-checkbox v-model="form.is_viber_1" :label="false">Viber 1</el-checkbox>
          </el-form-item>

          <el-form-item :label="$t('form.field.is_whatsapp_1')" prop="is_whatsapp_1" :error="getErrorForField('is_whatsapp_1', errorsServer)">
            <el-checkbox v-model="form.is_whatsapp_1" :label="false">Whatsapp 1</el-checkbox>
          </el-form-item>

          <el-form-item :label="$t('form.field.is_signal_1')" prop="is_signal_1" :error="getErrorForField('is_signal_1', errorsServer)">
            <el-checkbox v-model="form.is_signal_1" :label="false">Signal 1</el-checkbox>
          </el-form-item>

          <el-form-item :label="$t('form.field.wechat_1')" prop="wechat_1" :error="getErrorForField('wechat_1', errorsServer)">
            <el-input v-model="form.wechat_1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.wechat_1') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.telegram_1')" prop="telegram_1" :error="getErrorForField('telegram_1', errorsServer)">
            <el-input v-model="form.telegram_1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.telegram_1') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.line_1')" prop="line_1" :error="getErrorForField('line_1', errorsServer)">
            <el-input v-model="form.line_1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.line_1') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.calling_country_id_2')" prop="calling_country_id_2" :error="getErrorForField('calling_country_id_2', errorsServer)">
            <el-select v-model="form.calling_country_id_2" class="w-100">
              <el-option
                v-for="item in countries"
                :key="item.id"
                :label="item.calling_code"
                :value="item.id"
              >
              </el-option>
            </el-select>
          </el-form-item>

          <el-form-item :label="$t('form.field.phone_2')" prop="phone_2" :error="getErrorForField('phone_2', errorsServer)">
            <el-input v-model="form.phone_2" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone_2') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.is_viber_2')" prop="is_viber_2" :error="getErrorForField('is_viber_2', errorsServer)">
            <el-checkbox v-model="form.is_viber_2" :label="false">Viber 2</el-checkbox>
          </el-form-item>

          <el-form-item :label="$t('form.field.is_whatsapp_2')" prop="is_whatsapp_2" :error="getErrorForField('is_whatsapp_2', errorsServer)">
            <el-checkbox v-model="form.is_whatsapp_2" :label="false">Whatsapp 2</el-checkbox>
          </el-form-item>

          <el-form-item :label="$t('form.field.is_signal_2')" prop="is_signal_2" :error="getErrorForField('is_signal_2', errorsServer)">
            <el-checkbox v-model="form.is_signal_2" :label="false">Signal 2</el-checkbox>
          </el-form-item>

          <el-form-item :label="$t('form.field.wechat_2')" prop="wechat_2" :error="getErrorForField('wechat_2', errorsServer)">
            <el-input v-model="form.wechat_2" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.wechat_2') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.telegram_2')" prop="telegram_2" :error="getErrorForField('telegram_2', errorsServer)">
            <el-input v-model="form.telegram_2" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.telegram_2') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.line_2')" prop="line_2" :error="getErrorForField('line_2', errorsServer)">
            <el-input v-model="form.line_2" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.line_2') })" />
          </el-form-item>
          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formAccountAgency')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formAccountAgency')"
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
import AgencyResource from '@/http/api/v1/agency';
import CountryResource from '@/http/api/v1/country';
import CityResource from '@/http/api/v1/city';
import GlobalFormMixin from '@/plugins/mixins/GlobalForm';
import { parseTime } from '@/utils/helpers';
import { validURL } from '@/utils/validate';
import { validPhone } from '@/utils/validate';
const agencyResource = new AgencyResource();
const countryResource = new CountryResource();
const cityResource = new CityResource();
const defaultForm = {
  name: '',
  email: '',
  country_id: null,
  city_id: null,
  password: '',
  description: '',
  website: '',
  calling_country_id_1: '',
  phone_1: '',
  is_viber_1: false,
  is_whatsapp_1: false,
  wechat_1: '',
  telegram_1: '',
  line_1: '',
  is_signal_1: false,
  calling_country_id_2: '',
  phone_2: '',
  is_viber_2: false,
  is_whatsapp_2: false,
  wechat_2: '',
  telegram_2: '',
  line_2: '',
  is_signal_2: false,
  banner_url: '',
  is_vetified: 0,
  email_verified_at: null,
};
export default {
  name: 'FormAccountAgency',
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
    inputVisible: false,
    inputValue: '',
    disables: {
      citySelect: false,
    },
    isHidden: false,
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
        email: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.email'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            email_valid: true,
            message: this.$t('validate.email_valid', {
              field: this.$t('form.field.email'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
        country_id: [
          {
            type: 'number',
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.country_id'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
        city_id: [
          {
            type: 'number',
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.city_id'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
        password: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.password'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            max: 30,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.password'),
              min: 30,
            }),
            triggers: ['change', 'blur'],
          },
          {
            min: 8,
            message: this.$t('validate.min.string', {
              field: this.$t('form.field.password'),
              min: 8,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        website: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.website'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.website'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        banner_url: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.banner_url'),
            }),
            tiggers: ['change', 'blur'],
          },
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.banner_url'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        calling_country_id_1: [
          {
            type: 'number',
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.calling_country_id_1'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
        phone_1: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.phone_1'),
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
    'form.country_id': function (newVal) {
      if (newVal) {
        this.getCitiesbyCountry(newVal);
      } else {
        this.cities = [];
      }
    },
  },
  created() {
    this.isHidden = false;
    this.dialogVisible = this.isOpened;
    this.getCountries();
    if (this.targetId) {
      this.isHidden = true;
      this.getItem(+this.targetId);
    }
  },
  methods: {
    async getCountries() {
      try {
        const { data: { data }} = await countryResource.getAll();
        this.countries = data;
      } catch (e) {
        // ...
      }
    },
    async getCitiesbyCountry(countryId) {
      try {
        this.cities = [];
        this.disables.citySelect = true;
        const { data: { data }} = await cityResource.getCitiesbyCountry(countryId);
        this.cities = data;
        this.disables.citySelect = false;
      } catch (e) {
        // ...
      }
    },
    getItem(id) {
      agencyResource.get(id)
        .then(({ data: { data }}) => {
          data.is_viber_1 = !!data.is_viber_1;
          data.is_whatsapp_1 = !!data.is_whatsapp_1;
          data.is_signal_1 = !!data.is_signal_1;
          data.is_viber_2 = !!data.is_viber_2;
          data.is_whatsapp_2 = !!data.is_whatsapp_2;
          data.is_signal_2 = !!data.is_signal_2;
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
          agencyResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.account_agency')).toLowerCase(),
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
          agencyResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.account_agency')).toLowerCase(),
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
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
