import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class ContactResource extends Resource {
  constructor() {
    super('/support/contact');
  }

  toggleVerify(id) {
    return request({
      url: `${this.uri}/${id}/toggle-read`,
      method: 'PATCH',
    });
  }
}
