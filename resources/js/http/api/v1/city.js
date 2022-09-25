import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class CityResource extends Resource {
  constructor() {
    super('/location/city');
  }

  getCitiesbyCountry(id) {
    return request({
      url: `${this.uri}/get-cities-by-country/${id}`,
      method: 'GET',
    });
  }
}
