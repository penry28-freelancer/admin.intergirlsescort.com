import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class ReportResource extends Resource {
  constructor() {
    super('/report/report');
  }

  toggleVerify(id) {
    return request({
      url: `${this.uri}/${id}/toggle-verify`,
      method: 'PATCH',
    });
  }
}
