export default _self => ({
  name: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.name'),
      }),
      tiggers: ['change', 'blur'],
    },
    {
      max: 255,
      message: _self.$t('validate.max.string', {
        field: _self.$t('form.field.name'),
        min: 255,
      }),
      triggers: ['change', 'blur'],
    },
  ],
  country_id: [
    {
      type: 'number',
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.country_id'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  city_id: [
    {
      type: 'number',
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.city_id'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
});
