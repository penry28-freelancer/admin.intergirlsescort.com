<template>
  <div class="page-profile">
    <table-panel>
      <template slot="title">
        <small class="text--uppercase">{{ $t('table.title.profile') }}</small>
      </template>

      <template slot="table">
        <el-tabs type="card">
          <el-tab-pane label="Basic Info">
            <el-form
              ref="formProfile"
              :model="form"
              :rules="formRules"
            >
              <el-row>
                <el-col :span="9">
                  <el-form-item required :label="$t('form.field.name')" :error="getErrorForField('name', errorsServer)" prop="name">
                    <el-input v-model="form.name" autofocus :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
                  </el-form-item>

                  <el-form-item required :label="$t('form.field.email')" :error="getErrorForField('email', errorsServer)" prop="email">
                    <el-input v-model="form.email" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.email') })" />
                  </el-form-item>

                  <el-button
                    :loading="loading.form"
                    type="primary"
                    size="small"
                    class="text--uppercase"
                    @click="updateProfile('formProfile')"
                  >
                    {{ $t('button.update') }}
                  </el-button>
                </el-col>
              </el-row>
            </el-form>
          </el-tab-pane>

          <el-tab-pane label="Change Password">
            <el-form
              ref="formPwd"
              :model="formPwd"
              :rules="formRulesPwd"
            >
              <el-row>
                <el-col :span="9">
                  <el-form-item prop="password">
                    <el-input
                      v-model="formPwd.password"
                      type="password"
                      name="password"
                      show-password
                      :placeholder="$t('form.placeholder.enter', { field: $t('field.password') })"
                      @keyup.enter.native="onLogin"
                    />
                  </el-form-item>

                  <el-form-item prop="password_confirmation">
                    <el-input
                      v-model="formPwd.password_confirmation"
                      type="password"
                      name="password_confirmation"
                      show-password
                      :placeholder="$t('form.placeholder.enter', { field: $t('field.password_confirmation') })"
                      @keyup.enter.native="onLogin"
                    />
                  </el-form-item>

                  <el-button
                    :loading="loading.form"
                    type="primary"
                    size="small"
                    class="text--uppercase"
                    @click="updatePwd('formPwd')"
                  >
                    {{ $t('button.update') }}
                  </el-button>
                </el-col>
              </el-row>
            </el-form>
          </el-tab-pane>
        </el-tabs>
      </template>
    </table-panel>
  </div>
</template>

<script>
import TablePanel from '@/components/TablePanel';
import { SET_USER } from '@/store/mutation-types';
import AuthResource from '@/http/api/v1/auth';
import UserResource from '@/http/api/v1/user';

const authResource = new AuthResource();
const userResource = new UserResource();

const defaultForm = {
  name: '',
  email: '',
};

const updatePasswordForm = {
  password: '@Happy2022',
  password_confirmation: '@Happy2022',
};

export default {
  name: 'ProfileIndex',
  components: {
    TablePanel,
  },
  layout: 'admin',
  middleware: 'auth',
  data: () => ({
    form: { ...defaultForm },
    formPwd: { ...updatePasswordForm },
    errorsServer: [],
    loading: {
      form: false,
      formPwd: false,
    },
  }),
  computed: {
    formRules() {
      return {
        name: [
          {
            required: true,
            message: this.$t('validate.required', { field: this.$t('field.email') }),
            trigger: ['change', 'blur'],
          },
          {
            max: 255,
            message: this.$t('validate.max.string', {
              field: (this.$t('form.field.name')).toLowerCase(),
              min: 255,
            }),
          },
        ],
        email: [
          {
            required: true,
            message: this.$t('validate.required', { field: this.$t('field.email') }),
            trigger: ['change', 'blur'],
          },
          {
            type: 'email',
            message: this.$t('validate.email_valid'),
            trigger: ['change', 'blur'],
          },
        ],
      };
    },
    formRulesPwd() {
      return {
        password: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('field.password'),
            }),
            trigger: 'change',
          },
          {
            validator: (rule, value, callback) => {
              let messagePassword = '';
              switch (false) {
                case /[a-z]+/.test(value):
                  messagePassword = this.$t('validate.password.lowercase', {
                    field: this.$t('field.password'),
                    number: 1,
                  });
                  break;
                case /[A-Z]+/.test(value):
                  messagePassword = this.$t('validate.password.uppercase', {
                    field: this.$t('field.password'),
                    number: 1,
                  });
                  break;
                case /[0-9]+/.test(value):
                  messagePassword = this.$t('validate.password.number', {
                    field: this.$t('field.password'),
                    number: 1,
                  });
                  break;
                case /[!@#$%^&*]+/.test(value):
                  messagePassword = this.$t('validate.password.symbols', {
                    field: this.$t('field.password'),
                    number: 1,
                  });
                  break;
              }
              if (messagePassword) {
                return callback(messagePassword);
              }
              if (this.form.password_confirmation !== '') {
                this.$refs.formPwd.validateField('password_confirmation');
              }
              callback();
            },
            trigger: 'change',
          },
          {
            min: 8,
            message: this.$t('validate.min.string', {
              field: this.$t('field.password'),
              min: 8,
            }),
            trigger: 'change',
          },
        ],
        password_confirmation: [
          {
            required: true,
            message: this.$t('validate.required', {
              field: this.$t('field.password_confirmation'),
            }),
            trigger: 'change',
          },
          {
            validator: (rule, value, callback) => {
              if (value !== this.formPwd.password) {
                callback(
                  new Error(
                    this.$t('validate.confirmed', {
                      field: this.$t('field.password_confirmation'),
                    })
                  )
                );
              } else {
                callback();
              }
            },
            trigger: ['change'],
          },
        ],
      };
    },
  },
  created() {
    this.setup();
  },
  methods: {
    async setup() {
      try {
        const userAuth = await authResource.getUserAuth();
        this.form = userAuth.data.data;
      } catch (e) {
        console.log(e.response);
      }
    },
    updateProfile(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading.form = true;
          this.errorsServer = [];
          userResource.update(this.form, this.form.id)
            .then(({ data: { data }}) => {
              this.$store.dispatch(`auth/${SET_USER}`, data);
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.user')).toLowerCase(),
                }),
                type: 'success',
              });
              this.loading.form = false;
            })
            .catch(({ response }) => {
              if (response && response.data) {
                this.pushErrorFromServer(response.data);
              }
              this.loading.form = false;
            });
        }
      });
    },
    updatePwd(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading.formPwd = true;
          this.errorsServer = [];
          userResource.updatePassword(this.formPwd, this.form.id)
            .then(() => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.user')).toLowerCase(),
                }),
                type: 'success',
              });
              this.loading.formPwd = false;
            })
            .catch(({ response }) => {
              if (response && response.data) {
                this.pushErrorFromServer(response.data);
              }
              this.loading.formPwd = false;
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
  },
};
</script>
