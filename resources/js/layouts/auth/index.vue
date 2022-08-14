<template>
  <div class="layout-auth">
    <header class="auth-header">
      <div class="auth-header__inner">
        <div class="auth-header__logo">
          <h3>ADMIN MANAGEMENT</h3>
        </div>
      </div>
    </header>
    <section class="auth-body">
      <section class="auth-body__inner">
        <TargetLayout />
      </section>
    </section>
    <footer class="auth-footer">
      <div class="auth-footer__inner">
        <div class="auth-footer__logo"></div>
        <div class="auth-footer__desc"></div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'LayoutAuth',
};
</script>
<style lang="scss">
.auth {
  &-header {
    &__inner {
      padding: 40px 0;
      text-align: center;
      font-size: 1.456rem
    }
  }
  &-body {
    &__inner {
      width: 381px;
      margin: 0 auto;
      background-color: #ffffff;
      box-shadow: rgb(0 0 0 / 10%) 0px 0px 10px;
      padding: 30px 40px;
    }
  }
  &-custom {
    &--btn {
      margin-top: 12px!important;
      text-align: left!important;
      .svg-icon {
        margin-right: 10px;
      }
    }
  }
  &-action {
    &__header {
      text-align: center;
      margin-bottom: 20px;
      .title {
        color: #5e6c84;
        font-size: .9rem;
        margin-bottom: 5px;
      }
      .subtitle {
        color: #5e6c84;
        font-size: 1rem;
        margin-top: 10px;
      }
    }
  }
  &-help {
    margin-top: 25px;
    padding-top: 15px;
    border-top: 1px solid #dcdfe6;
    &__link {
      font-size: 0.9rem;
      text-align: center;
      padding: 3px 0;
      color: #0466cc;
      display: inline-block;
      cursor: pointer;
      &:hover {
        border-bottom: 1px solid #0466cc;
      }
    }
  }
}
.form-login {
  &--divider {
    color: rgb(151, 160, 175);
    display: block;
    font-size: 11px;
    line-height: 1;
    margin-top: 16px;
    text-align: center;
    text-transform: uppercase;
  }
}
</style>
