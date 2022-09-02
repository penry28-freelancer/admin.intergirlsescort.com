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
        <el-form ref="formFaq" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Question Input -->
          <el-form-item :label="$t('form.field.question')" :error="getErrorForField('question', errorsServer)" prop="question" required>
            <Tinymce
              ref="question"
              v-model="form.question"
              menubar=""
              :has-upload="false"
              :toolbar="['bold italic underline alignleft aligncenter alignright undo redo codesample hr bullist numlist link preview pagebreak forecolor backcolor fullscreen']"
              :height="200"
            />
            <el-input v-model="form.question" class="d-none" />
          </el-form-item>

          <!-- Answer Input -->
          <el-form-item :label="$t('form.field.answer')" :error="getErrorForField('answer', errorsServer)" prop="answer" required>
            <Tinymce
              ref="answer"
              v-model="form.answer"
              menubar=""
              :has-upload="false"
              :toolbar="['bold italic underline alignleft aligncenter alignright undo redo codesample hr bullist numlist link preview pagebreak forecolor backcolor fullscreen']"
              :height="200"
            />
            <el-input v-model="form.answer" class="d-none" />
          </el-form-item>

          <!-- Type Input -->
          <el-form-item :label="$t('form.field.type')" :error="getErrorForField('type', errorsServer)" prop="type" required>
            <el-select v-model="form.type" :placeholder="$t('form.placeholder.select', { field: $t('form.field.type') })" class="w-100">
              <el-option
                v-for="typeKey in Object.keys(serverConfig.faqType.label)"
                :key="+typeKey"
                :label="serverConfig.faqType.label[+typeKey]"
                :value="+typeKey"
              />
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
              @click="store('formFaq')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formFaq')"
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
import Tinymce from '@/components/Tinymce';
import { bodyConfig } from '@/utils/helpers';
import FaqResource from '@/http/api/v1/faq';
const faqResource = new FaqResource();
const defaultForm = {
  question: '',
  answer: '',
  type: 1,
};
export default {
  name: 'FormFaq',
  components: {
    Tinymce,
  },
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
    serverConfig: {
      faqType: bodyConfig('constants')['faq_type'],
    },
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
      faqResource.get(id)
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
          faqResource.store(this.form)
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
          faqResource.update(this.form, this.targetId)
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
