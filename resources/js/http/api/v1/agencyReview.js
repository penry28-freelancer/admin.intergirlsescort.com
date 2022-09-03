import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class AgencyReviewResource extends Resource {
  constructor() {
    super('/support/agency-review');
  }
  toggleVerify(id) {
    return request({
      url: `${this.uri}/${id}/toggle-verify`,
      method: 'PATCH',
    });
  }
}
