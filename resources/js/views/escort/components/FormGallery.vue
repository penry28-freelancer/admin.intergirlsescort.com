<template>
  <el-form ref="formAboutEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
    <el-form-item :label="$t('form.field.new_photo')">
      <vue-upload-multiple-image
        id-upload="myIdUpload"
        edit-upload="myIdEdit"
        :data-images="images.gallery"
        :multiple="true"
        @upload-success="uploadImageGallery"
        @before-remove="beforeRemoveGallery"
        @edit-image="editImageGallery"
      />
    </el-form-item>
    <div class="upload-video w-25 mb-2">
      <el-upload
        class="upload-demo"
        action="https://jsonplaceholder.typicode.com/posts/"
        :on-preview="handlePreview"
        :on-remove="handleRemove"
        :before-remove="beforeRemove"
        multiple
        :limit="3"
        :on-exceed="handleExceed"
        :file-list="fileList"
>
        <el-button size="small" type="primary">{{ $t('form.field.video') }}</el-button>
        <div slot="tip" class="el-upload__tip">.mkv, .mp4, .mov files with a size less than 200Mb</div>
      </el-upload>
    </div>
    <el-button-group>
      <el-button size="small" @click="store('formAboutEscort')">
        <span>Next</span>
        <i class="el-icon-arrow-right el-icon-right"></i>
      </el-button>
    </el-button-group>
  </el-form>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import formValidateEscort from '@/utils/validates/escort-about';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import escortOptions from '@/config/escort-options';

const defaultForm = {
  photos: '',
  video: null,
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
    images: {
      gallery: [],
    },
    escortOptions,
    visible: {
      addOtherPhone: false,
    },
    token: 'xxxx',
    video: '',
    fileList: [],
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
    // upload photos
    uploadImageGallery(formData, index, fileList) {},
    beforeRemoveGallery(index, done, fileList) {
      console.log('index', index, fileList);
      const r = confirm('remove image');
      if (r === true) {
        done();
      } else {
        //
      }
    },
    editImageGallery(formData, index, fileList) {},
    // upload video
    handleRemove(file, fileList) {
      console.log(file, fileList);
    },
    handlePreview(file) {
      console.log(file);
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
