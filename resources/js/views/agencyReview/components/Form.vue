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
        <el-form ref="formAgencyReview" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Nickname Input -->
          <el-form-item :label="$t('form.field.nickname')" prop="nickname" :error="getErrorForField('nickname', errorsServer)" required>
            <el-input v-model="form.nickname" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.nickname') })" />
          </el-form-item>

          <!-- Agency Input -->
          <el-form-item :label="$t('form.field.agency')" prop="agency_id" :error="getErrorForField('agency_id', errorsServer)">
            <el-select
              v-model="form.agency_id"
              class="w-100"
              :placeholder="$t('form.placeholder.select', {
                field: $t('form.field.agency')
              })"
            >
              <el-option
                v-for="item in agencies"
                :key="item.id"
                :label="item.name"
                :value="item.id"
              />
            </el-select>
          </el-form-item>

          <!-- Rating Input -->
          <el-form-item :label="$t('form.field.rating')" prop="rating" :error="getErrorForField('rating', errorsServer)">
            <el-rate v-model="form.rating" />
          </el-form-item>

          <!-- Comment Input -->
          <el-form-item :label="$t('form.field.comment')" prop="comment" :error="getErrorForField('comment', errorsServer)">
            <el-input v-model="form.comment" type="textarea" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.comment') })" />
          </el-form-item>

          <!-- Verify Input -->
          <el-form-item :label="$t('form.field.verified')" prop="is_verified" :error="getErrorForField('verified', errorsServer)">
            <el-radio-group v-model="form.is_verified">
              <el-radio-button :label="1">Yes</el-radio-button>
              <el-radio-button :label="0">No</el-radio-button>
            </el-radio-group>
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formAgencyReview')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formAgencyReview')"
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
import AgencyReviewResource from '@/http/api/v1/agencyReview';
import AgencyResource from '@/http/api/v1/agency';
const agencyReviewResource = new AgencyReviewResource();
const agencyResource = new AgencyResource();

const defaultForm = {
  nickname: '',
  agency_id: null,
  rating: null,
  comment: '',
  is_verified: 0,
};
export default {
  name: 'FormAgencyReview',
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
    agencies: [],
  }),
  computed: {
    formRules() {
      return {
        nickname: [
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
        agency_id: [
          {
            type: 'number',
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('form.field.agency'),
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
  },
  created() {
    this.dialogVisible = this.isOpened;
    this.setup();
    if (this.targetId) {
      this.getItem(+this.targetId);
    }
  },
  methods: {
    async setup() {
      try {
        const { data: { data }} = await agencyResource.getAll();
        this.agencies = data;
      } catch (err) {
        // ..
      }
    },
    getItem(id) {
      agencyReviewResource.get(id)
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
          agencyReviewResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.service')).toLowerCase(),
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
          agencyReviewResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.service')).toLowerCase(),
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
