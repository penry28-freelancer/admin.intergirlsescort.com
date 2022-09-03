import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class EscortReviewResource extends Resource {
  constructor() {
    super('/support/escort-review');
  }
  toggleVerify(id) {
    return request({
      url: `${this.uri}/${id}/toggle-verify`,
      method: 'PATCH',
    });
  }
}
