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
          <el-form-item :label="$t('form.field.title')" prop="title" :error="getErrorForField('title', errorsServer)" required>
            <el-input v-model="form.title" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.title') })" />
          </el-form-item>

          <el-form-item :label="$t('form.field.start_date')" prop="start_date" :error="getErrorForField('start_date', errorsServer)" required>
            <el-date-picker
              v-model="form.start_date"
              placeholder="Please select start date time"
              type="datetime"
              class="w-100"
              :rows="2"
            />
          </el-form-item>

          <el-form-item :label="$t('form.field.end_date')" prop="end_date" :error="getErrorForField('end_date', errorsServer)">
            <el-date-picker
              v-model="form.end_date"
              placeholder="Please select end date time"
              type="datetime"
              class="w-100"
              :rows="2"
            />
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
import TourResource from '@/http/api/v1/tour';
import CountryResource from '@/http/api/v1/country';
import CityResource from '@/http/api/v1/city';
import GlobalFormMixin from '@/plugins/mixins/GlobalForm';
const tourResource = new TourResource();
const countryResource = new CountryResource();
const cityResource = new CityResource();
const defaultForm = {
  title: '',
  start_date: '',
  end_date: '',
  country_id: null,
  city_id: null,
};
export default {
  name: 'FormTour',
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
        title: [
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
        start_date: [
          {
            type: 'date',
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.start_date'),
            }),
            tiggers: ['change', 'blur'],
          },
        ],
        end_date: [
          {
            type: 'date',
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.end_date'),
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
      tourResource.get(id)
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
          tourResource.store(this.form)
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
          tourResource.update(this.form, this.targetId)
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
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
