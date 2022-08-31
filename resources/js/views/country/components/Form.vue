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
        <el-form ref="formSubject" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Input -->
          <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)" required>
            <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
          </el-form-item>

          <!-- Code Input -->
          <el-form-item :label="$t('form.field.code')" prop="code" :error="getErrorForField('code', errorsServer)">
            <el-input v-model="form.code" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.code') })" />
          </el-form-item>
          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formSubject')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formSubject')"
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
// import SubjectResource from '@/http/api/v1/subject';
// const subjectResource = new SubjectResource();
const defaultForm = {
  name: '',
  code: '',
};
export default {
  name: 'FormSubject',
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
        code: [
          {
            max: 255,
            required: false,
            message: this.$t('validate.max.string', {
              field: this.$t('form.field.code'),
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
  },
  created() {
    this.dialogVisible = this.isOpened;
    if (this.targetId) {
      this.getItem(+this.targetId);
    }
  },
  methods: {
    getItem(id) {
      // subjectResource.get(id)
      //   .then(({ data: { data }}) => {
      //     this.form = data;
      //     this.$emit('open');
      //   })
      //   .catch(_ => {
      //     this.resetRoute();
      //     this.$message({
      //       showClose: true,
      //       message: this.$t('messages.cancel_action'),
      //       type: 'error',
      //     });
      //     this.$emit('close');
      //   });
    },
    store(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          // subjectResource.store(this.form)
          //   .then(_ => {
          //     this.$message({
          //       showClose: true,
          //       message: this.$t('messages.created', {
          //         model: (this.$t('model.subject')).toLowerCase(),
          //       }),
          //       type: 'success',
          //     });
          //     this.loading = false;
          //     this.$emit('success');
          //   })
          //   .catch(({ response }) => {
          //     if (response && response.data) {
          //       this.pushErrorFromServer(response.data);
          //     }
          //     this.loading = false;
          //   });
        }
      });
    },
    update(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          // subjectResource.update(this.form, this.targetId)
          //   .then(_ => {
          //     this.$message({
          //       showClose: true,
          //       message: this.$t('messages.updated', {
          //         model: (this.$t('model.subject')).toLowerCase(),
          //       }),
          //       type: 'success',
          //     });
          //     this.loading = false;
          //     this.resetRoute();
          //     this.$emit('success');
          //   })
          //   .catch(({ response }) => {
          //     if (response && response.data) {
          //       this.pushErrorFromServer(response.data);
          //     }
          //     this.loading = false;
          //   });
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
