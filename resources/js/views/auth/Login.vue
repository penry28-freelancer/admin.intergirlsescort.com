<template>
  <div class="auth-action">
    <div class="auth-action__inner">
      <div class="auth-action__header">
        <p class="title">{{ $t('view.auth.login_to_continue') }}</p>
        <h3 class="subtitle">{{ $t('app.name') }}</h3>
      </div>
      <div class="auth-action__body">
        <div class="auth-action__form">
          <div class="form-login--default">
            <el-form
              ref="login"
              :model="form"
              :rules="rules"
            >
              <el-form-item prop="email">
                <el-input
                  v-model="form.email"
                  type="email"
                  name="email"
                  :placeholder="$t('form.placeholder.enter', { field: $t('form.field.email') })"
                  @keyup.enter.native="onLogin"
                />
              </el-form-item>
              <el-form-item prop="password">
                <el-input
                  v-model="form.password"
                  type="password"
                  name="password"
                  show-password
                  :placeholder="$t('form.placeholder.enter', { field: $t('form.field.password') })"
                  @keyup.enter.native="onLogin"
                />
              </el-form-item>
              <el-form-item>
                <el-checkbox v-model="form.remember_me">{{ $t('view.auth.remember_me') }}</el-checkbox>
              </el-form-item>
              <div class="auth-action__submit">
                <el-button
                  type="primary"
                  class="full-size--btn"
                  :loading="loading"
                  @click.prevent="onLogin"
                >
                  <span>{{ $t('view.auth.login_button') }}</span>
                </el-button>
              </div>
            </el-form>
          </div>
        </div>
      </div>
      <div class="auth-action__footer">
        <div class="auth-help">
          <ul>
            <li>
              <router-link class="auth-help__link" :to="{ name: 'auth.reset-password' }">
                {{ $t('view.auth.cant_login') }}
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import { fConfig } from '@/utils/helpers';
import { validPassword } from '@/utils/validate';
import { SET_TOKEN } from '@/store/mutation-types';
import AuthResource from '@/http/api/v1/auth';

const authResource = new AuthResource();

const formDefault = {
  email: '',
  password: '',
  remember_me: false,
};

export default {
  name: 'LogIn',
  layout: 'auth',
  middleware: 'guest',
  data: () => ({
    loading: false,
    form: Object.assign(formDefault, {}),
    router: {
      redirect: undefined,
      otherQuery: {},
    },
  }),
  computed: {
    rules() {
      return {
        email: [
          {
            required: true,
            message: this.$t('validate.required', { field: this.$t('form.field.email') }),
            trigger: ['change', 'blur'],
          },
          {
            type: 'email',
            message: this.$t('validate.email_valid'),
            trigger: ['change', 'blur'],
          },
        ],
        password: [
          {
            required: true,
            message: this.$t('validate.required', { field: this.$t('form.field.password') }),
            trigger: ['change', 'blur'],
          },
          {
            validator: (rule, value, callback) => {
              if (!validPassword(value)) {
                callback(new Error(this.$t('validate.password_valid')));
              } else {
                callback();
              }
            },
            trigger: ['change', 'blur'],
          },
        ],
      };
    },
  },
  watch: {
    $route: {
      handler: function (route) {
        const query = route.query;
        if (query) {
          this.router.redirect = query.redirect;
          this.router.otherQuery = this.getOtherQuery(query);
        }
      },
      immediate: true,
    },
  },
  methods: {
    ...mapActions({
      login: 'auth/login',
    }),
    onLogin() {
      this.$refs['login'].validate(valid => {
        if (valid) {
          this.loading = true;
          authResource.login(this.form)
            .then(async ({ data: { data }}) => {
              this.$store.dispatch(`auth/${SET_TOKEN}`, { ...data, remember_me: this.form.remember_me });
              await this.$router.replace({
                path: this.router.redirect || fConfig('app.redirect'),
                query: this.router.otherQuery,
              });
              this.loading = false;
              this.$notify({
                title: this.$t('messages.title.success'),
                message: this.$t('messages.login_successfully'),
                type: 'success',
                duration: 2000,
              });
            })
            .catch(() => {
              this.loading = false;
            });
        }
      });
    },
    getOtherQuery(query) {
      return Object.keys(query).reduce((acc, cur) => {
        if (cur !== 'redirect') {
          acc[cur] = query[cur];
        }
        return acc;
      }, {});
    },
  },
};
</script>

