<template>
  <div :style="{ zIndex: zIndex, height: height, width: width }" class="pan-item">
    <el-tooltip effect="dark" :content="caption" placement="top">
      <div class="pan-info" @click="$emit('click')">
        <div class="pan-info-roles-container">
          <svg-icon v-if="showIcon && !image" class="pan-icon-upload" icon-class="upload" />
          <slot />
        </div>
      </div>
    </el-tooltip>
    <div v-if="image" class="pan-icon-remove" @click="$emit('clear')">
      <svg-icon icon-class="trash" />
    </div>
    <img v-show="image" :src="image" class="pan-thumb" :class="classImg" />
  </div>
</template>

<script>
export default {
  name: 'PanThumb',
  props: {
    image: {
      type: String,
      required: true,
    },
    zIndex: {
      type: Number,
      default: 1,
    },
    width: {
      type: String,
      default: '150px',
    },
    height: {
      type: String,
      default: '150px',
    },
    classImg: {
      type: String,
      default: '',
    },
    caption: {
      type: String,
      default: function () {
        return this.$t('form.field.pick_a_image');
      },
    },
    showIcon: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style lang="scss" scoped>
.pan-item {
  overflow: hidden;
  position: relative;
  border: 1px solid #dcdfe6;
  border-radius: 3px;
  cursor: pointer;
  background: #efefef;
}
.pan-info {
  position: absolute;
  z-index: 1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.pan-icon-upload {
  width: 3.5rem;
  height: 3.5rem;
  fill: #ffffff;
}
.pan-icon-remove {
  position: absolute;
  z-index: 2;
  top: 5px;
  right: 5px;
  padding: 4px;
  box-sizing: content-box;
  background: #ffffff54;
  border-radius: 50%;
  width: 1.2rem;
  height: 1.2rem;
  display: flex;
  justify-content: center;
  align-items: center;
  .svg-icon {
    fill: #ffffff;
    width: 1.2rem;
    height: 1.2rem;
  }
}
.pan-thumb {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>

