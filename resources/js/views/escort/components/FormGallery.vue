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
    <ele-upload-video
      v-model="video"
      :data="{
        token: token
      }"
      :file-size="20"
      :response-fn="handleResponse"
      style="margin: 50px"
      action="https://upload.qiniup.com/"
      @error="handleUploadError"
    />
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
import EleUploadVideo from 'vue-ele-upload-video';

const defaultForm = {
  name: '',
  country_id: null,
  city_id: null,
  perex: '',
  sex: 1,
  age: null,
  height: null,
  weight: null,
  ethnicity: null,
  hair_color: null,
  hair_lenght: null,
  bust_size: null,
  bust_type: null,
  available_for: null,
  nationality: null,
  travel: null,
  languages: [],
  tattoo: null,
  piercing: null,
  smoker: null,
  eye_color: null,
  orientation: null,
  pubic_hair: null,
  is_pornstar: null,
  verify_text: null,
  provides: null,
  website: null,
  phone1_code: null,
  phone1: null,
  phone1_whatsapp: null,
  phone1_wechat: null,
  phone1_telegram: null,
  phone1_lineapp: null,
  phone1_signal: null,
  phone1_wechatid: null,
  phone1_lineappid: null,
  phone1_telegramid: null,
  phone2_code: null,
  phone2: null,
  phone2_whatsapp: null,
  phone2_wechat: null,
  phone2_telegram: null,
  phone2_lineapp: null,
  phone2_signal: null,
  phone2_wechatid: null,
  phone2_lineappid: null,
  phone2_telegramid: null,
  geo_country_id: null,
};

export default {
  name: 'FormGalleryEscort',
  components: {
    VueUploadMultipleImage,
    EleUploadVideo,
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
    handleUploadError(error) {
      console.log('error', error);
    },
    handleResponse(response) {
      return 'https://www.xxx.com/upload/video/' + response.id;
    },
  },
};
</script>
