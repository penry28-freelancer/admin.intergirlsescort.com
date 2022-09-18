import Resource from '@/http/api/resource';

export default class LanguageResource extends Resource {
  constructor() {
    super('/location/language');
  }
}
