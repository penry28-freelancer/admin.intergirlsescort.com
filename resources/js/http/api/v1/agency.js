import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class AgencyResource extends Resource {
  constructor() {
    super('/escort/agency');
  }
  getAll() {
    return request({
      url: `${this.uri}/list/all`,
      method: 'GET',
    });
  }
}
