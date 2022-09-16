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
        <el-form ref="formMember" :loading="true" :model="form" :rules="formRules" label-position="top">
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

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formMember')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formMember')"
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
import MemberResource from '@/http/api/v1/member';
import CountryResource from '@/http/api/v1/country';
import CityResource from '@/http/api/v1/city';
import GlobalFormMixin from '@/plugins/mixins/GlobalForm';
import { parseTime } from '@/utils/helpers';
import { validURL } from '@/utils/validate';
import { validPhone } from '@/utils/validate';
const memberResource = new MemberResource();
const countryResource = new CountryResource();
const cityResource = new CityResource();
const defaultForm = {
  name: '',
  email: '',
  country_id: null,
  city_id: null,
  password: '',
  is_vetified: 0,
  email_verified_at: null,
};
export default {
  name: 'FormMember',
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
      memberResource.get(id)
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
          memberResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.member')).toLowerCase(),
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
          memberResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.member')).toLowerCase(),
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
