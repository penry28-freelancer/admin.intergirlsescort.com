<template>
  <el-form ref="formAboutEscort" :loading="true" :model="form" :rules="formRules" label-position="top">
    <!-- Name Input -->
    <el-form-item :label="$t('form.field.name')" prop="name" :error="getErrorForField('name', errorsServer)">
      <el-input v-model="form.name" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.name') })" />
    </el-form-item>

    <el-row class="row-2">
      <el-col :span="12">
        <el-form-item :label="$t('form.field.email')" prop="email" :error="getErrorForField('email', errorsServer)">
          <el-input v-model="form.email" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.email') })" />
        </el-form-item>
      </el-col>
      <el-col :span="12">
        <el-form-item :label="$t('form.field.password')" prop="password" :error="getErrorForField('password', errorsServer)">
          <el-input v-model="form.password" class="w-100" :rows="2" show-password :placeholder="$t('form.placeholder.enter', { field: $t('form.field.password') })" />
        </el-form-item>
      </el-col>
    </el-row>
    <el-row class="row-2">
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
        :data-images="form.images"
        :multiple="false"
        :show-edit="form.images.length > 0 ? false : true"
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
    <el-row class="row-2">
      <el-col :span="12">
        <el-form-item :label="$t('form.field.age')" prop="age" :error="getErrorForField('age', errorsServer)">
          <el-select v-model="form.birt_year" filterable class="w-100">
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
    <el-row class="row-2">
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
    <el-row class="row-2">
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
    <el-row class="row-2">
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
    <el-row class="row-2">
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
    <el-row class="row-2">
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
            v-model="form.language"
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
    <el-row class="row-2">
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
    <el-row class="row-2">
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
          <el-select v-model="form.eye" class="w-100">
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
    <el-row class="row-2">
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
          <el-select v-model="form.hair_pubic" class="w-100">
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
    <el-row class="row-2">
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
    <el-row class="row-2">
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
          <el-input v-model="form.phone1" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
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

    <el-form-item v-if="form.phone1_wechat" :label="$t('form.field.wechatid')" prop="phone1_wechatid" :error="getErrorForField('phone1_wechatid', errorsServer)">
      <el-input v-model="form.phone1_wechatid" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
    </el-form-item>

    <el-form-item v-if="form.phone1_telegram" :label="$t('form.field.telegramid')" prop="phone1_telegramid" :error="getErrorForField('phone1_telegramid', errorsServer)">
      <el-input v-model="form.phone1_telegramid" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
    </el-form-item>

    <el-form-item v-if="form.phone1_lineapp" :label="$t('form.field.lineappid')" prop="phone1_lineappid" :error="getErrorForField('phone1_lineappid', errorsServer)">
      <el-input v-model="form.phone1_lineappid" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
    </el-form-item>

    <template v-if="visible.addOtherPhone">
      <!-- Cellphones -->
      <label for="" class="form-label">{{ $t('form.field.cell_phone') }}</label>
      <el-row class="row-2">
        <el-col :span="6">
          <el-form-item prop="phone2_code" :error="getErrorForField('phone2_code', errorsServer)">
            <el-select v-model="form.phone2_code" class="w-100">
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
          <el-form-item prop="phone2" :error="getErrorForField('phone2', errorsServer)">
            <el-input v-model="form.phone2" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
          </el-form-item>
        </el-col>
      </el-row>

      <el-row>
        <el-col :span="4">
          <el-form-item prop="phone2_viber" :error="getErrorForField('phone2_viber', errorsServer)">
            <el-checkbox v-model="form.phone2_viber">viber</el-checkbox>
          </el-form-item>
        </el-col>

        <el-col :span="4">
          <el-form-item prop="phone2_whatsapp" :error="getErrorForField('phone2_whatsapp', errorsServer)">
            <el-checkbox v-model="form.phone2_whatsapp">Whatsapp</el-checkbox>
          </el-form-item>
        </el-col>

        <el-col :span="4">
          <el-form-item prop="phone2_wechat" :error="getErrorForField('phone2_wechat', errorsServer)">
            <el-checkbox v-model="form.phone2_wechat">Wechat</el-checkbox>
          </el-form-item>
        </el-col>

        <el-col :span="4">
          <el-form-item prop="phone2_telegram" :error="getErrorForField('phone2_telegram', errorsServer)">
            <el-checkbox v-model="form.phone2_telegram">Telegram</el-checkbox>
          </el-form-item>
        </el-col>

        <el-col :span="4">
          <el-form-item prop="phone2_lineapp" :error="getErrorForField('phone2_lineapp', errorsServer)">
            <el-checkbox v-model="form.phone2_lineapp">Lineapp</el-checkbox>
          </el-form-item>
        </el-col>

        <el-col :span="4">
          <el-form-item prop="phone2_signal" :error="getErrorForField('phone2_signal', errorsServer)">
            <el-checkbox v-model="form.phone2_signal">Signal</el-checkbox>
          </el-form-item>
        </el-col>
      </el-row>

      <el-form-item v-if="form.phone2_wechat" :label="$t('form.field.wechatid')" prop="phone2_wechatid" :error="getErrorForField('phone2_wechatid', errorsServer)">
        <el-input v-model="form.phone2_wechatid" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
      </el-form-item>

      <el-form-item v-if="form.phone2_telegram" :label="$t('form.field.telegramid')" prop="phone2_telegramid" :error="getErrorForField('phone2_telegramid', errorsServer)">
        <el-input v-model="form.phone2_telegramid" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
      </el-form-item>

      <el-form-item v-if="form.phone2_lineapp" :label="$t('form.field.lineappid')" prop="phone2_lineappid" :error="getErrorForField('phone2_lineappid', errorsServer)">
        <el-input v-model="form.phone2_lineappid" class="w-100" :rows="2" :placeholder="$t('form.placeholder.enter', { field: $t('form.field.phone') })" />
      </el-form-item>
    </template>

    <el-button
      size="small"
      :style="{ marginBottom: '20px' }"
      @click="visible.addOtherPhone = !visible.addOtherPhone"
    >
      <span>{{ visible.addOtherPhone ? 'REMOVE PHONE 2' : 'ADD ANOTHER PHONE' }}</span>
    </el-button>

    <!-- Block country -->
    <el-form-item :label="$t('form.field.block_country')" prop="geo_country_id" :error="getErrorForField('geo_country_id', errorsServer)">
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
      <el-button v-if="data == null" size="small" @click="store('formAboutEscort')">
        <span>Next</span>
        <i class="el-icon-arrow-right el-icon-right"></i>
      </el-button>
      <div v-else>
        <el-button size="small" @click="() => $emit('changeStep')">
          <span>Next</span>
          <i class="el-icon-arrow-right el-icon-right"></i>
        </el-button>
        <el-button size="small" @click="update('formAboutEscort')">
          <span>Update</span>
          <i class="el-icon-arrow-right el-icon-right"></i>
        </el-button>
      </div>
    </el-button-group>
  </el-form>
</template>

<script>
import GlobalForm from '@/plugins/mixins/GlobalForm';
import CountryResource from '@/http/api/v1/country';
import CityResource from '@/http/api/v1/city';
import LanguageResource from '@/http/api/v1/language';
import formValidateEscort from '@/utils/validates/escort-about';
import VueUploadMultipleImage from 'vue-upload-multiple-image';
import escortOptions from '@/config/escort-options';
import EscortResource from '@/http/api/v1/escort';

const escortResource = new EscortResource();
const countryResource = new CountryResource();
const cityResource = new CityResource();
const languageResource = new LanguageResource();

const defaultForm = {
  name: '',
  email: '',
  password: '',
  country_id: null,
  city_id: null,
  images: [],
  perex: '',
  sex: 1,
  birt_year: null,
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
  language: [],
  tattoo: null,
  piercing: null,
  smoker: null,
  eye: null,
  orientation: null,
  hair_pubic: null,
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
  is_edit_image: false,
};

export default {
  name: 'FormAboutEscort',
  components: {
    VueUploadMultipleImage,
  },
  mixins: [GlobalForm],
  props: {
    data: {
      type: Object,
      default: null,
    },
    escortId: {
      type: Number,
      default: null,
    },
  },
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
    visible: {
      addOtherPhone: false,
    },
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
    data(val) {
      if (val) {
        const language = val.escort_language.map(item => ({ ...item, id: item.language_id }));
        const images = val.images.filter(item => item.featured === 1);
        this.form = { ...val, name: val.accountable.name, email: val.accountable.email, language };
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
        //
      }
    },
    async getCitiesbyCountry(countryId) {
      try {
        this.cities = [];
        this.disabledCity = false;
        const { data: { data }} = await cityResource.getCitiesbyCountry(countryId);
        this.cities = data;
        this.disabledCity = true;
      } catch (err) {
        // ...
      }
    },
    store(form) {
      this.$refs[form].validate(valid => {
        if (valid) {
          this.loading = true;
          escortResource.store(this.form)
          .then(res => {
            this.$message({
              showClose: true,
              message: this.$t('messages.title.success'),
              type: 'success',
            });
            this.loading = false;
            this.$emit('changeStep', { escort_id: res.data.data.id });
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
          escortResource.update(this.form, this.escortId)
          .then(res => {
            this.$message({
              showClose: true,
              message: this.$t('messages.title.success'),
              type: 'success',
            });
            this.loading = false;
            this.$emit('changeStep');
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
      this.form.images = fileList;
      this.form.is_edit_image = true;
    },
    beforeRemoveGallery(index, done, fileList) {
      var r = confirm('remove image');
      if (r === true) {
        done();
        this.form.images = [];
      } else {
        //
      }
    },
    editImageGallery(formData, index, fileList) {
      this.form.images = fileList;
      this.form.is_edit_image = true;
    },
  },
};
</script>
