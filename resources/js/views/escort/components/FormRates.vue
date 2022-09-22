<template>
  <div>
    <el-form ref="formRatesEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
    <label class="mb-1">{{ $t('form.field.currency') }}</label><br>
    <el-select v-model="value" placeholder="Select" class="mb-3">
      <el-option
        v-for="item in options"
        :key="item.value"
        :label="item.label"
        :value="item.value"
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
        <tr>
          <th>Time</th>
          <th><input type="text"></th>
          <th>Currency</th>
        </tr>
        <tr>
          <th>Time</th>
          <th><input type="text"></th>
          <th>Currency</th>
        </tr>
        <tr>
          <th>Time</th>
          <th><input type="text"></th>
          <th>Currency</th>
        </tr>
      </tbody>
    </table>
  </el-form></div>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import formValidateEscort from '@/utils/validates/escort-about';
import VueUploadMultipleImage from 'vue-upload-multiple-image';

const defaultForm = {
  photos: '',
  video: null,
};

export default {
  name: 'FormGalleryEscort',
  components: {
    VueUploadMultipleImage,
  },
  mixins: [GlobalForm],
  data: () => ({
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
    tableData: [{
      date: '2016-05-03',
      name: `<el-input placeholder="Please input" v-model="input"></el-input>`,
      address: '200',
    }, {
      date: '2016-05-02',
      name: 'Tom',
      address: '200',
    }, {
      date: '2016-05-04',
      name: 'Tom',
      address: '200',
    }, {
      date: '2016-05-01',
      name: 'Tom',
      address: '200',
    }],
    options: [{
      value: 'Option1',
      label: 'Option1',
    }, {
      value: 'Option2',
      label: 'Option2',
    }, {
      value: 'Option3',
      label: 'Option3',
    }, {
      value: 'Option4',
      label: 'Option4',
    }, {
      value: 'Option5',
      label: 'Option5',
    }],
    value: '',
  }),
  computed: {
    formRules() {
      return {
        ...formValidateEscort(this),
      };
    },
  },
  watch: {
  },
  created() {
  },
  methods: {
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
