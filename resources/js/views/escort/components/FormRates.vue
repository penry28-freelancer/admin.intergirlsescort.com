<template>
  <div>
    <el-form ref="formRatesEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
      <label class="mb-1">{{ $t('form.field.currency') }}</label><br>
      <el-select v-model="form.currency" placeholder="Select" class="mb-3">
        <el-option
          v-for="item in currencies"
          :key="item.id"
          :label="item.name"
          :value="item.id"
        >
        </el-option>
      </el-select>
      <table class="table-rates w-50">
        <thead class="text-left">
          <tr>
            <th>Time</th>
            <th>Incall Rates</th>
            <th>Currency</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in escortOptions.time_rates" :key="item.label">
            <th>{{ item.label }}</th>
            <th><input v-model="form.rates[item.key]" type="text"></th>
            <th>Currency</th>
          </tr>
        </tbody>
      </table>
      <el-button-group>
        <el-button size="small" @click="store('formRatesEscort')">
          <span>Next</span>
          <i class="el-icon-arrow-right el-icon-right"></i>
        </el-button>
      </el-button-group>
    </el-form>
  </div>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import formValidateEscort from '@/utils/validates/escort-about';
import escortOptions from '@/config/escort-options';
import CurrencyResource from '@/http/api/v1/currency';

const currencyResource = new CurrencyResource();

const defaultForm = {
  currency: '',
  currencyName: '',
  rates: {
    rate_30: '',
    rate_1: '',
    rate_2: '',
    rate_3: '',
    rate_6: '',
    rate_12: '',
    rate_24: '',
    rate_48: '',
    rate_a24: '',
  },
};

export default {
  name: 'FormGalleryEscort',
  components: {
  },
  mixins: [GlobalForm],
  props: {
    data: {
      type: Object,
      default: null,
    },
  },
  data: () => ({
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
    currencies: [],
    value: '',
    escortOptions,
  }),
  computed: {
    formRules() {
      return {
        ...formValidateEscort(this),
      };
    },
  },
  watch: {
    'form.currency'(val) {
      const selectedCurrency = this.currencies.filter(i => i.id === val);
      if (selectedCurrency){
        this.form.currencyName = selectedCurrency[0].name;
      }
    },
  },
  created() {
    this.setup();
    if (this.data) {
      this.form = this.data;
    }
  },
  methods: {
    store(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.$emit('changeStep');
          this.$emit('passData', {
            modal: 'rates',
            data: this.form,
          });
          this.loading = false;
        }
      });
    },
    async setup() {
      try {
        const [currnecyRes] = await Promise.all([
          currencyResource.list(),
        ]);
        this.currencies = currnecyRes.data.data;
      } catch (err) {
        //
      }
    },
  },
};
</script>

<style scoped>
.table-rates {
  font-size: 14px;
  background: #fff;
  -webkit-box-shadow: 0 2px 7px 0 rgb(0 0 0 / 6%);
  box-shadow: 0 2px 7px 0 rgb(0 0 0 / 6%);
  margin-bottom: 20px;
  width: 100%;
}

.table-rates thead th:first-child {
    text-align: left;
    padding-left: 20px;
}
.table-rates thead th {
    background: #cb2845;
    color: #fff;
    padding: 10px 5px;
}

.table-rates tbody th {
    color: #cb2845;
    padding-left: 20px;
    min-width: 130px;
}

.table-rates tbody td, .table-rates tbody th {
    text-align: left;
    padding: 10px 5px;
    border-bottom: 1px solid #ddd;
}

</style>
