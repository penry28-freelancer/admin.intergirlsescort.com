import Resource from '@/http/api/resource';

export default class CountryResource extends Resource {
  constructor() {
    super('/location/country');
  }
}
