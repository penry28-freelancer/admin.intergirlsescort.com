import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class ClubResource extends Resource {
  constructor() {
    super('/user/club');
  }

  getAll() {
    return request({
      url: `${this.uri}/list/all`,
      method: 'GET',
    });
  }
}
