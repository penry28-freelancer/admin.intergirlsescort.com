import { scrollTo } from '@/utils/scroll-to';

export default {
  methods: {
    scrollToError(valid, errors) {
      if (!valid) {
        if (document.getElementsByName(Object.keys(errors)[0]).length) {
          scrollTo(
            document.getElementsByName(Object.keys(errors)[0])[0].getBoundingClientRect().top -
              document.body.getBoundingClientRect().top -
              130,
            800
          );
        }
        return true;
      }
      return false;
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
        const error = filtered[0].value;
        if (Array.isArray(error)) {
          return error[0];
        }
        return error;
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
