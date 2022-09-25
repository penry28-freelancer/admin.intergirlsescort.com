import Resource from '@/http/api/resource';

export default class CountryGroupResource extends Resource {
  constructor() {
    super('/location/country-group');
  }
}
