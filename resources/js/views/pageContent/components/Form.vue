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
        <el-form ref="formPageContent" :loading="true" :model="form" :rules="formRules" label-position="top">
          <!-- Name Title -->
          <el-form-item :label="$t('form.field.title')" prop="title" :error="getErrorForField('title', errorsServer)" required>
            <el-input v-model="form.title" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.title') })" />
          </el-form-item>

          <!-- Content Input -->
          <el-form-item :label="$t('form.field.content')" :error="getErrorForField('content', errorsServer)" prop="content">
            <Tinymce
              ref="content"
              v-model="form.content"
              menubar=""
              :has-upload="false"
              :toolbar="['bold italic underline alignleft aligncenter alignright undo redo codesample hr bullist numlist link preview pagebreak forecolor backcolor fullscreen']"
              :height="200"
            />
            <el-input v-model="form.content" class="d-none" />
          </el-form-item>

          <!-- Button form -->
          <el-form-item class="d-flex justify-end m-b--0">
            <el-button
              v-if="!$route.query.edit"
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="store('formPageContent')"
            >
              {{ $t('button.create') }}
            </el-button>
            <el-button
              v-else
              :loading="loading"
              type="primary"
              size="small"
              class="text--uppercase"
              @click="update('formPageContent')"
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
import GlobalForm from '@/plugins/mixins/GlobalForm';
import Tinymce from '@/components/Tinymce';
import PageContentResource from '@/http/api/v1/pageContent';
const pageContentResource = new PageContentResource();
const defaultForm = {
  title: '',
  content: '',
};
export default {
  name: 'FormPageContent',
  components: {
    Tinymce,
  },
  mixins: [GlobalForm],
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
      pageContentResource.get(id)
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
          pageContentResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.page_content')).toLowerCase(),
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
          pageContentResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.page_content')).toLowerCase(),
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
  },
};
</script>

<style lang="scss">
@import "@/styles/comps/form-dialog.scss";
</style>
