<template>
  <el-form ref="formWorkingTimeEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
    <label>Time zone</label><br>
    <el-select v-model="form.timeZone" placeholder="Select" class="mb-2">
      <el-option v-for="item in timeZones" :key="item.id" :label="item.gmt + item.name" :value="item.id"></el-option>
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
        <tr v-for="item in form.days" :key="item.id">
          <th>{{ item.name }}</th>
          <td>
            <el-time-select
              v-model="item.from"
              :picker-options="{
                start: '00:00',
                step: '00:30',
                end: '23:30'
              }"
              placeholder="Select start time"
            >
            </el-time-select>
          </td>
          <td>
            <el-time-select
              v-model="item.to"
              :picker-options="{
                start: '00:00',
                step: '00:30',
                end: '23:30'
              }"
              placeholder="Select end time"
            >
            </el-time-select>
          </td>
          <td>
            <el-checkbox v-model="item.allday"></el-checkbox>
          </td>
        </tr>
      </tbody>
    </table>
    <el-button-group>
        <el-button size="small" @click="store('formWorkingTimeEscort')">
          <span>Complete</span>
          <i class="el-icon-arrow-right el-icon-right"></i>
        </el-button>
      </el-button-group>
  </el-form>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import formValidateEscort from '@/utils/validates/escort-about';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import escortOptions from '@/config/escort-options';
import TimeZoneResource from '@/http/api/v1/timezone';

const timeZoneResource = new TimeZoneResource();

const defaultForm = {
  timeZone: '',
  days: [],
};

export default {
  name: 'FormGalleryEscort',
  components: {
    VueUploadMultipleImage,
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
    timeZones: [],
  }),
  computed: {
    formRules() {
      return {
        ...formValidateEscort(this),
      };
    },
  },
  watch: {},
  created() {
    this.setup();
    this.form.days = this.data.map(item => ({ id: item.day_id, name: item.name, from: item.from, to: item.to, allday: item.all_day === 1 }));
    console.log(555, this.data);
  },
  methods: {
    async setup() {
      try {
        this.form.days = escortOptions.days.map(item => ({ ...item, from: null, to: null, allday: false }));
        const [timezoneRes] = await Promise.all([
          timeZoneResource.list(),
        ]);
        this.timeZones = timezoneRes.data.data;
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
            modal: 'workingTime',
            data: this.form,
          });
          this.loading = false;
        }
      });
    },
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
