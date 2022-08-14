import request from '@/http/request';
import Resource from '@/http/api/resource';

export default class AuthResource extends Resource {
  constructor() {
    super('/admin/user');
  }

  updatePassword(resource, id) {
    return request({
      url: `${this.uri}/${id}/update-password`,
      method: 'post',
      data: resource,
    });
  }
}
