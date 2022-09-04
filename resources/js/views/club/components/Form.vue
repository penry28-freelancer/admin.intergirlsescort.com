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
        <el-form ref="formClub" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Input -->
          <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)" required>
            <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.club_hours')" prop="club_hours" :error="getErrorForField('club_hours', errorsServer)">
            <el-input
              v-for="item in form.club_hours"
              :key="item.id"
              :value="item.title"
              name="form.club_hours"
              >
              <el-button slot="append" icon="el-icon-remove" @click="handleClose(item.title)"></el-button>
            </el-input>
            <el-input
              v-if="inputVisible"
              ref="saveTagInput"
              v-model="inputValue"
              class="input-new-tag"
              @keyup.enter.native="handleInputConfirm"
              @blur="handleInputConfirm"
            >
            </el-input>
            <el-button v-else class="button-new-tag" size="small" @click="showInput">+ New Office Hours</el-button>
          </el-form-item>

          <el-form-item :label="$t('form.field.website_url')" prop="website_url" :error="getErrorForField('website_url', errorsServer)">
            <el-input v-model="form.website_url" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.website_url') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.phone_1')" prop="phone_1" :error="getErrorForField('phone_1', errorsServer)">
            <el-input v-model="form.phone_1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone_1') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.phone_2')" prop="phone_2" :error="getErrorForField('phone_2', errorsServer)">
            <el-input v-model="form.phone_2" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone_2') })" />
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

          <el-form-item :label="$t('form.field.address')" prop="address" :error="getErrorForField('address', errorsServer)">
            <el-input v-model="form.address" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.address') })" />
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formClub')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formClub')"
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
import ClubResource from '@/http/api/v1/club';
import CountryResource from '@/http/api/v1/country';
import CityResource from '@/http/api/v1/city';
import GlobalFormMixin from '@/plugins/mixins/GlobalForm';
import { parseTime } from '../../../utils/helpers';
const clubResource = new ClubResource();
const countryResource = new CountryResource();
const cityResource = new CityResource();
const defaultForm = {
  name: '',
  website_url: '',
  club_hours: [],
  phone_1: '',
  phone_2: '',
  country_id: null,
  city_id: null,
  address: '',
};
export default {
  name: 'FormClub',
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
        website_url: [
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.website_url'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        phone_1: [
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.phone_1'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
          },
        ],
        phone_2: [
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.phone_2'),
              min: 255,
            }),
            triggers: ['change', 'blur'],
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
        address: [
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.address'),
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
    'form.country_id': function (newVal) {
      if (newVal) {
        this.getCitiesbyCountry(newVal);
      } else {
        this.cities = [];
      }
    },
  },
  created() {
    this.dialogVisible = this.isOpened;
    this.getCountries();
    if (this.targetId) {
      this.getItem(+this.targetId);
    }
  },
  methods: {
    handleClose(title) {
      this.form.club_hours.splice(this.form.club_hours.findIndex(e => e.title === title), 1);
    },
    showInput() {
      this.inputVisible = true;
      this.$nextTick(_ => {
        this.$refs.saveTagInput.$refs.input.focus();
      });
    },
    handleInputConfirm() {
      const inputValue = this.inputValue;
      if (inputValue) {
        const club_hour = { title: inputValue, club_id: this.form.id };
        this.form.club_hours.push(club_hour);
      }
      this.inputVisible = false;
      this.inputValue = '';
    },
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
      clubResource.get(id)
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
          clubResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.club')).toLowerCase(),
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
          clubResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.club')).toLowerCase(),
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
