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
  // sex: [
  //   {
  //     required: true,
  //     message: _self.$t('validate.required', {
  //       field: _self.$t('form.field.sex'),
  //     }),
  //     tiggers: ['change', 'blur'],
  //   },
  // ],
  // age: [
  //   {
  //     required: true,
  //     message: _self.$t('validate.required', {
  //       field: _self.$t('form.field.age'),
  //     }),
  //     tiggers: ['change', 'blur'],
  //   },
  // ],
  // height: [
  //   {
  //     required: true,
  //     message: _self.$t('validate.required', {
  //       field: _self.$t('form.field.height'),
  //     }),
  //     tiggers: ['change', 'blur'],
  //   },
  // ],
  // weight: [
  //   {
  //     required: true,
  //     message: _self.$t('validate.required', {
  //       field: _self.$t('form.field.weight'),
  //     }),
  //     tiggers: ['change', 'blur'],
  //   },
  // ],
  ethnicity: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.ethnicity'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  hair_color: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.hair_color'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  hair_lenght: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.hair_lenght'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  bust_size: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.bust_size'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  bust_type: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.bust_type'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  available_for: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.available_for'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  // nationality: [
  //   {
  //     required: true,
  //     message: _self.$t('validate.required', {
  //       field: _self.$t('form.field.nationality'),
  //     }),
  //     tiggers: ['change', 'blur'],
  //   },
  // ],
  travel: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.travel'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  languages: [
    {
      type: 'array',
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.languages'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  tattoo: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.tattoo'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  piercing: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.piercing'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  smoker: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.smoker'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  eye_color: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.eye_color'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  orientation: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.orientation'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  pubic_hair: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.pubic_hair'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
  verify_text: [
    {
      required: true,
      message: _self.$t('validate.required', {
        field: _self.$t('form.field.verify_text'),
      }),
      tiggers: ['change', 'blur'],
    },
  ],
});
