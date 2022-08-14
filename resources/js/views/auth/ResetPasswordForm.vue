<template>
  <div class="auth-action">
    <div class="auth-action__inner">
      <div class="auth-action__header">
        <p class="title">{{ $t('view.auth.choose_new_password') }}</p>
      </div>
    </div>
    <div class="auth-action__body">
      <div class="auth-action__form">
        <div class="form-login--default">
          <el-form
            v-if="!isSuccess"
            ref="formResetPassword"
            :model="form"
            :rules="rules"
            @submit.prevent
          >
            <el-form-item prop="password">
              <el-input
                v-model="form.password"
                type="password"
                name="password"
                show-password
                :placeholder="$t('form.placeholder.enter', { field: $t('field.password') })"
                @keyup.enter.native="onSubmit"
              />
            </el-form-item>
            <div class="auth-action__submit">
              <el-button
                type="primary"
                class="full-size--btn"
                :loading="loading"
                @click.prevent="onSubmit"
              >
                <span>{{ $t('button.continue') }}</span>
              </el-button>
            </div>
          </el-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AuthResource from '@/http/api/v1/auth';
const authResource = new AuthResource();

export default {
  name: 'ResetPasswordForm',
  layout: 'auth',
  data() {
    const password = (rule, value, callback) => {
      if (value.trim().length === 0) {
        callback(
          new Error(
            this.$t('validate.required', {
              field: this.$t('field.password'),
            })
          )
        );
      } else {
        let msgPwd = '';
        switch (false) {
          case /[a-z]+/.test(value):
            msgPwd = this.$t('validate.password.lowercase', {
              field: this.$t('field.password'),
              number: 1,
            });
            break;
          case /[A-Z]+/.test(value):
            msgPwd = this.$t('validate.password.uppercase', {
              field: this.$t('field.password'),
              number: 1,
            });
            break;
          case /[0-9]+/.test(value):
            msgPwd = this.$t('validate.password.number', {
              field: this.$t('field.password'),
              number: 1,
            });
            break;
          case /[!@#$%^&*]/.test(value):
            msgPwd = this.$t('validate.password.special_character', {
              field: this.$t('field.password'),
              number: 1,
            });
            break;
        }
        if (msgPwd) {
          return callback(msgPwd);
        }
        callback();
      }
    };
    return {
      loading: false,
      form: {
        token: this.$route.params.token,
        password: '',
      },
      rules: {
        password: [
          { validator: password, trigger: ['change', 'blur'] },
          {
            min: 8,
            message: this.$t('validate.min.string', {
              attribute: this.$t('field.password'),
              min: 8,
            }),
            trigger: ['change', 'blur'],
          },
        ],
      },
    };
  },
  methods: {
    onSubmit() {
      this.$refs['formResetPassword'].validate(valid => {
        if (valid) {
          this.loading = true;
          authResource.resetPassword(this.form)
          .then(() => {
            this.$router.replace({ name: 'auth.login' });
            this.$notify({
              title: this.$t('messages.title.success'),
              message: this.$t('messages.reset_password_successfully'),
              type: 'success',
              duration: 2000,
            });
            this.loading = false;
          })
          .catch(() => {
            this.loading = false;
          });
        }
      });
    },
  },
};
</script>
