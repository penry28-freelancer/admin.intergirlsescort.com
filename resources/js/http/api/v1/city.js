import Resource from '@/http/api/resource';

export default class CityResource extends Resource {
  constructor() {
    super('/location/city');
  }
}
