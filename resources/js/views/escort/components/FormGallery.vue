<template>
  <el-form ref="formGalleryEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
    <el-form-item :label="$t('form.field.new_photo')">
      <vue-upload-multiple-image
        prop="photos"
        :error="getErrorForField('photos', errorsServer)"
        id-upload="myIdUpload"
        edit-upload="myIdEdit"
        :data-images="form.photos"
        :multiple="true"
        @upload-success="uploadImageGallery"
        @before-remove="beforeRemoveGallery"
        @edit-image="editImageGallery"
      />
    </el-form-item>
    <div class="upload-video w-25 mb-2">
      <el-upload
        prop="videos"
        :error="getErrorForField('videos', errorsServer)"
        class="upload-demo"
        action="https://jsonplaceholder.typicode.com/posts/"
        :on-preview="handlePreview"
        :on-remove="handleRemove"
        :before-remove="beforeRemove"
        :on-change="handleChange"
        multiple
        :limit="3"
        :on-exceed="handleExceed"
        :file-list="form.videos"
      >
        <el-button size="small" type="primary">{{ $t('form.field.video') }}</el-button>
        <div slot="tip" class="el-upload__tip">.mkv, .mp4, .mov files with a size less than 200Mb</div>
      </el-upload>
    </div>
    <el-button-group>
      <el-button size="small" @click="store('formGalleryEscort')">
        <span>Next</span>
        <i class="el-icon-arrow-right el-icon-right"></i>
      </el-button>
    </el-button-group>
  </el-form>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import formValidateEscort from '@/utils/validates/escort-gallery';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import escortOptions from '@/config/escort-options';

const defaultForm = {
  photos: [],
  videos: [],
};

export default {
  name: 'FormGalleryEscort',
  components: {
    VueUploadMultipleImage,
  },
  mixins: [GlobalForm],
  data: () => ({
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
    formData: new FormData(),
    escortOptions,
    visible: {
      addOtherPhone: false,
    },
    token: 'xxxx',
    video: '',
  }),
  computed: {
    formRules() {
      return {
        ...formValidateEscort(this),
      };
    },
  },
  watch: {
  },
  created() {
  },
  methods: {
    store(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.$emit('changeStep');
          this.$emit('passData', {
            modal: 'gallery',
            data: this.form,
          });
          this.loading = false;
        }
      });
    },
    // upload photos
    uploadImageGallery(formData, index, fileList) {
      this.form.photos = fileList;
    },
    beforeRemoveGallery(index, done, fileList) {
      const r = confirm('remove image');
      if (r === true) {
        this.form.photos = fileList;
        done();
      } else {
        //
      }
    },
    editImageGallery(formData, index, fileList) {
      this.form.photos = fileList;
    },
    // upload video
    handleChange(file, fileList) {
      // this.fileList = fileList.slice(-3);
      if (fileList && fileList.length > 0) {
        this.form.videos = fileList;
      }
    },
    handleRemove(file, fileList) {
    },
    handlePreview(file) {
    },
    handleExceed(files, fileList) {
      this.$message.warning(`The limit is 3, you selected ${files.length} files this time, add up to ${files.length + fileList.length} totally`);
    },
    beforeRemove(file, fileList) {
      return this.$confirm(`Cancel the transfert of ${file.name} ?`);
    },
  },
};
</script>
