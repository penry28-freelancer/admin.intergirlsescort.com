<template>
  <el-form ref="formServicesEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
    <table class="table-services w-75">
      <thead>
        <tr class="text-left">
          <th>Service</th>
          <th>Included</th>
          <th>Extra</th>
          <th>Currency</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in services" :key="item.service_id">
          <th>
            <label class="checkbox" for="frm-formService-services_251">
              <el-checkbox v-model="item.checked">{{ item.service_name }}</el-checkbox>
            </label>
          </th>
          <td>
            <el-select v-model="item.included" placeholder="Select">
              <el-option
                label="Included"
                :value="1"
              >
              </el-option>
              <el-option
                label="Extra"
                :value="0"
              >
              </el-option>
            </el-select>
          </td>
          <td>
            <el-input v-model="item.extra" :disabled="item.included == 0"></el-input>
            <span id="frm-formService-services_extra_251_message" class=""></span>
          </td>
          <td>{{ currencyname }}</td>
        </tr>
      </tbody>
    </table>
    <el-button-group>
        <el-button size="small" @click="store('formServicesEscort')">
          <span>Next</span>
          <i class="el-icon-arrow-right el-icon-right"></i>
        </el-button>
      </el-button-group>
  </el-form>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import formValidateEscort from '@/utils/validates/escort-about';
import ServiceResource from '@/http/api/v1/service';

const serviceResource = new ServiceResource();

const defaultForm = {

};

export default {
  name: 'FormGalleryEscort',
  components: {
  },
  mixins: [GlobalForm],
  props: {
    currencyname: {
      type: String,
      default: 'USD',
    },
    data: {
      type: Object,
      default: null,
    },
  },
  data: () => ({
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
    services: [],
  }),
  computed: {
    formRules() {
      return {
        ...formValidateEscort(this),
      };
    },
  },
  watch: {},
  async created() {
    await this.setup();
    if (this.data) {
      this.form = this.data;
      const result = this.services.map(item => {
        const checkitem = this.data.filter(item2 => item2.service_id === item.service_id);
        if (checkitem && checkitem.length > 0){
          return { ...item, checked: true, included: checkitem[0].is_included, extra: checkitem[0].extra_price };
        }
        return item;
      });
      this.services = result;
    }
  },
  methods: {
    async setup() {
      try {
        const [serviceRes] = await Promise.all([
          serviceResource.list(),
        ]);
        this.services = serviceRes.data.data.map(item => ({ service_id: item.id, service_name: item.name, checked: false, included: 0, extra: '' }));
        // this.form = this.services;
      } catch (err) {
        console.log('Error: ', err);
      }
    },
    store(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.$emit('changeStep');
          this.$emit('passData', {
            modal: 'services',
            data: this.services,
          });
          this.loading = false;
        }
      });
    },
  },
};
</script>

<style scoped>
.table-services {
    font-size: 14px;
    background: #fff;
    -webkit-box-shadow: 0 2px 7px 0 rgb(0 0 0 / 6%);
    box-shadow: 0 2px 7px 0 rgb(0 0 0 / 6%);
    margin-bottom: 20px;
    width: 100%;
}

.table-services thead th:first-child {
    text-align: left;
    padding-left: 20px;
}
.table-services thead th {
    background: #cb2845;
    color: #fff;
    padding: 10px 5px;
}

.table-services tbody th {
    color: #cb2845;
    padding-left: 20px;
}
.table-services tbody td, .table-services tbody th {
    text-align: left;
    padding: 10px 5px;
    border-bottom: 1px solid #ddd;
}

.form-inside .form-group .checkbox {
    background: #fff;
    display: inline-block;
    padding: 5px 10px 5px 30px;
    margin-bottom: 5px;
    border: 1px solid #ddd;
    -webkit-box-shadow: 0 2px 7px 0 rgb(0 0 0 / 6%);
    box-shadow: 0 2px 7px 0 rgb(0 0 0 / 6%);
    line-height: 19px;
}

</style>
