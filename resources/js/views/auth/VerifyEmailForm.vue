<template>
  <div class="auth-action">
    <div class="auth-action__inner">
      <div class="auth-action__header">
        <p class="title">{{ $t('view.auth.cant_login') }}</p>
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
            <el-form-item prop="email">
              <el-input
                v-model="form.email"
                type="email"
                name="email"
                :placeholder="$t('form.placeholder.enter', { field: $t('field.email') })"
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
                <span>{{ $t('view.auth.send_recovery_link') }}</span>
              </el-button>
            </div>
          </el-form>
          <div v-else>
            <div
              :style="{
                color: '#f00',
                background: 'url(https://aid-frontend.prod.atl-paas.net/atlassian-id/front-end/5.0.286/static/media/check-your-email-open-letter.a73949dd.svg) center bottom no-repeat',
                height: '88px',
                marginBottom: '24px'
              }"
            />
            <div
              :style="{
                textAlign: 'center',
                fontSize: '15px',
              }"
            >
              <p>{{ $t('view.auth.resend_recovery_link_success') }}</p>
              <strong>{{ form.email }}</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="auth-action__footer">
      <div class="auth-help">
        <ul>
          <li>
            <router-link class="auth-help__link" :to="{ name: 'auth.login' }">
              {{ $t('view.auth.return_to_login') }}
            </router-link>
          </li>
          <li v-if="isSuccess">
            <p class="auth-help__link" @click="isSuccess = false">
              {{ $t('view.auth.resend_recovery_link') }}
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import AuthResource from '@/http/api/v1/auth';
const authResource = new AuthResource();

const defaultForm = {
  email: 'phamdinhhung2k1.it@gmail.com',
};

export default {
  name: 'VerifyEmailForm',
  layout: 'auth',
  data: () => ({
    isSuccess: false,
    loading: false,
    form: Object.assign({}, defaultForm),
  }),
  computed: {
    rules() {
      return {
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
  },
  methods: {
    onSubmit() {
      this.$refs['formResetPassword'].validate(valid => {
        if (valid) {
          this.loading = true;
          authResource.verifyEmailResetPassword(this.form)
          .then(() => {
            this.isSuccess = true;
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
