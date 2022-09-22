<template>
  <el-form ref="formAboutEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
    <label>Time zone</label><br>
    <el-select v-model="value" placeholder="Select" class="mb-2">
      <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value"></el-option>
    </el-select>
    <table id="js-table-working-time" class="table-working-time w-75">
      <thead>
        <tr>
          <th>Day</th>
          <th>From</th>
          <th>To</th>
          <th>All day</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Monday</th>
          <td>
            <input
              id="frm-formWorkingTime-days-0-from"
              type="text"
              name="days[0][from]"
            />
          </td>
          <td>
            <input
              id="frm-formWorkingTime-days-0-to"
              type="text"
              name="days[0][to]"
              class="text picker__input"
            />
          </td>
          <td>
            <label class="checkbox" for="frm-formWorkingTime-days-0-all">
              <input
                id="frm-formWorkingTime-days-0-all"
                type="checkbox"
                name="days[0][all]"
                data-lfv-initialized="true"
                data-lfv-message-id="frm-formWorkingTime-days-0-all_message"
              />
              <span class="checkmark"></span>
            </label>
            <span id="frm-formWorkingTime-days-0-all_message"></span>
          </td>
        </tr>
      </tbody>
    </table>
  </el-form>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import formValidateEscort from '@/utils/validates/escort-about';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import escortOptions from '@/config/escort-options';

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
    options: [
      {
        value: 'Option1',
        label: 'Option1',
      },
      {
        value: 'Option2',
        label: 'Option2',
      },
      {
        value: 'Option3',
        label: 'Option3',
      },
      {
        value: 'Option4',
        label: 'Option4',
      },
      {
        value: 'Option5',
        label: 'Option5',
      },
    ],
    value: '',
  }),
  computed: {
    formRules() {
      return {
        ...formValidateEscort(this),
      };
    },
  },
  watch: {},
  created() {},
  methods: {
  },
};
</script>

<style scoped>
.table-working-time {
    font-size: 14px;
    background: #fff;
    -webkit-box-shadow: 0 2px 7px 0 rgb(0 0 0 / 6%);
    box-shadow: 0 2px 7px 0 rgb(0 0 0 / 6%);
    margin-bottom: 20px;
    width: 100%;
}

.table-working-time thead th:first-child {
    text-align: left;
    padding-left: 20px;
}
.table-working-time thead th {
    background: #cb2845;
    color: #fff;
    padding: 10px 5px;
}
.table-working-time tbody th {
    padding-left: 20px;
}
.table-working-time tbody td, .table-working-time tbody th {
    text-align: left;
    padding: 10px 5px;
    border-top: 1px solid #ddd;
}
</style>
