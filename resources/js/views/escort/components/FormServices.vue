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
        <tr>
          <th>
            <label class="checkbox" for="frm-formService-services_251">
              <input
                id="frm-formService-services_251"
                type="checkbox"
              />
              <span class="checkmark"></span>
              69 position
            </label>
            <span id="frm-formService-services_251_message" class=""></span>
          </th>
          <td>
            <select
              id="frm-formService-services_included_251"
              name="services_included_251"
              style="display: none"
            >
              <option value="included" selected="selected">Included</option>
            </select>
            <div class="selectize-control js-select js-service-select single">
              <div class="selectize-input items has-options full has-items">
                <div class="item" data-value="included">Included</div>
                <input
                  id="frm-formService-services_included_251-selectized"
                  type="search"
                  style="width: 4px; opacity: 0; position: absolute; left: -10000px"
                />
              </div>
              <div
                class="selectize-dropdown single js-select js-service-select"
                style="display: none; width: 188.688px; top: 40px; left: 0px; visibility: visible"
              >
                <div class="selectize-dropdown-content">
                  <div class="option selected active" data-selectable="" data-value="included">Included</div>
                  <div class="option selected" data-selectable="" data-value="extra">Extra</div>
                </div>
              </div>
            </div>
            <span id="frm-formService-services_included_251_message" class=""></span>
          </td>
          <td>
            <input
              id="frm-formService-services_extra_251"
              type="text"
              name="services_extra_251"
            />
            <span id="frm-formService-services_extra_251_message" class=""></span>
          </td>
          <td>GBP</td>
        </tr>
      </tbody>
    </table>
  </el-form>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import formValidateEscort from '@/utils/validates/escort-about';

const defaultForm = {
  photos: '',
  video: null,
};

export default {
  name: 'FormGalleryEscort',
  components: {
  },
  mixins: [GlobalForm],
  data: () => ({
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
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
  methods: {},
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
