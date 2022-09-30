<template>
  <el-form ref="formAboutEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
    <!-- Name Input -->
    <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)">
      <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
    </el-form-item>

    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.country_id')" prop="country_id" :error="getErrorForField('country_id', errorsServer)">
          <el-select v-model="form.country_id" class="w-100">
            <el-option
              v-for="item in countries"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
      </el-col>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.city_id')" prop="city_id" :error="getErrorForField('city_id', errorsServer)">
          <el-select v-model="form.city_id" :disabled="!disabledCity" class="w-100">
            <el-option
              v-for="item in cities"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Profile Image -->
    <el-form-item :label="$t('form.field.profile_picture')">
      <vue-upload-multiple-image
        id-upload="myIdUpload"
        edit-upload="myIdEdit"
        :data-images="images.gallery"
        :multiple="false"
        @upload-success="uploadImageGallery"
        @before-remove="beforeRemoveGallery"
        @edit-image="editImageGallery"
      />
    </el-form-item>

    <!-- Perex Input -->
    <el-form-item :label="$t('form.field.perex')" prop="perex" :error="getErrorForField('perex', errorsServer)">
      <el-input v-model="form.perex" type="textarea" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.perex') })" />
    </el-form-item>

    <!-- Sex Input -->
    <el-form-item :label="$t('form.field.sex')" prop="sex" :error="getErrorForField('sex', errorsServer)">
      <el-radio-group v-model="form.sex">
        <el-option
          v-for="item in escortOptions.sex"
          :key="item.value"
          :label="item.label"
          :value="item.value"
        />
      </el-radio-group>
    </el-form-item>

    <!-- Age & Height Input -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.age')" prop="age" :error="getErrorForField('age', errorsServer)">
          <el-select v-model="form.age" filterable class="w-100">
            <el-option
              v-for="item in ageOptions"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.height')" prop="height" :error="getErrorForField('height', errorsServer)">
          <el-select v-model="form.height" filterable class="w-100">
            <el-option
              v-for="item in escortOptions.height"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Weight & Ethnicity Input -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.weight')" prop="weight" :error="getErrorForField('weight', errorsServer)">
          <el-select v-model="form.weight" class="w-100">
            <el-option
              v-for="item in escortOptions.weight"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.ethnicity')" prop="ethnicity" :error="getErrorForField('ethnicity', errorsServer)">
          <el-select v-model="form.ethnicity" class="w-100">
            <el-option
              v-for="item in escortOptions.ethnicity"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Hair color & Hair length Input -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.hair_color')" prop="hair_color" :error="getErrorForField('hair_color', errorsServer)">
          <el-select v-model="form.hair_color" class="w-100">
            <el-option
              v-for="item in escortOptions.hair_color"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.hair_lenght')" prop="hair_lenght" :error="getErrorForField('hair_lenght', errorsServer)">
          <el-select v-model="form.hair_lenght" class="w-100">
            <el-option
              v-for="item in escortOptions.hair_lenght"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Breast size & Breast type Input -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.bust_size')" prop="bust_size" :error="getErrorForField('bust_size', errorsServer)">
          <el-select v-model="form.bust_size" class="w-100">
            <el-option
              v-for="item in escortOptions.bust_size"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.bust_type')" prop="bust_type" :error="getErrorForField('bust_type', errorsServer)">
          <el-select v-model="form.bust_type" class="w-100">
            <el-option
              v-for="item in escortOptions.bust_type"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Available for & Nationality Input -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.available_for')" prop="available_for" :error="getErrorForField('available_for', errorsServer)">
          <el-select v-model="form.available_for" class="w-100">
            <el-option
              v-for="item in escortOptions.available_for"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.nationality')" prop="nationality" :error="getErrorForField('nationality', errorsServer)">
          <el-select v-model="form.nationality" class="w-100">
            <el-option
              v-for="item in countries"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Travel for & Languages Input -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.travel')" prop="travel" :error="getErrorForField('travel', errorsServer)">
          <el-select v-model="form.travel" class="w-100">
            <el-option
              v-for="item in escortOptions.travel"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.languages')" prop="languages" :error="getErrorForField('languages', errorsServer)">
          <el-select
            v-model="form.languages"
            class="w-100"
            multiple
            filterable
          >
            <el-option
              v-for="item in languages"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Tattoo & Piercing -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.tattoo')" prop="tattoo" :error="getErrorForField('tattoo', errorsServer)">
          <el-select v-model="form.tattoo" class="w-100">
            <el-option
              v-for="item in escortOptions.tattoo"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.piercing')" prop="piercing" :error="getErrorForField('piercing', errorsServer)">
          <el-select v-model="form.piercing" class="w-100">
            <el-option
              v-for="item in escortOptions.piercing"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Smoker & Eye color -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.smoker')" prop="smoker" :error="getErrorForField('smoker', errorsServer)">
          <el-select v-model="form.smoker" class="w-100">
            <el-option
              v-for="item in escortOptions.smoker"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.eye_color')" prop="eye_color" :error="getErrorForField('eye_color', errorsServer)">
          <el-select v-model="form.eye_color" class="w-100">
            <el-option
              v-for="item in escortOptions.eye_color"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Orientation & Pubic hair -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.orientation')" prop="orientation" :error="getErrorForField('orientation', errorsServer)">
          <el-select v-model="form.orientation" class="w-100">
            <el-option
              v-for="item in escortOptions.orientation"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12">
        <el-form-item :label="$t('form.field.pubic_hair')" prop="pubic_hair" :error="getErrorForField('pubic_hair', errorsServer)">
          <el-select v-model="form.pubic_hair" class="w-100">
            <el-option
              v-for="item in escortOptions.pubic_hair"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Are you pornstar? -->
    <el-row>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.are_you_pornstar')" prop="is_pornstar" :error="getErrorForField('is_pornstar', errorsServer)">
          <el-select v-model="form.is_pornstar" class="w-100">
            <el-option
              v-for="item in escortOptions.is_pornstar"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="12" />
    </el-row>

    <!-- Verify text Input -->
    <el-form-item :label="$t('form.field.verify_text')" prop="verify_text" :error="getErrorForField('verify_text', errorsServer)">
      <el-input v-model="form.verify_text" type="textarea" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.perex') })" />
    </el-form-item>

    <!-- Provides Input -->
    <el-form-item :label="$t('form.field.services')" prop="provides" :error="getErrorForField('provides', errorsServer)">
      <el-input v-model="form.provides" type="textarea" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.perex') })" />
    </el-form-item>

    <!-- Provides Input -->
    <el-form-item :label="$t('form.field.web')" prop="website" :error="getErrorForField('website', errorsServer)">
      <el-input v-model="form.website" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.website') })" />
    </el-form-item>

    <!-- Cellphones -->
    <label for="" class="form-label">{{ $t('form.field.cell_phone') }}</label>
    <el-row>
      <el-col :span="6">
        <el-form-item prop="phone1_code" :error="getErrorForField('phone1_code', errorsServer)">
          <el-select v-model="form.phone1_code" class="w-100">
            <el-option
              v-for="item in cities"
              :key="item.id"
              :label="item.name"
              :value="item.id"
            />
          </el-select>
        </el-form-item>
      </el-col>

      <el-col :span="18">
        <el-form-item prop="phone1" :error="getErrorForField('phone1', errorsServer)">
          <el-input v-model="form.phone1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone1') })" />
        </el-form-item>
      </el-col>
    </el-row>

    <el-row>
      <el-col :span="4">
        <el-form-item prop="phone1_viber" :error="getErrorForField('phone1_viber', errorsServer)">
          <el-checkbox v-model="form.phone1_viber">viber</el-checkbox>
        </el-form-item>
      </el-col>

      <el-col :span="4">
        <el-form-item prop="phone1_whatsapp" :error="getErrorForField('phone1_whatsapp', errorsServer)">
          <el-checkbox v-model="form.phone1_whatsapp">Whatsapp</el-checkbox>
        </el-form-item>
      </el-col>

      <el-col :span="4">
        <el-form-item prop="phone1_wechat" :error="getErrorForField('phone1_wechat', errorsServer)">
          <el-checkbox v-model="form.phone1_wechat">Wechat</el-checkbox>
        </el-form-item>
      </el-col>

      <el-col :span="4">
        <el-form-item prop="phone1_telegram" :error="getErrorForField('phone1_telegram', errorsServer)">
          <el-checkbox v-model="form.phone1_telegram">Telegram</el-checkbox>
        </el-form-item>
      </el-col>

      <el-col :span="4">
        <el-form-item prop="phone1_lineapp" :error="getErrorForField('phone1_lineapp', errorsServer)">
          <el-checkbox v-model="form.phone1_lineapp">Lineapp</el-checkbox>
        </el-form-item>
      </el-col>

      <el-col :span="4">
        <el-form-item prop="phone1_signal" :error="getErrorForField('phone1_signal', errorsServer)">
          <el-checkbox v-model="form.phone1_signal">Signal</el-checkbox>
        </el-form-item>
      </el-col>
    </el-row>

    <!-- Block country -->
    <el-form-item prop="geo_country_id" :error="getErrorForField('geo_country_id', errorsServer)">
      <el-select
        v-model="form.geo_country_id"
        multiple
        filterable
        class="w-100"
        placeholder="Choose countries"
      >
        <el-option
          v-for="item in countries"
          :key="item.id"
          :label="item.name"
          :value="item.id"
        />
      </el-select>
    </el-form-item>
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
import EscortResource from '@/http/api/v1/escort';
import CountryResource from '@/http/api/v1/country';
import CityResource from '@/http/api/v1/city';
import LanguageResource from '@/http/api/v1/language';
import formValidateEscort from '@/utils/validates/escort-about';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import escortOptions from '@/config/escort-options';
const escortResource = new EscortResource();
const countryResource = new CountryResource();
const cityResource = new CityResource();
const languageResource = new LanguageResource();

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
  phone1_telegram: null,
  phone1_lineapp: null,
  phone1_signal: null,
  phone2_code: null,
  phone2: null,
  phone2_whatsapp: null,
  phone2_telegram: null,
  phone2_lineapp: null,
  phone2_signal: null,
  geo_country_id: null,
};

export default {
  name: 'FormAboutEscort',
  components: {
    VueUploadMultipleImage,
  },
  mixins: [GlobalForm],
  data: () => ({
    form: Object.assign({}, defaultForm),
    errorsServer: [],
    loading: false,
    formData: new FormData(),
    countries: [],
    cities: [],
    languages: [],
    images: {
      gallery: [],
    },
    disabledCity: false,
    escortOptions,
  }),
  computed: {
    formRules() {
      return {
        ...formValidateEscort(this),
      };
    },
    ageOptions() {
      const ages = [];
      const currentYear = +(new Date().getFullYear());
      for (let index = (currentYear - 80); index <= (currentYear - 18); index++) {
        ages.push({
          value: index,
          label: currentYear - index,
        });
      }
      return ages.reverse();
    },
  },
  watch: {
    'isOpened': function (newVal) {
      this.dialogVisible = newVal;
    },
    'form.country_id': function (newVal) {
      if (newVal) {
        this.getCitiesbyCountry(newVal);
      } else {
        this.cities = [];
      }
    },
  },
  created() {
    this.setup();
  },
  methods: {
    async setup() {
      try {
        const [countryRes, languageRes] = await Promise.all([
          countryResource.getAll(),
          languageResource.getAll(),
        ]);
        this.countries = countryRes.data.data;
        this.languages = languageRes.data.data;
      } catch (err) {
        // ...
      }
    },
    async getCitiesbyCountry(countryId) {
      try {
        this.cities = [];
        this.disabledCity = true;
        const { data: { data }} = await cityResource.getCitiesbyCountry(countryId);
        this.cities = data;
        this.disabledCity = false;
      } catch (err) {
        // ...
      }
    },
    store(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          this.errorsServer = [];
          escortResource.store(this.form)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.created', {
                  model: (this.$t('model.escort')).toLowerCase(),
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
          escortResource.update(this.form, this.targetId)
            .then(_ => {
              this.$message({
                showClose: true,
                message: this.$t('messages.updated', {
                  model: (this.$t('model.escort')).toLowerCase(),
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
    uploadImageGallery(formData, index, fileList) {

    },
    beforeRemoveGallery(index, done, fileList) {

    },
    editImageGallery(formData, index, fileList) {

    },
  },
};
</script>
