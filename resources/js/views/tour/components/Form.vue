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

          <el-form-item :label="$t('form.field.start_date')" prop="start_date" :error="getErrorForField('start_date', errorsServer)">
            <el-date-picker
              v-model="form.start_date"
              type="datetime"
              class="w-100"
              :rows="2"
>
            </el-date-picker>
          </el-form-item>

          <el-form-item :label="$t('form.field.end_date')" prop="end_date" :error="getErrorForField('end_date', errorsServer)">
            <el-date-picker
              v-model="form.end_date"
              type="datetime"
              class="w-100"
              :rows="2"
>
            </el-date-picker>
          </el-form-item>

          <el-form-item :label="$t('form.field.country_id')" prop="country_id" :error="getErrorForField('country_id', errorsServer)">
            <el-select v-model="form.country_id" class="w-100" @change="onChange()">
              <el-option
                v-for="item in option_countries"
                :key="item.id"
                :label="item.name"
                :value="item.id"
                >
              </el-option>
            </el-select>
          </el-form-item>

          <el-form-item :label="$t('form.field.city_id')" prop="city_id" :error="getErrorForField('city_id', errorsServer)">
            <el-select v-model="form.city_id" class="w-100">
              <el-option
                v-for="item in option_cities"
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
    option_countries: [],
    option_cities: [],
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
        // start_date: [
        //   {
        //     required: true,
        //     message: this.$t('validate.required', {
        //       field: this.$t('form.field.start_date'),
        //     }),
        //     tiggers: ['change', 'blur'],
        //   },
        // ],
        // end_date: [
        //   {
        //     required: true,
        //     message: this.$t('validate.required', {
        //       field: this.$t('form.field.end_date'),
        //     }),
        //     tiggers: ['change', 'blur'],
        //   },
        // ],
        // country_id: [
        //   {
        //     required: true,
        //     message: this.$t('validate.required', {
        //       field: this.$t('form.field.country_id'),
        //     }),
        //     tiggers: ['change', 'blur'],
        //   },
        // ],
        // city_id: [
        //   {
        //     required: true,
        //     message: this.$t('validate.required', {
        //       field: this.$t('form.field.city_id'),
        //     }),
        //     tiggers: ['change', 'blur'],
        //   },
        // ],
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
  mounted() {
    this.getCountries();
  },
  methods: {
    async getCountries() {
      try {
        const { data } = await countryResource.getAll();
        this.option_countries = data.data;
      } catch (e) {
        this.isRefresh = false;
      }
    },
    async getCitiesbyCountry(country_id) {
      try {
        const { data } = await cityResource.getCitiesbyCountry(country_id);
        this.option_cities = data.data;
      } catch (e) {
        this.isRefresh = false;
      }
    },
    onChange() {
      var country_id = this.form.country_id;
      if (country_id) {
        this.getCitiesbyCountry(country_id);
      }
    },
    getItem(id) {
      tourResource.get(id)
        .then(({ data: { data }}) => {
          this.form = data;
          this.getCitiesbyCountry(this.form.country_id);
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
    pushErrorFromServer({ message, errors }) {
      this.$message({
        showClose: true,
        message: message,
        type: 'error',
      });
      if (errors && !this.errorsServer.length) {
        for (const [key, value] of Object.entries(errors)) {
          this.errorsServer.push({ key, value });
        }
      }
    },
    getErrorForField(field, errors) {
      if (!errors && !errors.length) {
        return false;
      }
      const filtered = errors.filter(error => {
        return error.key === field;
      });
      if (filtered.length) {
        return filtered[0].value;
      }
    },
    onBeforeClose() {
      this.resetRoute();
      this.$emit('close');
    },
    resetRoute() {
      if (this.$route.query.edit) {
        this.$router.replace({
          query: {},
        });
      }
    },
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
